<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>

<div class='row' style='padding: 30px;'>
	<p>Todos os alunos da turma <?php echo $nome_turma; ?></p><br />
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
</div>
<div class='row' id='container' name='container' style='border: 1px solid red; border: 1px solid rgba(0,0,0,.1);'>
	<?php
		echo "<div class='col-lg-10 offset-lg-1'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover'>";
					echo "<thead>";
							echo "<td>Nome</td>";
							echo "<td>Nº da chamada</td>";
							echo "<td>Curso</td>";
							echo "<td>Inserir/alterar notas</td>";
						echo "<tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Alunos); $i++)
						{
							echo "<tr>";
								echo "<td>".$Alunos[$i]['nome']."</td>";
								echo "<td>".$Alunos[$i]['numero_chamada']."</td>";
								echo "<td>".$Alunos[$i]['nome_curso']."</td>";
								echo "<td>";
									echo "<a href='".$url."boletim/boletim/".$Alunos[$i]['aluno_id']."/".$Alunos[$i]['turma_id']."' title='Editar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-edit'></a>";
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
