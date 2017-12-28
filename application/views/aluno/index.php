<script type='text/javascript'>
	window.onload = function(){
		
		document.getElementById('menu_aluno').className = "active";
	}
</script>
<div class='row' style='padding: 30px;'>
	<p>Todos os alunos</p><br />
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
</div>
<div class='row' id='container' name='container' style='border: 1px solid rgba(0,0,0,.1);'>
	<?php
		echo "<div class='col-lg-10 offset-lg-1'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover'>";
					echo "<thead>";
						echo"<tr><td colspan='9' class='text-right'>";
							echo"<a class='btn btn-danger' href='".$url."index.php/aluno/alunoPdf' target='_blank'>PDF</a>";
							echo"<a class='btn btn-success' href='".$url."index.php/aluno/create_edit/0/'>Novo aluno</a>";
						echo"</td></tr>";
						echo "<tr>";
							echo "<td>Nome</td>";
							echo "<td>Matrícula</td>";
							echo "<td>Nº da chamada</td>";
							echo "<td>Data de registro</td>";
							echo "<td>Data de nascimento</td>";
							echo "<td>Sexo</td>";
							echo "<td>Turma</td>";
							echo "<td>Curso</td>";
							echo "<td>Ações</td>";
						echo "<tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Alunos); $i++)
						{
							echo "<tr>";
								echo "<td>".$Alunos[$i]['NomeAluno']."</td>";
								echo "<td>".$Alunos[$i]['Matricula']."</td>";
								echo "<td>".$Alunos[$i]['NumeroChamada']."</td>";
								echo "<td>".$Alunos[$i]['DataRegistro']."</td>";
								echo "<td>".$Alunos[$i]['DataNascimento']."</td>";
								echo "<td>".(($Alunos[$i]['Sexo'] == 1)? "Masculino" : "Feminino")."</td>";
								echo "<td>".$Alunos[$i]['NomeTurma']."</td>";
								echo "<td>".$Alunos[$i]['NomeCurso']."</td>";
								echo "<td>";
									echo "<a href='".$url."index.php/aluno/create_edit/".$Alunos[$i]['Id']."' title='Editar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-edit'></a>  |  ";
									echo "<span onclick='Main.confirm_delete(". $Alunos[$i]['Id'] .");' id='sp_lead_trash' name='sp_lead_trash' title='Apagar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-trash'></span>";
								echo "</td>";
							echo "</tr>";
						}
					echo "</tbody>";
				echo "</table>";
			echo "</div>";
		echo "</div>";
	?>
</div>
