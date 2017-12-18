<script type='text/javascript'>
	window.onload = function(){
		
		document.getElementById('menu_turma').className = "active";
	}
</script>
<div class='row' style='padding: 30px;'>
		<div class='col-lg-8 offset-lg-2'>
			<div class="card">
				<h4 class="card-header">
					<?php if(isset($Turma[0]['Id'])) echo"Editar turma"; else echo"Nova turma";  ?>
				</h4>
				<h4 class="card-title" style="margin: 10px;">
					<?php echo "Selecione as disciplinas para a turma ".$Turma[0]['NomeTurma'];  ?>
				</h4>
				<div class="card-body">
					<?php
						$atr = array('id' => 'form_cadastro','name' => 'form_cadastro');
						echo form_open("$controller/store_disciplina",$atr);
					?>

					<input type='hidden' id='Id' name='Id' value='<?php if(!empty($Turma[0]['Id'])) echo $Turma[0]['Id']; ?>'/>
					<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
					<div class='form-group'>
						<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
						<?php
							for($i = 0; $i < count($disciplinas); $i++)
							{
								$checked = "";
								for($j = 0; $j < count($disciplinas_turma); $j++)
								{
									if($disciplinas[$i]['Id'] == $disciplinas_turma[$j]['DisciplinaId'])
									{
										$checked = "checked";
										break;
									}
								}
								echo"<label for='".$disciplinas[$i]['Id']."'>";
									echo"<input $checked type='checkbox' name='disciplinas[]' id='".$disciplinas[$i]['Id']."' value='".$disciplinas[$i]['Id']."'> <span></span>".$disciplinas[$i]['Nome'];
								echo"</label><br />";
							}
						?>
						</div>
					</div>
				</div>
			</div>
			<div class='row' style="margin: 10px;">
				<div class='col-lg-6'>
					<a class='btn btn-danger btn-block' href="<?php echo $url; ?>index.php/turma/create_edit/<?php echo $Turma[0]['Id']."/1";  ?>" ><span class='glyphicon glyphicon-menu-left'></span> Voltar</a>
				</div>
				<div class='col-lg-6'>
					<input type='button' value='Avançar' id='bt_disciplina_turma' class='btn btn-success btn-block'/>
				</div>
			</div>
		</form>
	</div>
</div>
