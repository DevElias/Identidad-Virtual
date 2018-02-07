function GuardarCargo()
{
	oData          = new Object();	
	oData.nombre   = $('#nombre').val();
	oData.status   = $('#status').val();
	oData.superior = $('#superior').val();
	oData.detalle  = $('#detalle').val();
	
	if($('#superior').val() != 0)
	 {
		 $("#superior").removeClass("erroData");
		 $("#superior").attr("style", "");
		 $(".error").remove();
		 $('#loading-techo').show();
		 
		 $.ajax({
				type: "POST",
				url: "/cargo/save",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['results'])
					{
						$.confirm({
						    content: "Grabado con éxito.",
						    buttons: {
						        ok: function(){
						            location.href = "/cargo";
						        }
						    }
						});
					}
					else
					{
						$.confirm({
						    content: "Erro ao Grabar.",
						    buttons: {
						        ok: function(){
						            location.href = "/cargo";
						        }
						    }
						});
					}
				}
			});
	 } 
	 else
	 {
		 $("#superior").removeClass("erroData");
		 $("#superior").attr("style", "");
		 $(".error").remove();
		 var msg = 'Campo Obligatorio.';
		 $( "#superior" ).focus();
	     $("#superior").addClass("erroData");
	     $(".erroData").css("border", "1px solid red").after('<p class="error" style="color:red;">' + msg + '</p>');
	     return false;
	 }
}

function ActualizarCargo()
{
	oData          = new Object();	
	oData.id       = $('#id').val();
	oData.nombre   = $('#nombre').val();
	oData.status   = $('#status').val();
	oData.superior = $('#superior').val();
	oData.detalle  = $('#detalle').val();
	
	$.ajax({
		type: "POST",
		url: "/cargo/edit",
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
				            location.href = "/cargo";
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
				            location.href = "/cargo";
				        }
				    }
				});
			}
		}
	});
}