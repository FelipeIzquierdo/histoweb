var connection = new RTCMultiConnection();
var videos_id =  [ 'video-home' , 'video-visit' ];
var videos_widget = [ 'invited_widget' , 'doctor_widget' ];
var roomsList = document.getElementById('rooms-list');
var number_videos = 0;
var video_element;

connection.session = {
    audio: true,
    video: true
};

connection.onstream = function(e) {

    if ( number_videos == 1 )
    {
        var element_ant = $( '#'+videos_id[ (number_videos - 1 )] );
        element_ant.parent().removeAttr('class').attr('class', 'col-md-2').animate({ width: "10%", },2000);  
        element_ant.children().find( "video" ).attr('width', element_ant.parent().width() ); 
    }

    if( number_videos < 2 )
    {
        appendVideo(e.mediaElement, e.streamid);
    }

}

function appendVideo(video, streamid) {
    video.width = $( '#'+videos_id[ number_videos ] ).parent().width();    
    video_element = document.getElementById( videos_id[ number_videos ] ) || document.body;
    enableId ( videos_id[ number_videos ] , videos_widget[ number_videos ] );
    video = getVideo(video, streamid);
    video_element.insertBefore(video, video_element.firstChild);
    rotateVideo(video);
    number_videos = number_videos + 1;
    document.getElementById('leave-conference').disabled = false;
    
}

function getVideo(video, streamid) {
    var div = document.createElement('div');
    div.className = 'video1';

    var button = document.createElement('button');
    button.id = streamid;
    button.innerHTML = 'Comenzar a grabar';
    button.onclick = function() {
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
                    div.appendChild(h2);
                }

                if (blob.video) {
                    h2 = document.createElement('h2');
                    h2.innerHTML = '<a href="' + URL.createObjectURL(blob.video) + '" target="_blank">Open recorded ' + blob.video.type + '</a>';
                    div.appendChild(h2);
                }
            });
        }
        setTimeout(function() {
            button.disabled = false;
        }, 3000);
    };
    div.appendChild(button);
    div.appendChild(video);
    return div;
}

function rotateVideo(mediaElement) {
    mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(0deg)';
    setTimeout(function() {
        mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(360deg)';
    }, 1000);
}

connection.onstreamended = function(e) {
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
        console.log(  )
        connection.join(session);
    };
};

document.getElementById('init-conference').onclick = function() {
    enableId( "leave-conference" , "init-conference" );
    connection.sessionid = room;
    this.disabled = true;
    connection.extra = {
        'session-name': name || 'Anonymous'
    };
    connection.open();

};

document.getElementById('leave-conference').onclick = function() {
    this.disabled = true;
    connection.close();
};

function enableId( enable , disabled  )
{
    $( '#'+disabled ).hide("clip");   
    $( '#'+enable ).show("clip");   
}

// setup signaling to search existing sessions
connection.connect();

function hola()
{
    
}
