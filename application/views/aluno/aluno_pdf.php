<style>
	.table-info{
		background-color: #8da7d5;
	}
	.table-striped{
		padding: 10px;
		background-color: white;
		border-collapse: collapse;
	}
	.table-striped td{
		padding: 10px;
		
	}
</style>
<div class='row'>
	<h2>Todos os alunos</2>
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
</div>
<div class='row' id='container' name='container' style='border: 1px solid rgba(0,0,0,.3); '>
	<?php
		echo "<table class='table table-striped'>";
			echo "<thead>";
				echo"<tr><td colspan='9' class='text-right'>";
				echo"</td></tr>";
				echo "<tr class='table-info'>";
					echo "<td>Nº</td>";
					echo "<td>Nome</td>";
					echo "<td>Data de nascimento</td>";
					echo "<td>Sexo</td>";
					echo "<td>Turma</td>";
					echo "<td>Curso</td>";
				echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
				for($i = 0; $i < count($Alunos); $i++)
				{
					echo "<tr>";
						echo "<td>".$Alunos[$i]['NumeroChamada']."</td>";
						echo "<td>".$Alunos[$i]['NomeAluno']."</td>";
						echo "<td>".$Alunos[$i]['DataNascimento']."</td>";
						echo "<td>".(($Alunos[$i]['Sexo'] == 1)? "Masculino" : "Feminino")."</td>";
						echo "<td>".$Alunos[$i]['NomeTurma']."</td>";
						echo "<td>".$Alunos[$i]['NomeCurso']."</td>";
					echo "</tr>";
				}
			echo "</tbody>";
		echo "</table>";
	?>
</div>
