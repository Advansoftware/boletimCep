<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>
<br /><br>
<div class='row padding20' id='container' name='container'>
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
	<?php
		echo "<div class='col-lg-10 offset-lg-1 padding background_dark'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover text-white'>";
					echo "<thead>";
						echo "<tr>";
							echo"<th class='text-center' colspan='4'>";
								echo"<p style='color: white; margin-top: 10px;'>Todos os alunos da turma ".$nome_turma."</p>";
							echo"</th>";
						echo"</tr>";
						echo "<tr>";
						echo "<td>Nome</td>";
							echo "<td>Nº da chamada</td>";
							echo "<td>Curso</td>";
							echo "<td class='text-right'>Inserir / alterar notas</td>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Alunos); $i++)
						{
							echo "<tr>";
								echo "<td>".$Alunos[$i]['nome']."</td>";
								echo "<td>".$Alunos[$i]['numero_chamada']."</td>";
								echo "<td>".$Alunos[$i]['nome_curso']."</td>";
								echo "<td class='text-right'>";
									echo "<a href='".$url."boletim/boletim/".$Alunos[$i]['aluno_id']."/".$Alunos[$i]['turma_id']."' title='Editar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-edit'></a>";
									echo "&nbsp;|&nbsp;";
									echo "<a href='".$url."boletim/boletimAlunoPdf/".$Alunos[$i]['aluno_id']."/".$Alunos[$i]['turma_id']."' title='Gerar PDF' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-save-file' target='_blank'</a>";
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