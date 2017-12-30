<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>

<div class='row' style='padding: 30px;'>
	<p>Todas as turmas</p><br />
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
</div>
<div class='row' id='container' name='container' style='border: 1px solid rgba(0,0,0,.1);'>
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
					<select name='turma_id' id='turma_id' class='form-control'>
						<option value='0'>Selecione uma turm de origem</option>
						<?php
							for($i = 0; $i < count($Turmas); $i++)
							{
								if($Turmas[$i]['qtd_aluno'] > 0)
									echo"<option value='". $Turmas[$i]['id'] ."'>".$Turmas[$i]['nome_turma']."</option>";
							}
						?>
					</select>
				</div>
				<div class='input-group mb-2 mb-sm-0 text-danger' id='error-turma_id'></div>
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
						echo"<tr>";
						echo"<td colspan='4' class='text-right'>";
							echo"<button class='btn btn-outline-danger' id='bt_trocar_aluno'>Trocar aluno de turma</button>";
						echo"</td>";
						echo"<td class='text-right'>";
						if(permissao::get_permissao(CREATE,$controller))
							echo"<a class='btn btn-success' href='".$url."$controller/create_edit/0/'>Nova turma</a>";
						echo"</td>";
						echo"</tr>";
						echo "<tr>";
							echo "<td>Nome</td>";
							echo "<td>Data de registro</td>";
							echo "<td>Curso</td>";
							echo "<td>Quantidade de alunos</td>";
							echo "<td>Ações</td>";
						echo "<tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Turmas); $i++)
						{
							echo "<tr>";
								echo "<td>".$Turmas[$i]['nome_turma']."</td>";
								echo "<td>".$Turmas[$i]['data_registro']."</td>";
								echo "<td>".$Turmas[$i]['nome_curso']."</td>";
								echo "<td>".$Turmas[$i]['qtd_aluno']."</td>";
								echo "<td>";
								if(permissao::get_permissao(UPDATE,$controller))
									echo "<a href='".$url."$controller/create_edit/".$Turmas[$i]['id']."' title='Editar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-edit'></a>  |  ";
								if(permissao::get_permissao(DELETE,$controller))
									echo "<span onclick='Main.confirm_delete(". $Turmas[$i]['id'] .");' id='sp_lead_trash' name='sp_lead_trash' title='Apagar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-trash'></span>";
								echo "</td>";
							echo "</tr>";
						}
					echo "</tbody>";
				echo "</table>";
			echo "</div>";
			paginacao::get_paginacao($paginacao,$controller);
		echo "</div>";
	?>
</div>
