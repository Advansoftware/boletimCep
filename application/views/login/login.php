<?php
	$atr = array('id' => 'form_login','name' => 'form_login');
	echo form_open('login/validar',$atr);
?>
<div class="modal fade" id="login_modal_aguardar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body text-center">
		Aguarde... validando seus dados.
      </div>
      <div class="modal-footer text-center" style='display: block;'>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="login_modal_erro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body text-center">
		E-mail e/ou senha inválidos
      </div>
      <div class="modal-footer text-center" style='display: block;'>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<div class='col-md-8  offset-md-2 col-lg-4 offset-lg-4 padding shadow-basic' style='background-color: rgba(255,255,255,1);'>
	<div class='text-center' style='color: silver;'>
		<h3>Login<br /><br /> Informe seus dados</h3>
	</div>
	<br /><br />
	<div class='form-group'>
		<div class='input-group mb-2 mb-sm-0'>
			<div class='input-group-addon'><span class='glyphicon glyphicon-envelope'></span></div>
			<input type='text' spellcheck='false' placeholder='E-mail' class='form-control' id='email' name='email' autofocus />
		</div>
		<div class='input-group mb-2 mb-sm-0 text-danger' id='error-email'></div>
	</div>
	<div class='form-group'>
		<div class='input-group mb-2 mb-sm-0'>
			<div class='input-group-addon'><span class='glyphicon glyphicon-lock'></span></div>
			<input type='password' placeholder='Senha' class='form-control' id='senha' name='senha'>
		</div>
		<div class='input-group mb-2 mb-sm-0 text-danger' id='error-senha'></div>
	</div>
	<input type='button' id='bt_login' name='bt_login' value='Entrar' class='btn btn-danger btn-block' />
</div>

</form>