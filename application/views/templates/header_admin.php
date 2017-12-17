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
			<li>
				<a href="<?php echo $url; ?>index.php/disciplina/index" > <i class="icon-home glyphicon glyphicon-paperclip" style="margin-bottom: 10px;"></i><span>Disciplina</span></a>
				<a href="<?php echo $url; ?>index.php/curso/index" > <i class="icon-home glyphicon glyphicon-folder-open" style="margin-bottom: 10px;"></i><span>Curso</span></a>
			</li>
			<li>
				<a href="<?php echo $url; ?>index.php/admin/estatistica" ><i class="icon-form glyphicon glyphicon-book" style="margin-bottom: 10px;"></i><span>Turma</span></a>
			</li>
			<li>
				<a href="<?php echo $url; ?>index.php/aluno/index" ><i class="icon-form glyphicon glyphicon-user" style="margin-bottom: 10px;"></i><span>Aluno</span></a>
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