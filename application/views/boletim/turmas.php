<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>

<div class='row' style='padding: 30px;'>
	<p>Todas as turmas do curso de <?php echo $nome_curso; ?></p><br />
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
</div>
<div class='row' id='container' name='container' style='border: 1px solid red;'>
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
							echo "<tr style='cursor: pointer;' onclick='Main.lista_alunos(".$Turmas[$i]['id'].");'>";
								echo "<td>".$Turmas[$i]['nome_turma']."</td>";
								echo "<td>".$Turmas[$i]['nome_curso']."</td>";
								echo "<td>".$Turmas[$i]['qtd_aluno']."</td>";
								echo "<td>";
									echo"<button class='btn btn-danger'>Gerar PDF</button>";
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
