<div class='page home-page'>
	<header class="header">
		<nav class="navbar">
			<div class="container-fluid">
				<div class="navbar-holder d-flex align-items-center justify-content-between">
					<div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn">
					<span class="glyphicon glyphicon-align-justify" style='line-height: 40px; transform: scale(2.5);'> </span></a>
					
					</div>
					<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
						<li class="nav-item">
							<?php
								echo"<div data-toggle='popover' data-html='true' data-placement='left' title='<div class=\"text-center\">Opções da conta</div>' 
									data-content='
										<button class=\"btn btn-outline-danger btn-block\" onclick=\"Main.logout()\">Sair</button>
									
									'  style='font-size: 40px; color: #dc3545; cursor: pointer; padding: 10px; border: 1px solid #dc3545; border-radius: 35px;'>
										 <span class='glyphicon glyphicon-user'></span></div>";
							  ?>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<div class="modal fade" id="admin_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			
		  </div>
		  <div class="modal-body text-center" id='mensagem'>
			
		  </div>
		  <div class="modal-footer">
			
		  </div>
		</div>
	  </div>
	</div>
	<div class='row' style='padding: 30px;'>
		<p>Editar Lead </p><br />
	</div>
	<div class='row' id='container' name='container'>
		<div class='col-lg-8 offset-lg-2' style='background-color: white'>
			<?php
				$atr = array('id' => 'form_cadastro','name' => 'form_cadastro');
				echo form_open('lead/store',$atr);
			?>
			<br />
			<input type='hidden' value='<?= set_value('id') ? : (isset($id) ? $id : '') ?>' id='lead' name='lead'>
			
			
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<input type='text' class='form-control' placeholder='Nome' autofocus name='nome' id='nome' value='<?= set_value('nome') ? : (isset($nome) ? $nome : '') ?>'>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-nome'><?php echo form_error('nome') ?  : ''; ?></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<input type='text' spellcheck='false' class='form-control' name='email' id='email' placeholder='E-mail' value='<?= set_value('email') ? : (isset($email) ? $email : '') ?>'>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-email'><?php echo form_error('email') ?  : ''; ?></div>
				</div>
				
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<input type='text' spellcheck='false' class='form-control' name='cpf' id='cpf' placeholder='CPF' value='<?= set_value('cpf') ? : (isset($cpf) ? $cpf : '') ?>'>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-cpf'><?php echo form_error('cpf') ?  : ''; ?></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<input type='text' spellcheck='false' class='form-control' name='cep' id='cep' placeholder='CEP' value='<?= set_value('cep') ? : (isset($cep) ? $cep : '') ?>'>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-cep'><?php echo form_error('cep') ?  : ''; ?></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<input type='text' spellcheck='false' class='form-control' name='telefone' id='telefone' placeholder='Telefone' value='<?= set_value('telefone') ? : (isset($telefone) ? $telefone : '') ?>'>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-telefone'><?php echo form_error('telefone') ?  : ''; ?></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<textarea spellcheck='false' class='form-control' name='observacoes' id='observacoes' placeholder='Observações'><?= set_value('observacoes') ? : (isset($observacoes) ? $observacoes : '') ?></textarea>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-observacoes'><?php echo form_error('observacoes') ?  : ''; ?></div>
				</div>		
				<?php
					echo"<input type='button' id='bt_cadastro' name='bt_cadastro' class='btn btn-danger btn-block' value='Atualizar'>";
				?>
			</form>
		</div>
	</div>
</div>
