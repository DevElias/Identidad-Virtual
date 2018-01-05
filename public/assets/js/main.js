$('#loading').hide(); //Sempre esconde
//Metodo de Login do Usuario
function Acessar()
{
	oData         = new Object();	
	oData.acao    = "Login";
	oData.usuario = $('#usuario').val(); 
	oData.senha   = $('#senha').val();
	
	$('#loading').show();
	
	$.ajax({
				type: "POST",
				url: "http://www.macintel.com.br/app/controller/Controller.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['results'])
					{
						window.location.assign("http://www.macintel.com.br/app/view/home.php");
						
						$('#loading').hide();
					}
					else
					{
						$.confirm({
						    content: "Usu\u00e1rio ou senha incorreta!",
						    buttons: {
						        ok: function(){
						            
						        }
						    }
						});
						
						$('#loading').hide();
					}
				}
			});	
}


//Metodo de Gravacao de Clientes
function GravarCliente()
{
	//$("#btn-gravarcli").addClass('disabled'); //Disabled do Btn
	
	oData          = new Object();	
	oData.acao     = "GravarCliente";
	oData.nome     = $('#nome').val(); 
	oData.senha    = $('#senha').val(); 
	oData.email    = $('#email').val(); 
	oData.cpf      = $('#cpf').val(); 
	oData.endereco = $('#endereco').val(); 
	oData.telefone = $('#telefone').val(); 
	oData.perfil   = $('#perfil').val(); 
	oData.nomeuser = $('#nomeuser').val(); 
	
	$('#loading').show();
	
	$.ajax({
				type: "POST",
				url: "http://www.macintel.com.br/app/controller/Controller.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['results'])
					{
						$.confirm({
						    content: "Gravado com Sucesso.",
						    buttons: {
						        ok: function(){
						            location.href = "http://www.macintel.com.br/app/view/home.php";
						        }
						    }
						});
						
						$('#loading').hide();
						
						//window.location.assign("http://www.macintel.com.br/app/view/home.php")
					}
					else
					{
						$.confirm({
						    content: "Erro ao Gravar.",
						    buttons: {
						        ok: function(){
						            location.href = "http://www.macintel.com.br/app/view/usuario.php";
						        }
						    }
						});
						
						$('#loading').hide();
					}
				}
			});	
}

//Metodo de Listagem de Clientes
function ListaCliente()
{
	oData          = new Object();	
	oData.acao     = "ListaCliente";
	
	$.ajax({
		type: "POST",
		url: "http://www.macintel.com.br/app/controller/Controller.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{
			if(oData['results'])
			{
				$('#Lista').html(oData['results']);
			}
			else
			{
				alert('ERRO ao Carregar');
			}
		}
	});	
}

//Metodo para Carregar Dados de Clientes (Edição)
function EditarCliente(id)
{
	oData          = new Object();	
	oData.acao     = "EditarCliente";
	oData.id       = id;
	
	window.location.assign("http://www.macintel.com.br/app/view/editar-usuario.php/?id="+ id)
}

//Metodo de Alterar os Clientes
function AtualizarCliente(id)
{
	oData          = new Object();	
	oData.acao     = "AtualizarCliente";
	oData.id       = id;
	oData.nome     = $('#nome').val(); 
	oData.senha    = $('#senha').val(); 
	oData.email    = $('#email').val(); 
	oData.cpf      = $('#cpf').val(); 
	oData.endereco = $('#endereco').val(); 
	oData.telefone = $('#telefone').val(); 
	oData.perfil   = $('#perfil').val(); 
	oData.nomeuser = $('#nomeuser').val();
	
	$('#loading').show();
	
	$.ajax({
		type: "POST",
		url: "http://www.macintel.com.br/app/controller/Controller.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{
			if(oData['results'])
			{
				$.confirm({
				    content: "Alterado com Sucesso.",
				    buttons: {
				        ok: function(){
				            location.href = "http://www.macintel.com.br/app/view/home.php";
				        }
				    }
				});
				
				$('#loading').hide();
				
				//window.location.assign("http://www.macintel.com.br/app/view/home.php")
			}
			else
			{
				$.confirm({
				    content: "Erro ao Editar.",
				    buttons: {
				        ok: function(){
				            location.href = "http://www.macintel.com.br/app/view/usuario.php";
				        }
				    }
				});
				
				$('#loading').hide();
			}
		}
	});	
}

