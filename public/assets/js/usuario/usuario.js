function ActualizarUsuario()
{
	oData        = new Object();	
	oData.id     = $('#id').val();
	oData.sede   = $('#sede').val();
	oData.area   = $('#area').val();
	oData.cargo  = $('#cargo').val();
	
	$.ajax({
		type: "POST",
		url: "/usuario/edit",
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
				            location.href = "/usuario";
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
				            location.href = "/usuario";
				        }
				    }
				});
			}
		}
	});
}