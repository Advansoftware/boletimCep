<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>
<br /><br />
<div class='row' id='container' name='container' style='padding: 20px;'>
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
	<div id="admin_trocar_aluno" class="modal" tabindex="-1" role="dialog" >
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
					<div class='input-group-addon  text-dark'>Turmas&nbsp;</div>
					<select name='turma_id' id='turma_id' class='form-control  text-dark border border-dark'>
						<option value='0'>Selecione uma turma de origem</option>
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
		echo "<div class='col-lg-10 offset-lg-1 padding' style='background: #393836;'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover' style='color: white;'>";
					echo "<thead>";
						echo"<tr>";
							echo"<td class='text-center' colspan='5'>";
								echo"<p style='color: white; margin-top: 10px;'>Todas as turmas</p>";
							echo"</td>";
						echo"</tr>";
						echo"<tr>";
						echo"<td colspan='5' class='text-right'>";
							echo"<button class='btn btn-danger' id='bt_trocar_aluno'>Trocar aluno de turma</button>";
						if(permissao::get_permissao(CREATE,$controller))
							echo"<a class='btn btn-success' href='".$url."$controller/create_edit/0/'>Nova turma</a>";
						echo"</td>";
						echo"</tr>";
						echo "<tr>";
							echo "<td>Nome</td>";
							echo "<td>Curso</td>";
							echo "<td>Quantidade de alunos</td>";
							echo "<td class='text-right'>Ações</td>";
						echo "<tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Turmas); $i++)
						{
							echo "<tr>";
								echo "<td>".$Turmas[$i]['nome_turma']."</td>";
								echo "<td>".$Turmas[$i]['nome_curso']."</td>";
								echo "<td>".$Turmas[$i]['qtd_aluno']."</td>";
								echo "<td class='text-right'>";
								if(permissao::get_permissao(UPDATE,$controller))
									echo "<a href='".$url."$controller/create_edit/".$Turmas[$i]['id']."' title='Editar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-edit'></a>  |  ";
								echo "<a href='".$url."$controller/detalhes/".$Turmas[$i]['id']."' title='Detalhes' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-th'></a>";
								if(permissao::get_permissao(DELETE,$controller))
									echo " | <span onclick='Main.confirm_delete(". $Turmas[$i]['id'] .");' id='sp_lead_trash' name='sp_lead_trash' title='Apagar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-trash'></span>";
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
