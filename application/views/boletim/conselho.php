<?php $this->load->helper("aluno");?>

<div class='table-responsive' id=boletim>
<input type='hidden' id='controller' value='Nota'/>
<?php
	echo"<div class='row padding30'>";
		echo "<div class='col-lg-12 text-center'>";
			echo"ENSINO MÉDIO INTEGRADO AO CURSO <b>TÉCNICO EM ".$alunos[0]['nome_curso']."</b>";
		echo "</div>";
		echo"<div class='col-lg-12 text-center'>";
			if($nivel == 1)
				echo"<br />1º Conselho de classe";
			else
				echo"<br />2º Conselho de classe";
		echo"</div>";
	echo"</div>";
	echo"<div class='row' style='padding: 30px; padding-top: 0px;'>";
	if($nivel == 1)	
	{
		echo"<table class='table' border='1px' >";
			echo "<tbody class='border border-secondary'>";
			echo"<tr>";
				echo"<td style='width: 25%;' class='text-center'>";
					echo"Turma: ".$alunos[0]['nome_turma'];
				echo"</td>";
				echo"<td colspan='".(count($disciplinas) * 2)."' class='text-center'>";
					echo "Disciplinas";
				echo"</td>";
			echo"</tr>";
			echo "<tr>";
				echo "<td class='text-center' style='vertical-align: middle;' rowspan='2'>";
					echo"Alunos";
				echo "</td>";
				for($i = 0; $i < count($disciplinas); $i++)
				{
					echo "<td colspan='2' class='text-center'>";
						echo $disciplinas[$i]['nome'];
					echo "</td>";
				}
			echo "</tr>";
			echo "<tr>";
				for($i = 0; $i < count($disciplinas); $i++)
				{
					echo "<td class='text-center'>";
						echo "Nota";
					echo "</td>";
					echo "<td class='text-center'>";
						echo "Faltas";
					echo "</td>";
				}
			echo "</tr>";
			for($i = 0; $i < count($alunos); $i++)
			{
				echo"<tr>";
					echo"<td style='vertical-align: middle;'>";
						echo $alunos[$i]['nome_aluno'];
					echo"</td>";
					for($j = 0; $j < count($disciplinas); $j++)
					{
						echo "<td onclick='Main.load_dados_conselho(".$alunos[$i]['aluno_id'].",".$alunos[$i]['turma_id'].",".$disciplinas[$j]['disciplina_id'].",\"0\")'>";
							echo"<input readonly='readonly' value='".aluno::get_info_aluno($alunos[$i]['aluno_id'],$alunos[$i]['turma_id'],$disciplinas[$j]['disciplina_id'])[0]['nota_final']."' class='form-control text-center text-dark border border-secondary' type='text' />";
						echo "</td>";
							echo "<td onclick='Main.load_dados_conselho(".$alunos[$i]['aluno_id'].",".$alunos[$i]['turma_id'].",".$disciplinas[$j]['disciplina_id'].",\"0\")'>";
							echo"<input readonly='readonly' value='".aluno::get_info_aluno($alunos[$i]['aluno_id'],$alunos[$i]['turma_id'],$disciplinas[$j]['disciplina_id'])[0]['faltas']."' class='form-control text-center text-dark border border-secondary' type='text' />";
						echo "</td>";
					}
				echo"</tr>";
			}
		echo"</table>";
	}
	else
	{
		echo"<table class='table' border='1px' >";
			echo "<tbody class='border border-secondary'>";
			echo"<tr>";
				echo"<td style='width: 25%;' class='text-center'>";
					echo"Turma: ".$alunos[0]['nome_turma'];
				echo"</td>";
				echo"<td colspan='".count($disciplinas)."' class='text-center'>";
					echo "Disciplinas";
				echo"</td>";
			echo"</tr>";
			echo "<tr>";
				echo "<td class='text-center' style='vertical-align: middle;' rowspan='2'>";
					echo"Alunos";
				echo "</td>";
				for($i = 0; $i < count($disciplinas); $i++)
				{
					echo "<td colspan='1' class='text-center'>";
						echo $disciplinas[$i]['nome'];
					echo "</td>";
				}
			echo "</tr>";
			echo "<tr>";
				for($i = 0; $i < count($disciplinas); $i++)
				{
					echo "<td class='text-center'>";
						echo "Nota ";
					echo "</td>";
				}
			echo "</tr>";
			for($i = 0; $i < count($alunos); $i++)
			{
				echo"<tr>";
					echo"<td style='vertical-align: middle;'>";
						echo $alunos[$i]['nome_aluno'];
					echo"</td>";
					for($j = 0; $j < count($disciplinas); $j++)
					{
						echo "<td>";
							echo"<input onblur='Main.atualiza_nota_disciplina(".$alunos[$i]['aluno_id'].",".$disciplinas[$i]['disciplina_id'].",0,this.value,".$alunos[$i]['turma_id']. ",\"exame\");' value='".aluno::get_info_aluno($alunos[$i]['aluno_id'],$alunos[$i]['turma_id'],$disciplinas[$j]['disciplina_id'])[0]['exame']."' class='form-control text-center text-dark border border-secondary' type='text' />";
						echo "</td>";
					}
				echo"</tr>";
			}
		echo"</table>";
	}
	echo"</div>";
?>
</div>