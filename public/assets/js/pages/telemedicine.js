function init()
{
    // create our webrtc connection
    webrtc = new SimpleWebRTC({
    localVideoEl: 'localVideo',
    remoteVideosEl: '',
    autoRequestMedia: true,
    debug: false,
    detectSpeakingEvents: true,
    autoAdjustMic: false
    });
}

init();

webrtc.on('videoAdded', function (video, peer) {
    $( "#doctor_widget" ).hide( "clip");
    var remotes = document.getElementById('remotes');
    if (remotes) {
        var d = document.createElement('div');
        d.className = 'videoContainer';
        d.id = 'container_' + webrtc.getDomId(peer);
        d.appendChild(video);
        var vol = document.createElement('div');
        vol.id = 'volume_' + peer.id;
        vol.className = 'volume_bar';
        video.onclick = function () {
            video.style.width = video.videoWidth + 'px';
            video.style.height = video.videoHeight + 'px';
        };
        d.appendChild(vol);
        remotes.appendChild(d);

    }

    // show the ice connection state
    if (peer && peer.pc) {
        var connstate = document.createElement('div');
        connstate.className = 'connectionstate';
        remotes.appendChild(connstate);
        peer.pc.on('iceConnectionStateChange', function (event) {
            switch (peer.pc.iceConnectionState) {
            case 'checking':
                $('#callingSignal')[0].play();
                //connstate.innerText = 'Connecting to peer...';
                break;
            case 'connected':
            case 'completed': // on caller side
                $('#callingSignal')[0].pause();
                //connstate.innerText = 'Connection established.';
                break;
            case 'disconnected':
                $('#endCallSignal')[0].play();
                //connstate.innerText = 'Disconnected.';
                break;
            case 'failed':
                break;
            case 'closed':
                $('#endCallSignal')[0].play();
                //connstate.innerText = 'Connection closed.';
                break;
            }
        });
    }
});

webrtc.on('videoRemoved', function (video, peer) {
    var remotes = document.getElementById('remotes');
    var el = document.getElementById('container_' + webrtc.getDomId(peer));
    if (remotes && el) {
        $( "#doctor_widget" ).show("clip");
        remotes.removeChild(el);
    }
});

webrtc.on('readyToCall', function () {
    // you can name it anything
    if (room) webrtc.joinRoom(room);
});

// hangup
//
$('#hangupButton').click(function(){ 
    webrtc.stopLocalVideo();
    webrtc.leaveRoom();
    document.getElementById("hangupButton").style.display = 'none';
    document.getElementById("init").style.display = "block";
});

$('#init').click(function(){ 
    init();
    document.getElementById("init").style.display = 'none';
    document.getElementById("hangupButton").style.display = "block";
});

// Mute camera
//
$('.btn_camera_off').on('click', function() {
    var action = $(this).data('action');
    if (action === 'mute') {
      $(this).addClass('off').data('action', 'unmute');
      webrtc.pauseVideo();
    } else {
      $(this).removeClass('off').data('action', 'mute');
        webrtc.resumeVideo();
    }
});   

// Mute microphone
//
$('.btn_mic_off').on('click', function() {
    var action = $(this).data('action');
    if (action === 'mute') {
      $(this).addClass('off').data('action', 'unmute');
      webrtc.mute();
    } else {
      $(this).removeClass('off').data('action', 'mute');
      webrtc.unmute();
    }
});
