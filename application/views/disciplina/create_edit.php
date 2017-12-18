<script type='text/javascript'>
	window.onload = function(){
		
		document.getElementById('menu_disciplina').className = "active";
	}
</script>
<div class='row' style='padding: 30px;'>
	<div class='col-lg-8 offset-lg-2'>
		<p><?php if(isset($Disciplina['Id'])) echo"Editar disciplina"; else echo"Nova disciplina";  ?></p><br />
		<?php
			$atr = array('id' => 'form_cadastro_disciplina','name' => 'form_cadastro');
			echo form_open('disciplina/store',$atr);
		?>
		<br />
			<input type='hidden' id='Id' name='Id' value='<?= set_value($Disciplina['Id']) ? : (isset($Disciplina['Id']) ? $Disciplina['Id'] : '') ?>'/>
			<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
			<div class='form-group'>
				<div class='input-group mb-2 mb-sm-0'>
					<div class='input-group-addon'>Nome</div>
					<input type='text' class='form-control' placeholder='Nome' autofocus name='Nome' id='Nome' value='<?= set_value($Disciplina['Nome']) ? : (isset($Disciplina['Nome']) ? $Disciplina['Nome']: '') ?>'>
				</div>
				<div class='input-group mb-2 mb-sm-0 text-danger' id='error-nome'></div>
			</div>
			<div class='form-group'>
				<div class='input-group mb-2 mb-sm-0'>
					<div class='input-group-addon'>Categoria</span></div>
					<select name='CategoriaId' id='CategoriaId' class='form-control'>
						<option value='0'>Selecione</option>
						<?php
							for($i = 0; $i < count($Categoria); $i++)
							{
								$selected = "";
								if($Categoria[$i]['Id'] == $Disciplina['CategoriaId'])
									$selected = "selected";
								echo"<option $selected value='". $Categoria[$i]['Id'] ."'>".$Categoria[$i]['Nome']."</option>";
							}
						?>
					</select>
				</div>
				<div class='input-group mb-2 mb-sm-0 text-danger' id='error-CategoriaId'></div>
			</div>
			<?php
				if(!isset($Disciplina['Id']))
					echo"<input type='submit' id='bt_cadastro_disciplina' class='btn btn-danger btn-block' style='width: 200px;' value='Cadastrar'>";
				else
					echo"<input type='submit' id='bt_cadastro_disciplina' class='btn btn-danger btn-block' style='width: 200px;' value='Atualizar'>";
			?>
		</form>
	</div>
</div>
