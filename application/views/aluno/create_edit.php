<div class='row' style='padding: 30px;'>
		<div class='col-lg-8 offset-lg-2'>
		<p><?php if(isset($Aluno[0]['id'])) echo"Editar aluno"; else echo"Novo aluno";  ?></p><br />
		<?php
			$atr = array('id' => 'form_cadastro_aluno','name' => 'form_cadastro');
			echo form_open("$controller/store",$atr);
		?>
			<br />
				<input type='hidden' id='id' name='id' value='<?php if(!empty($Aluno[0]['id'])) echo $Aluno[0]['id']; ?>'/>
				<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon' style="width: 180px;">Nome</div>
						<input name='nome' id='nome' value='<?php if(!empty($Aluno[0]['nome_aluno'])) echo $Aluno[0]['nome_aluno']; ?>' type='text' class='form-control' placeholder='Nome' autofocus />
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-nome'></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon' style="width: 180px;">Matrícula</div>
						<input name='matricula' id='matricula' value='<?php if(!empty($Aluno[0]['matricula'])) echo $Aluno[0]['matricula']; ?>' type='text' class='form-control' placeholder='Matrícula'/>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-matricula'></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon' style="width: 180px;">Nº da chamada</div>
						<input name='numero_chamada' id='numero_chamada' value='<?php if(!empty($Aluno[0]['numero_chamada'])) echo $Aluno[0]['numero_chamada']; ?>' type='text' class='form-control' placeholder='Nº da chamada'/>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-numero_chamada'></div>
				</div>
				<div class='form-group'>
					<div class="card">
					  <h4 class="card-header">Sexo</h4>
					  <div class="card-body">
						<ul class="list-group">
							<li class='list-group-item'>
								<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
									<label for="masculino">
										<input name='sexo' id='masculino' value='1' <?php if(!empty($Aluno[0]['sexo'])) 
											if($Aluno[0]['sexo'] == 1)
												echo "checked";
										 ?> type='radio'/> <span></span>Masculino
									</label>
								</div>
							</li>
							<li class='list-group-item'>
								<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
									<label for="feminino">
										<input name='sexo' id='feminino' value='0' <?php if(!empty($Aluno[0]['sexo']) ||(isset($Aluno[0]['sexo']) && $Aluno[0]['sexo'] == 0)) 
											if($Aluno[0]['sexo'] == 0)
												echo "checked";
										 ?> type='radio'/> <span></span>Feminino
									</label>
								</div>
							</li>
						</ul>
					  </div>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-sexo'></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon' style="width: 180px;">Data de nascimento</div>
						<input name='data_nascimento' id='data_nascimento' value='<?php if(!empty($Aluno[0]['data_nascimento_f1'])) echo $Aluno[0]['data_nascimento_f1']; ?>' type='date' class='form-control' />
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-data_nascimento'></div>
				</div>
					<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon' style="width: 180px;">Curso</span></div>
						<select name='curso_id' id='curso_id' class='form-control'>
							<option value='0'>Selecione</option>
							<?php
								for($i = 0; $i < count($Cursos); $i++)
								{
									$selected = "";
									if($Cursos[$i]['id'] == $Aluno[0]['curso_id'])
										$selected = "selected";
									echo"<option $selected value='". $Cursos[$i]['id'] ."'>".$Cursos[$i]['nome']."</option>";
								}
							?>
						</select>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-curso_id'></div>
				</div>
				
				<?php
					if(!isset($Curso[0]['id']))
						echo"<input type='submit' class='btn btn-danger btn-block' style='width: 200px;' value='Cadastrar'>";
					else
						echo"<input type='submit' class='btn btn-danger btn-block' style='width: 200px;' value='Atualizar'>";
				?>
			</form>


	</div>
</div>
