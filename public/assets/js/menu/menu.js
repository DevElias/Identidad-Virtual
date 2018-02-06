function BuscaStatus()
{
	oData = new Object();	
		
	$.ajax({
		type: "POST",
		url: "/menu/status",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
		}
	});
}

function MudaStatus()
{
	oData          = new Object();	
	
	console.log(oData.status);
		
	$.ajax({
		type: "POST",
		url: "/menu/change",
		dataType: "json",
		data: oData,
		success: function(oData)
		{	
			
		}
	});
}
