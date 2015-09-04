<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Videoconferencia</title>
   
    <script type="text/javascript">
    	var apiKey = '{{ $api_key }}'; 
		var sessionId = '2_MX40NTMwNTQ2Mn5-MTQzOTE0MjA2Mzk0N35HUkdteEdlcVhGSFMrMkdZQ2kwckM2SWp-UH4'; 
		var token = 'T1==cGFydG5lcl9pZD00NTMwNTQ2MiZzaWc9M2FmYjlmYTJjZTdlN2UyMzg1NzhmM2MxZWIwNjE1YmIwNWQyNWExNTpzZXNzaW9uX2lkPTJfTVg0ME5UTXdOVFEyTW41LU1UUXpPVEUwTWpBMk16azBOMzVIVWtkdGVFZGxjVmhHU0ZNck1rZFpRMmt3Y2tNMlNXcC1VSDQmY3JlYXRlX3RpbWU9MTQzOTE0MjA2NCZyb2xlPW1vZGVyYXRvciZub25jZT0xNDM5MTQyMDY0LjAyNzEzNTk4NTI4OTcmZXhwaXJlX3RpbWU9MTQzOTc0Njg2NCZjb25uZWN0aW9uX2RhdGE9bmFtZSUzREZlbGlwZQ==';  
    </script>
    {!! Html::script('http://static.opentok.com/webrtc/v2.2/js/opentok.min.js') !!}
    {!! Html::style('css/videoconferencing.css') !!}
    {!! Html::script('assets/js/videoconferencing.js') !!}
</head>
<body>
	<p>{{ $api_key }}</p> <br>
	<p>{{ $session_id }}</p> <br>
	<p>{{ $token }}</p> <br>
    <div id="opentok_console" class="opentok_console">
        <div id="links" class="links">
            <div class="header">Control Panel</div>
            <div id="controlpanel">
                <input id="txtName" type="text" />
                <input type="button" value="Connect" onclick="javascript:connect()" />
                <input type="button" value="Leave" onclick="javascript:disconnect()" />
                <div class="header">Connected Users</div>
                <div id="onlineusers">
                </div>

            </div>
        </div>

        <div class="videos">
            <div id="myCamera" class="publisherContainer"></div>
            <div id="subscribers" class="subscribersContainer"></div>

        </div>
    </div>
        <div id="acceptCallBox">
            <!-- Should be initially hidden using CSS -->
            <div id="acceptCallLabel"></div>
            <input type="button" id="callAcceptButton" value="Accept" /> <input type="button" id="callRejectButton" value="Reject" />
        </div>
	<script type="text/javascript" charset="utf-8">
		show('connectLink');
	</script>
</body>
</html>