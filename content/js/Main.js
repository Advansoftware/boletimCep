var Main = {
	base_url : "http://"+window.location.host+"/git/boletimCep/",
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
				url: Main.base_url+'Account/validar',
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
			url: Main.base_url+"Account/logout",
			complete: function(data) {
				 location.reload();
			}
		});
	},
	login_isvalid : function (){
		if($("#email-login").val() == "")
			Main.show_error("email-login","Informe seu e-mail","");
		else if(Main.valida_email($("#email-login").val()) == false)
			Main.show_error("email-login","Formato de e-mail inválido","");
		else if($("#senha-login").val() == "")
			Main.show_error("senha-login","Insira sua senha","");
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
			return true;
		else
			return false;
	},
	show_error : function(form, error, class_error)
	{
		if(class_error != "")
			document.getElementById(form).className = "input-material "+class_error;
		document.getElementById("error-"+form).innerHTML = error;
	},
	limpa_login : function ()
	{
		$("#senha-login").val("");
		$("#senha-login").focus();
	},
	create_edit : function (){
		$("#mensagem").html("Aguarde... processando dados");
		$('#admin_modal').modal({
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
				if(msg.response == "sucesso")
				{
					$("#mensagem").html("Dados salvos com sucesso");
					window.location.assign(Main.base_url+$("#controller").val()+"/index");
				}
				else
				{
					setTimeout(function(){
						$("#admin_modal").modal('hide');
						
						$("#mensagem_warning").html(msg.response);
						$('#admin_warning_modal').modal({
							keyboard: false,
							backdrop : 'static'
						})	
					},500);
				}
			}
		});
	},
	settings_geral_validar : function(){
		Main.create_edit();
	},
	usuario_validar : function(){
		if($("#nome").val() == "")
			Main.show_error("nome", 'Informe o nome de usuário', 'is-invalid');
		else if($("#email").val() == "")
			Main.show_error("email", 'Informe o e-mail de usuário', 'is-invalid');
		else if(Main.valida_email($("#email").val()) == false)
			Main.show_error("email", 'Formato de e-mail inválido', 'is-invalid');
		else if($("#senha").val() == "")
			Main.show_error("senha", 'Informe a senha de usuário', 'is-invalid');
		else
		{
			var trava = 0;
			if($("#id").val() == "")//se estiver criando um usuário
			{
				if($("#confirmar_senha").val() == "")
				{
					trava = 1;
					Main.show_error("confirmar_senha", 'Repita a senha de usuário', 'is-invalid');
				}
				else if($("#senha").val() != $("#confirmar_senha").val())
				{
					trava = 1;
					Main.show_error("confirmar_senha", 'Senha especificada é diferente da anterior', 'is-invalid');
				}
			}
			if(trava == 0)
			{
				if($("#grupo_id").val() == "0")
					Main.show_error("grupo_id", 'Selecione um tipo de usuário', 'is-invalid');
				else if($("#nova_senha").val() != "")
				{
					if($("#confirmar_nova_senha").val() == "")
						Main.show_error("confirmar_nova_senha", 'Repita a nova senha', 'is-invalid');
					else if($("#nova_senha").val() != $("#confirmar_nova_senha").val())
						Main.show_error("confirmar_nova_senha", 'Senha especificada é diferente da anterior', 'is-invalid');
					else
						Main.create_edit();
				}
				else
					Main.create_edit();
			}
		}
	},
	registro_validar : function(){
		if($("#nome").val() == "")
			Main.show_error("nome", 'Informe o nome de usuário', 'is-invalid');
		else if($("#email").val() == "")
			Main.show_error("email", 'Informe o e-mail de usuário', 'is-invalid');
		else if(Main.valida_email($("#email").val()) == false)
			Main.show_error("email", 'Formato de e-mail inválido', 'is-invalid');
		else if($("#senha").val() == "")
			Main.show_error("senha", 'Informe a senha de usuário', 'is-invalid');
		else if($("#confirmar_senha").val() == "")
			Main.show_error("confirmar_senha", 'Repita a senha de usuário', 'is-invalid');
		else if($("#senha").val() != $("#confirmar_senha").val())
			Main.show_error("confirmar_senha", 'Senha especificada é diferente da anterior', 'is-invalid');
		else
			Main.create_edit();
	},
	menu_validar : function()
	{
		if($("#nome").val() == "")
			Main.show_error("nome", 'Informe o nome de menu', 'is-invalid');
		else if($("#ordem").val() == "")
			Main.show_error("ordem", 'Informe o número da ordem', 'is-invalid');
		else
			Main.create_edit();
	},
	modulo_validar : function()
	{
		if($("#nome").val() == "")
			Main.show_error("nome", 'Informe o nome de módulo', 'is-invalid');
		else if($("#descricao").val() == "")
			Main.show_error("descricao", 'Informe a descrição de módulo', 'is-invalid');
		else if($("#url_modulo").val() == "")
			Main.show_error("url_modulo", 'Informe a url de módulo', 'is-invalid');
		else if($("#ordem").val() == "")
			Main.show_error("ordem", 'Informe o número da ordem', 'is-invalid');
		else
			Main.create_edit();
	},
	grupo_validar : function()
	{
		if($("#nome").val() == "")
			Main.show_error("nome", 'Informe o nome de grupo', 'is-invalid');
		else
			Main.create_edit();
	},
	create_edit : function (){
		$("#mensagem").html("Aguarde... processando dados");
		$('#admin_modal').modal({
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
		
		if($("#nome").val() == "")
			Main.show_error("nome","Informe o nome da disciplina","is-invalid");
		else if($("#CategoriaId").val() == "0")
			Main.show_error("categoria_id","Selecione uma categoria","is-invalid");
		else
			Main.create_edit();
	},
	aluno_validar : function(){
		if($("#nome").val() == "")
			Main.show_error("nome","Informe o nome do aluno","is-invalid");
		else if($("#matricula").val() == "")
			Main.show_error("matricula","Informe a matrícula do aluno","is-invalid");
		else if($("#numero_chamada").val() == "")
			Main.show_error("numero_chamada","Informe o número da chamada do aluno","is-invalid");
		else if($("#form_cadastro_aluno").find("input[name='sexo']:checked").length == 0)
			Main.show_error("sexo","Selecione o sexo do aluno","");
		else if($("#data_nascimento").val() == "")
			Main.show_error("data_nascimento","Informe a data de nascimento do aluno","is-invalid");
		else if($("#curso_id").val() == "0")
			Main.show_error("curso_id","Selecione o curso do aluno","is-invalid");
		else
			Main.create_edit();
	},
	curso_validar : function(){
		if($("#nome").val() == "")
			Main.show_error("nome","Informe o nome do curso","is-invalid");
		else if($("#form_cadastro_curso").find("input[name='disciplinas[]']:checked").length == 0)
			Main.show_error("discip","Selecione ao menos uma disciplina","");
		else
			Main.create_edit();
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
	turma_validar : function (type){
		if($("#nome").val() == "")
			Main.show_error("nome","Informe o nome da turma","is-invalid");
		else if($("#curso_id").val() == "0")
			Main.show_error("curso_id","Selecione o curso do aluno","is-invalid");
		else
			Main.create_edit_turma(type);
	},
	disciplina_turma_validar : function (){

		Main.create_edit_turma_disciplina();
	},
	aluno_turma_validar : function(){
		Main.create_edit_turma_aluno();
	},
	create_edit_turma : function (type){
		$("#mensagem").html("Aguarde... processando dados");
		$('#admin_modal').modal({
			keyboard: false,
			backdrop : 'static'
		})
		$.ajax({
			url: Main.base_url+$("#controller").val()+'/store/',
			data: $("#"+$("form[name=form_cadastro]").attr("id")).serialize(),
			dataType:'json',
			cache: false,
			type: 'POST',
			success: function (msg) {
				$("#mensagem").html("Dados salvos com sucesso");
				if(type == "Finalizar")
					window.location.assign(Main.base_url+"Turma/index");
				else
					window.location.assign(Main.base_url+msg.page);
			}
		});
	},
	create_edit_turma_disciplina : function (){
		$("#mensagem").html("Aguarde... processando dados");
		$('#admin_modal').modal({
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
		$('#admin_modal').modal({
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
		if($("#turma_id").val() == "0")
			Main.show_error("turma_id","Selecione a turma de origem para continuar","is-invalid");
		else
			window.location.assign(Main.base_url+"turma/trocar_aluno/"+$("#turma_id").val());
	},
	troca_aluno_validar : function (){
		if($("#turma_id").val() == "0")
			Main.show_error("turma_id","Selecione uma turma de destino","is-invalid");
		else if($("#form_cadastro_troca_aluno").find("input[name='alunos[]']:checked").length == 0)
			Main.show_error("alunos_selecionados","Selecione ao menos um aluno","");
		else
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
	lista_turma : function(curso){
		window.location.assign(Main.base_url+"boletim/turmas/"+curso);
	},
	lista_alunos : function(turma){
		window.location.assign(Main.base_url+"boletim/alunos/"+turma);
	},
	atualiza_boletim : function(aluno,disciplina,bimestre,valor,boletim_id,campo)
	{
		if(valor != "" && valor != " ")
		{
			$("#mensagem").html("Aguarde... processando dados");
			$('#admin_modal').modal({
				keyboard: false,
				backdrop : 'static'
			})
			$.ajax({
				url: Main.base_url+$("#controller").val()+'/atualiza_boletim/'+aluno+"/"+disciplina+"/"+bimestre+"/"+valor+"/"+boletim_id+"/"+campo,
				dataType:'json',
				cache: false,
				type: 'POST',
				success: function (msg) {
					
					$("#mensagem").html("Dados salvos com sucesso");
					setTimeout(function(){
						$("#admin_modal").modal('hide');
					},500);
				}
			});
		}
	},
	settings : function(){
		$("#settings").modal('show');
	}
};