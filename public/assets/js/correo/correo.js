function CrearCorreo()
{
	oData           = new Object();	
	oData.hacer     = 'Crear';
	oData.pais      = $('#pais').val();
	oData.appelido  = $('#appelido').val();
	oData.nombre    = $('#nombre').val();
	oData.correo    = $('#correo').val();
	oData.area      = $('#area').val();
	oData.rol       = $('#rol').val();
	oData.motivo    = $('#motivo').val();
	oData.copia     = $('#copia').val();
	
	$.ajax({
		type: "POST",
		url: "/correo/crear",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$.confirm({
				    content: "Solicitado con éxito.",
				    buttons: {
				        ok: function(){
				            location.href = "/correo/concluir";
				        }
				    }
				});
			}
			else
			{
				$.confirm({
				    content: "Erro ao Solicitar.",
				    buttons: {
				        ok: function(){
				            location.href = "/";
				        }
				    }
				});
			}
		}
	});
}

function CrearNickname()
{
	oData            = new Object();	
	oData.hacer      = 'Crear un Alias (nickname)';
	oData.pais       = $('#pais').val();
	oData.cuentareal = $('#correo-real').val();
	oData.alias      = $('#alias').val();
	oData.motivo     = $('#motivo-nickame-value').val();
	oData.copia      = $('#copia-nickname').val();
	
	$.ajax({
		type: "POST",
		url: "/correo/nickname",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$.confirm({
				    content: "Solicitado con éxito.",
				    buttons: {
				        ok: function(){
				            location.href = "/correo/concluir";
				        }
				    }
				});
			}
			else
			{
				$.confirm({
				    content: "Erro ao Solicitar.",
				    buttons: {
				        ok: function(){
				            location.href = "/";
				        }
				    }
				});
			}
		}
	});
}

function Modificar()
{
	oData            = new Object();	
	oData.hacer      = 'Modificar';
	oData.pais       = $('#pais').val();
	oData.modify     = $('#modify').val();
	oData.motivo     = $('#motivo-modificar-value').val();
	oData.copia      = $('#copia-modificar').val();
	
	$.ajax({
		type: "POST",
		url: "/correo/modificar",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$.confirm({
				    content: "Solicitado con éxito.",
				    buttons: {
				        ok: function(){
				            location.href = "/correo/concluir";
				        }
				    }
				});
			}
			else
			{
				$.confirm({
				    content: "Erro ao Solicitar.",
				    buttons: {
				        ok: function(){
				            location.href = "/";
				        }
				    }
				});
			}
		}
	});
}

function Recuperar()
{
	oData                  = new Object();	
	oData.hacer            = 'Recuperar contraseña';
	oData.pais             = $('#pais').val();
	oData.correo_recuperar = $('#correo-recuperar').val();
	oData.motivo     	   = $('#motivo-recuperar-value').val();
	oData.copia            = $('#copia-recuperar').val();
	
	$.ajax({
		type: "POST",
		url: "/correo/recuperar",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$.confirm({
				    content: "Solicitado con éxito.",
				    buttons: {
				        ok: function(){
				            location.href = "/correo/concluir";
				        }
				    }
				});
			}
			else
			{
				$.confirm({
				    content: "Erro ao Solicitar.",
				    buttons: {
				        ok: function(){
				            location.href = "/";
				        }
				    }
				});
			}
		}
	});
}

function Suspender()
{
	oData                  = new Object();	
	oData.hacer            = 'Suspender (Bloquear)';
	oData.pais             = $('#pais').val();
	oData.correo_suspender = $('#correo-suspender').val();
	oData.motivo     	   = $('#motivo-suspender-value').val();
	oData.copia            = $('#copia-suspender').val();
	
	$.ajax({
		type: "POST",
		url: "/correo/suspender",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$.confirm({
				    content: "Solicitado con éxito.",
				    buttons: {
				        ok: function(){
				            location.href = "/correo/concluir";
				        }
				    }
				});
			}
			else
			{
				$.confirm({
				    content: "Erro ao Solicitar.",
				    buttons: {
				        ok: function(){
				            location.href = "/";
				        }
				    }
				});
			}
		}
	});
}

