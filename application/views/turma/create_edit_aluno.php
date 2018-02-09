<div class='row padding30'>
	<div class='col-lg-8 offset-lg-2'>
		<div class="card">
			<h4 class="card-header">
				<?php if(isset($Turma['id'])) echo"Editar turma"; else echo"Nova turma";  ?>
			</h4>
			<h4 class="card-title" style="margin: 10px;">
				<?php echo "Selecione os alunos para a turma ".$Turma['nome_turma'];  ?>
			</h4>
			<div class="card-body">
				<?php
					$atr = array('id' => 'form_cadastro','name' => 'form_cadastro');
					echo form_open("$controller/store_aluno",$atr);
				?>
				<input type='hidden' id='id' name='id' value='<?php if(!empty($Turma['id'])) echo $Turma['id']; ?>'/>
				<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
				<div class='form-group'>
					<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
					<?php
						for($i = 0; $i < count($alunos); $i++)
						{
							$checked = "";
							for($j = 0; $j < count($alunos_turma); $j++)
							{
								if($alunos[$i]['id'] == $alunos_turma[$j]['aluno_id'])
								{
									$checked = "checked";
									break;
								}
							}
							echo"<label for='".$alunos[$i]['id']."'>";
								echo"<input $checked type='checkbox' name='alunos[]' id='".$alunos[$i]['id']."' value='".$alunos[$i]['id']."'><span></span>".$alunos[$i]['nome'];
							echo"</label><br />";
						}
					?>
					</div>
				</div>
			</div>
		</div>
		<div class='row' style="margin: 10px;">
			<div class='col-lg-6'>
				<a class='btn btn-danger btn-block' href="<?php echo $url; ?>index.php/turma/create_edit/<?php echo $Turma['id']."/2";  ?>" ><span class='glyphicon glyphicon-menu-left'></span> Voltar</a>
			</div>
			<div class='col-lg-6'>
				<input type='button' value='Finalizar' id='bt_aluno_turma' class='btn btn-success btn-block'/>
			</div>
		</div>
		</form>
	</div>
</div>