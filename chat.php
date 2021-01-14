<script src="js/jscolor-2.0.4/jscolor.js?v=<?php echo(rand()); ?>"></script>
<audio id="audioMensajenuevo" src="audio/mensajeNuevo.mp3" style="display:none;"></audio>
<div id="selectorColor" style="display:none;">


    <input style="margin-top:0px position:absolute; visibility:hidden" id="colorInput" class="jscolor" value="000000">

</div>
<?php
session_start();
if(isset($_SESSION['skype'])){ 
	 $usuario_chat=$_SESSION['skype'];
}
?>

<br>

<script type="text/javascript">
var miNickName = $("#miNickName").val();
//var estatus_chat=0;
//	var miCompra=330;
var miSexo = $("#mi_sexo").val();


var imagenUpload = "";

function webCam() {
    $("#contenedor_camaraWeb").show();
    $("#contenedor_user").hide();

}

function espectadores() {
    $("#contenedor_camaraWeb").hide();
    $("#contenedor_user").show();
}


function subirImagen() {
    $(".upfile").trigger("click");
}

function prepararImagen() {
    var filesToUpload = document.getElementById('file').files[0];

    var reader = new FileReader();
    reader.readAsDataURL(filesToUpload);
    // Set the image once loaded into file reader
    reader.onload = function(e) {
        imagenUpload = e.target.result;

        enviarImagen();
    }
}

function enviarMensaje() {
    alert("enviarMensaje ..");
}

function configuracionChat() {

    if ((document.getElementsByClassName("modalconfiguracion")[0].style.display) == "none") {
        $(".modalconfiguracion").show();
        $('#colorInput').appendTo('#color1');
    } else {
        $(".modalconfiguracion").hide();
        $('#colorInput').appendTo('#selectorColor');
    }
}

