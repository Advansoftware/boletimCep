<script type='text/javascript'>
	window.onload = function(){
		
		document.getElementById('menu_boletim').className = "active";
	}
</script>
<div class='row' style='padding: 30px;'>
	<p>Todas as turmas do curso de <?php echo $NomeCurso; ?></p><br />
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
</div>
<div class='row' id='container' name='container' style='border: 1px solid red;'>
	<div id="admin_trocar_aluno" class="modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header text-center">
			<h5 class="modal-title">Alunos</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div  class="modal-body text-center">
			<div class='form-group'>
				<div class='input-group mb-2 mb-sm-0'>
					<div class='input-group-addon'>Turmas</div>
					<select name='TurmaId' id='TurmaId' class='form-control'>
						<option value='0'>Selecione uma turma</option>
						<?php
							for($i = 0; $i < count($Turmas); $i++)
							{
								if($Turmas[$i]['Qtd_Aluno'] > 0)
									echo"<option $selected value='". $Turmas[$i]['Id'] ."'>".$Turmas[$i]['NomeTurma']."</option>";
							}
						?>
					</select>
				</div>
				<div class='input-group mb-2 mb-sm-0 text-danger' id='error-turma'></div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" id="bt_trocar_aluno_continuar">Continuar</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		  </div>
		</div>
	  </div>
	</div>

	<?php
		echo "<div class='col-lg-10 offset-lg-1'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover'>";
					echo "<thead>";
						echo "<tr>";
							echo "<td>Nome</td>";
							echo "<td>Curso</td>";
							echo "<td>Quantidade de alunos</td>";
							echo "<td>Ações</td>";
						echo "<tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Turmas); $i++)
						{
							echo "<tr style='cursor: pointer;' onclick='Main.lista_alunos(".$Turmas[$i]['Id'].");'>";
								echo "<td>".$Turmas[$i]['NomeTurma']."</td>";
								echo "<td>".$Turmas[$i]['NomeCurso']."</td>";
								echo "<td>".$Turmas[$i]['Qtd_Aluno']."</td>";
								echo "<td>";
									echo"<button class='btn btn-danger'>Gerar PDF</button>";
								echo "</td>";
							echo "</tr>";
						}
					echo "</tbody>";
				echo "</table>";
			echo "</div>";
		echo "</div>";
	?>
</div>
