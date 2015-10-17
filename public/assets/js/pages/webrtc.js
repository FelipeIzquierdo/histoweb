var connection = new RTCMultiConnection('H1ST0W3B'); // channel-id (Importante)
var videos_widget = [ 'invited_widget' , 'doctor_widget' ];
var roomsList = document.getElementById('rooms-list');
var number_videos = 0;
var name_room = 'sala';
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

connection.onstreamended = function(e) 
{
    $( "#"+name_room ).empty();
    document.getElementById("leave-conference").click();
};

var sessions = {};
connection.onNewSession = function(session) 
{
    if (sessions[session.sessionid]) return;
    sessions[session.sessionid] = session;
    console.log('session');
    console.log(session);
    var li = document.createElement('li');
    li.id = session['userid'];
    li.style.fontSize = '12px';
    li.innerHTML = '<a><span class="sidebar-nav-mini-hide text-success"> ' + session.extra['session-name'] + '</span>' +
        '<button style="margin-left: 20px" class="btn btn-success btn-sm join"> <i class="fa fa-phone" ></i>  </button></a>';
    roomsList.insertBefore(li, roomsList.firstChild);
    var joinRoomButton = li.querySelector('.join');
    joinRoomButton.setAttribute('data-sessionid', session.sessionid);
    joinRoomButton.onclick = function() {
        this.disabled = true;
        var sessionid = this.getAttribute('data-sessionid');
        session = sessions[sessionid];
        if (!session) throw 'No such session exists.';
        connection.join(session);
        enableId( "leave-conference" , "init-conference" );
    };
};

connection.onSessionClosed = function (e) {
    $('#'+e['userid']).remove();
};

connection.onleave = function (e) {
    $('#'+e['userid']).remove();
};

connection.onMediaError = function(event) 
{
    document.getElementById("leave-conference").click();
    alert('Error');
};

document.getElementById('init-conference').onclick = function() 
{
    enableId( "leave-conference" , "init-conference" );
    connection.sessionid = (Math.random() * 999999999999).toString().replace('.', '');
    connection.extra = {
        'session-name': name || 'Anonymous'
    };
    connection.open();
};

document.getElementById('leave-conference').onclick = function() 
{
    enableId( "init-conference" , "leave-conference" );
    enableId( videos_widget[0] , name_room );
    enableId( videos_widget[1] , name_room );
    connection.close();
    number_videos = 0;
};

function rotateVideo(mediaElement) 
{
    mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(0deg)';
    setTimeout(function() 
    {
        mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(360deg)';
    }, 1000);
}

function enableId( enable , disabled  )
{
    $( '#'+disabled ).hide("clip");   
    $( '#'+enable ).show("clip");   
}

// setup signaling to search existing sessions
connection.connect();