$("#modalconfig").on("click", function() {
    $(".modalconfiguracion").hide();
    $('#colorInput').appendTo('#selectorColor');
});
</script>
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="btn-panel btn-panel-conversation">
                <a href="javascript:webCam()" style='color:#6D6D6D;'
                    class="encabezadochat btn  col-lg-6 send-message-btn " role="button"><i class="fa fa-video"></i> Web
                    Cam</a>
                <span onclick="espectadores()" class="encabezadochat btn  col-lg-6  send-message-btn pull-right"
                    role="button"><i class="fas fa-users"></i>Espectadores</span>

            </div>
        </div>

        <div class=" col-lg-8">
            <div class="btn-panel btn-panel-msg"><label for=""><span
                        style="color:#6D6D6D;"><strong><mark>Publico</mark></strong></span> &nbsp <strong><span
                            id="mynameuser" style="color:#C50D00;"></span><span id="mynameuserPrivate"
                            style="color:#FF9901; display:none;"></span></strong></label>
                <a href="javascript:configuracionChat();" style='color:#6D6D6D; font-size:11px;'
                    class="encabezadochat btn  col-lg-3  send-message-btn pull-right" role="button"><i
                        class="fas fa-cogs"></i> Configuración</a>
            </div>
        </div>
    </div>
    <div class="row" style="height:500pxs;">
        <style type="text/css">
        .encabezadochat {
            background: #EEEEEE;
            border-left-width: thin;
            border-left-color: #CCC;
            cursor: pointer;
        }

        .cuerpoChat {
            width: 100%;
            height: 2px;
            background: #EEEEEE;
            margin-bottom: 5px;
        }

        .mediabox {
            margin-bottom: 5px;
            width: 100%;
            background: #EEEEEE;
            color: #ADADAD;

            -webkit-box-shadow: -2px 1px 3px 1px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: -2px 1px 3px 1px rgba(0, 0, 0, 0.2);
            box-shadow: -2px 1px 3px 1px rgba(0, 0, 0, 0.2);
        }

        .inboxMedia {
            cursor: pointer;
            -webkit-box-shadow: -2px 1px 3px 1px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: -2px 1px 3px 1px rgba(0, 0, 0, 0.2);
            box-shadow: -2px 1px 3px 1px rgba(0, 0, 0, 0.2);
        }

        .inboxMedia:hover {
            background: #EEEEEE;
        }

        .botonFormato:hover {
            background: #F1F1F1;
        }

        .switchCh {
            cursor: pointer;
        }

        .switchCh:hover {
            cursor: pointer;
            background: #D1D1D1;
        }
        </style>
        <div class="conversation-wrap col-lg-4">
            <div id="contenedor_camaraWeb" style=" width:100%;">
                <div id="videos-container"></div>
            </div>

            <div class="mediabox" style=display:none;"">
                <center class="switchCh" id="centerInbox" onclick="switchchat()"><span
                        style=" color:black;">Inbox</span> &nbsp <i style="font-size:10px;"
                        class="far fa-user"></i>&nbsp<span id="contadorPrivados">0</span> &nbsp <i
                        style="font-size:10px;" class="far fa-envelope"></i> &nbsp <span
                        id="contadorMSJPrivados">0</span></center>
                <center class="switchCh" id="centerPublico" onclick="switchchat()" style="display:none;"><span
                        style="color:black;">Chat Amigos</span>&nbsp <i style="font-size:10px;" class="far fa-user"></i>
                </center>
            </div>
            <div id="contenedor_user" style="display:none; height:300px; overflow:scroll;">
                <!-- contenedor de usuarios conectados-->
            </div>
            <div style="display:none;" id="contenedor_mensaje_privado" style="height:300px; overflow:scroll;">
                <!-- contenedor de mensajes privados-->
            </div>

        </div>

        <div class="message-wrap col-lg-8">
            <img onclick="limpiarimg()" style="display:none; width:100%; position:relative; z-index:3; cursor:pointer;"
                src="" id="verimagenSeleccionada" />
            <div class="cuerpoChat"></div>
            <div id="modalconfig" class="modalconfiguracion"
                style="cursor:pointer; opacity:0.5; display:none; width:94%; height:300px; background:gray; z-index:2; position:absolute;">
            </div>
            <div class="modalconfiguracion"
                style="margin-top:10px; background:white; display:none; width:50%; height:; z-index:15; position:absolute; left:25%;">
                <i onclick="configuracionChat()"
                    style="cursor:pointer; float:right; margin-top:5px; margin-right:10px; color:#9A9A9A;"
                    class="fas fa-times"></i><br>
                <div style="width:100%; background:#EEEEEE; height:1px; color:#EEEEEE;"></div>
                <span id="textoModelo" style="margin-bottom:5px;">Texto Texto Texto Texto Texto Texto</span>
                <div id="color1">
                </div>

                <div style="margin-top:; position:absolute; z-index:10;">
                    <div onclick="bold()" class="botonFormato" style="float:left; position:relative; cursor:pointer; border: 1px solid #9A9A9A;
							border-radius: 4px; width:20px; text-align:center;"><span id="spanNegritas">N</span></div>

                    <div onclick="subrayar()" class="botonFormato" style="float:left; position:relative; cursor:pointer; border: 1px solid #9A9A9A;
							border-radius: 4px; width:20px; text-align:center;"><span id="subrayado">S</span></div>


                    &nbsp<div id="colortrigger" style="margin-left:5px; float:left; position:;  cursor:pointer; border: 1px solid #9A9A9A;
							border-radius: 4px; width:20px; text-align:center; background:black; color:black;">r</div>
                </div>
                <br>
                <br>
                <button onclick="configuracionChat()" type="button" class="btn"
                    style="background:#DDDDDD; color:black;"><i class="fas fa-check"></i></button>

            </div>
            <div id="inboxChat" class="msg-wrap" style="height:300px; overflow:scroll;">
                <!-- inbox chat publico-->
            </div>
            <div id="inboxChatPrivate" class="msg-wrap" style="display:none; height:300px; overflow:scroll;">
                <!-- inbox chat privado-->
                chat privado
            </div>
            <script type="text/javascript">
            $("#colortrigger").on("click", function() {

                var targetNode = document.getElementById("colorInput");
                triggerMouseEvent(targetNode, "mousedown");

            });

            function triggerMouseEvent(node, eventType) {
                var clickEvent = document.createEvent('MouseEvents');
                clickEvent.initEvent(eventType, true, true);
                node.dispatchEvent(clickEvent);
            }

            var boldVal = 0;

            function bold() {
                if (boldVal == 1) {
                    fontWeight = "normal";
                    $("#textoModelo").attr("style", "color:#" + $("#colorInput").val() + "; font-weight:" + fontWeight +
                        "; text-decoration:" + subr + ";");
                    $("#spanNegritas").attr("style", "font-weight:" + fontWeight + ";");
                    $("#idinputTextChat").attr("style", "color:#" + $("#colorInput").val() + ";font-weight:" +
                        fontWeight + ";  text-decoration:" + subr + ";");

                    boldVal = 0;
                } else {
                    fontWeight = "bold";
                    $("#textoModelo").attr("style", "color:#" + $("#colorInput").val() + "; font-weight:" + fontWeight +
                        "; text-decoration:" + subr + ";");
                    $("#spanNegritas").attr("style", "font-weight:" + fontWeight + ";");
                    $("#idinputTextChat").attr("style", "color:#" + $("#colorInput").val() + ";font-weight:" +
                        fontWeight + ";  text-decoration:" + subr + ";");

                    boldVal = 1;
                }
            }
            var subrayado = 0;

            function subrayar() {

                if (subrayado == 1) {
                    subr = "none";
                    $("#textoModelo").attr("style", "color:#" + $("#colorInput").val() + "; font-weight:" + fontWeight +
                        "; text-decoration:" + subr + ";");
                    $("#subrayado").attr("style", "text-decoration:" + subr + ";");
                    $("#idinputTextChat").attr("style", "color:#" + $("#colorInput").val() + ";font-weight:" +
                        fontWeight + ";  text-decoration:" + subr + ";");

                    subrayado = 0;
                } else {
                    subr = "underline #" + $("#colorInput").val() + "";
                    $("#textoModelo").attr("style", "color:#" + $("#colorInput").val() + "; font-weight:" + fontWeight +
                        "; text-decoration:" + subr + ";");
                    $("#subrayado").attr("style", "text-decoration:" + subr + ";");
                    $("#idinputTextChat").attr("style", "color:#" + $("#colorInput").val() + ";font-weight:" +
                        fontWeight + ";  text-decoration:" + subr + ";");

                    subrayado = 1;
                }

            }

            $(".jscolor").on("change", function() {
                if (subrayado == 1) {
                    subr = "underline #" + $("#colorInput").val() + "";
                }
                $("#textoModelo").attr("style", "color:#" + $("#colorInput").val() + "; font-weight:" +
                    fontWeight + "; text-decoration:" + subr + ";");


                $("#idinputTextChat").attr("style", "color:#" + $("#colorInput").val() + ";font-weight:" +
                    fontWeight + ";  text-decoration:" + subr + ";");

                $("#colortrigger").attr("style",
                    "margin-left:5px; float:left; position:;  cursor:pointer; border: 1px solid #9A9A9A; border-radius: 4px; width:20px; text-align:center; background:#" +
                    $("#colorInput").val() + "; color:#" + $("#colorInput").val() + ";");

                colorletraEnviar = "#" + $("#colorInput").val();
            });
            </script>
            <div class="send-wrap ">

                <textarea id="idinputTextChat" class="inputTextChat form-control send-message" rows="3"
                    placeholder="Escriba su mensaje..."></textarea>

            </div>
            <div class="btn-panel">
                <a href="javascript:subirImagen();" style='display:none; color:#6D6D6D; font-size:11px;'
                    class="encabezadochat col-lg-3 btn   send-message-btn " role="button"><i
                        class="fas fa-cloud-upload-alt"></i> Agregar Imagen</a>
                <input id="file" onchange="prepararImagen()" type="file" class="upfile" style="display:none;" />
                <a href="javascript:textChat_send();" style='color:#6D6D6D; font-size:11px;'
                    class="encabezadochat col-lg-4 text-right btn   send-message-btn pull-right" role="button"><i
                        class="fa fa-plus"></i> Enviar mensaje</a>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<script src="js/RTCMultiConnection.min.js"></script>
