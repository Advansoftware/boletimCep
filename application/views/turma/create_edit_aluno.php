<script type='text/javascript'>
	window.onload = function(){
		
		document.getElementById('menu_turma').className = "active";
	}
</script>
<div class='row' style='padding: 30px;'>
		<div class='col-lg-8 offset-lg-2'>
		<p><?php if(isset($Turma[0]['Id'])) echo"Editar turma"; else echo"Nova turma";  ?></p><br />
		<p><?php echo "Selecione os alunos para a turma ".$Turma[0]['NomeTurma'];  ?></p><br />
		<?php
			$atr = array('id' => 'form_cadastro','name' => 'form_cadastro');
			echo form_open("$controller/store_aluno",$atr);
		?>
			<br />
				<input type='hidden' id='Id' name='Id' value='<?php if(!empty($Turma[0]['Id'])) echo $Turma[0]['Id']; ?>'/>
				<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
				<div class='form-group'>
					<?php
						for($i = 0; $i < count($alunos); $i++)
						{
							$checked = "";
							for($j = 0; $j < count($alunos_turma); $j++)
							{
								if($alunos[$i]['Id'] == $alunos_turma[$j]['AlunoId'])
								{
									$checked = "checked";
									break;
								}
							}
							echo"<label for='".$alunos[$i]['Id']."'>";
								echo"<input $checked type='checkbox' name='alunos[]' id='".$alunos[$i]['Id']."' value='".$alunos[$i]['Id']."'>".$alunos[$i]['Nome'];
							echo"</label><br />";
						}
					?>
				</div>
				
				<div class='row'>
					<div class='col-lg-6'>
						<a class='btn btn-danger btn-block' href="<?php echo $url; ?>index.php/turma/create_edit/<?php echo $Turma[0]['Id']."/2";  ?>" ><span class='glyphicon glyphicon-menu-left'></span> Voltar</a>
					</div>
					<div class='col-lg-6'>
						<input type='button' value='Finalizar' id='bt_aluno_turma' class='btn btn-danger btn-block'/>
					</div>
				</div>
			</form>
	</div>
</div>
