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
		<p>Todos os Leads</p>
	</div>
	<div class='row' id='container' name='container'>
		<?php
			echo "<div class='col-lg-10 offset-lg-1'>";
				echo "<div class='table-responsive'>";
					echo "<table class='table table-striped table-hover'>";
						echo "<thead>";
							echo "<tr>";
								echo "<td>Nome</td>";
								echo "<td>Ativo</td>";
								echo "<td>E-mail</td>";
								echo "<td>CPF</td>";
								echo "<td>CEP</td>";
								echo "<td>Telefone</td>";
								echo "<td>Observações</td>";
								echo "<td>Ações</td>";
							echo "<tr>";
						echo "</thead>";
						echo "<tbody>";
							for($i = 0; $i < count($leads); $i++)
							{
								$ativo = "";
								if($leads[$i]['ativo'] == 1)
									$ativo = "Sim";
								else
									$ativo = "Não";
								echo "<tr>";
									echo "<td>".$leads[$i]['nome']."</td>";
									echo "<td>".$ativo."</td>";
									echo "<td>".$leads[$i]['email']."</td>";
									echo "<td>".$leads[$i]['cpf']."</td>";
									echo "<td>".$leads[$i]['cep']."</td>";
									echo "<td>".$leads[$i]['telefone']."</td>";
									echo "<td>".$leads[$i]['observacoes']."</td>";
									echo "<td>";
										echo "<a href='".$url."index.php/admin/edit/".$leads[$i]['id']."' title='Editar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-edit'></a>  |  ";
										echo "<span onclick='Main.trash_lead(". $leads[$i]['id'] .");' id='sp_lead_trash' name='sp_lead_trash' title='Apagar' style='color: #dc3545; cursor: pointer;' class='glyphicon glyphicon-trash'></span>";
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
