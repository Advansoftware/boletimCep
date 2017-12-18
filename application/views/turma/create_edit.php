<script type='text/javascript'>
	window.onload = function(){
		
		document.getElementById('menu_turma').className = "active";
	}
</script>
<div class='row' style='padding: 30px;'>
		<div class='col-lg-8 offset-lg-2'>
		<p><?php if(isset($Turma[0]['Id'])) echo"Editar turma"; else echo"Nova turma";  ?></p><br />
		<?php
			$atr = array('id' => 'form_cadastro_turma','name' => 'form_cadastro');
			echo form_open("$controller/store",$atr);
		?>
			<br />
				<input type='hidden' id='Id' name='Id' value='<?php if(!empty($Turma[0]['Id'])) echo $Turma[0]['Id']; ?>'/>
				<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Nome</div>
						<input name='Nome' id='Nome' value='<?php if(!empty($Turma[0]['NomeTurma'])) echo $Turma[0]['NomeTurma']; ?>' type='text' class='form-control' placeholder='Nome' autofocus />
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-nome'></div>
				</div>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Curso</div>
						<select name='CursoId' id='CursoId' class='form-control'>
							<option value='0'>Selecione</option>
							<?php
								for($i = 0; $i < count($Cursos); $i++)
								{
									$selected = "";
									if($Cursos[$i]['Id'] == $Turma[0]['CursoId'])
										$selected = "selected";
									echo"<option $selected value='". $Cursos[$i]['Id'] ."'>".$Cursos[$i]['Nome']."</option>";
								}
							?>
						</select>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-curso_id'></div>
				</div>
				<div class='row'>
					<div class='col-lg-6'>
						<button class='btn btn-danger btn-block' disabled="disabled"><span class='glyphicon glyphicon-menu-left'></span> Voltar</button>
					</div>
					<div class='col-lg-6'>
						<input type='submit' value='Avançar' class='btn btn-danger btn-block'/>
					</div>
				</div>
			</form>
	</div>
</div>