function Eliminar()
{
	oData                  = new Object();	
	oData.hacer            = 'Eliminar';
	oData.pais             = $('#pais').val();
	oData.correo_eliminar  = $('#correo-eliminar').val();
	
	if($("#si").is(':checked')) 
	{  
		oData.correo_origen  = $('#correo-origem').val();
		oData.correo_destino = $('#correo-destino').val();
		oData.transferDoc    = 'Sí';
    }
	else
	{
		oData.transferDoc = 'No';
	}
	
	oData.motivo     	   = $('#motivo-eliminar-value').val();
	oData.copia            = $('#copia-eliminar').val();
	
	$.ajax({
		type: "POST",
		url: "/correo/eliminar",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$.confirm({
				    content: "Solicitado con éxito.",
				    buttons: {
				        ok: function(){
				            location.href = "/correo/concluir";
				        }
				    }
				});
			}
			else
			{
				$.confirm({
				    content: "Erro ao Solicitar.",
				    buttons: {
				        ok: function(){
				            location.href = "/";
				        }
				    }
				});
			}
		}
	});
}

function Transferir()
{
	oData                  = new Object();	
	oData.hacer            = 'Transferir Documentos';
	oData.pais             = $('#pais').val();
	oData.correo_origen    = $('#correo-origem-transfer').val();
	oData.correo_destino   = $('#correo-destino-transfer').val();
	oData.motivo     	   = $('#motivo-transfer-value').val();
	oData.copia            = $('#copia-tranfer').val();
	
	$.ajax({
		type: "POST",
		url: "/correo/transferir",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$.confirm({
				    content: "Solicitado con éxito.",
				    buttons: {
				        ok: function(){
				            location.href = "/correo/concluir";
				        }
				    }
				});
			}
			else
			{
				$.confirm({
				    content: "Erro ao Solicitar.",
				    buttons: {
				        ok: function(){
				            location.href = "/";
				        }
				    }
				});
			}
		}
	});
}

