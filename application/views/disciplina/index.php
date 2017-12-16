<div class='page home-page'>
	<header class="header">
		<nav class="navbar">
			<div class="container-fluid">
				<div class="navbar-holder d-flex align-items-center justify-content-between">
					<div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn">
					<span class="glyphicon glyphicon-align-justify" style='line-height: 40px; transform: scale(2.5);'> </span></a>
					
					</div>
					<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
						<li class="nav-item">
							<?php
								echo"<div data-toggle='popover' data-html='true' data-placement='left' title='<div class=\"text-center\">Opções da conta</div>' 
									data-content='
										<button class=\"btn btn-outline-danger btn-block\" onclick=\"Main.logout()\">Sair</button>
									
									'  style='font-size: 40px; color: #dc3545; cursor: pointer; padding: 10px; border: 1px solid #dc3545; border-radius: 35px;'>
										 <span class='glyphicon glyphicon-user'></span></div>";
							  ?>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<div class="modal fade" id="admin_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			
		  </div>
		  <div class="modal-body text-center" id='mensagem'>
			
		  </div>
		  <div class="modal-footer">
			
		  </div>
		</div>
	  </div>
	</div>
	<div class='row' style='padding: 30px;'>
		<p>Todas as Disciplinas </p><br />
	</div>
	<div class='row' id='container' name='container' style='border: 1px solid red;'>
		<?php
			echo "<div class='col-lg-10 offset-lg-1'>";
				echo "<div class='table-responsive'>";
					echo "<table class='table table-striped table-hover'>";
						echo "<thead>";
							echo"<tr><td colspan='3' class='text-right'>";
								echo"<a href='".$url."index.php/disciplina/create_edit/0/'>Nova disciplina</a>";
							echo"</td></tr>";
							echo "<tr>";
								echo "<td>Nome</td>";
								echo "<td>Categoria</td>";
								echo "<td>Ações</td>";
							echo "<tr>";
						echo "</thead>";
						echo "<tbody>";
							for($i = 0; $i < count($Disciplinas); $i++)
							{
								$ativo = "";
								if($Disciplinas[$i]['Ativo'] == 1)
									$ativo = "Sim";
								else
									$ativo = "Não";
								echo "<tr>";
									echo "<td>".$Disciplinas[$i]['NomeDisciplina']."</td>";
									echo "<td>".$Disciplinas[$i]['NomeCategoria']."</td>";

									echo "<td>";
										echo "<a href='".$url."index.php/disciplina/create_edit/".$Disciplinas[$i]['Id']."' title='Editar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-edit'></a>  |  ";
										echo "<span onclick='Main.deleta_disciplina(". $Disciplinas[$i]['Id'] .");' id='sp_lead_trash' name='sp_lead_trash' title='Apagar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-trash'></span>";
									echo "</td>";
								echo "</tr>";
							}
						echo "</tbody>";
					echo "</table>";
				echo "</div>";
			echo "</div>";
		?>
	</div>
	</div>
</div>
