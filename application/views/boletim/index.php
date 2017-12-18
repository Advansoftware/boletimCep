<script type='text/javascript'>
	window.onload = function(){
		
		document.getElementById('menu_boletim').className = "active";
	}
</script>
<div class='row' style='padding: 30px;'>
	<p>Todos os cursos</p><br />
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
</div>
<div class='row' id='container' name='container' style='border: 1px solid rgba(0,0,0,.1);'>
	<?php
		echo "<div class='col-lg-10 offset-lg-1'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover'>";
					echo "<thead>";
						echo "<tr>";
							echo "<td>Nome</td>";
							echo "<td>Data de registro</td>";
						echo "<tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Cursos); $i++)
						{
							echo "<tr style='cursor: pointer;' onclick='Main.lista_turma(".$Cursos[$i]['Id'].");'>";
								echo "<td>".$Cursos[$i]['Nome']."</td>";
								echo "<td>".$Cursos[$i]['DataRegistro']."</td>";
							echo "</tr>";
						}
					echo "</tbody>";
				echo "</table>";
			echo "</div>";
		echo "</div>";
	?>
</div>
