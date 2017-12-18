<div class='row' style='padding: 30px;'>
	<div class='col-lg-8 offset-lg-2'>
		<p>
			<?php if(isset($Curso[0]['Id'])) echo"Editar curso"; else echo"Novo curso";  ?>
		</p>
		<br />
		<?php $atr = array('id' => 'form_cadastro','name' => 'form_cadastro'); echo form_open('curso/store',$atr); ?>
			<br />
			<input type='hidden' id='Id' name='Id' value='<?php if(!empty($Curso[0]['Id'])) echo $Curso[0]['Id']; ?>'/>
			<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
			<div class='form-group'>
				<div class='input-group mb-2 mb-sm-0'>
					<div class='input-group-addon'>Nome</div>
					<input type='text' class='form-control' placeholder='Nome' autofocus name='NomeCurso' id='Nome' value='<?php if(!empty($Curso[0]['NomeCurso'])) echo $Curso[0]['NomeCurso']; ?>'>
				</div>
				<div class='input-group mb-2 mb-sm-0 text-danger' id='error-nome'></div>
			</div>
			<div class='form-group'>
				<legend>Disciplinas técnicas</legend>
				<ul class="list-group">
				<?php
					for($i = 0; $i < count($Disciplinas); $i ++)
					{
						if($Disciplinas[$i]["CategoriaId"] == 1)
						{
							$checked = "";
							for($j = 0; $j < count($Curso); $j++)
								if($Curso[$j]['DisciplinaId'] == $Disciplinas[$i]['Id'])
									$checked = "checked";
							
							echo"<li class='list-group-item'>";
								echo"<div class='checkbox checbox-switch switch-success custom-controls-stacked'>";
									echo"<label for='".$Disciplinas[$i]['Id']."'>";
										echo "<input $checked  id='". $Disciplinas[$i]['Id'] ."' value='". $Disciplinas[$i]['Id'] ."' type='checkbox' name='disciplinas[]' /><span></span>".$Disciplinas[$i]["NomeDisciplina"];
									echo"</label>";
								echo"</div>";
							echo"</li>";
						}
					}
				?>
				</ul>
			</div>
			<div class='form-group'>
				<legend>Disciplinas do ensino médio</legend>
				<ul class="list-group">
				<?php
					for($i = 0; $i < count($Disciplinas); $i ++)
					{
						if($Disciplinas[$i]["CategoriaId"] == 2)
						{
							$checked = "";
							for($j = 0; $j < count($Curso); $j++)
								if($Curso[$j]['DisciplinaId'] == $Disciplinas[$i]['Id'])
									$checked = "checked";
							
							echo"<li class='list-group-item'>";
								echo"<div class='checkbox checbox-switch switch-success custom-controls-stacked'>";
									echo"<label for='".$Disciplinas[$i]['Id']."'>";
										echo "<input $checked value='". $Disciplinas[$i]['Id'] ."' id='". $Disciplinas[$i]['Id'] ."' type='checkbox' name='disciplinas[]' /><span></span>".$Disciplinas[$i]["NomeDisciplina"];
									echo"</label>";
								echo"</div>";
							echo"</li>";
						}
					}
				?>
				</ul>
			</div>
			<?php
				if(!isset($Curso[0]['Id']))
					echo"<input  type='button' id='bt_cadastro_curso' class='btn btn-danger btn-block' style='width: 200px' value='Cadastrar'>";
				else
					echo"<input type='button' id='bt_cadastro_curso' class='btn btn-danger btn-block' style='width: 200px;'  value='Atualizar'>";
			?>
		</form>
	</div>                           
</div>
