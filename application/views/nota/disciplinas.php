<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>
<br /><br>
<div class='row padding20' id='container' name='container'>
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
	<?php
		echo "<div class='col-lg-10 offset-lg-1 padding' style='background: #393836;'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover text-white'>";
					echo "<thead>";
						echo "<tr>";
							echo"<th class='text-center' colspan='4'>";
								echo"<p style='color: white; margin-top: 10px;'>Todas as disciplinas da turma ".$nome_turma."</p>";
							echo"</th>";
						echo"</tr>";
						echo "<tr>";
						echo "<td>Nome</td>";
							echo "<td>Categoria</td>";
							echo "<td>Inserir/alterar notas</td>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($disciplinas); $i++)
						{
							echo "<tr>";
								echo "<td>".$disciplinas[$i]['nome']."</td>";
								echo "<td>".$disciplinas[$i]['nome_categoria']."</td>";
								echo "<td>";
									echo "<a href='".$url."nota/nota_disciplina/".$turma_id."/".$disciplinas[$i]['disciplina_id']."' title='Editar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-edit'></a>";
								echo "</td>";
							echo "</tr>";
						}
					echo "</tbody>";
				echo "</table>";
			echo "</div>";
			paginacao::get_paginacao($paginacao,$controller);
		echo "</div>";
	?>
	
</div>
