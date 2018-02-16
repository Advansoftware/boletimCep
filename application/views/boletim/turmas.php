<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>
<br /><br />
<div id="admin_opcoes_conselho" class="modal fade" tabindex="-1" role="dialog" >
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header text-center">
			<h5 class="modal-title">-</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div  class="modal-body text-center">
			<div class='form-group'>
				<div class='input-group mb-2 mb-sm-0'>
					<div class='input-group-addon  text-dark'>Conselho&nbsp;</div>
					<select name='opt_id' id='opt_id' class='form-control  text-dark border border-dark'>
						<option value='0'>Selecione</option>
						<option value='1'>1º Conselho</option>
						<option value='2'>2º Conselho</option>
					</select>
				</div>
				<div class='input-group mb-2 mb-sm-0 text-danger' id='error-opt_id'></div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" id="bt_escolhe_opcao_conselho">Continuar</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		  </div>
		</div>
	  </div>
	</div>

<div class='row padding20' id='container' name='container'>
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
	<?php
		echo "<div class='col-lg-10 offset-lg-1 padding background_dark'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover text-white'>";
					echo "<thead>";
						echo"<tr>";
							echo"<td class='text-center' colspan='5'>";
							  echo"<p style='color: white; margin-top: 10px;'>Todas as turmas do curso de ".$nome_curso."</p>";
							echo"</td>";
						echo"</tr>";
						echo "<tr>";
							echo "<td>Nome</td>";
							//echo "<td>Curso</td>";
							echo "<td class='text-center'>Quantidade de alunos</td>";
							echo "<td class='text-right'>Ações</td>";
						echo "<tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Turmas); $i++)
						{
							echo "<tr style='cursor: pointer;'>";
								echo "<td style='vertical-align: middle;'>".$Turmas[$i]['nome_turma']."</td>";
								//echo "<td>".$Turmas[$i]['nome_curso']."</td>";
								echo "<td class='text-center' style='vertical-align: middle;'>".$Turmas[$i]['qtd_aluno']."</td>";
								echo "<td class='text-right'>";
									echo"<a class='btn btn-danger' href='#' target='_blank'>Gerar PDF</a>";
									echo"<a onclick='Main.lista_alunos(".$Turmas[$i]['id'].");' class='btn btn-success' href='#'>Ver alunos</a>";
									echo"<button class='btn btn-info ' href='#' onclick='Main.mostra_opcoes_conselho(".$Turmas[$i]['id'].");'>Conselho</button>";
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
