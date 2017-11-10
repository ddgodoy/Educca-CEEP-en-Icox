<div id="chatdiv">
    <div id='cabeceraSala'><strong>Sala de chat: <?php echo $curso ?></strong></div>

    <div id='contenedor' class='contenedor'>

    	<div id='scroll' class='scroll'></div>

      <div class='usuario'></div>

    	<div id='entrada' class='entrada'>
        	<form id='formchat' name='formchat'>
        	    <?php echo input_hidden_tag('id', $id) ?>
                <?php echo input_hidden_tag('ultimo', -1) ?>
                <?php echo input_hidden_tag('nick',$nombreUsuario) ?>
        		<!--input id='mensaje' name='mensaje' class='mensaje' type='text' maxlength='120' size='50' autocomplete="off" / -->
        		<textarea id='mensaje' name='mensaje' class='mensaje' type='text' rows="2" cols="52" onkeypress="pulsar(event)" autocomplete="off"></textarea>
        		<input id='botoncete' class='botoncete' type='submit' value='Enviar' />
        	</form>
      		<span id='error' class='error'></span>
    	</div>
    </div>

    <div id='conectados'></div>
</div>
 <script>

  function pulsar(e) {
    tecla = (document.all) ? e.keyCode :e.which;
    if (13==tecla)
	 { if (   ($('#mensaje').val())!=''  )
	     {
	       envio();
	       $('#mensaje').val('');}
     }
  }

   function addUsuarios(xml) {

     $("#conectados").html("<div class='divconectados'><strong>USUARIOS CONECTADOS</strong></div>");

     $("usuarios",xml).each(function(id) {
       usuario = $("usuarios",xml).get(id);

        if ($("tipo",usuario).text() == "profesor")
            imagen = "<img src='/images/profesor.png' width='12' height='12' Title='Profesor'>";
        else
            imagen = "<img src='/images/alumno.png' width='12' height='12' Title='Alumno'>";

       $("#conectados").append("<p align='left'>"+imagen+" "+$("nombre",usuario).text()+
                     "</p>");


     });
   }


   function updateUsuarios() {
      idcurso = $("#id").val();
      $.post("/chat/usuariosConectados",{  id: idcurso }, function(xml) {
       $("#loading").remove();
       addUsuarios(xml);
     });
     setTimeout('updateUsuarios()', 9000);
   }


   function updateMensajes() {
      $.ajax
      (
       {
       	type: "POST",
       	url: "/chat/getmessages",
       	data: "ultimo="+document.formchat.ultimo.value+"&id="+document.formchat.id.value, // ultimo:document.formchat.ultimo.value
       	success: function(xml)
       		{  if($("status",xml).text()) {alert("entra2");return;}
       		   $("message",xml).each(function(id) {
                     message = $("message",xml).get(id);
         		  //Agregamos el mensaje y la respuesta a la capa "scroll"
         		 $('#scroll').append("<p align='left'><b>"+$("author",message).text()+" ("+
                        $("time",message).text()+")</b>: "+$("text",message).text()+"</p>");
                    //document.formchat.mensaje.value="";
                    document.formchat.ultimo.value=$("idmessage",message).text();
                  })

         		//Movemos el scroll hasta abajo para que muestre el último mensaje
         		//document.getElementById('scroll').scrollTop = document.getElementById('scroll').scrollHeight - document.getElementById('scroll').offsetHeight;
         		var objDiv = document.getElementById("scroll");
                objDiv.scrollTop = objDiv.scrollHeight;
       		}
       }
      );
      $('#mensaje').focus();
       setTimeout('updateMensajes()', 2000);
      return false;
   }

    setTimeout('updateMensajes()', 1500);

//Añadimos en el evento onclik del boton de envio la llamada a la funcion envio()
$(document).ready
(
  function()
  {
    //$('#botoncete').click(envio);
    //$('#botoncete').submit(envio);
    $('#formchat').submit(envio);
    $('#mensaje').focus();
  }
);

//Esta función se lanza cuando hacemos click en el botón de envio
function envio()
{
  //Comprobamos que haya escrito algo en el campo mensaje
  if (($('#mensaje').val())!='')
  {
  	  //Mostramos en pantalla lo que ha escrito el usuario
  	  //$('#scroll').append("<p><span class='usuario'>"+$('#nick').val()+": </span>"+$('#mensaje').val()+"</p>");
  	  //document.getElementById('scroll').scrollTop = document.getElementById('scroll').scrollHeight - document.getElementById('scroll').offsetHeight;

      //Mediante Ajax enviamos el mensaje a la pagina procesar.php
       $.ajax
      (
       {
       	type: "POST",
       	url: "/chat/getmessages",
       	data: "message="+$('#mensaje').val()+"&operation=postmsg&id="+document.formchat.id.value,
       //	success: function(msg)
       //		{
              	success: function(xml)
       		{
       		   $("message",xml).each(function(id) {
                     message = $("message",xml).get(id);
         		  //Agregamos el mensaje y la respuesta a la capa "scroll"
         		 $('#scroll').append("<p align='left'><b>"+$("author",message).text()+" ("+
                        $("time",message).text()+")</b>: "+$("text",message).text()+"</p>");
                    document.formchat.mensaje.value="";
                    document.formchat.ultimo.value=$("idmessage",message).text();
                 })

         		//Movemos el scroll hasta abajo para que muestre el último mensaje
         		//document.getElementById('scroll').scrollTop = document.getElementById('scroll').scrollHeight - document.getElementById('scroll').offsetHeight;
         		var objDiv = document.getElementById("scroll");
                objDiv.scrollTop = objDiv.scrollHeight;

            //Limpiamos el mensaje que hemos enviado del input text
            $('#mensaje').val('');

       		}
       }
      );
      $('#mensaje').focus();
      return false;
  }
  //En caso de no haber mensaje mostramos un aviso
  else
  {
    $('#mensaje').focus();
    return false;
  }
}




updateUsuarios();

 </script>
