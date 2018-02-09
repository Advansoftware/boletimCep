<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>
<br/><br/>
<div class='row padding20' id='container' name='container'>
	<?php
		echo "<div class='col-lg-10 offset-lg-1 padding background_dark'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover text-white'>";
					echo "<thead>";
						echo"<tr>";
							echo"<td class='text-center' colspan='5'>";
								echo"<p style='color: white; margin-top: 10px;'>Todos os Cursos</p>";
							echo"</td>";
						echo"</tr>";
						echo "<tr>";
							echo "<td>Nome</td>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Cursos); $i++)
						{
							echo "<tr style='cursor: pointer;' onclick='Main.lista_turma(".$Cursos[$i]['id'].",\"boletim\");'>";
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