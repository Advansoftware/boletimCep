$(document).ready(
	//inicializa o html adicionando os envetos js especificados abaixo
	function () {

		Main.load_mask();
		//event for form login
	   $( "#form_login").submit(function( event ) {
			event.preventDefault();
			Main.login();
		});
		
		$('#email-login').blur(function() { 
			if(this.value != '')
			{
				if(Main.valida_email(this.value) == false)
					Main.show_error("email-login", 'Formato de e-mail inválido', '');
				else
					Main.show_error("email-login", '', '');
			}
		}); 
		
		$('#senha-login').blur(function() { 
			if(this.value != '') Main.show_error("senha-login", '', '');
		});
		
		$('#nome').blur(function() { 
			if(this.value != '') Main.show_error("nome", '', 'is-valid');
		});
		
		$('#senha').blur(function() { 
			if(this.value != '') Main.show_error("senha", '', 'is-valid');
		});
		
		$('#confirmar_senha').blur(function() { 
			if(this.value != '') Main.show_error("confirmar_senha", '', 'is-valid');
		});
		
		$('#grupo_id').blur(function() { 
			if(this.value != '0') Main.show_error("grupo_id", '', 'is-valid');
		});
		
		$('#nova_senha').blur(function() { 
			if(this.value != '') Main.show_error("nova_senha", '', 'is-valid');
		});
		
		$('#confirmar_nova_senha').blur(function() { 
			if(this.value != '') Main.show_error("confirmar_nova_senha", '', 'is-valid');
		});
		
		$('#ordem').blur(function() { 
			if(this.value != '') Main.show_error("ordem", '', 'is-valid');
		});
		
		$('#descricao').blur(function() { 
			if(this.value != '') Main.show_error("descricao", '', 'is-valid');
		});
		
		$('#url_modulo').blur(function() { 
			if(this.value != '') Main.show_error("url_modulo", '', 'is-valid');
		});
		
		$('#icone').blur(function() { 
			/*if(this.value != '')*/ Main.show_error("icone", '', 'is-valid');
		});
		
		$('#menu_id').blur(function() { 
			if(this.value != '0') Main.show_error("menu_id", '', 'is-valid');
		});
		
		$('#email').blur(function()
		{
			if(this.value != '')
			{
				if(Main.valida_email(this.value) == false)
					Main.show_error("email", 'Formato de e-mail inválido', 'is-invalid');
				else
					Main.show_error("email", '', 'is-valid');
			}
		});
		
		$('#email').keypress(function() { 
			if ((window.event ? event.keyCode : event.which) == 13){Main.login();}; 
		});
		
		$('#senha').keypress(function() { 
			if ((window.event ? event.keyCode : event.which) == 13){Main.login();}; 
		});
		//BTN CADASTROS
		$( "#form_cadastro_Usuario").submit(function( event ) {
			event.preventDefault();
			Main.usuario_validar();
		});
		
		$( "#form_cadastro_Menu").submit(function( event ) {
			event.preventDefault();
			Main.menu_validar();
		});
		
		$( "#form_cadastro_Modulo").submit(function( event ) {
			event.preventDefault();
			Main.modulo_validar();
		});
		
		$( "#form_cadastro_Grupo").submit(function( event ) {
			event.preventDefault();
			Main.grupo_validar();
		});
		
		$( "#form_cadastro_disciplina" ).submit(function( event ) {
			event.preventDefault();
			Main.disciplina_validar();
		});
		
		$( "#form_cadastro_curso" ).submit(function( event ) {
			event.preventDefault();
			Main.curso_validar();
			
		});
		
		$( "#form_cadastro_aluno" ).submit(function( event ) {
			event.preventDefault();
			Main.aluno_validar();
		});
		
		$( "#form_cadastro_turma" ).submit(function( event ) {
			event.preventDefault();
			Main.turma_validar();
		});
		$( "#form_cadastro_troca_aluno" ).submit(function( event ) {
			event.preventDefault();
			Main.troca_aluno_validar();
		});
		
		//FIM BTN CADASTROS

		$('#CategoriaId').blur(function() { 
			if(this.value != '') Main.show_error("CategoriaId","error-CategoriaId","","form-control is-valid");
		});
		//event for form register
		
		$('#Matricula').blur(function() { 
			if(this.value != '') Main.show_error("Matricula","error-matricula","","form-control is-valid");
		});
		
		$('#NumeroChamada').blur(function() { 
			if(this.value != '') Main.show_error("NumeroChamada","error-numero_chamada","","form-control is-valid");
		});
		
		$('#DataNascimento').blur(function() { 
			if(this.value != '') Main.show_error("DataNascimento","error-data_nascimento","","form-control is-valid");
		});
		
		$('#CursoId').blur(function() { 
			if(this.value != '0') Main.show_error("CursoId","error-curso_id","","form-control is-valid");
		});
		//event for form register
		 $('#bt_delete').click(function() {
			Main.delete_registro();
		});
		
		$('#bt_disciplina_turma').click(function() { 
			Main.disciplina_turma_validar();
		});
		
		$('#bt_aluno_turma').click(function() { 
			Main.aluno_turma_validar();
		});
		
		$('#bt_trocar_aluno').click(function() {
			$("#admin_trocar_aluno").modal('show');
		});
		$('#bt_trocar_aluno_continuar').click(function() {
			Main.validar_turma_origem();
		});
		$('#TurmaId').click(function() {
			if(this.value != '0') Main.show_error("TurmaId","error-turma","","form-control is-valid");
		});
	}
 );