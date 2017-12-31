<div class='row' style='padding: 30px;'>
		<div class='col-lg-8 offset-lg-2'>
		<p><?php if(isset($Turma[0]['id'])) echo"Editar turma"; else echo"Nova turma";  ?></p><br />
		<?php
			$atr = array('id' => 'form_cadastro_turma','name' => 'form_cadastro');
			echo form_open("$controller/store",$atr);
		?>
			<br />
				<input type='hidden' id='id' name='id' value='<?php if(!empty($Turma[0]['id'])) echo $Turma[0]['id']; ?>'/>
				<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Nome</div>
						<input name='nome' id='nome' value='<?php if(!empty($Turma[0]['nome_turma'])) echo $Turma[0]['nome_turma']; ?>' type='text' class='form-control' placeholder='Nome' autofocus />
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-nome'></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Curso</div>
						<select name='curso_id' id='curso_id' class='form-control'>
							<option value='0'>Selecione</option>
							<?php
								for($i = 0; $i < count($Cursos); $i++)
								{
									$selected = "";
									if(isset($Turma[0]['curso_id']) && $Cursos[$i]['id'] == $Turma[0]['curso_id'])
										$selected = "selected";
									echo"<option $selected value='". $Cursos[$i]['id'] ."'>".$Cursos[$i]['nome']."</option>";
								}
							?>
						</select>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-curso_id'></div>
				<eudiv>
				<div class='row'>
					<div class='col-lg-4'>
						<button class='btn btn-secondary btn-block' disabled="disabled"><span class='glyphicon glyphicon-menu-left'></span> Voltar</button>
					</div>
					<div class='col-lg-4'>
						<input type='submit' value='Avançar' class='btn btn-success btn-block'/>
					</div>
					<div class='col-lg-4'>
						<input type='submit' value='Finalizar' class='btn btn-success btn-block'/>
					</div>
				</div>
			</form>
	</div>
</div>