function GuardarCargo()
{
	oData          = new Object();	
	oData.nombre   = $('#nombre').val();
	oData.status   = $('#status').val();
	oData.superior = $('#superior').val();
	
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

function ActualizarCargo()
{
	oData          = new Object();	
	oData.id       = $('#id').val();
	oData.nombre   = $('#nombre').val();
	oData.status   = $('#status').val();
	oData.superior = $('#superior').val();
	
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