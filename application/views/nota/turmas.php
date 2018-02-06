<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>
<br /><br />
<div class='row' id='container' name='container' style='padding: 20px;'>
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
	<?php
		echo "<div class='col-lg-10 offset-lg-1 padding' style='background: #393836;'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover' style='color: white;'>";
					echo "<thead>";
						echo"<tr>";
							echo"<td class='text-center' colspan='5'>";
							  echo"<p style='color: white; margin-top: 10px;'>Todas as turmas do curso de ".$nome_curso."</p>";
							echo"</td>";
						echo"</tr>";
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
							echo "<tr style='cursor: pointer;' onclick='Main.lista_alunos(".$Turmas[$i]['id'].");'>";
								echo "<td>".$Turmas[$i]['nome_turma']."</td>";
								echo "<td>".$Turmas[$i]['nome_curso']."</td>";
								echo "<td>".$Turmas[$i]['qtd_aluno']."</td>";
								echo "<td>";
									//echo"<a class='btn btn-danger' href='".$url."boletim/boletim_da_TurmaPdf('22,9') target='_blank'>Gerar PDF</a>";
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
