$('#btn-load').on('click',function(){
  
});

$('#connectLink').on('click',function(){
    toggleImages();
});

$('#disconnectLink').on('click',function(){
    toggleImages();
}); 

$('#videoexit').on('click',function(){
    toggleImages();
    disconnect();
});

var session;
var publisher;
		
var VIDEO_WIDTH = 361;
var VIDEO_HEIGHT = 347;

		 
var _selfstream;
var  subscribers = new Array();
var _streams = new Array();
var _connections = new Array();
		
function connect() {
    OT.on("exception", exceptionHandler);
		
    // Un-comment the following to set automatic logging:
    OT.setLogLevel(OT.DEBUG);

    if (!(OT.checkSystemRequirements())) {
        alert("You don't have the minimum requirements to run this application.");
    } else {
        session = OT.initSession(sessionId);	// Initialize session
        session.connect(apiKey, token);
        // Add event listeners to the session

        session.on('sessionConnected', sessionConnectedHandler);
        session.on('sessionDisconnected', sessionDisconnectedHandler);
        session.on('connectionCreated', connectionCreatedHandler);
        session.on('connectionDestroyed', connectionDestroyedHandler);
        session.on('streamCreated', streamCreatedHandler);
        session.on('streamDestroyed', streamDestroyedHandler);
        session.on("signal", signalEventHandler);
    }
			
}

function disconnect() {
    stopPublishing();
    session.disconnect() ;
	
    changeClassDisconnect();
}

// Called when user wants to start publishing to the session
function startPublishing() {
    if (!publisher) {
        var parentDiv = document.getElementById("myCamera");
        var publisherDiv = document.createElement('div'); // Create a div for the publisher to replace
        publisherDiv.setAttribute('id', 'opentok_publisher');
        parentDiv.appendChild(publisherDiv);
        var publisherProps = {width: VIDEO_WIDTH, height: VIDEO_HEIGHT, name: name};
        publisher = OT.initPublisher(apiKey, publisherDiv.id, publisherProps);  // Pass the replacement div id and properties
        session.publish(publisher);
        publisher.on("streamCreated", function (event) {  //access the self video 
            _selfstream = event.stream;
        });
				 
    }
}

function stopPublishing() {
    if (publisher) {
        session.unpublish(publisher);
    }
    publisher = null;

			 
}

		
function sessionConnectedHandler(event) {
			 
    startPublishing();
    changeClassConnect();
}

function streamCreatedHandler(event) {
			 	    
    addSelect(event.stream);      //add call button when a new user comes online
			 
}

function addSelect( selectedStream) {

        
    if (! document.getElementById("btn_" + selectedStream.streamId))
    {
        $("#onlineusers").append('<li class="list-group-item btn_'+selectedStream.streamId+'">'+
                        '<div class="col-xs-0">'+
                           '<button id="btn_'+selectedStream.streamId+'" href="javascript:void(0)" class="btn btn-rounded btn-sm btn-success" onclick="beginCall(this)" ><i class="fa fa-phone"></i></button>'+
                            '<span class="name">'+ selectedStream.name.toString() +'</span><br/>'+
                        '</div>'+
                    '</li>');

        _streams[selectedStream.streamId] = selectedStream;
        search();
    }
}
function removeButton(selectedStream) {
    if(!invitado)
    {
        document.getElementById("btn_" + selectedStream.streamId).parentNode.parentNode.remove();
        var buttonContainer = document.getElementById("onlineusers");
        delete _streams[selectedStream.streamId];
    }
}

function endCall(obj, label) {
    console.log("endcall called");
    console.log(obj.value);
    _stream = _streams[obj.id.replace("btn_", "")];
    obj.value = label;
    obj.setAttribute("onclick", "beginCall(this)");
    removeStream(_stream);
    session.signal({
        type: "endcall",
        to:  _stream.connection,
        data: { streamId: _selfstream.streamId+"|"+_selfstream.name }
    },
              function (error) {
                  if (error) {
                      console.log("signal error: " + error.reason);
                  } else {
                      console.log("signal sent");
                  }
              }
          );
}

function beginCall(obj) {

   if(!invitado)
    {
        document.getElementById('calling').style.display = 'block';
    }        

    console.log(obj.value);

    obj.setAttribute("onclick", "endCall(this,'" + obj.value + "')");
    obj.value = 'End Call';
    _stream = _streams[obj.id.replace("btn_", "")];

     
    var streamNames = _stream.name.toString();



    session.signal({
        type: "begincall",
        to: _stream.connection,
        data: { streamId: _selfstream.streamId + "|" + _selfstream.name }
    },
            function (error) {
                if (error) {
                    console.log("signal error: " + error.reason);
                } else {
                    console.log("signal sent: begincall:");
                }
            }
        );
}


