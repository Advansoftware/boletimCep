<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>

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
							echo"<a class='btn btn-danger' href='".$url."aluno/alunoPdf' target='_blank'>PDF</a>";
							if(permissao::get_permissao(CREATE,$controller))
								echo"<a class='btn btn-success' href='".$url."aluno/create/0/'>Novo aluno</a>";
						echo"</td></tr>";
						echo "<tr>";
							echo "<td>Nome</td>";
							echo "<td>Matrícula</td>";
							/*echo "<td>Nº da chamada</td>";
							echo "<td>Data de registro</td>";
							echo "<td>Data de nascimento</td>";
							echo "<td>Sexo</td>";
							echo "<td>Turma</td>";
							echo "<td>Curso</td>";*/
							echo "<td class='text-right'>Ações</td>";
						echo "<tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Alunos); $i++)
						{
							echo "<tr>";
								echo "<td>".$Alunos[$i]['nome_aluno']."</td>";
								echo "<td>".$Alunos[$i]['matricula']."</td>";
								/*echo "<td>".$Alunos[$i]['numero_chamada']."</td>";
								echo "<td>".$Alunos[$i]['data_registro']."</td>";
								echo "<td>".$Alunos[$i]['data_nascimento']."</td>";
								echo "<td>".(($Alunos[$i]['sexo'] == 1)? "Masculino" : "Feminino")."</td>";
								echo "<td>".$Alunos[$i]['nome_turma']."</td>";
								echo "<td>".$Alunos[$i]['nome_curso']."</td>";*/
								echo "<td class='text-right'>";
								if(permissao::get_permissao(UPDATE,$controller))
									echo "<a href='".$url."aluno/edit/".$Alunos[$i]['id']."' title='Editar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-edit'></a>  |  ";
								echo "<a href='".$url."$controller/detalhes/".$Alunos[$i]['id']."' title='Detalhes' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-th'></a>";
								if(permissao::get_permissao(DELETE,$controller))
									echo " | <span onclick='Main.confirm_delete(". $Alunos[$i]['id'] .");' id='sp_lead_trash' name='sp_lead_trash' title='Apagar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-trash'></span>";
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