<!-- <script src="http://localhost:9001/socket.io/socket.io.js"></script> -->
<script src="https://wcamgirls-stream.mybluemix.net/socket.io/socket.io.js"></script>
<script type="text/javascript">
var espacio = '';
var sock_val = $('#val_sock').val();
// var webSocket=io.connect(sock_val+'/'+espacio);

var options = {
    rememberUpgrade: true,
    transports: ['websocket'],
    secure: true,
    rejectUnauthorized: false,
    withCredentials: true,
    extraHeaders: {
        "my-custom-header": "abcd"
    }
}
var webSocket = io.connect('https://wcamgirls-stream.mybluemix.net/' + espacio, options);

var inboxLocal = [];
var listaUsuariosLocal = [];
var misSalasPrivadas = [];
var inboxPrivado = [];

var idmiDestinatarioPrivado = 0;
var colorletraEnviar = "";
var fontWeight = "normal";
var subr = "none";
var horaCtual;
var contadorMensajesPrivados = 0;

function tamanioimagen(e) {
    var imagensel = $(e).attr('src');
    $("#verimagenSeleccionada").attr("src", imagensel);
    $("#verimagenSeleccionada").show();
}

function limpiarimg() {
    $("#verimagenSeleccionada").attr("src", "");
    $("#verimagenSeleccionada").hide();
}

