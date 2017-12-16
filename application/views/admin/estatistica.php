<script type='text/javascript'>
	window.onload = function(){
		Main.estatistica('init');
	}
</script>
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
	<div class='row' style='padding: 20px;'>
		<p>Estatísticas - quantidade de leads cadastrados por dia do mês </p>
	</div>
	<div class='row'id='container' name='container'>
		<div class='col-lg-12' style='margin-bottom: 20px;'>
			<div class='col-lg-8 offset-lg-2 text-center'>
				<fieldset style='border: 1px solid #dc3545;'>
					<legend>Selecione o Período</legend>
				<div class='row'>
					<div class='col-lg-4'>
						<div class='form-group'>
						<select id='mes' name='mes' class='form-control'>
							<?php
								$meses = array(
									"1" => "Janeiro",
									"2" => "Fevereiro",
									"3" => "Março",
									"4" => "Abril",
									"5" => "Maio",
									"6" => "Junho",
									"7" => "Junho",
									"8" => "Agosto",
									"9" => "Setembro",
									"10" => "Outubro",
									"11" => "Novembro",
									"12" => "Dezembro",
									);
									$month = date("m");
									for($i = 1; $i <= 12; $i++)
									{
										$selected = "";
										if($i == $month)
											$selected = "selected";
										echo"<option $selected value='".$i."'>".$meses[$i]."</option>";
									}
							?>
						</select>
						</div>
					</div>
					<div class='col-lg-4'>
						<div class='form-group'>
							<select id='ano' name='ano' class='form-control'>
								<option value='0'>Ano</option>
									<?php
										$year = date("Y");
										for($i = 0; $i < 5; $i++)
										{
											$selected = "";
											if(($year - $i) == $year)
												$selected = "selected";
											echo"<option $selected value='".($year - $i)."'>".($year - $i)."</option>";
										}
									?>
							</select>
						</div>
					</div>
					<div class='col-lg-4'>
						<input type='button' onclick="Main.estatistica('filter');" class='form-control btn-danger' value='Filtrar' />
					</div>
				</div>
				</fieldset>
			</div>
		</div>
		<div class='col-lg-10 offset-lg-1 table-responsive'>
			<canvas id='lineChart' width='800' height='350' style='margin-left: 8%;'></canvas>
			<div id='lineLegend'></div>
		</div>
	</div>
</div>
