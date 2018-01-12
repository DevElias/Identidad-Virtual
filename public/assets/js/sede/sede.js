function GuardarSede()
{
	oData          = new Object();	
	oData.nombre   = $('#nombre').val();
	oData.pais     = $('#pais').val();
	oData.status   = $('#status').val();
	
	$.ajax({
		type: "POST",
		url: "/sede/save",
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
				            location.href = "/sede";
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
				            location.href = "/sede";
				        }
				    }
				});
			}
		}
	});
}

function ActualizarSede()
{
	oData          = new Object();	
	oData.id       = $('#id').val();
	oData.nombre   = $('#nombre').val();
	oData.pais     = $('#pais').val();
	oData.status   = $('#status').val();
	
	$.ajax({
		type: "POST",
		url: "/sede/edit",
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
				            location.href = "/sede";
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
				            location.href = "/sede";
				        }
				    }
				});
			}
		}
	});
}