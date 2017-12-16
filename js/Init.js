$(document).ready(
	//inicializa o html adicionando os envetos js especificados abaixo
	function () {

		Main.load_mask();
		
		//event for form login
	    $('#bt_login').click(function() { 
			Main.login();
		});
		
		$('#email').blur(function() { 
			if(this.value != '') Main.valida_email(this.value);
		});
		
		$('#email').keypress(function() { 
			if ((window.event ? event.keyCode : event.which) == 13){Main.login();}; 
		});
		
		$('#senha').keypress(function() { 
			if ((window.event ? event.keyCode : event.which) == 13){Main.login();}; 
		});
		
		$('#bt_cadastro_disciplina').click(function() { 
			Main.disciplina_validar();
		});

		$('#Nome').blur(function() { 
			if(this.value != '') Main.show_error("Nome","error-nome","","form-control is-valid");
		});
		
		$('#CategoriaId').blur(function() { 
			if(this.value != '') Main.show_error("CategoriaId","error-CategoriaId","","form-control is-valid");
		});
		
		
		//event for form register

	}
 );