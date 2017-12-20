<script type='text/javascript'>
	window.onload = function(){
		
		document.getElementById('menu_boletim').className = "active";
	}
</script>
<div class='table-responsive'>
<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
<?php
	echo"<div class='row' style='padding: 30px;'>";
		echo "<div class='col-lg-12 text-center'>";
			echo"ENSINO MÉDIO INTEGRADO AO CURSO <b>TÉCNICO EM ".$boletim[0]['NomeCurso']."</b>";
		echo "</div>";
	echo"</div>";
	echo"<div class'row' style='padding: 30px;'>";
		echo"<div class='col-lg-12'>";
			echo"<table class='table'>";
				echo"<tr>";
					echo"<td colspan='2'>";
						echo"Turma: ".$boletim[0]['NomeTurma'];
					echo"</td>";
				echo"</tr>";
				echo"<tr>";
					echo"<td>";
						echo"Nº: ".$boletim[0]['NumeroChamada'];
					echo"</td>";
					echo"<td>";
						echo"Nome: ".$boletim[0]['NomeAluno'];
					echo"</td>";
				echo"</tr>";
			echo"</table>";
		echo"</div>";
	echo"</div>";
	echo"<div class='row' style='padding: 30px; padding-top: 0px;'>";
		echo"<table class='table' border='1px'>";
			echo"<tr>";
				echo"<td rowspan='2' colspan='2' style='width: 25%;'>";
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
			$categoria_temp = $boletim[0]['NomeCategoria'];
			$count = 0;
			$array_disciplina_categoria = array();
			//echo $boletim[0]['NomeCategoria']."<br />";
			//echo $boletim[1]['NomeCategoria']."<br />";
			//echo $boletim[2]['NomeCategoria']."<br />";
			for($i = 0; $i < count($boletim); $i++)
			{
				if($boletim[$i]['NomeCategoria'] != $categoria_temp)
				{
					$categoria_temp = $boletim[$i]['NomeCategoria'];
					array_push($array_disciplina_categoria,$count);
					$count = 1;
				}
				else
					$count++;
			}		
			array_push($array_disciplina_categoria,$count);
			$count = 0;
			$categoria_temp = "";
			for($i = 0; $i < count($boletim); $i++)
			{
				if($boletim[$i]['NomeCategoria'] != $categoria_temp)
				{
					echo"<tr>";
						$categoria_temp = $boletim[$i]['NomeCategoria'];
						echo"<td style='vertical-align: middle;' colspan='12' style='width: 8%;'>";
							echo "<b>".$boletim[$i]['NomeCategoria']."</b>";
						echo"</td>";
					echo"</tr>";
					$count++;
				}
				echo"<tr>";
					echo"<td colspan='2'>";
						echo $boletim[$i]['NomeDisciplina'];
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim(".$boletim[$i]['AlunoId'].",".$boletim[$i]['DisciplinaId'].",1,this.value,".(!empty($boletim[$i]['BoletimId']) ? $boletim[$i]['BoletimId'] : '0'). ",\"Nota1\");' class='form-control text-center' type='text' value='".$boletim[$i]['Nota1']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim(".$boletim[$i]['AlunoId'].",".$boletim[$i]['DisciplinaId'].",1,this.value,".(!empty($boletim[$i]['BoletimId']) ? $boletim[$i]['BoletimId'] : '0'). ",\"Falta1\");' class='form-control text-center' type='text' value='".$boletim[$i]['Falta1']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim(".$boletim[$i]['AlunoId'].",".$boletim[$i]['DisciplinaId'].",2,this.value,".(!empty($boletim[$i]['BoletimId']) ? $boletim[$i]['BoletimId'] : '0'). ",\"Nota2\");' class='form-control text-center' type='text' value='".$boletim[$i]['Nota2']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim(".$boletim[$i]['AlunoId'].",".$boletim[$i]['DisciplinaId'].",2,this.value,".(!empty($boletim[$i]['BoletimId']) ? $boletim[$i]['BoletimId'] : '0'). ",\"Falta2\");' class='form-control text-center' type='text' value='".$boletim[$i]['Falta2']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim(".$boletim[$i]['AlunoId'].",".$boletim[$i]['DisciplinaId'].",3,this.value,".(!empty($boletim[$i]['BoletimId']) ? $boletim[$i]['BoletimId'] : '0'). ",\"Nota3\");' class='form-control text-center' type='text' value='".$boletim[$i]['Nota3']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim(".$boletim[$i]['AlunoId'].",".$boletim[$i]['DisciplinaId'].",3,this.value,".(!empty($boletim[$i]['BoletimId']) ? $boletim[$i]['BoletimId'] : '0'). ",\"Falta3\");' class='form-control text-center' type='text' value='".$boletim[$i]['Falta3']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim(".$boletim[$i]['AlunoId'].",".$boletim[$i]['DisciplinaId'].",4,this.value,".(!empty($boletim[$i]['BoletimId']) ? $boletim[$i]['BoletimId'] : '0'). ",\"Nota4\");' class='form-control text-center' type='text' value='".$boletim[$i]['Nota4']."' />";
					echo"</td>";
					echo"<td>";
						echo"<input onblur='Main.atualiza_boletim(".$boletim[$i]['AlunoId'].",".$boletim[$i]['DisciplinaId'].",4,this.value,".(!empty($boletim[$i]['BoletimId']) ? $boletim[$i]['BoletimId'] : '0'). ",\"Falta4\");' class='form-control text-center' type='text' value='".$boletim[$i]['Falta4']."' />";
					echo"</td>";
					echo"<td>";
						if(!empty($boletim[$i]['Nota4']))
							echo"<input readonly='readonly' class='form-control text-center' type='text' value='".(($boletim[$i]['Nota1'] + $boletim[$i]['Nota2'] + $boletim[$i]['Nota3'] + $boletim[$i]['Nota4']) / 4)."' />";
						else
							echo"<input type='text' class='form-control text-center' readonly='readonly'>";
					echo"</td>";
					echo"<td>";
						if(!empty($boletim[$i]['Falta1']))
							echo"<input readonly='readonly' class='form-control text-center' type='text' value='".($boletim[$i]['Falta1'] + $boletim[$i]['Falta2'] + $boletim[$i]['Falta3'] + $boletim[$i]['Falta4'])."' />";
						else
							echo"<input type='text' class='form-control text-center' readonly='readonly'>";
					echo"</td>";
				echo"</tr>";
			}
		echo"</table>";
	echo"</div>";
?>
</div>