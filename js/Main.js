var Main = {
	// possui as funções js invocadas pelos eventos js colocados nas tags HTML
	//especificar a base_url de acordo com o host
	base_url : 'http://localhost/git/boletimCep/index.php/',
	load_mask : function(){
		$(document).ready(function(){
			$('[data-toggle="popover"]').popover(),
			$('#telefone').mask('(00) 0000-00009'),
			$('#cep').mask('00000-000'),
			$('#cpf').mask('000.000.000-00')
		});
	},
	login : function () {
		if(Main.login_isvalid() == true)
		{
			$('#login_modal_aguardar').modal({
				keyboard: false,
				backdrop : 'static'
			});
			$.ajax({
				url: Main.base_url+'login/validar',
				data: $("#form_login").serialize(),
				dataType:'json',
				cache: false,
				type: 'POST',
				success: function (msg) {
					if(msg.response == "valido")
						location.reload();
					else
					{
						setTimeout(function(){
							$('#login_modal_aguardar').modal('hide');
						},500);
						Main.limpa_login();
						$('#login_modal_erro').modal({
							keyboard: false,
							backdrop : 'static'
						})
					}
				}
			});
		}
	},
	logout : function (){
		$("#mensagem").html("Aguarde... encerrando sessão");
		$('#admin_modal').modal({
			keyboard: false,
			backdrop : 'static'
		});
		$.ajax({
			type: "POST",
			dataType: "json",
			url: Main.base_url+"login/logout",
			//data: "action=loadall&id=" + 2,
			complete: function(data) {
				 location.reload();
			}
		});
	},
	login_isvalid : function (){
		if($("#email").val() == "")
			Main.show_error("email","error-email","Informe seu e-mail","form-control is-invalid");
		else if(Main.valida_email($("#email").val()) == false)
			Main.show_error("email","error-email","Formato de e-mail inválido","form-control is-invalid");
		else if($("#senha").val() == "")
			Main.show_error("senha","error-senha","Insira sua senha","form-control is-invalid");
		else
			return true;
	},
	
	valida_email : function(email)
	{
		var nome = email.substring(0, email.indexOf("@"));
		var dominio = email.substring(email.indexOf("@")+ 1, email.length);

		if ((nome.length >= 1) &&
			(dominio.length >= 3) && 
			(nome.search("@")  == -1) && 
			(dominio.search("@") == -1) &&
			(nome.search(" ") == -1) && 
			(dominio.search(" ") == -1) &&
			(dominio.search(".") != -1) &&      
			(dominio.indexOf(".") >= 1)&& 
			(dominio.lastIndexOf(".") < dominio.length - 1)) 
		{
			document.getElementById('email').className = "form-control is-valid";
			document.getElementById('error-email').innerHTML = "";
			return true;
		}
		else
		{
			document.getElementById('email').className = "form-control is-invalid";
			document.getElementById('error-email').innerHTML = "Formato de e-mail inválido.";
			return false;
		}
	},
	show_error : function(form, id_div_error, error, class_error)
	{
		document.getElementById(form).className = class_error;
		document.getElementById(id_div_error).innerHTML = error;
	},
	limpa_login : function ()
	{
		$("#senha").val("");
		$("#senha").focus();
	},
	create_edit : function (){
		$("#mensagem").html("Aguarde... processando dados");
		$('#lead_modal_aguardar').modal({
			keyboard: false,
			backdrop : 'static'
		})
		$.ajax({
			url: Main.base_url+$("#controller").val()+'/store',
			data: $("#form_cadastro").serialize(),
			dataType:'json',
			cache: false,
			type: 'POST',
			success: function (msg) {
				$("#mensagem").html("Dados salvos com sucesso");
				window.location.assign(Main.base_url+$("#controller").val()+"/index");
			}
		});
	},
	disciplina_validar : function (){
		if($("#Nome").val() == "")
			Main.show_error("Nome","error-nome","Informe o nome da disciplina","form-control is-invalid");
		else if($("#CategoriaId").val() == "0")
			Main.show_error("CategoriaId","error-CategoriaId","Selecione uma categoria","form-control is-invalid");
		else
			Main.create_edit();
	},
	deleta_disciplina : function(id){
		
		if(confirm("Deseja realmente exluir esta disciplina?") == true)
		{
			$.ajax({
				url: Main.base_url+'disciplina/delete/'+id,
				dataType:'json',
				cache: false,
				type: 'POST',
				complete: function (data) {
					location.reload();
				}
			});
		}
	},
	estatistica : function(has_value){
		
		$("#mensagem").html("Aguarde... carregando dados");
		
		$('#admin_modal').modal({
			keyboard: false,
			backdrop : 'static'
		});
		
		var mes = (new Date().getMonth() + 1);
		var ano = new Date().getFullYear();

		if(has_value == "filter")
		{
			mes = $("#mes").val();
			ano = $("#ano").val();
		}
		$.ajax({
			url: Main.base_url+'lead/estatistica/'+mes+"/"+ano,
			dataType:'json',
			cache: false,
			type: 'POST',
			success: function (response) {
			
				setTimeout(function(){
					$('#admin_modal').modal('hide');
				},500);
			
				var data = {
					labels : response.dia,
					datasets : [
						{
							fillColor : "rgba(255,255,255,0)",
							strokeColor : "#dc3545",
							pointColor : "rgba(255,255,255,1)",
							pointStrokeColor : "#dc35d45",
							data : response.qtd,
							label : ''
						}
					]
				};

				var ctx = document.getElementById("lineChart").getContext("2d");
				new Chart(ctx).Line(data);

				legend(document.getElementById("lineLegend"), data);
			}
		});
	}
};