$(".inputTextChat").on("keyup", function(e) {
    if (e.which == 13) {
        textChat_send();
    } else {
        webSocket.emit('escribiendo', miNickName, miNickName, 1);
    }

});


function textChat_send() {
    var f = new Date();
    horaCtual = f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds();
    if ((document.getElementById("mynameuserPrivate").style.display) == "inline") {
        if (($(".inputTextChat").val()) != 0) {
            webSocket.emit('chat_Privado', "sala0", "<span  class='pull-left' id='textoAenviar' style='font-weight:" +
                fontWeight + "; color:" + colorletraEnviar + ";  text-decoration:" + subr + ";'>" + $(
                    ".inputTextChat").val() + "</span>", miNickName, misSalasPrivadas[idmiDestinatarioPrivado][1],
                miSexo, horaCtual);
            $(".inputTextChat").val("");
        }
    } else {
        if (($(".inputTextChat").val()) != 0) {
            console.log("enviando a sala---" + miNickName);
            console.log("<span  class='pull-left' id='textoAenviar' style='font-weight:" + fontWeight + "; color:" +
                colorletraEnviar + ";  text-decoration:" + subr + ";'>" + $(".inputTextChat").val() + "</span>");

            webSocket.emit('chat_publico', miNickName, "<span class='pull-left' id='textoAenviar' style='font-weight:" +
                fontWeight + "; color:" + colorletraEnviar + ";  text-decoration:" + subr + ";'>" + $(
                    ".inputTextChat").val() + "</span>", miNickName, miSexo, horaCtual);
            $(".inputTextChat").val("");
        }

    }
}

function enviarImagen() {
    var f = new Date();
    horaCtual = f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds();
    if ((document.getElementById("mynameuserPrivate").style.display) == "inline") {
        $(".inputTextChat").val("Enviando imagen...");
        webSocket.emit('chat_Privado', "sala0",
            "<img id='imagenesChat' onclick='tamanioimagen(this)' class='imagenChat' style='width:50px; cursor:pointer;' src='" +
            imagenUpload + "' />", miNickName, misSalasPrivadas[idmiDestinatarioPrivado][1], miSexo, horaCtual);
        setTimeout(function() {
            $(".inputTextChat").val("");
        }, 3000);
    } else {
        $(".inputTextChat").val("Enviando imagen...");
        webSocket.emit('chat_publico', "sala0",
            "<img id='imagenesChat' onclick='tamanioimagen(this)' class='imagenChat' style='width:50px; cursor:pointer;' src='" +
            imagenUpload + "' />", miNickName, miSexo, horaCtual);
        setTimeout(function() {
            $(".inputTextChat").val("");
        }, 3000);
    }
}

conectar_chat_modelo();

function conectar_chat_modelo() {
    //webSocket.emit('conectar_chat_publico',"sala0",miNickName,miSexo);
    webSocket.emit('conectar_usuario', miNickName, miNickName, "female");
    console.log("conectando a sala.." + miNickName);
}
//aun no encuentro aplicacion en este proy
function verifica_disponibilidad() {
    webSocket.emit('verifica_disponibilidad', "sala0");

}


