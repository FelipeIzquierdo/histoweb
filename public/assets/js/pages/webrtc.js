var connection = new RTCMultiConnection();
var videos_widget = [ 'invited_widget' , 'doctor_widget' ];
var roomsList = document.getElementById('rooms-list');
var number_videos = 0;
var video_element;

connection.session = 
{
    audio: true,
    video: true
};

connection.onstream = function(e) 
{
    appendVideo(e.mediaElement, e.streamid);
}

function appendVideo(video, streamid) 
{
    if( number_videos < 2 )
    {
        enableId ( 'sala' , videos_widget[ number_videos ] );
        video.width = $( '#sala' ).parent().width();    
        video_element = document.getElementById( 'sala' ) || document.body;
        number_videos = number_videos + 1;
        video = getVideo(video, streamid, video_element , number_videos );
        if ( number_videos == 2 )
        {
            $('.video_1').addClass( 'videos col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-push-8 col-sm-push-8 col-md-push-8 col-lg-push-8' );
        }
    }
}

function getVideo(video, streamid, element, number ) 
{
    var button = document.createElement('button');
    button.id = streamid;
    button.className = 'record_'+number;
    button.src = image_record;
    button.type = "image";
    button.innerHTML = 'Comenzar a grabar';

    button.onclick = function() 
    {
        this.disabled = true;
        if (this.innerHTML == 'Comenzar a grabar') {
            this.innerHTML = 'Stop Recording';
            connection.streams[this.id].startRecording({
                audio: true,
                video: true
            });
        } else {
            this.innerHTML = 'Comenzar a grabar';
            var stream = connection.streams[this.id];
            stream.stopRecording(function(blob) {
                var h2;

                if (blob.audio && !(connection.UA.Chrome && stream.type == 'remote')) {
                    h2 = document.createElement('h2');
                    h2.innerHTML = '<a href="' + URL.createObjectURL(blob.audio) + '" target="_blank">Open recorded ' + blob.audio.type + '</a>';
                    element.appendChild(h2);
                }

                if (blob.video) {
                    h2 = document.createElement('h2');
                    h2.innerHTML = '<a href="' + URL.createObjectURL(blob.video) + '" target="_blank">Open recorded ' + blob.video.type + '</a>';
                    element.appendChild(h2);
                }
            });
        }
        setTimeout(function() {
            button.disabled = false;
        }, 3000);
    };
    video.className = 'video_'+number;
    element.appendChild(button);
    element.appendChild(video);
    return element;
}

function rotateVideo(mediaElement) 
{
    mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(0deg)';
    setTimeout(function() 
    {
        mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(360deg)';
    }, 1000);
}

connection.onstreamended = function(e) 
{
    var div = e.mediaElement.parentNode;
    div.style.opacity = 0;
    rotateVideo(div);
    setTimeout(function() {
        if (div.parentNode) {
            div.parentNode.removeChild(div);
        }
    }, 1000);
};

var sessions = {};
        connection.onNewSession = function(session) {
            if (sessions[session.sessionid]) return;
            sessions[session.sessionid] = session;
            var tr = document.createElement('tr');
            tr.innerHTML = '<td><strong>' + session.extra['session-name'] + '</strong> is running a conference!</td>' +
                '<td><button class="join">Join</button></td>';
            roomsList.insertBefore(tr, roomsList.firstChild);
            var joinRoomButton = tr.querySelector('.join');
            joinRoomButton.setAttribute('data-sessionid', session.sessionid);
            joinRoomButton.onclick = function() {
                this.disabled = true;
                var sessionid = this.getAttribute('data-sessionid');
                session = sessions[sessionid];
                if (!session) throw 'No such session exists.';
                connection.join(session);
            };
        };

document.getElementById('init-conference').onclick = function() 
{
    enableId( "leave-conference" , "init-conference" );
    //connection.sessionid = room;
    connection.sessionid = (Math.random() * 999999999999).toString().replace('.', '');
    connection.extra = {
        'session-name': name || 'Anonymous'
    };
    connection.open();

};

document.getElementById('leave-conference').onclick = function() 
{
    enableId( "init-conference" , "leave-conference" );
    enableId( videos_widget[0] , "sala" );
    enableId( videos_widget[1] , "sala" );
    connection.close();
};

function enableId( enable , disabled  )
{
    $( '#'+disabled ).hide("clip");   
    $( '#'+enable ).show("clip");   
}

// setup signaling to search existing sessions
connection.connect();
