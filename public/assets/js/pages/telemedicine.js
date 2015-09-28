var container = document.getElementById('container');

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

    $( "#invited_widget" ).show("clip");
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
    $( "#invited_widget" ).hide("clip");
});

$('#init').click(function(){ 
    init();
    document.getElementById("init").style.display = 'none';
    document.getElementById("hangupButton").style.display = "block";
});

$('#save_video').click(function(){ 
        
            preview.src = '';
            fileName = Math.round(Math.random() * 99999999) + 99999999;
            // Firefox even supports StereoAudioRecorder.js
            // i.e.
            // recorderType: StereoAudioRecorder
           if (!isFirefox) {
                recordAudio.stopRecording(function() {
                    PostBlob(recordAudio.getBlob(), 'audio', fileName + '.wav');
                });
            } else {
                recordAudio.stopRecording(function(url) {
                    preview.src = url;
                  //  PostBlob(recordAudio.getBlob(), 'video', fileName + '.webm');
                });
            }

            if (!isFirefox && webrtcDetectedBrowser !== 'edge') {
                recordVideo.stopRecording(function() {
                    //PostBlob(recordVideo.getBlob(), 'video', fileName + '.webm');
                });
            }

});

function xhr(url, data, progress, percentage, callback) 
{
     var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                callback(request.responseText);
            }
        };

        request.upload.onloadstart = function() {
            percentage.innerHTML = 'Upload started...';
        };
        request.upload.onprogress = function(event) {
            console.log( 'evento total'+event.total );
            progress.max = event.total;
            progress.value = event.loaded;
            percentage.innerHTML = 'Upload Progress ' + Math.round(event.loaded / event.total * 100) + "%";
        };
        request.upload.onload = function() {
            percentage.innerHTML = 'Saved!';
        };
    
    request.open('POST', url , true );
    request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
    request.send(data);
}

function PostBlob(blob, fileType, fileName) {
            // FormData
            var formData = new FormData();
            formData.append(fileType + '-filename', fileName);
            formData.append(fileType + '-blob', blob);
            // progress-bar
            var hr = document.createElement('hr');
            container.appendChild(hr);
            var strong = document.createElement('strong');
            strong.id = 'percentage';
            strong.innerHTML = fileType + ' upload progress: ';
            container.appendChild(strong);
            var progress = document.createElement('progress');
            container.appendChild(progress);
            // POST the Blob using XHR2

            xhr('deprueba', formData, progress, percentage, function(fileURL) {
                container.appendChild(document.createElement('hr'));
                var mediaElement = document.createElement(fileType);
                var source = document.createElement('source');
                var href = location.href.substr(0, location.href.lastIndexOf('/') + 1);
                source.src = href + fileURL;
                if (fileType == 'video' && webrtcDetectedBrowser !== 'edge') source.type = 'video/webm; codecs="vp8, vorbis"';
                if (fileType == 'audio') source.type = !!navigator.mozGetUserMedia ? 'audio/ogg' : 'audio/wav';
                mediaElement.appendChild(source);
                mediaElement.controls = true;
                container.appendChild(mediaElement);
                mediaElement.play();
                progress.parentNode.removeChild(progress);
                strong.parentNode.removeChild(strong);
                hr.parentNode.removeChild(hr);
            });
        }

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
            