webSocket.on('verificacion_chat_rp', function(listausuarios) {

    if (($(".nicNameuser").val()) == "") {
        document.getElementById('botonOk').style.display = 'none';
        document.getElementById('botonFalse').style.display = 'none';
    }
    if (listausuarios.length > 0) {

        for (var cont = 0; cont < listausuarios.length; cont++) {

            if ((listausuarios[cont][1]) == ($(".nicNameuser").val())) {
                document.getElementById('botonFalse').style.display = 'block';
                document.getElementById('botonOk').style.display = 'none';
                return false;

            } else {
                document.getElementById('botonFalse').style.display = 'none';
                document.getElementById('botonOk').style.display = 'block';
            }
        }
    } else {
        if (($(".nicNameuser").val()) == "") {
            document.getElementById('botonOk').style.display = 'none';
            document.getElementById('botonFalse').style.display = 'none';
        } else {
            document.getElementById('botonFalse').style.display = 'none';
            document.getElementById('botonOk').style.display = 'block';
        }
    }


});


webSocket.on('usrescribiendo', usrescribiendo);

function usrescribiendo(room, nickname, estatus) {
    console.log("entrante escribiendo...");
    if (estatus === 1) {
        for (var esc = 0; esc < listaUsuariosLocal.length; esc++) {

            if ((listaUsuariosLocal[esc][1]) === nickname) {
                listaUsuariosLocal[esc][1] = nickname +
                    "...... <i class='fa fa-pencil-alt' aria-hidden='true' style='color:green'></i>";

                return false;
            }
        }
        user_respuesta_chat(listaUsuariosLocal);
    }
}
webSocket.on('dejaescribir', dejaescribir);

function dejaescribir(nickname) {
    for (var escr = 0; escr < listaUsuariosLocal.length; escr++) {

        if ((listaUsuariosLocal[escr][1]) === (nickname +
                "...... <i class='fa fa-pencil-alt' aria-hidden='true' style='color:green'></i>")) {
            listaUsuariosLocal[escr][1] = nickname;
            user_respuesta_chat(listaUsuariosLocal);
            return false;
        }
    }


}
webSocket.on('usuarios_chat_rp', user_respuesta_chat);

function user_respuesta_chat(usuarios_con) {
    console.log("usuario conectado....");
    listaUsuariosLocal = usuarios_con;

    var con_usr = document.getElementById("contenedor_user").innerHTML = "";
    for (var a = 0; a < usuarios_con.length; a++) {
        var colorsex = "";
        if ((usuarios_con[a][2]) === "male") {
            colorsex = "blue";
        } else if ((usuarios_con[a][2]) === "female") {
            colorsex = "#FC19D8";
        }
        var con_usr = document.getElementById("contenedor_user").innerHTML;
        document.getElementById("contenedor_user").innerHTML =
            "<div class=\"inboxMedia media conversation\" style=\"margin-top:5px;\"> " +
            "&nbsp <i style=\"font-size:12px; color:" + colorsex +
            ";  margin-top:5px;\" class=\"fa fa-user\" aria-hidden=\"true\"></i>&nbsp" +
            "<div class=\"media-body\">" +
            "<span style='font-size:11px;' class=\"media-heading\">" + usuarios_con[a][1] + "</span>" +
            "</div>" +
            "</div>" + con_usr;
    }

}

