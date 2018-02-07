function GuardarRegion()
{
	oData          = new Object();	
	oData.nombre   = $('#nombre').val();
	oData.codigo   = $('#codigo').val();
	oData.status   = $('#status').val();
	
	$.ajax({
		type: "POST",
		url: "/region/save",
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
				            location.href = "/region";
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
				            location.href = "/region";
				        }
				    }
				});
			}
		}
	});
}

function ActualizarRegion()
{
	oData          = new Object();	
	oData.id       = $('#id').val();
	oData.nombre   = $('#nombre').val();
	oData.codigo   = $('#codigo').val();
	oData.status   = $('#status').val();
	
	$.ajax({
		type: "POST",
		url: "/region/edit",
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
				            location.href = "/region";
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
				            location.href = "/region";
				        }
				    }
				});
			}
		}
	});
}