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
		<p><?php if(isset($Aluno[0]['Id'])) echo"Editar aluno"; else echo"Novo aluno";  ?></p><br />
		<?php
			$atr = array('id' => 'form_cadastro','name' => 'form_cadastro');
			echo form_open('aluno/store',$atr);
		?>
			<br />
				<input type='hidden' id='Id' name='Id' value='<?php if(!empty($Aluno[0]['Id'])) echo $Aluno[0]['Id']; ?>'/>
				<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Nome</div>
						<input name='NomeAluno' id='Nome' value='<?php if(!empty($Aluno[0]['NomeAluno'])) echo $Aluno[0]['NomeAluno']; ?>' type='text' class='form-control' placeholder='Nome' autofocus />
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-nome'></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Matrícula</div>
						<input name='Matricula' id='Matricula' value='<?php if(!empty($Aluno[0]['Matricula'])) echo $Aluno[0]['Matricula']; ?>' type='text' class='form-control' placeholder='Matrícula'/>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-matricula'></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Nº da chamada</div>
						<input name='NumeroChamada' id='NumeroChamada' value='<?php if(!empty($Aluno[0]['NumeroChamada'])) echo $Aluno[0]['NumeroChamada']; ?>' type='text' class='form-control' placeholder='Nº da chamada'/>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-numero_chamada'></div>
				</div>
				<div class='form-group'>
					<fieldset>
						<legend>Sexo</legend>
						<label for="masculino">
							<input name='Sexo' id='masculino' value='1' <?php if(!empty($Aluno[0]['Sexo'])) 
								if($Aluno[0]['Sexo'] == 1)
									echo "checked";
							 ?> type='radio'/> Masculino
						</label><br />
						<label for="feminino">
							<input name='Sexo' id='feminino' value='0' <?php if(!empty($Aluno[0]['Sexo']) ||(isset($Aluno[0]['Sexo']) && $Aluno[0]['Sexo'] == 0)) 
								if($Aluno[0]['Sexo'] == 0)
									echo "checked";
							 ?> type='radio'/> Feminino
						</label>
						</legend>
					</fieldset>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-sexo'></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Data de nascimento</div>
						<input name='DataNascimento' id='DataNascimento' value='<?php if(!empty($Aluno[0]['DataNascimento'])) echo $Aluno[0]['DataNascimento']; ?>' type='date' class='form-control' />
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-data_nascimento'></div>
				</div>
					<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Curso</span></div>
						<select name='CursoId' id='CursoId' class='form-control'>
							<option value='0'>Selecione</option>
							<?php
								for($i = 0; $i < count($Cursos); $i++)
								{
									$selected = "";
									if($Cursos[$i]['Id'] == $Aluno[0]['CursoId'])
										$selected = "selected";
									echo"<option $selected value='". $Cursos[$i]['Id'] ."'>".$Cursos[$i]['NomeCurso']."</option>";
								}
							?>
						</select>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-curso_id'></div>
				</div>
				
				<?php
					if(!isset($Curso[0]['Id']))
						echo"<input type='button' id='bt_cadastro_curso' class='btn btn-danger btn-block' value='Cadastrar'>";
					else
						echo"<input type='button' id='bt_cadastro_curso' class='btn btn-danger btn-block' value='Atualizar'>";
				?>
			</form>
	</div>
	</div>
</div>