function switchchat() {
    if (misSalasPrivadas.length > 0) {
        if ((document.getElementById("centerInbox").style.display) == "none") {
            document.getElementById("centerInbox").style.display = "";
            $("#contenedor_user").show();
            $("#inboxChat").show();
            $("#centerInbox").show();
            $("#mynameuserPrivate").hide();
            contadorMensajesPrivados = 0;
            document.getElementById("contadorMSJPrivados").innerHTML = contadorMensajesPrivados;

            document.getElementById("centerPublico").style.display = "none";
            $("#contenedor_mensaje_privado").hide();
            $("#inboxChatPrivate").hide();
            $("#centerPublico").hide();

        } else {
            agregarSalajePrivada();
            document.getElementById("centerInbox").style.display = "none";
            $("#contenedor_user").hide();
            $("#inboxChat").hide();
            $("#centerInbox").hide();
            document.getElementById("mynameuserPrivate").style.display = "inline";
            contadorMensajesPrivados = 0;
            document.getElementById("contadorMSJPrivados").innerHTML = contadorMensajesPrivados;

            document.getElementById("centerPublico").style.display = "";
            $("#contenedor_mensaje_privado").show();
            $("#inboxChatPrivate").show();
            $("#centerPublico").show();
        }
    } else {
        alert("No tiene mensajes privados.");
    }
}
//---------var chat privado --
function iniciarPrivado(id) {
    var f = new Date();
    horaCtual = f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds();

    if (miNickName != listaUsuariosLocal[id][1]) {
        $("#contenedor_user").hide();
        $("#inboxChat").hide();
        $("#centerInbox").hide();

        $("#contenedor_mensaje_privado").show();
        $("#inboxChatPrivate").show();
        $("#centerPublico").show();
        if (existeEnmiLista() != false) {
            idmiDestinatarioPrivado = ((existeEnmiLista()) - 1);
            document.getElementById("mynameuserPrivate").innerHTML = "&nbsp con: &nbsp" + listaUsuariosLocal[id][1];
            document.getElementById("mynameuserPrivate").style.display = "inline";
            contadorMensajesPrivados = 0;
            document.getElementById("contadorMSJPrivados").innerHTML = contadorMensajesPrivados;
            agregarSalajePrivada();
        } else {

            webSocket.emit('chat_pPrivados', "sala0", miNickName, listaUsuariosLocal[id][1], miSexo, horaCtual);
            document.getElementById("mynameuserPrivate").innerHTML = "&nbsp con: &nbsp" + listaUsuariosLocal[id][1];
            document.getElementById("mynameuserPrivate").style.display = "inline";
            misSalasPrivadas.push([miNickName + listaUsuariosLocal[id][1], listaUsuariosLocal[id][1], miSexo, horaCtual,
                0
            ]);
            document.getElementById("contadorPrivados").innerHTML = misSalasPrivadas.length + ".";
            idmiDestinatarioPrivado = misSalasPrivadas.length - 1;
            agregarSalajePrivada();

            contadorMensajesPrivados = 0;
            document.getElementById("contadorMSJPrivados").innerHTML = contadorMensajesPrivados;

        }
    }

    function existeEnmiLista() {
        for (var a = 0; a < misSalasPrivadas.length; a++) {
            if (((miNickName + listaUsuariosLocal[id][1]) == misSalasPrivadas[a][0]) || ((listaUsuariosLocal[id][1] +
                    miNickName) == misSalasPrivadas[a][0])) {
                return a + 1;
            }
        }
        return false;
    }
}
webSocket.on('chat_rpPrivado', function(remitente, destinatario, sexo, horaMensaje) {

    if (destinatario == miNickName) {
        if (buscaExitSalaP() != false) {
            idmiDestinatarioPrivado = misSalasPrivadas[(buscaExitSalaP() - 1)];
            document.getElementById("mynameuserPrivate").innerHTML = "&nbsp con: &nbsp" + remitente;
            document.getElementById("mynameuserPrivate").style.display = "none";

            agregarSalajePrivada();

        } else {
            misSalasPrivadas.push([remitente + destinatario, remitente, sexo, horaMensaje, 0]);
            document.getElementById("contadorPrivados").innerHTML = misSalasPrivadas.length + ".";
            document.getElementById("mynameuserPrivate").innerHTML = "&nbsp con: &nbsp" + remitente;
            document.getElementById("mynameuserPrivate").style.display = "none";
            idmiDestinatarioPrivado = misSalasPrivadas.length - 1;
            agregarSalajePrivada();

        }

    }

    function buscaExitSalaP() {
        for (var a = 0; a < misSalasPrivadas.length; a++) {
            if (((remitente + destinatario) == misSalasPrivadas[a][0]) || ((destinatario + remitente) ==
                    misSalasPrivadas[a][0])) {
                return a + 1;
            }
        }
        return false;
    }

});