//Metodo de Exclusão de Clientes
function ExcluirCliente(id)
{
	oData          = new Object();	
	oData.acao     = "ExcluirCliente";
	oData.id       = id;
	
	$.ajax({
		type: "POST",
		url: "http://www.macintel.com.br/app/controller/Controller.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{
			if(oData['results'])
			{
				$.confirm({
				    content: "Excluido com Sucesso.",
				    buttons: {
				        ok: function(){
				            location.href = "http://www.macintel.com.br/app/view/listagem-usuarios.php";
				        }
				    }
				});
				
				//location.reload();
			}
			else
			{
				$.confirm({
				    content: "Erro ao Excluir.",
				    buttons: {
				        ok: function(){
				            location.href = "http://www.macintel.com.br/app/view/listagem-usuarios.php";
				        }
				    }
				});
			}
		}
	});	
}

//Metodo de Gravacao das Ordem de Serviço
function GravaOS()
{
	oData            = new Object();	
	oData.acao       = "GravaOS";
	oData.numero     = $('#numero').val(); 
	oData.cliente    = $('#cliente').val();
	oData.data       = $('#data').val();
	oData.entrada    = $('#entrada').val();
	oData.saida      = $('#saida').val();
	oData.dia        = $('#dia').val();
	oData.hora       = $('#hora').val();
	oData.manutencao = $('#manutencao').val();
	oData.antena     = $('#antena').val();
	oData.interfone  = $('#interfone').val();
	oData.porta      = $('#porta').val();
	oData.cftv       = $('#cftv').val();
	oData.cerca      = $('#cerca').val();
	oData.painel     = $('#painel').val();
	oData.outros     = $('#outros').val();
	oData.descricao  = $('#descricao').val();
	
	$('#loading').show();
	
	//Antena
	if($("#antena").is(":checked"))
	{
		oData.antena = '1';
	}
	else
	{
		oData.antena = '0';
	}
	
	//interfone
	if($("#interfone").is(":checked"))
	{
		oData.interfone = '1';
	}
	else
	{
		oData.interfone = '0';
	}
	
	//porta
	if($("#porta").is(":checked"))
	{
		oData.porta = '1';
	}
	else
	{
		oData.porta = '0';
	}
	
	//cftv
	if($("#cftv").is(":checked"))
	{
		oData.cftv = '1';
	}
	else
	{
		oData.cftv = '0';
	}
	
	//cerca
	if($("#cerca").is(":checked"))
	{
		oData.cerca = '1';
	}
	else
	{
		oData.cerca = '0';
	}
	
	//painel
	if($("#painel").is(":checked"))
	{
		oData.painel = '1';
	}
	else
	{
		oData.painel = '0';
	}
	
	//outros
	if($("#outros").is(":checked"))
	{
		oData.outros = '1';
	}
	else
	{
		oData.outros = '0';
	}
	
		
	$.ajax({
				type: "POST",
				url: "http://www.macintel.com.br/app/controller/Controller.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['results'])
					{
						$.confirm({
						    content: "O.S Gravada com Sucesso.",
						    buttons: {
						        ok: function(){
						            location.href = "http://www.macintel.com.br/app/view/home.php";
						        }
						    }
						});
						
						$('#loading').hide();
					}
					else
					{
						$.confirm({
						    content: "Erro ao Gravar.",
						    buttons: {
						        ok: function(){
						        	window.location.reload(true);
						        }
						    }
						});
						
						$('#loading').hide();
					}
				}
			});	
}

