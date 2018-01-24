<script type='text/javascript'>
	window.onload = function(){
		
		document.getElementById('menu_turma').className = "active";
	}
</script>
<div class='row' style='padding: 30px;'>
		<div class='col-lg-8 offset-lg-2'>
			<div class="card">
				<h4 class="card-header">
					<?php if(isset($Turma['id'])) echo"Editar turma"; else echo"Nova turma";  ?>
				</h4>
				<h4 class="card-title" style="margin: 10px;">
					<?php echo "Selecione as disciplinas para a turma ".$Turma['nome_turma'];  ?>
				</h4>
				<div class="card-body">
					<?php
						$atr = array('id' => 'form_cadastro','name' => 'form_cadastro');
						echo form_open("$controller/store_disciplina",$atr);
					?>

					<input type='hidden' id='id' name='id' value='<?php if(!empty($Turma['id'])) echo $Turma['id']; ?>'/>
					<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
					<div class='form-group'>
						<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
						<?php
							for($i = 0; $i < count($disciplinas); $i++)
							{
								$checked = "";
								for($j = 0; $j < count($disciplinas_turma); $j++)
								{
									if($disciplinas[$i]['id'] == $disciplinas_turma[$j]['disciplina_id'])
									{
										$checked = "checked";
										break;
									}
								}
								echo"<label for='".$disciplinas[$i]['id']."'>";
									echo"<input $checked type='checkbox' name='disciplinas[]' id='".$disciplinas[$i]['id']."' value='".$disciplinas[$i]['id']."'> <span></span>".$disciplinas[$i]['nome'];
								echo"</label><br />";
							}
						?>
						</div>
					</div>
				</div>
			</div>
			<div class='row' style="margin: 10px;">
				<div class='col-lg-6'>
					<a class='btn btn-danger btn-block' href="<?php echo $url; ?>turma/create_edit/<?php echo $Turma['id']."/1";  ?>" ><span class='glyphicon glyphicon-menu-left'></span> Voltar</a>
				</div>
				<div class='col-lg-6'>
					<input type='button' value='Avançar' id='bt_disciplina_turma' class='btn btn-success btn-block'/>
				</div>
			</div>
		</form>
	</div>
</div>