<br /><br />
<div class='row padding20' id='container' name='container'>
	<?php
		echo "<div class='col-lg-10 offset-lg-1' style='background: #393836;'>";
			echo"<a href='javascript:window.history.go(-1)' class='link padding' title='Voltar'>";
				echo"<span class='glyphicon glyphicon-arrow-left' style='font-size: 25px; color: white;'></span>";
			echo"</a>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover text-white'>";
					echo"<tr>";
						echo "<td colspan='2'>";
							echo"<p  class='text-center' style='margin-top: 10px; color: white;'>";
								echo"Detalhes do aluno selecionado";
							echo"</p>";
						echo"</td>";
					echo"</tr>";
					echo"</tr>";
					echo "<tr>";
						echo "<td>Nome</td>";
						echo "<td>".$obj[0]['nome_aluno']."</td>";
					echo"</tr>";
					echo "<tr>";
						echo "<td>Matrícula</td>";
						echo "<td>".$obj[0]['matricula']."</td>";
					echo "</tr>";
					echo"<tr>";
					echo "<tr>";
						echo "<td>Número da chamada</td>";
						echo "<td>".$obj[0]['numero_chamada']."</td>";
					echo "</tr>";
						echo "<td>Ativo</td>";
						echo "<td>".(($obj[0]['ativo'] == 1) ? 'Sim' : 'Não')."</td>";
					echo "</tr>";
					echo"<tr>";
						echo "<td>Data de registro</td>";
						echo "<td>".$obj[0]['data_registro']."</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td>Data de nascimento</td>";
						echo "<td>".$obj[0]['data_nascimento_f2']."</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td>Sexo</td>";
						if($obj[0]['sexo'] == 1)
							echo "<td>Masculino</td>";
						else
							echo "<td>Feminino</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td>Turma</td>";
						echo "<td>".$obj[0]['nome_turma']."</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td>Curso</td>";
						echo "<td>".$obj[0]['nome_curso']."</td>";
					echo "</tr>";
				echo "</table>";
			echo "</div>";
		echo "</div>";
	?>
</div>