//Metodo de Envio de Senha
function EsqueciSenha()
{
	oData         = new Object();	
	oData.acao    = "EsqueciSenha";
	oData.email = $('#esqueci-email').val(); 
	$.ajax({
				type: "POST",
				url: "http://www.macintel.com.br/app/controller/Controller.php",
				dataType: "json",
				data: oData,
				success: function(oData)
				{	
					if(oData['results'])
					{
						$.confirm({
						    content: "Senha Enviada com Sucesso!",
						    buttons: {
						        ok: function(){
						        	window.location.reload(true);
						        }
						    }
						});
					}
					else
					{
						$.confirm({
						    content: "Erro ao Enviar E-mail!",
						    buttons: {
						        ok: function(){
						        	window.location.reload(true);
						        }
						    }
						});
					}
				}
			});	
}

//Metodo de Exclusão de O.S Solicitadas
function ExcluirSolicitada(id)
{
	oData          = new Object();	
	oData.acao     = "ExcluirSolicitada";
	oData.id       = id;
	
	$.ajax({
		type: "POST",
		url: "http://www.macintel.com.br/app/controller/Controller.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{
			if(oData['results'])
			{
				$.confirm({
				    content: "O.S Excluida com Sucesso",
				    buttons: {
				        ok: function(){
				        	window.location.reload(true);
				        }
				    }
				});
			}
			else
			{
				$.confirm({
				    content: "Erro ao Excluir",
				    buttons: {
				        ok: function(){
				        	
				        }
				    }
				});
			}
		}
	});	
}

//Metodo para Carregar Dados das O.S Solicitadas (Edição)
function EditarSolicitada(id)
{
	oData          = new Object();	
	oData.acao     = "EditarSolicitada";
	oData.id       = id;
	
	window.location.assign("http://www.macintel.com.br/app/view/editar-os-solicitada.php/?id="+ id)
}

//Metodo de Alterar as O.S Solicitadas
function AtualizarSolicitada(id)
{
	oData            = new Object();	
	oData.acao       = "AtualizarSolicitada";
	oData.id         = id;
	oData.numero     = $('#numero').val(); 
	oData.data       = $('#data').val();
	oData.entrada    = $('#entrada').val();
	oData.saida      = $('#saida').val();
	oData.dia        = $('#dia').val();
	oData.hora       = $('#hora').val();
	oData.manutencao = $('#manutencao').val();
	oData.descricao  = $('#descricao').val();
	oData.tecnico    = $('#tecnico').val();
	oData.cliente    = $('#cliente').val();
	
	$('#loading').show();
	
	//Controle Perfil para alertar ou nao
	oData.controle   = $('#controle').val();
	if(oData.controle == 0)//Tecnico
	{
		if(oData.tecnico == 0)
		{
			$.confirm({
			    content: "Selecione um Tecnico",
			    buttons: {
			        ok: function(){
			        	
			        }
			    }
			});
			$('#loading').hide();
			return false;
		}
	}

	//Antena
	if($("#antena").is(":checked"))
	{
		oData.antena = '1';
	}
	else
	{
		oData.antena = '0';
	}
	
	//interfone
	if($("#interfone").is(":checked"))
	{
		oData.interfone = '1';
	}
	else
	{
		oData.interfone = '0';
	}
	
	//porta
	if($("#porta").is(":checked"))
	{
		oData.porta = '1';
	}
	else
	{
		oData.porta = '0';
	}
	
	//cftv
	if($("#cftv").is(":checked"))
	{
		oData.cftv = '1';
	}
	else
	{
		oData.cftv = '0';
	}
	
	//cerca
	if($("#cerca").is(":checked"))
	{
		oData.cerca = '1';
	}
	else
	{
		oData.cerca = '0';
	}
	
	//painel
	if($("#painel").is(":checked"))
	{
		oData.painel = '1';
	}
	else
	{
		oData.painel = '0';
	}
	
	//outros
	if($("#outros").is(":checked"))
	{
		oData.outros = '1';
	}
	else
	{
		oData.outros = '0';
	}
	
	
	$.ajax({
		type: "POST",
		url: "http://www.macintel.com.br/app/controller/Controller.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{
			if(oData['results'])
			{
				$.confirm({
				    content: "O.S Alterada com Sucesso",
				    buttons: {
				        ok: function(){
				        	location.href = "http://www.macintel.com.br/app/view/home.php";
				        }
				    }
				});
				
				$('#loading').hide();
			}
			else
			{
				$.confirm({
				    content: "Erro ao Editar",
				    buttons: {
				        ok: function(){
				        	
				        }
				    }
				});
				
				$('#loading').hide();
			}
		}
	});	
}