function agregarSalajePrivada() {
    var con_msj_privado = document.getElementById("contenedor_mensaje_privado").innerHTML = "";
    var msjcontador = "";
    for (var a = 0; a < misSalasPrivadas.length; a++) {
        var colorsex = "";
        if ((misSalasPrivadas[a][2]) === "male") {
            colorsex = "blue";
        } else if ((misSalasPrivadas[a][2]) === "female") {
            colorsex = "#FC19D8";
        }
        if (misSalasPrivadas[a][4] > 0) {
            msjcontador = misSalasPrivadas[a][4];
        } else {
            msjcontador = "";
        }
        var con_msj_privado = document.getElementById("contenedor_mensaje_privado").innerHTML;
        document.getElementById("contenedor_mensaje_privado").innerHTML =
            "<div onclick=\"verMensajesPrivados(" + a +
            ")\" class=\"inboxMedia media conversation\" style=\"margin-top:5px;\"> " +
            "&nbsp <i style=\"font-size:12px; color:" + colorsex +
            ";  margin-top:5px;\" class=\"fa fa-user\" aria-hidden=\"true\"></i>&nbsp" +
            "<div class=\"media-body\">" +
            "<span style='font-size:11px;' class=\"pull-left media-heading\">" + misSalasPrivadas[a][1] + "</span> " +
            msjcontador +
            "</div>" +
            "</div>" + con_msj_privado;
    }
}

function verMensajesPrivados(id) {
    idmiDestinatarioPrivado = id;
    misSalasPrivadas[idmiDestinatarioPrivado][4] = 0;
    agregarSalajePrivada();

    document.getElementById("mynameuserPrivate").innerHTML = "&nbsp con: &nbsp" + misSalasPrivadas[id][1];
    document.getElementById("inboxChatPrivate").innerHTML = "";

    document.getElementById("inboxChatPrivate").innerHTML = "";
    for (var a = 0; a < inboxPrivado.length; a++) {
        if (misSalasPrivadas[idmiDestinatarioPrivado][0] == inboxPrivado[a][0]) {
            var sexUsuarioActivo = "";
            if (inboxPrivado[a][4] === "male") {
                sexUsuarioActivo =
                    "<i style=\"font-size:14px; color:blue; margin-top:5px;\" class=\"fa fa-user\" aria-hidden=\"true\"></i>";
            } else if (inboxPrivado[a][4] === "female") {
                sexUsuarioActivo =
                    "<i style=\"font-size:14px; color:#FC19D8; margin-top:5px;\" class=\"fa fa-user\" aria-hidden=\"true\"></i>";
            }



            var contInbox = document.getElementById("inboxChatPrivate").innerHTML;
            document.getElementById("inboxChatPrivate").innerHTML =
                "<div class=\"media msg\">" +
                sexUsuarioActivo + "&nbsp" +
                "<div class=\"media-body\">" +
                " <small class=\"pull-right time\" style=\"color:#ADADAD;\"><i class=\"far fa-clock\"></i> " +
                inboxPrivado[a][5] + "</small>" +
                "<span class=\"pull-left media-heading\"><strong>" + inboxPrivado[a][2] + ":</strong></span>" +
                "<small class=\"col-lg-10\">" + inboxPrivado[a][1] + "</small>" +
                "</div>" +
                "</div>" + contInbox;
        }
    }
    ////
}
webSocket.on('msj_puente_privados', actualizaChatPrivado);

function actualizaChatPrivado(mensaje, nickname, destinatario, misexo, horamensaje) {
    if (existeEnmiListaPrivada() != false) {
        if (nickname != miNickName) {
            misSalasPrivadas[existeEnmiListaPrivada() - 1][4] = ((misSalasPrivadas[existeEnmiListaPrivada() - 1][4]) +
                1);
        }

        inboxPrivado.push([misSalasPrivadas[(existeEnmiListaPrivada() - 1)][0], mensaje, nickname, destinatario, misexo,
            horamensaje
        ]);
        if (nickname != miNickName) {
            document.getElementById('audioMensajenuevo').play();
        }
        document.getElementById("inboxChatPrivate").innerHTML = "";
        for (var a = 0; a < inboxPrivado.length; a++) {
            if (misSalasPrivadas[idmiDestinatarioPrivado][0] == inboxPrivado[a][0]) {
                var sexUsuarioActivo = "";
                if (inboxPrivado[a][4] === "male") {
                    sexUsuarioActivo =
                        "<i style=\"font-size:14px; color:blue; margin-top:5px;\" class=\"fa fa-user\" aria-hidden=\"true\"></i>";
                } else if (inboxPrivado[a][4] === "female") {
                    sexUsuarioActivo =
                        "<i style=\"font-size:14px; color:#FC19D8; margin-top:5px;\" class=\"fa fa-user\" aria-hidden=\"true\"></i>";
                }



                var contInbox = document.getElementById("inboxChatPrivate").innerHTML;
                document.getElementById("inboxChatPrivate").innerHTML =
                    "<div class=\"media msg\">" +
                    sexUsuarioActivo + "&nbsp" +
                    "<div class=\"media-body\">" +
                    " <small class=\"pull-right time\" style=\"color:#ADADAD;\"><i class=\"far fa-clock\"></i> " +
                    inboxPrivado[a][5] + "</small>" +
                    "<span class=\"pull-left media-heading\"><strong>" + inboxPrivado[a][2] + ":</strong></span>" +
                    "<small class=\"col-lg-10\">" + inboxPrivado[a][1] + "</small>" +
                    "</div>" +
                    "</div>" + contInbox;
            }
        }
        contadorMensajesPrivados = contadorMensajesPrivados + 1;
        document.getElementById("contadorMSJPrivados").innerHTML = contadorMensajesPrivados;

    } else {
        //
    }

    function existeEnmiListaPrivada() {
        for (var a = 0; a < misSalasPrivadas.length; a++) {
            if ((nickname + destinatario == misSalasPrivadas[a][0]) || ((destinatario + nickname) == misSalasPrivadas[a]
                    [0])) {
                return a + 1;
            }
        }
        return false;
    }
}
webSocket.on('actualizaLocal_chat_rp', local_respuesta_chat);

