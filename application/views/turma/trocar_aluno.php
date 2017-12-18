<script type='text/javascript'>
	window.onload = function(){
		
		document.getElementById('menu_turma').className = "active";
	}
</script>
<div class='row' style='padding: 30px;'>
	<div class='col-lg-8 offset-lg-2'>
		<div class="card">
			<h4 class="card-header">Trocar aluno de turma</h4>
			<div class="card-body">
				<?php
					$atr = array('id' => 'form_cadastro_troca_aluno','name' => 'form_cadastro');
				echo form_open("$controller/store_troca_aluno",$atr);
				?>
				<input type='hidden' id='Id_atual' name='Id_atual' value='<?php if(!empty($turma_atual[0]['Id'])) echo $turma_atual[0]['Id']; ?>'/>
				<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon'>Turma de destino</div>
						<select name='TurmaId' id='TurmaId' class='form-control'>
							<option value='0'>Selecione</option>
							<?php
								for($i = 0; $i < count($turmas); $i++)
								{
									echo"<option value='". $turmas[$i]['Id'] ."'>".$turmas[$i]['NomeTurma']."</option>";
								}
							?>
						</select>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-turma'></div>
				</div>
				<div class='form-group'>
					
						<h2 class="card-title">Alunos da turma <?php echo $turma_atual[0]['NomeTurma']; ?></h2>
						<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
							<?php
								for($i = 0; $i < count($alunos); $i++)
								{
									echo"<label for='".$alunos[$i]['AlunoId']."'>";
										echo"<input type='checkbox' name='alunos[]' id='".$alunos[$i]['AlunoId']."' value='".$alunos[$i]['AlunoId']."'><span></span>".$alunos[$i]['Nome'];
									echo"</label><br />";
								}
							?>
						</div>
					
				</div>
				<div class='row'>
					<div class='col-lg-4'>
						<input type='submit' value='Salvar' class='btn btn-success btn-block'/>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
