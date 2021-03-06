<br /><br />
<div class='row padding20' id='container' name='container'>
	<div class='col-lg-10 offset-lg-1 padding background_dark'>
	<div class='table-responsive'>
		<p class='text-center text-white'><?php if(isset($Disciplina['id'])) echo"Editar disciplina"; else echo"Nova disciplina";  ?></p><br />
		<?php
			$atr = array('id' => 'form_cadastro_disciplina','name' => 'form_cadastro');
			echo form_open("$controller/store",$atr);
		?>
		<br />
			<input type='hidden' id='id' name='id' value='<?= set_value($Disciplina['id']) ? : (isset($Disciplina['id']) ? $Disciplina['id'] : '') ?>'/>
			<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
			<div class='form-group relative'>
					<input type='text'  class="input-material" autofocus name='nome' id='nome' value='<?= set_value($Disciplina['nome']) ? : (isset($Disciplina['nome']) ? $Disciplina['nome']: '') ?>'>
					<label for="nome" class="label-material">Nome</label>
				<div class='input-group mb-2 mb-sm-0 text-danger' id='error-nome'></div>
			</div>
			<div class='form-group'>
				<div class='input-group mb-2 mb-sm-0'>
					<div class='input-group-addon'>Categoria: </span></div>
					<select name='categoria_id' id='categoria_id' class='form-control'>
						<option value='0'>Selecione</option>
						<?php
							for($i = 0; $i < count($Categoria); $i++)
							{
								$selected = "";
								if($Categoria[$i]['id'] == $Disciplina['categoria_id'])
									$selected = "selected";
								echo"<option $selected value='". $Categoria[$i]['id'] ."'>".$Categoria[$i]['nome']."</option>";
							}
						?>
					</select>
				</div>
				<div class='input-group mb-2 mb-sm-0 text-danger' id='error-categoria_id'></div>
			</div>
			<?php
				if(!isset($Disciplina['id']))
					echo"<input type='submit' id='bt_cadastro_disciplina' class='btn btn-danger btn-block' style='width: 200px;' value='Cadastrar'>";
				else
					echo"<input type='submit' id='bt_cadastro_disciplina' class='btn btn-danger btn-block' style='width: 200px;' value='Atualizar'>";
			?>
		</form>
	</div>
</div>
