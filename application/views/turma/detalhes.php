<br /><br />
<div class='row padding20' id='container' name='container'>
	<?php
		echo "<div class='col-lg-10 offset-lg-1 background_dark'>";
			echo"<a href='javascript:window.history.go(-1)' class='padding' title='Voltar'>";
				echo"<span class='glyphicon glyphicon-arrow-left' style='font-size: 25px; color: white;'></span>";
			echo"</a>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover text-white'>";
					echo"<tr>";
						echo "<td colspan='2'>";
							echo"<p  class='text-center' style='margin-top: 10px; color: white;'>";
								echo"Detalhes da turma selecionada";
							echo"</p>";
						echo"</td>";
					echo"</tr>";
					echo"</tr>";
					echo "<tr>";
						echo "<td>Nome</td>";
						echo "<td>".$obj['nome_turma']."</td>";
					echo"</tr>";
					echo "<tr>";
						echo "<td>Ano letivo</td>";
						echo "<td>".$obj['ano_letivo']."</td>";
					echo"</tr>";
					echo"<tr>";
						echo "<td>Ativo</td>";
						echo "<td>".(($obj['ativo'] == 1) ? 'Sim' : 'Não')."</td>";
					echo "</tr>";
					echo"<tr>";
						echo "<td>Data de registro</td>";
						echo "<td>".$obj['data_registro']."</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td>Curso</td>";
						echo "<td>".$obj['nome_curso']."</td>";
					echo "</tr>";
				echo "</table>";
			echo "</div>";
			echo "<div class='row padding10 text-white'>Pestinhas<br /><br />";
				for($i = 0; $i < count($alunos); $i++)
				{
					echo $alunos[$i]['nome_aluno']."<br />";
				}
			echo "</div>";
		echo "</div>";
	?>
</div>