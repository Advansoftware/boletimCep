<head>
<?= link_tag('content/css/bootstrap.min.css') ?>
<style>
.table{
	font-size: 13px;
}
.img-fluid{
	width:100%;
	margin-bottom: 30px; 
	margin-top: -20px;
}
h2{
	text-align: center;
}
</style>

	
</head>
<body>
	<header>
		
		<img  class="img-fluid" src="<?php echo $url?>content/imagens/topo.png">
	</header>
<div class='row'>
	<h2>Lista de Alunos</h2>
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
</div>
<div class='row' id='container' name='container' style='border: 1px solid rgba(0,0,0,.3); '>
	<?php
		echo "<table class='table table-striped'>";
			echo "<thead class='thead-dark'>";
				echo "<tr>";
					echo "<th>Nº</th>";
					echo "<th>Nome</th>";
					echo "<th>Data de nascimento</th>";
					echo "<th>Sexo</th>";
					echo "<th>Turma</th>";
					echo "<th>Curso</th>";
				echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
				for($i = 0; $i < count($Alunos); $i++)
				{
					echo "<tr>";
						echo "<th scope='row'>".$Alunos[$i]['numero_chamada']."</td>";
						echo "<td>".$Alunos[$i]['nome_aluno']."</td>";
						echo "<td>".$Alunos[$i]['data_nascimento']."</td>";
						echo "<td>".(($Alunos[$i]['sexo'] == 1)? "Masculino" : "Feminino")."</td>";
						echo "<td>".$Alunos[$i]['nome_turma']."</td>";
						echo "<td>".$Alunos[$i]['nome_curso']."</td>";
					echo "</tr>";
				}
			echo "</tbody>";
		echo "</table>";
	?>
</div>
</body>