//Metodo para Carregar Dados das O.S Abertas (Edição)
function EditarAbertas(id)
{
	oData          = new Object();	
	oData.acao     = "EditarAbertas";
	oData.id       = id;
	
	window.location.assign("http://www.macintel.com.br/app/view/editar-os-aberta.php/?id="+ id)
}

//Metodo de Alterar as O.S Abertas
function AtualizarAberta(id)
{
	oData            = new Object();	
	oData.acao       = "AtualizarAberta";
	oData.id         = id;
	oData.numero     = $('#numero').val(); 
	oData.data       = $('#data').val();
	oData.entrada    = $('#entrada').val();
	oData.saida      = $('#saida').val();
	oData.dia        = $('#dia').val();
	oData.hora       = $('#hora').val();
	oData.manutencao = $('#manutencao').val();
	oData.descricao  = $('#descricao').val();
	oData.tecnico    = $('#tecnico').val();
	oData.controle   = $('#controle').val();
	oData.desctec    = $('#desctec').val();
	oData.status     = $('#status').val();
	oData.cliente    = $('#cliente').val();
	
	$('#loading').show();

	//Antena
	if($("#antena").is(":checked"))
	{
		oData.antena = '1';
	}
	else
	{
		oData.antena = '0';
	}
	
	//interfone
	if($("#interfone").is(":checked"))
	{
		oData.interfone = '1';
	}
	else
	{
		oData.interfone = '0';
	}
	
	//porta
	if($("#porta").is(":checked"))
	{
		oData.porta = '1';
	}
	else
	{
		oData.porta = '0';
	}
	
	//cftv
	if($("#cftv").is(":checked"))
	{
		oData.cftv = '1';
	}
	else
	{
		oData.cftv = '0';
	}
	
	//cerca
	if($("#cerca").is(":checked"))
	{
		oData.cerca = '1';
	}
	else
	{
		oData.cerca = '0';
	}
	
	//painel
	if($("#painel").is(":checked"))
	{
		oData.painel = '1';
	}
	else
	{
		oData.painel = '0';
	}
	
	//outros
	if($("#outros").is(":checked"))
	{
		oData.outros = '1';
	}
	else
	{
		oData.outros = '0';
	}
	
	
	$.ajax({
		type: "POST",
		url: "http://www.macintel.com.br/app/controller/Controller.php",
		dataType: "json",
		data: oData,
		success: function(oData)
		{
			if(oData['results'])
			{
				$.confirm({
				    content: "O.S Alterada com Sucesso",
				    buttons: {
				        ok: function(){
				        	location.href = "http://www.macintel.com.br/app/view/home.php";
				        }
				    }
				});
				
				$('#loading').hide();
			}
			else
			{
				$.confirm({
				    content: "Erro ao Editar",
				    buttons: {
				        ok: function(){
				        	location.href = "http://www.macintel.com.br/app/view/home.php";
				        }
				    }
				});
				
				$('#loading').hide();
			}
		}
	});	
}


//Metodo para Carregar Dados das O.S Finalizada (Visualização)
function VisualizaOS(id)
{
	oData          = new Object();	
	oData.acao     = "VisualizarOS";
	oData.id       = id;
	
	window.location.assign("http://www.macintel.com.br/app/view/visualizar-os-finalizada.php/?id="+ id)
}


