<head>
<?= link_tag('content/css/bootstrap.min.css') ?>
<style>
#table-infos th, #table-infos td{
	border-top: none;
	padding: none;
}
#tabela-dados th, #tabela-dados td{
	border-top: none;
}
.table{
	font-size: 13px;
	margin: -10px;
}
.img-fluid{
	width:90%;
	margin-bottom: 30px; 
}
strong{
	font-size: 15px;
}
.table-blue{
	background-color: #002060;
	color: white;
	width: 15%;
	border: 1px solid black;
	padding: 5px 0px 5px 0px !important;
}
.table-nota{
	background-color: #0070c0;
	font-size: 13px;
	color: white;
	font-weight: bold;
	text-align: center;
	vertical-align: middle !important;
	border: 1px solid black;
	border-top-color: black; 

}
.table-corpo{
	border: 1px solid black;
	text-align: center;
	border-top: 1px solid black; 
}
.table-disciplinas{
	background-color: #daeef3;
}
</style>
<div class='table-responsive'>
<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
	<header class="text-center">
		<img  class="img-fluid border border-dark" src="<?php echo $url?>content/imagens/topo.png">
		<?php echo"<strong>ENSINO MÉDIO INTEGRADO AO CURSO TÉCNICO EM ".$boletim[0]['nome_curso']."<strong>";?>
	</header>
<?php
	echo "<div class='col-lg-12'>";
	echo"<div class'row' style='padding: 30px;'>";
		echo"<div class='col-lg-12'>";
			echo"<table class='table' id='tabela-dados'>";
				echo"<tr>";
					echo"<td class='text-right'>";
						echo"Turma:";
					echo "</td>";
					echo "<td class='alert alert-dark text-center'>";
						echo $boletim[0]['nome_turma'];
					echo"</td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
				echo"</tr>";
				echo"<tr>";
					echo"<td  class='text-right'>";
						echo"Nº:";
					echo"</td>";
					echo "<td  class='alert alert-dark text-center'>";
						echo $boletim[0]['numero_chamada'];
					echo "</td>";
					echo"<td class='text-right'>";
						echo"Nome:";
					echo"</td>";
					echo "<td class='alert alert-dark text-center' colspan='14'>";
						echo $boletim[0]['nome_aluno'];
					echo "</td>";
				echo"</tr>";
			echo"</table>";
		echo"</div>";
	echo"</div>";
	echo"<div class='row' style='padding: 30px; padding-top: 0px;'>";
		echo"<table class='table' id='table-infos'> ";
			echo "<tbody>";
			echo"<tr>";
				
				echo"<td rowspan='2' colspan='2' style='width: 25%;'>";
				echo"</td>";
				echo"<td class='text-center table-blue' colspan='2'>";
					echo"<strong>1º Bimestre <br />- 20 pontos -</strong>";
				echo"</td>";
				echo"<td class='text-center table-blue' colspan='2'>";
					echo"<strong>2º Bimestre <br />- 25 pontos -</strong>";
				echo"</td>";
				echo"<td class='text-center table-blue' colspan='2'>";
					echo"<strong>3º Bimestre <br />- 25 pontos -</strong>";
				echo"</td>";
				echo"<td class='text-center table-blue' colspan='2'>";
					echo"<strong>4º Bimestre <br />- 30 pontos -</strong>";
				echo"</td>";
				echo"<td colspan='2'>";
				echo"</td>";
			echo"</tr>";
			echo"<tr>";
				echo"<td class='table-nota'>";
					echo"Nota";
				echo"</td>";
 				echo"<td class='table-nota'>";
					echo"Faltas";
				echo"</td>";
				echo"<td class='table-nota'>";
					echo"Nota";
				echo"</td>";
				echo"<td class='table-nota'>";
					echo"Faltas";
				echo"</td>";
				echo"<td class='table-nota'>";
					echo"Nota";
				echo"</td>";
				echo"<td class='table-nota'>";
					echo"Faltas";
				echo"</td>";
				echo"<td class='table-nota'>";
					echo"Nota";
				echo"</td>";
				echo"<td class='table-nota'>";
					echo"Faltas";
				echo"</td>";
					echo"<td class='table-nota'>";
					echo"Média Final";
				echo"</td>";
				echo"<td class='table-nota'>";
					echo"Total Faltas";
				echo"</td>";
			echo"</tr>";
			$categoria_temp = $boletim[0]['nome_categoria'];
			$count = 0;
			$array_disciplina_categoria = array();
			//echo $boletim[0]['NomeCategoria']."<br />";
			//echo $boletim[1]['NomeCategoria']."<br />";
			//echo $boletim[2]['NomeCategoria']."<br />";
			for($i = 0; $i < count($boletim); $i++)
			{
				if($boletim[$i]['nome_categoria'] != $categoria_temp)
				{
					$categoria_temp = $boletim[$i]['nome_categoria'];
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
				if($boletim[$i]['nome_categoria'] != $categoria_temp)
				{
					echo"<tr>";
						$categoria_temp = $boletim[$i]['nome_categoria'];
						echo"<td  style='position: relative;padding: 5px;background-color: #002060;color: white;' class='table-corpo border border-dark' colspan=12>";
							echo "<b>".$boletim[$i]['nome_categoria']."</b>";
						echo"</td>";
					echo"</tr>";
					$count++;

				}
				echo "<tr>";
					echo"<td colspan='2'  class='table-corpo table-disciplinas'>";
						echo $boletim[$i]['nome_disciplina'];
					echo"</td>";
					echo"<td class='table-corpo'>";
						echo $boletim[$i]['nota1'];
					echo"</td>";
					echo"<td class='table-corpo'>";
						echo $boletim[$i]['falta1'];
					echo"</td>";
					echo"<td class='table-corpo'>";
						echo $boletim[$i]['nota2'];
					echo"</td>";
					echo"<td  class='table-corpo'>";
						echo $boletim[$i]['falta2'];
					echo"</td>";
					echo"<td  class='table-corpo'>";
						echo $boletim[$i]['nota3'];
					echo"</td>";
					echo"<td  class='table-corpo'>";
						echo $boletim[$i]['falta3'];
					echo"</td>";
					echo"<td  class='table-corpo'>";
						echo $boletim[$i]['nota4'];
					echo"</td>";
					echo"<td  class='table-corpo'>";
						echo $boletim[$i]['falta4'];
					echo"</td>";
					echo"<td  class='table-corpo'>";
						if(!empty($boletim[$i]['nota4']))
							echo (($boletim[$i]['nota1'] + $boletim[$i]['nota2'] + $boletim[$i]['nota3'] + $boletim[$i]['nota4']) / 4);
						else
							
					echo"</td>";
					echo"<td class='table-corpo'>";
						if(!empty($boletim[$i]['falta1']))
							echo  ($boletim[$i]['falta1'] + $boletim[$i]['falta2'] + $boletim[$i]['falta3'] + $boletim[$i]['falta4']);
					echo"</td>";
				echo"</tr>";
			}
		echo"</table>";
	echo"</div>";
?>
</div>