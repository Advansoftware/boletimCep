<div class='table-responsive' id=boletim>
<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
<?php
	echo"<div class='row padding30'>";
		echo "<div class='col-lg-12 text-center'>";
			echo"ENSINO MÉDIO INTEGRADO AO CURSO <b>TÉCNICO EM ".$boletim[0]['nome_curso']."</b>";
		echo "</div>";
	echo"</div>";
	echo"<div class'row padding30>";
		echo"<div class='col-lg-12'>";
			echo"<table class='table'>";
				echo"<tr>";
					echo"<td colspan='2'>";
						echo"Turma: ".$boletim[0]['nome_turma'];
					echo"</td>";
				echo"</tr>";
				echo"<tr>";
					echo"<td>";
						echo"Disciplina: ".$boletim[0]['nome_disciplina'];
					echo"</td>";
				echo"</tr>";
			echo"</table>";
		echo"</div>";
	echo"</div>";
	echo"<div class='row' style='padding: 30px; padding-top: 0px;'>";
		echo"<table class='table' border='1px' >";
			echo "<tbody class='border border-secondary'>";
			echo"<tr>";
				echo"<td rowspan='2' colspan='2' style='width: 25%; vertical-align: bottom;'>";
					echo "Alunos";
				echo"</td>";
				echo"<td style='width: 15%;' class='text-center' colspan='2'>";
					echo"1º Bimestre <br />20 pontos";
				echo"</td>";
				echo"<td style='width: 15%;' class='text-center' colspan='2'>";
					echo"2º Bimestre <br />25 pontos";
				echo"</td>";
				echo"<td style='width: 15%;' class='text-center' colspan='2'>";
					echo"3º Bimestre <br />25 pontos";
				echo"</td>";
				echo"<td style='width: 15%;' class='text-center' colspan='2'>";
					echo"4º Bimestre <br />30 pontos";
				echo"</td>";
				echo"<td style='width: 15%;' class='text-center' colspan='2'>";
				echo"</td>";
			echo"</tr>";
			echo"<tr>";
				echo"<td class='text-center'>";
					echo"Nota";
				echo"</td>";
				echo"<td class='text-center'>";
					echo"Faltas";
				echo"</td>";
				echo"<td class='text-center'>";
					echo"Nota";
				echo"</td>";
				echo"<td class='text-center'>";
					echo"Faltas";
				echo"</td>";
				echo"<td class='text-center'>";
					echo"Nota";
				echo"</td>";
				echo"<td class='text-center'>";
					echo"Faltas";
				echo"</td>";
				echo"<td class='text-center'>";
					echo"Nota";
				echo"</td>";
				echo"<td class='text-center'>";
					echo"Faltas";
				echo"</td>";
					echo"<td class='text-center'>";
					echo"Média Final";
				echo"</td>";
				echo"<td class='text-center'>";
					echo"Total Faltas";
				echo"</td>";
			echo"</tr>";
			for($i = 0; $i < count($boletim); $i++)
			{
				echo"<tr>";
					echo"<td colspan='2'>";
						echo $boletim[$i]['nome_aluno'];
					echo"</td>";
										echo"<td>";
						echo"<input onblur='Main.atualiza_boletim_por_disciplina(".$boletim[$i]['aluno_id'].",".$boletim[$i]['disciplina_id'].",1,this.value,".$boletim[$i]['turma_id']. ",\"nota1\");' class='form-control text-center text-dark border border-secondary' type='text' value='".$boletim[$i]['nota1']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim_por_disciplina(".$boletim[$i]['aluno_id'].",".$boletim[$i]['disciplina_id'].",1,this.value,".$boletim[$i]['turma_id']. ",\"falta1\");' class='form-control text-center text-dark border border-secondary' type='text' value='".$boletim[$i]['falta1']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim_por_disciplina(".$boletim[$i]['aluno_id'].",".$boletim[$i]['disciplina_id'].",2,this.value,".$boletim[$i]['turma_id']. ",\"nota2\");' class='form-control text-center text-dark border border-secondary' type='text' value='".$boletim[$i]['nota2']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim_por_disciplina(".$boletim[$i]['aluno_id'].",".$boletim[$i]['disciplina_id'].",2,this.value,".$boletim[$i]['turma_id']. ",\"falta2\");' class='form-control text-center text-dark border border-secondary' type='text' value='".$boletim[$i]['falta2']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim_por_disciplina(".$boletim[$i]['aluno_id'].",".$boletim[$i]['disciplina_id'].",3,this.value,".$boletim[$i]['turma_id']. ",\"nota3\");' class='form-control text-center text-dark border border-secondary' type='text' value='".$boletim[$i]['nota3']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim_por_disciplina(".$boletim[$i]['aluno_id'].",".$boletim[$i]['disciplina_id'].",3,this.value,".$boletim[$i]['turma_id']. ",\"falta3\");' class='form-control text-center text-dark border border-secondary' type='text' value='".$boletim[$i]['falta3']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim_por_disciplina(".$boletim[$i]['aluno_id'].",".$boletim[$i]['disciplina_id'].",4,this.value,".$boletim[$i]['turma_id']. ",\"nota4\");' class='form-control text-center text-dark border border-secondary' type='text' value='".$boletim[$i]['nota4']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim_por_disciplina(".$boletim[$i]['aluno_id'].",".$boletim[$i]['disciplina_id'].",4,this.value,".$boletim[$i]['turma_id']. ",\"falta4\");' class='form-control text-center text-dark border border-secondary' type='text' value='".$boletim[$i]['falta4']."' />";
					echo"</td>";
					echo"<td>";
						if(!empty($boletim[$i]['nota4']))
							echo"<input readonly='readonly' class='form-control text-center text-dark' type='text' value='".(($boletim[$i]['nota1'] + $boletim[$i]['nota2'] + $boletim[$i]['nota3'] + $boletim[$i]['nota4']) / 4)."' />";
						else
							echo"<input type='text' class='form-control text-center text-dark border border-secondary' readonly='readonly'>";
					echo"</td>";
					echo"<td>";
							echo"<input readonly='readonly' class='form-control text-center text-dark border border-secondary' type='text' value='".($boletim[$i]['falta1'] + $boletim[$i]['falta2'] + $boletim[$i]['falta3'] + $boletim[$i]['falta4'])."' />";
					echo"</td>";
				echo"</tr>";
			}
		echo"</table>";
	echo"</div>";
?>
</div>