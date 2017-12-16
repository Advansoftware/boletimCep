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
		//event for form login
		
		//event for form register
		
		$('#bt_cadastro').click(function() {
			Main.cadastro();
		});
		
		$('#nome').blur(function() { 
			if(this.value != '') Main.show_error("nome","error-nome","","form-control is-valid");
		});
		
		$('#email').blur(function() { 
			if(this.value != '') Main.valida_email(this.value);
		});
		
		$('#cpf').blur(function() { 
			if(this.value != '') Main.show_error("cpf","error-cpf","","form-control is-valid");
		});
		
		$('#cep').blur(function() { 
			if(this.value != '') Main.show_error("cep","error-cep","","form-control is-valid");
		});
		
		$('#telefone').blur(function() { 
			if(this.value != '') Main.show_error("telefone","error-telefone","","form-control is-valid");
		});
		
		//event for form register

	}
 );