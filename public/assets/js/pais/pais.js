function GuardarPais()
{
	oData          = new Object();	
	oData.nombre   = $('#nombre').val();
	oData.codigo   = $('#codigo').val();
	oData.status   = $('#status').val();
	
	$.ajax({
		type: "POST",
		url: "/pais/save",
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
				            location.href = "/pais";
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
				            location.href = "/pais";
				        }
				    }
				});
			}
		}
	});
}

function ActualizarPais()
{
	oData          = new Object();	
	oData.id       = $('#id').val();
	oData.nombre   = $('#nombre').val();
	oData.codigo   = $('#codigo').val();
	oData.status   = $('#status').val();
	
	$.ajax({
		type: "POST",
		url: "/pais/edit",
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
				            location.href = "/pais";
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
				            location.href = "/pais";
				        }
				    }
				});
			}
		}
	});
}