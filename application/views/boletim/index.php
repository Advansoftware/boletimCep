<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>

<div class='row' style='padding: 30px;'>
	<p>Todos os cursos</p><br />
</div>
<div class='row' id='container' name='container' style='border: 1px solid rgba(0,0,0,.1);'>
	<?php
		echo "<div class='col-lg-10 offset-lg-1'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover'>";
					echo "<thead>";
						echo "<tr>";
							echo "<td>Nome</td>";
						echo "<tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Cursos); $i++)
						{
							echo "<tr style='cursor: pointer;' onclick='Main.lista_turma(".$Cursos[$i]['id'].");'>";
								echo "<td>".$Cursos[$i]['nome']."</td>";
							echo "</tr>";
						}
					echo "</tbody>";
				echo "</table>";
			echo "</div>";
			paginacao::get_paginacao($paginacao,$controller);
		echo "</div>";
	?>
</div>
