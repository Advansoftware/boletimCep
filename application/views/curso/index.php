<?php $this->load->helper("permissao");?>
<?php $this->load->helper("paginacao");?>

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
						echo"<tr><td colspan='4' class='text-right'>";
						if(permissao::get_permissao(CREATE,$controller))
							echo"<a class='btn btn-success' href='".$url."curso/create/0/'>Novo curso</a>";
						echo"</td></tr>";
						echo "<tr>";
							echo "<td>Nome</td>";
							echo "<td>Data de registro</td>";
							echo "<td>Quantidade de disciplina</td>";
							echo "<td>Ações </td>";
						echo "<tr>";
					echo "</thead>";
					echo "<tbody>";
						for($i = 0; $i < count($Cursos); $i++)
						{
							echo "<tr>";
								echo "<td>".$Cursos[$i]['nome']."</td>";
								echo "<td>".$Cursos[$i]['data_registro']."</td>";
								echo "<td>".$Cursos[$i]['qtd_disciplina']."</td>";
								echo "<td>";
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
