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
		<div class='col-lg-8 offset-lg-2'>
		<p><?php if(isset($Disciplina['Id'])) echo"Editar disciplina"; else echo"Nova disciplina";  ?></p><br />
		<?php
			$atr = array('id' => 'form_cadastro','name' => 'form_cadastro');
			echo form_open('disciplina/store',$atr);
		?>
			<br />
				<input type='hidden' id='Id' name='Id' value='<?= set_value($Disciplina['Id']) ? : (isset($Disciplina['Id']) ? $Disciplina['Id'] : '') ?>'/>
				<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Nome</div>
						<input type='text' class='form-control' placeholder='Nome' autofocus name='Nome' id='Nome' value='<?= set_value($Disciplina['Nome']) ? : (isset($Disciplina['Nome']) ? $Disciplina['Nome']: '') ?>'>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-nome'></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Categoria</span></div>
						<select name='CategoriaId' id='CategoriaId' class='form-control'>
							<option value='0'>Selecione</option>
							<?php
								for($i = 0; $i < count($Categoria); $i++)
								{
									$selected = "";
									if($Categoria[$i]['Id'] == $Disciplina['CategoriaId'])
										$selected = "selected";
									echo"<option $selected value='". $Categoria[$i]['Id'] ."'>".$Categoria[$i]['Nome']."</option>";
								}
							?>
						</select>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-CategoriaId'></div>
				</div>
				<?php
					if(!isset($Disciplina['Id']))
						echo"<input type='button' id='bt_cadastro_disciplina' class='btn btn-danger btn-block' style='width: 200px;' value='Cadastrar'>";
					else
						echo"<input type='button' id='bt_cadastro_disciplina' class='btn btn-danger btn-block' value='Atualizar'>";
				?>
			</form>
	</div>
	</div>
</div>