function local_respuesta_chat(mensajes) {
    console.log("usuario conectado a la sala");

    console.log("actualizando lista tamaño--" + mensajes.length);
    inboxLocal = mensajes;
    var contInbox = document.getElementById("inboxChat").innerHTML = "";
    //   contenedorInbox40.push([misexo,nickname,mensajes]);
    for (var a = 0; a < mensajes.length; a++) {

        var sexUsuarioActivo = "";
        if ((mensajes[a][0]) === "male") {
            sexUsuarioActivo =
                "<i style=\"font-size:14px; color:blue; margin-top:5px;\" class=\"fa fa-user\" aria-hidden=\"true\"></i>";
        } else if ((mensajes[a][0]) === "female") {
            sexUsuarioActivo =
                "<i style=\"font-size:14px; color:#FC19D8; margin-top:5px;\" class=\"fa fa-user\" aria-hidden=\"true\"></i>";
        }



        var contInbox = document.getElementById("inboxChat").innerHTML;
        document.getElementById("inboxChat").innerHTML =

            "<div class=\"media1 msg\">" +
            "<div class=\"media-body\">" +
            " <small class=\"pull-right time\" style=\"color:#ADADAD;\"><i class=\"far fa-clock\"></i> " + mensajes[a][
                3] + "</small>" +
            "<span class=\"pull-left media-heading\"><strong>" + mensajes[a][1] + "--\> </strong></span>" +
            "<small class=\"col-lg-10\">" + mensajes[a][2] + "</small>" +
            "</div>" +
            "</div>" + contInbox;

    }

}

webSocket.on('chat_rp', respuesta_chat);

function respuesta_chat(misexo, nickname, mensaje, horamensaje) {
    console.log("recibiendo mensaje.. en modelo.");
    if (nickname != miNickName) {
        //document.getElementById('audioMensajenuevo').play();
    }

    var sexUsuarioActivo = "";
    if (misexo === "male") {
        sexUsuarioActivo =
            "<i style=\"font-size:14px; color:blue; margin-top:5px;\" class=\"fa fa-user\" aria-hidden=\"true\"></i>";
    } else if (misexo === "female") {
        sexUsuarioActivo =
            "<i style=\"font-size:14px; color:#FC19D8; margin-top:5px;\" class=\"fa fa-user\" aria-hidden=\"true\"></i>";
    }



    var contInbox = document.getElementById("inboxChat").innerHTML;
    document.getElementById("inboxChat").innerHTML =
        "<div class=\"media1 msg\">" +
        "<div class=\"media-body\">" +
        " <small class=\"pull-right time\" style=\"color:#ADADAD;\"><i class=\"far fa-clock\"></i> " + horamensaje +
        "</small>" +
        "<span class=\"pull-left media-heading\"><strong>" + nickname + "--\> </strong></span>" +
        "<small class=\"col-lg-10\">" + mensaje + "</small>" +
        "</div>" +
        "</div>" + contInbox;


}
</script>