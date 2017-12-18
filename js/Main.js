var Main = {
	base_url : "http://"+window.location.host+"/git/boletimCep/index.php/",
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
			data: $("#"+$("form[name=form_cadastro]").attr("id")).serialize(),
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
	aluno_validar : function(){
		Main.create_edit();
		//if($("#Nome").val() == "")
		//	Main.show_error("Nome","error-nome","Informe o nome do curso","form-control is-invalid");
		
		
	},
	curso_validar : function(){
		Main.create_edit();
		//if($("#Nome").val() == "")
		//	Main.show_error("Nome","error-nome","Informe o nome do curso","form-control is-invalid");
		
		
	},
	id_registro : "",
	confirm_delete : function(id){
		Main.id_registro = id;
		$("#menssagem_confirm").html("Deseja realmente excluir o registro selecionado?");
		$('#admin_confirm_modal').modal({
			keyboard: false,
			backdrop : 'static'
		});
	},
	delete_registro : function(){
		$.ajax({
			url: Main.base_url+$("#controller").val()+'/deletar/'+Main.id_registro,
			dataType:'json',
			cache: false,
			type: 'POST',
			complete: function (data) {
				location.reload();
			}
		});
	},
	turma_validar : function (){
		Main.create_edit_turma();
	},
	disciplina_turma_validar : function (){
		Main.create_edit_turma_disciplina();
	},
	aluno_turma_validar : function(){
		Main.create_edit_turma_aluno();
	},
	create_edit_turma : function (){
		$("#mensagem").html("Aguarde... processando dados");
		$('#lead_modal_aguardar').modal({
			keyboard: false,
			backdrop : 'static'
		})
		$.ajax({
			url: Main.base_url+$("#controller").val()+'/store',
			data: $("#"+$("form[name=form_cadastro]").attr("id")).serialize(),
			dataType:'json',
			cache: false,
			type: 'POST',
			success: function (msg) {
				$("#mensagem").html("Dados salvos com sucesso");
				window.location.assign(Main.base_url+msg.page);
			}
		});
	},
	create_edit_turma_disciplina : function (){
		$("#mensagem").html("Aguarde... processando dados");
		$('#lead_modal_aguardar').modal({
			keyboard: false,
			backdrop : 'static'
		})
		$.ajax({
			url: Main.base_url+$("#controller").val()+'/store_disciplina',
			data: $("#form_cadastro").serialize(),
			dataType:'json',
			cache: false,
			type: 'POST',
			success: function (msg) {
				$("#mensagem").html("Dados salvos com sucesso");
				window.location.assign(Main.base_url+msg.page);
			}
		});
	},
	create_edit_turma_aluno : function (){
		$("#mensagem").html("Aguarde... processando dados");
		$('#lead_modal_aguardar').modal({
			keyboard: false,
			backdrop : 'static'
		})
		$.ajax({
			url: Main.base_url+$("#controller").val()+'/store_aluno',
			data: $("#form_cadastro").serialize(),
			dataType:'json',
			cache: false,
			type: 'POST',
			success: function (msg) {
				$("#mensagem").html("Dados salvos com sucesso");
				window.location.assign(Main.base_url+msg.page);
			}
		});
	},
	validar_turma_origem : function(){
		if($("#TurmaId").val() == "0")
			Main.show_error("TurmaId","error-turma","Selecione uma turma para continuar","form-control is-invalid");
		else
			window.location.assign(Main.base_url+"turma/trocar_aluno/"+$("#TurmaId").val());
			
	},
	troca_aluno_validar : function (){
		if($("#TurmaId").val() == "0")
			Main.show_error("TurmaId","error-turma","Selecione uma turma de destino","form-control is-invalid");
		var checado = $("#form_cadastro_troca_aluno").find("input[name='alunos[]']:checked").length > 0;
		if(checado == 1)
			Main.troca_aluno();
	},
	troca_aluno : function(){
		$.ajax({
			url: Main.base_url+$("#controller").val()+'/store_troca_aluno',
			data: $("#form_cadastro_troca_aluno").serialize(),
			dataType:'json',
			cache: false,
			type: 'POST',
			success: function (msg) {
				$("#mensagem").html("Dados salvos com sucesso");
				window.location.assign(Main.base_url+"/turma/index");
			}
		});
	},
};