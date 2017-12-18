<html>
	<head> 
		
		<title><?php echo $title;?></title>
		<?= link_tag('css/bootstrap.min.css') ?>
		<?= link_tag('css/normalize.css') ?>
		<?= link_tag('css/font-awesome.css') ?>
		<?= link_tag('css/glyphicons.css') ?>
		<?= link_tag('css/site.css') ?>
		<?= link_tag('css/default.css') ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head >
	<body id='c'>
		<div class='container-fluid'>
			<nav class="side-navbar">
				<div class="sidenav-header d-flex align-items-center justify-content-center">
					<div class="sidenav-header-inner  text-center"><img src="<?php echo $url;?>imagens/logo.png" alt="CEP" class="img-fluid rounded-circle">
						<h2>CEP - Admin</h2>
					</div>
					<div style="margin-top: 15px;" class="sidenav-header-logo"><a href="#" class="brand-small text-center">
						<strong>CEP</strong></a>
					</div>
				</div>
				<div class="main-menu">
					<ul id="side-main-menu" class="side-menu list-unstyled">                  
						<li id='menu_disciplina'>
							<a href="<?php echo $url; ?>index.php/disciplina/index" > <i class="icon-home glyphicon glyphicon-paperclip" style="margin-bottom: 10px;"></i><span>Disciplina</span></a>
						</li>
						<li id='menu_curso'>
							<a href="<?php echo $url; ?>index.php/curso/index" > <i class="icon-home glyphicon glyphicon-folder-open" style="margin-bottom: 10px;"></i><span>Curso</span></a>
						</li>
						<li id='menu_turma'>
							<a href="<?php echo $url; ?>index.php/turma/index" ><i class="icon-form glyphicon glyphicon-book" style="margin-bottom: 10px;"></i><span>Turma</span></a>
						</li>
						<li id='menu_aluno'>
							<a href="<?php echo $url; ?>index.php/aluno/index" ><i class="icon-form glyphicon glyphicon-user" style="margin-bottom: 10px;"></i><span>Aluno</span></a>
						</li>
						<li id='menu_boletim'>
							<a href="<?php echo $url; ?>index.php/boletim/index" ><i class="icon-form glyphicon glyphicon-user" style="margin-bottom: 10px;"></i><span>Boletim</span></a>
					<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
						<li class="nav-item">
							<?php
								echo"<div data-toggle='popover' data-html='true' data-placement='left' title='<div class=\"text-center\">Opções da conta</div>' 
									data-content='
										<button class=\"btn btn-outline-danger btn-block glyphicon glyphicon-cog\" onclick=\"Main.logout()\">&nbsp;Configurações</button><button class=\"btn btn-outline-danger btn-block glyphicon glyphicon-log-out\" onclick=\"Main.logout()\">&nbsp;Sair</button>
									
									'  style='font-size: 40px; color: #f5f5f5; cursor: pointer; padding: 10px; border: 1px solid #e9ecef; border-radius: 35px;'>
										 <span class='glyphicon glyphicon-user'></span></div>";
							  ?>
						</li>
					</ul>
				</div>
			</nav>
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
			<div id="admin_confirm_modal" class="modal" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header text-center">
					<h5 class="modal-title">Atenção</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div id="menssagem_confirm" class="modal-body text-center">
					
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-primary" id="bt_delete">Sim</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
				  </div>
				</div>
			  </div>
			</div>
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