function signalEventHandler(event) {
    
    var playing = false;

    if (event.type == "signal:begincall") {

        audio.play();
        playing = true;

        $.get();
        audio.addEventListener("ended", function() {
            this.currentTime = 0;
            this.play();
        }, false);

        //***************************Call Begin*********************************//            

        data = event.data.streamId.toString().split('|');
        _streamId = data[0];
        _name = data[1];

        document.getElementById('acceptCallBox').style.display = 'block';
        document.getElementById('acceptCallLabel').innerHTML = 'Llamando ' + _name;


        //***************************Accept Call*************************************//
        document.getElementById('callAcceptButton').onclick = function () {

            playing = false;
            audio.pause();

            document.getElementById('acceptCallBox').style.display = 'none';
            document.getElementById('acceptCallLabel').innerHTML = '';

            document.getElementById('name_doc').innerHTML = _name;
            if(!invitado)
            {
                _btn = document.getElementById('btn_' + _streamId);
                _btn.setAttribute("onclick", "endCall(this,'" + _btn.value + "')");
                _btn.value = 'End Call';
            }

            addStream(_streams[_streamId]);
            session.signal({
                type: "acceptcall",
                to: _streams[_streamId].connection,
                data: { callaccepted: _selfstream.streamId + "|" + _selfstream.name + "|yes" }
            },
                function (error) {
                    if (error) { console.log("signal error: " + error.reason); }
                    else { console.log("signal sent"); }
                }
            );

        }

        //***************************Accept Call*************************************//

        //***************************Reject Call*************************************//
        document.getElementById('callRejectButton').onclick = function () {

            playing = false;
            audio.pause();

            document.getElementById('acceptCallBox').style.display = 'none';
            document.getElementById('acceptCallLabel').innerHTML = '';

            session.signal({
                type: "acceptcall",
                to: _streams[_streamId].connection,
                data: { callaccepted: _selfstream.streamId + "|" + _selfstream.name + "|no" }
            },
                    function (error) {
                        if (error) { console.log("signal error: " + error.reason); }
                        else { console.log("signal sent"); }
                    }
                );
        }
        //***************************Reject Call*************************************//
        //***************************Call Begin*********************************//
    }
    else if (event.type == "signal:acceptcall") {
        
        data = event.data.callaccepted.toString().split('|');
        _streamId = data[0];
        _name = data[1];
        _callaccepted = data[2];
         
        if (_callaccepted == 'yes') { 

            addStream(_streams[_streamId]);
        }
        if (_callaccepted == 'no') {

            document.getElementById('calling').style.display = 'none';
            document.getElementById('name_doc').innerHTML = '';
            alert('Llamada rechaza por ' + _name);
            document.getElementById("btn_" + _streamId).click();
        }
    }
 
    else if (event.type == "signal:endcall") {
        data = event.data.streamId.toString().split("|");
        _streamId = data[0];
    
        removeStream(_streams[_streamId]);
        _btn = document.getElementById('btn_' + _streamId);
        _btn.setAttribute("onclick", "beginCall(this)");
        _btn.value = 'Call ' + data[1];

         

    }

}

function streamDestroyedHandler(event) {
    // This signals that a stream was destroyed. Any Subscribers will automatically be removed.
    // This default behaviour can be prevented using event.preventDefault()
    removeButton(event.stream);
}

function sessionDisconnectedHandler(event) {
    // This signals that the user was disconnected from the Session. Any subscribers and publishers
    // will automatically be removed. This default behaviour can be prevented using event.preventDefault()

    session.off('sessionConnected', sessionConnectedHandler);
    session.off('streamCreated', streamCreatedHandler);
    session.off('streamDestroyed', streamDestroyedHandler);
    session.off('connectionCreated', connectionCreatedHandler);
    session.off("signal", signalEventHandler);
    OT.off("exception", exceptionHandler);
    session.off('sessionDisconnected', sessionDisconnectedHandler);
    publisher = null;
    changeClassConnect();
			 
}



function connectionDestroyedHandler(event) {
    // This signals that connections were destroyed
}

function connectionCreatedHandler(event) {
    // This signals new connections have been created.
}

/*
If you un-comment the call to OT.setLogLevel(), above, OpenTok automatically displays exception event messages.
*/
function exceptionHandler(event) {
    alert("Exception: " + event.code + "::" + event.message);
}

//--------------------------------------
//  HELPER METHODS
//--------------------------------------

function addStream(stream) {
    $('#VideoModal').modal('hide');

    // Check if this is the stream that I am publishing, and if so do not publish.
    if (stream.connection.connectionId == session.connection.connectionId) {
        return;
    }
    var subscriberDiv = document.createElement('div'); // Create a div for the subscriber to replace
    subscriberDiv.setAttribute('id', stream.streamId); // Give the replacement div the id of the stream as its id.
    document.getElementById("subscribers").appendChild(subscriberDiv);
    var subscriberProps = {width: VIDEO_WIDTH, height: VIDEO_HEIGHT};
    subscribers[stream.streamId] = session.subscribe(stream, subscriberDiv.id, subscriberProps);
}


function removeStream(stream)
{
    session.unsubscribe(subscribers[stream.streamId]);
}

function changeClassConnect() {
    $('#connectLink').attr('onclick',"javascript:disconnect()");
    document.getElementById('connectLink').innerHTML = '<i class="fa fa-fw fa-user-md"></i> Colgar';
    document.getElementById('connectLink').className = 'btn btn-danger';
    document.getElementById('connectLink').id = 'disconnectLink';

    $('#VideoModal').modal({ backdrop: 'static', keyboard: false })
        .one('click', '#confirm', function() {
        $form.trigger('submit'); // submit the form
    });
        alert('cone');
}

function changeClassDisconnect() {
    $('#disconnectLink').attr('onclick',"javascript:connect()");
    document.getElementById('disconnectLink').innerHTML = '<i class="fa fa-fw fa-user-md"></i> Iniciar';
    document.getElementById('disconnectLink').className = 'btn btn-success';
    document.getElementById('disconnectLink').id = 'connectLink';
    alert('dis');
}

function toggleImages(){
    $('#imagen1').toggle('slow');
    $('#imagen2').toggle('slow');
}

function search()
{
    $('#contact-list').searchable({
        searchField: '#contact-list-search',
        selector: 'li',
        childSelector: '.col-xs-0',
        show: function( elem ) {
            elem.slideDown(100);
        },
        hide: function( elem ) {
            elem.slideUp( 100 );
        }
    });
}


        