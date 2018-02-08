<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>
<br /><br />
<div class='row' id='container' name='container' style='padding: 20px;'>
	<input type='hidden' id='controller' value='<?php echo $controller; ?>'/>
	<?php
		echo "<div class='col-lg-10 offset-lg-1 padding' style='background: #393836;'>";
			echo "<div class='table-responsive'>";
				echo "<table class='table table-striped table-hover' style='color: white;'>";
					echo "<thead>";
						echo"<tr>";
							echo"<td class='text-center' colspan='5'>";
								echo"<p style='color: white; margin-top: 10px;'>Todos os cursos</p>";
							echo"</td>";
						echo"</tr>";
						echo"<tr><td colspan='4' class='text-right'>";
						if(permissao::get_permissao(CREATE,$controller))
							echo"<a class='btn btn-success' href='".$url."curso/create/0/'>Novo curso</a>";
						echo"</td></tr>";
						echo "<tr>";
							echo "<td>Nome</td>";
							echo "<td>Quantidade de disciplina</td>";
							echo "<td style='text-align: right;'>Ações</td>";
						echo "<tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Cursos); $i++)
						{
							echo "<tr>";
								echo "<td>".$Cursos[$i]['nome']."</td>";
								echo "<td>".$Cursos[$i]['qtd_disciplina']."</td>";
								echo "<td style='text-align: right;'>";
								if(permissao::get_permissao(UPDATE,$controller))
									echo "<a href='".$url."curso/edit/".$Cursos[$i]['id']."' title='Editar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-edit'></a>  |  ";
								if(permissao::get_permissao(DELETE,$controller))
									echo "<span onclick='Main.confirm_delete(". $Cursos[$i]['id'] .");' id='sp_lead_trash' name='sp_lead_trash' title='Apagar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-trash'></span>";
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
