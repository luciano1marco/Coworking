<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/'.$this->router->class; ?>
	</section>

	<!--<div style="margin-top: 8px" id="alert_message">
		<?php if($this->session->userdata("message") != null) { ?>
			<div class="alert alert-info alert-dismissable" role="alert">
				<?php echo $this->session->userdata("message"); ?> 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php } ?>
	</div>--->

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo anchor('admin/mesas/create', '<i class="fa fa-plus"></i> Novo Espaço', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
					</div>
					
					<div class="box-body">
						<table id="datatable" class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Descrição</th>
									<th>Açoes</th>
								</tr>
							</thead>

							<tbody>
							<?php foreach ($mesa as $i):?>
							<?php 							
								
								$ativo   	= $i['ativo'];
								$id 		= $i['id'];
								// Para usar ID depois							
								$id_check['value'] = $i['id'];

								$sim = '<span class="label label-success">SIM</span>';
								$nao = '<span class="label label-default">NÃO</span>';
							?>

								<tr>
									<td><?php echo htmlspecialchars($i['descricao'], ENT_QUOTES, 'UTF-8'); ?></td>
										
									<!-- Publicado -->
									<td><?php echo ($ativo) ? anchor($anchor.'/deactivate/'.$id, $sim) : anchor($anchor.'/activate/'. $id, $nao); ?></td>

									<!-- Opções -->                                            
									<td>
										<?php echo anchor($anchor.'/edit/'.$i['id'], "<button class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
									</td>
								</tr>
							<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