function Validation()
{
	//Crear Correo
	$("#correo").blur(function()
	{
		 var reg=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;

		 if(reg.test($("#correo").val()))
		 {
			 $("#correo").removeClass("erroCorreo");
			 $("#correo").attr("style", "");
			 $(".errorC").remove();
			 $('#part3').prop('disabled', false);
		 } 
		 else
		 {
			 $("#correo").removeClass("erroCorreo");
			 $("#correo").attr("style", "");
			 $(".errorC").remove();
			 var msg = 'No es un correo v\u00E1lido.';
			 $( "#correo" ).focus();
		     $("#correo").addClass("erroCorreo");
		     $(".erroCorreo").css("border", "1px solid red").after('<p class="errorC" style="color:red;">' + msg + '</p>');
		     $('#part3').prop('disabled', true);
		 }
	});
	
	//Crear nickname
	$("#correo-real").blur(function()
	{
		 var reg=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;

		 if(reg.test($("#correo-real").val()))
		 {
			 $("#correo-real").removeClass("erroData");
			 $("#correo-real").attr("style", "");
			 $(".error").remove();
			 $('#finaliza-nickname').prop('disabled', false);
		 } 
		 else
		 {
			 $("#correo-real").removeClass("erroData");
			 $("#correo-real").attr("style", "");
			 $(".error").remove();
			 var msg = 'No es un correo v\u00E1lido.';
			 $( "#correo-real" ).focus();
		     $("#correo-real").addClass("erroData");
		     $(".erroData").css("border", "1px solid red").after('<p class="error" style="color:red;">' + msg + '</p>');
		     $('#finaliza-nickname').prop('disabled', true);
		 }
	});
	
	//recuperar contrasena
	$("#correo-recuperar").blur(function()
	{
		 var reg=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;

		 if(reg.test($("#correo-recuperar").val()))
		 {
			 $("#correo-recuperar").removeClass("erroData");
			 $("#correo-recuperar").attr("style", "");
			 $(".error").remove();
			 $('#finaliza-recuperar').prop('disabled', false);
		 } 
		 else
		 {
			 $("#correo-recuperar").removeClass("erroData");
			 $("#correo-recuperar").attr("style", "");
			 $(".error").remove();
			 var msg = 'No es un correo v\u00E1lido.';
			 $( "#correo-recuperar" ).focus();
		     $("#correo-recuperar").addClass("erroData");
		     $(".erroData").css("border", "1px solid red").after('<p class="error" style="color:red;">' + msg + '</p>');
		     $('#finaliza-recuperar').prop('disabled', true);
		 }
	});
	
	//Correo a suspender
	$("#correo-suspender").blur(function()
	{
		 var reg=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;

		 if(reg.test($("#correo-suspender").val()))
		 {
			 $("#correo-suspender").removeClass("erroData");
			 $("#correo-suspender").attr("style", "");
			 $(".error").remove();
			 $('#finaliza-suspender').prop('disabled', false);
		 } 
		 else
		 {
			 $("#correo-suspender").removeClass("erroData");
			 $("#correo-suspender").attr("style", "");
			 $(".error").remove();
			 var msg = 'No es un correo v\u00E1lido.';
			 $( "#correo-suspender" ).focus();
		     $("#correo-suspender").addClass("erroData");
		     $(".erroData").css("border", "1px solid red").after('<p class="error" style="color:red;">' + msg + '</p>');
		     $('#finaliza-suspender').prop('disabled', true);
		 }
	});
	
	//Correo a Eliminar
	$("#correo-eliminar").blur(function()
	{
		 var reg=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;

		 if(reg.test($("#correo-eliminar").val()))
		 {
			 $("#correo-eliminar").removeClass("erroData");
			 $("#correo-eliminar").attr("style", "");
			 $(".error").remove();
			 $('#finaliza-eliminar').prop('disabled', false);
		 } 
		 else
		 {
			 $("#correo-eliminar").removeClass("erroData");
			 $("#correo-eliminar").attr("style", "");
			 $(".error").remove();
			 var msg = 'No es un correo v\u00E1lido.';
			 $( "#correo-eliminar" ).focus();
		     $("#correo-eliminar").addClass("erroData");
		     $(".erroData").css("border", "1px solid red").after('<p class="error" style="color:red;">' + msg + '</p>');
		     $('#finaliza-eliminar').prop('disabled', true);
		 }
	});
	
	//Transferir Documentos Correo Origen
	$("#correo-origem-transfer").blur(function()
	{
		 var reg=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;

		 if(reg.test($("#correo-origem-transfer").val()))
		 {
			 $("#correo-origem-transfer").removeClass("erroData");
			 $("#correo-origem-transfer").attr("style", "");
			 $(".error").remove();
			 $('#finaliza-transfer').prop('disabled', false);
		 } 
		 else
		 {
			 $("#correo-origem-transfer").removeClass("erroData");
			 $("#correo-origem-transfer").attr("style", "");
			 $(".error").remove();
			 var msg = 'No es un correo v\u00E1lido.';
			 $( "#correo-origem-transfer" ).focus();
		     $("#correo-origem-transfer").addClass("erroData");
		     $(".erroData").css("border", "1px solid red").after('<p class="error" style="color:red;">' + msg + '</p>');
		     $('#finaliza-transfer').prop('disabled', true);
		 }
	});
	
	//Transferir Documentos Correo Destino
	$("#correo-destino-transfer").blur(function()
	{
		 var reg=/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;

		 if(reg.test($("#correo-destino-transfer").val()))
		 {
			 $("#correo-destino-transfer").removeClass("erroData");
			 $("#correo-destino-transfer").attr("style", "");
			 $(".error").remove();
			 $('#finaliza-transfer').prop('disabled', false);
		 } 
		 else
		 {
			 $("#correo-destino-transfer").removeClass("erroData");
			 $("#correo-destino-transfer").attr("style", "");
			 $(".error").remove();
			 var msg = 'No es un correo v\u00E1lido.';
			 $( "#correo-destino-transfer" ).focus();
		     $("#correo-destino-transfer").addClass("erroData");
		     $(".erroData").css("border", "1px solid red").after('<p class="error" style="color:red;">' + msg + '</p>');
		     $('#finaliza-transfer').prop('disabled', true);
		 }
	});
	
	$("#pais").change(function() 
	{
		  if($("#pais").val() != 0)
		  {
			  $('#part2').prop('disabled', false);
		  }
		  else
		  {
			  $('#part2').prop('disabled', true);
		  }
	});
}

function ActualizarCorreo()
{
	oData                = new Object();	
	oData.id             = $('#id').val();
	oData.contrasena     = $('#contrasena_temporal').val();
	oData.estadoPersonas = $('#estado_personas').val();
	oData.estadoPyt      = $('#estado_pyt').val();
	oData.comentario     = $('#comentario').val();
	
	$.ajax({
		type: "POST",
		url: "/correo/edit",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			if(oData['results'])
			{
				$.confirm({
				    content: "Actualizado  con éxito.",
				    buttons: {
				        ok: function(){
				            location.href = "/correo/listado";
				        }
				    }
				});
			}
			else
			{
				$.confirm({
				    content: "Erro ao Actualizar.",
				    buttons: {
				        ok: function(){
				            location.href = "/correo/listado";
				        }
				    }
				});
			}
		}
	});
}


	
