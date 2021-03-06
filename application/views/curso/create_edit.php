<br /><br />
<div class='row padding20' id='container' name='container'>
	<div class='col-lg-10 offset-lg-1 padding background_dark'>
	<div class='table-responsive'>
		<p class='text-white text-center'>
			<?php if(isset($Curso[0]['id'])) echo"Editar curso"; else echo"Novo curso";  ?>
		</p>
		<br />
		<?php $atr = array('id' => 'form_cadastro_curso','name' => 'form_cadastro'); echo form_open("$controller/store",$atr); ?>
			<br />
			<input type='hidden' id='id' name='id' value='<?php if(!empty($Curso[0]['id'])) echo $Curso[0]['id']; ?>'/>
			<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
			<div class='form-group relative'>
				<input type='text' autofocus  class="input-material"  name='nome' id='nome' value='<?php if(!empty($Curso[0]['nome_curso'])) echo $Curso[0]['nome_curso']; ?>'>
				<label for="nome" class="label-material">Nome</label>
				<div class='input-group mb-2 mb-sm-0 text-danger' id='error-nome'></div>
				</div>
			</div>
			<div class='form-group'>
				<div class="card text-dark bg-dark mb-3">  
				  <h3 class="card-header text-white">Disciplinas técnicas</h3>
					<div class="card-body">
						<ul class="list-group">
						<?php
							for($i = 0; $i < count($Disciplinas); $i ++)
							{
								if($Disciplinas[$i]["categoria_id"] == 1)
								{
									$checked = "";
									for($j = 0; $j < count($Curso); $j++)
										if($Curso[$j]['disciplina_id'] == $Disciplinas[$i]['id'])
											$checked = "checked";
									
									echo"<li class='list-group-item'>";
										echo"<div class='checkbox checbox-switch switch-success custom-controls-stacked'>";
											echo"<label for='".$Disciplinas[$i]['id']."'>";
												echo "<input $checked  id='". $Disciplinas[$i]['id'] ."' value='". $Disciplinas[$i]['id'] ."' type='checkbox' name='disciplinas[]' /><span></span>".$Disciplinas[$i]["nome_disciplina"];
											echo"</label>";
										echo"</div>";
									echo"</li>";
								}
							}
						?>
						</ul>
					</div>
				</div>
			</div>
			<div class='form-group'>
				<div class="card text-dark bg-dark mb-3">  
				  <h3 class="card-header text-white">Disciplinas do ensino médio</h3>
					<div class="card-body">
						<ul class="list-group">
						<?php
							for($i = 0; $i < count($Disciplinas); $i ++)
							{
								if($Disciplinas[$i]["categoria_id"] == 2)
								{
									$checked = "";
									for($j = 0; $j < count($Curso); $j++)
										if($Curso[$j]['disciplina_id'] == $Disciplinas[$i]['id'])
											$checked = "checked";
									
									echo"<li class='list-group-item'>";
										echo"<div class='checkbox checbox-switch switch-success custom-controls-stacked'>";
											echo"<label for='".$Disciplinas[$i]['id']."'>";
												echo "<input $checked value='". $Disciplinas[$i]['id'] ."' id='". $Disciplinas[$i]['id'] ."' type='checkbox' name='disciplinas[]' /><span></span>".$Disciplinas[$i]["nome_disciplina"];
											echo"</label>";
										echo"</div>";
									echo"</li>";
								}
							}
						?>
						</ul>
						<div class='input-group mb-2 mb-sm-0 text-danger' id='error-discip'></div>
					</div>
				</div>
			</div>
			
			<?php
				if(!isset($Curso[0]['id']))
					echo"<input  type='submit' id='bt_cadastro_curso' class='btn btn-danger btn-block' style='width: 200px' value='Cadastrar'>";
				else
					echo"<input type='submit' id='bt_cadastro_curso' class='btn btn-danger btn-block' style='width: 200px;'  value='Atualizar'>";
			?>
		</form>
	</div>                           
</div>
