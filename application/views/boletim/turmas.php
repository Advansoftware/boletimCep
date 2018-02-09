<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>
<br /><br />
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
									echo"<a class='btn btn-info ' href='".$url."boletim/conselho/".$Turmas[$i]['id']."'>Conselho</a>";
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
