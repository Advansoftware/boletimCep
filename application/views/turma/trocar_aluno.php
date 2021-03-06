<br /><br />
<div class='row' id='container' name='container'>
	<div class='col-lg-10 offset-lg-1 padding background_dark'>
		<p class='text-white text-center'>
			<div class="card text-dark bg-light mb-3">
				<h4 class="card-header bg-warning">Trocar aluno de turma</h4>
			<div class="card-body">
				<?php
					$atr = array('id' => 'form_cadastro_troca_aluno','name' => 'form_cadastro');
				echo form_open("$controller/store_troca_aluno",$atr);
				?>
				<input type='hidden' id='id_atual' name='id_atual' value='<?php if(!empty($turma_atual['id'])) echo $turma_atual['id']; ?>'/>
				<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
				<div class='form-group'>
					<div class='input-group mb-2 mb-sm-0'>
						<div class='input-group-addon text-dark '>Turma de destino</div>
						<select name='turma_id' id='turma_id' class='form-control'>
							<option value='0'>Selecione</option>
							<?php
								for($i = 0; $i < count($turmas); $i++)
									if($turmas[$i]['id'] != $turma_atual['id'])
										echo"<option value='". $turmas[$i]['id'] ."'>".$turmas[$i]['nome_turma']."</option>";
							?>
						</select>
					</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-turma_id'></div>
				</div>
				<div class='form-group'>
						<h2 class="card-title">Alunos da turma <?php echo $turma_atual['nome_turma']; ?></h2>
						<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
							<?php
								for($i = 0; $i < count($alunos); $i++)
								{
									echo"<label for='".$alunos[$i]['aluno_id']."'>";
										echo"<input type='checkbox' name='alunos[]' id='".$alunos[$i]['aluno_id']."' value='".$alunos[$i]['aluno_id']."'><span></span>".$alunos[$i]['nome_aluno'];
									echo"</label><br />";
								}
							?>
						</div>
					<div class='input-group mb-2 mb-sm-0 text-danger' id='error-alunos_selecionados'></div>
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