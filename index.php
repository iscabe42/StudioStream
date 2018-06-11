<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.webrtc-experiment.com/style.css">

    <title>Video Broadcasting </title>

    <meta name="description" content="One-to-Many Video Broadcasting using RTCMultiConnection" />
    <meta name="keywords" content="WebRTC,RTCMultiConnection,Demos,Experiments,Samples,Examples" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        video {
            object-fit: fill;
        }
        button,
        input,
        select {
            font-weight: normal;
            padding: 2px 4px;
            text-decoration: none;
            display: inline-block;
            text-shadow: none;
            font-size: 16px;
            outline: none;
        }

        .make-center {
            text-align: center;
            padding: 5px 10px;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

   	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/popper/popper.min.js"></script>

    
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
</head>

<body>
<!-- juees 16 de noviembre del 2017-->
<!-- domingo 26 de noviembre del 2017-->
<!-- lunes 4 de diciembre del 2017-->
<!-- martes 6 de febrero del 2018
jueves 22 de febrero del 2018 sin cambios solo comentario
-->
   <?php
	if(isset($_POST["nom_modelo"])){
        $nom_modelo=$_POST["nom_modelo"];
        $soc_valor=$_POST["sock_val"];
        $mi_sexo=$_POST["mi_sexo"];

        echo "<input type='hidden' id='val_sock' value='$soc_valor' />";	
        echo "<input type='hidden' id='miNickName' value='$nom_modelo' />";	
        echo "<input type='hidden' id='mi_sexo' value='$mi_sexo' />";	
		
		echo "
		<input type='hidden' id='nomodd' value='$nom_modelo' />
		<script>
			setTimeout(function(){
				abrir_sala();
			}
			,1000);
		</script>
		";
		}
		else{
			$nom_modelo="000";
			}
	?>

       
			<?php
			echo "
			<input style='display:none;' type='text' id='room-id' value='$nom_modelo'>
			";
			?>
                
                <button style="display:none;" id="open-room">Open Room</button>
                <button style="display:none;" id="join-room">Join Room</button>
                <button style="display:none;" id="open-or-join-room">Auto Open Or Join Room</button>
        <center>
		
        <?php
        include "chat.php";
        ?>
		</center>


	  <canvas id="canvas" style="display:none;"></canvas>
        <script src="js/RTCMultiConnection.min.js"></script>
        <script src="https://wcamgirls-stream.mybluemix.net/socket.io/socket.io.js"></script>

        <script>
		var espacio='';
//var sock_val=$('#val_sock').val();
var webSocket=io.connect('https://wcamgirls-stream.mybluemix.net/'+espacio);


		setTimeout(function (){
		var videoob=document.querySelector('video');
		var imagencanvas = document.getElementById('canvas');
		var ctx = imagencanvas.getContext('2d');
				imagencanvas.width = videoob.videoWidth;
				imagencanvas.height = videoob.videoHeight;
	
				ctx.drawImage(videoob, 0, 0,videoob.videoWidth,videoob.videoHeight);
			var datos = imagencanvas.toDataURL("image/jpeg",0.3);	
			var nomm=$("#nomodd").val();
			webSocket.emit('imagen-modelo',nomm,1);
			}
		
		,5000);
            // .......................................................
            // ........................UI Code........................
            // ......................................................

            document.getElementById('open-room').onclick = function() {
                disableInputButtons();
                connection.sdpConstraints.mandatory = {
                    OfferToReceiveAudio: false,
                    OfferToReceiveVideo: false
                };
                connection.open(document.getElementById('room-id').value, function() {
                    showRoomURL(connection.sessionid);
                });
            };
			function abrir_sala(){
			  disableInputButtons();
                connection.sdpConstraints.mandatory = {
                    OfferToReceiveAudio: false,
                    OfferToReceiveVideo: false
                };
                connection.open(document.getElementById('room-id').value, function() {
                    showRoomURL(connection.sessionid);
                });	
			}
            document.getElementById('join-room').onclick = function() {
                disableInputButtons();
                connection.sdpConstraints.mandatory = {
                    OfferToReceiveAudio: true,
                    OfferToReceiveVideo: true
                };
                connection.join(document.getElementById('room-id').value);
            };

            document.getElementById('open-or-join-room').onclick = function() {
                disableInputButtons();
                connection.openOrJoin(document.getElementById('room-id').value, function(isRoomExists, roomid) {
                    if(!isRoomExists) {
                        showRoomURL(roomid);
                    }
                });
            };

            // ......................................................
            // ..................RTCMultiConnection Code.............
            // ......................................................

            var connection = new RTCMultiConnection();

            // by default, socket.io server is assumed to be deployed on your own URL
            connection.socketURL = 'https://wcamgirls-stream.mybluemix.net/';

            // comment-out below line if you do not have your own socket.io server
            // connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';

            connection.socketMessageEvent = 'video-broadcast-demo';

            connection.session = {
                audio: true,
                video: true,
                oneway: true
            };

            connection.videosContainer = document.getElementById('videos-container');
            connection.onstream = function(event) {
                connection.videosContainer.appendChild(event.mediaElement);
                $("video").attr("style","height:200px;");

                event.mediaElement.play();
                setTimeout(function() {
                    event.mediaElement.play();
                   
                }, 1000);
            };

            function disableInputButtons() {
                document.getElementById('open-or-join-room').disabled = true;
                document.getElementById('open-room').disabled = true;
                document.getElementById('join-room').disabled = true;
                document.getElementById('room-id').disabled = true;
            }

            // ......................................................
            // ......................Handling Room-ID................
            // ......................................................

            function showRoomURL(roomid) {
                var roomHashURL = '#' + roomid;
                var roomQueryStringURL = '?roomid=' + roomid;

                var html = '<h2>Unique URL for your room:</h2><br>';

                html += 'Hash URL: <a href="' + roomHashURL + '" target="_blank">' + roomHashURL + '</a>';
                html += '<br>';
                html += 'QueryString URL: <a href="' + roomQueryStringURL + '" target="_blank">' + roomQueryStringURL + '</a>';

                var roomURLsDiv = document.getElementById('room-urls');
                //roomURLsDiv.innerHTML = html;

                roomURLsDiv.style.display = 'block';
            }

            (function() {
                var params = {},
                    r = /([^&=]+)=?([^&]*)/g;

                function d(s) {
                    return decodeURIComponent(s.replace(/\+/g, ' '));
                }
                var match, search = window.location.search;
                while (match = r.exec(search.substring(1)))
                    params[d(match[1])] = d(match[2]);
                window.params = params;
            })();

            var roomid = '';
            if (localStorage.getItem(connection.socketMessageEvent)) {
                roomid = localStorage.getItem(connection.socketMessageEvent);
            } else {
                roomid = connection.token();
            }
            //document.getElementById('room-id').value = roomid;
            document.getElementById('room-id').onkeyup = function() {
                localStorage.setItem(connection.socketMessageEvent, this.value);
            };

            var hashString = location.hash.replace('#', '');
            if(hashString.length && hashString.indexOf('comment-') == 0) {
              hashString = '';
            }

            var roomid = params.roomid;
            if(!roomid && hashString.length) {
                roomid = hashString;
            }

            if(roomid && roomid.length) {
                document.getElementById('room-id').value = roomid;
                localStorage.setItem(connection.socketMessageEvent, roomid);

                // auto-join-room
                (function reCheckRoomPresence() {
                    connection.checkPresence(roomid, function(isRoomExists) {
                        if(isRoomExists) {
                            connection.join(roomid);
                            return;
                        }

                        setTimeout(reCheckRoomPresence, 5000);
                    });
                })();

                disableInputButtons();
            }
        </script>

        

     

    

</body>

</html>
