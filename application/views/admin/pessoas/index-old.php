<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
	<section class="content-header">
		<?php $icon = '<i class="fa fa-' . $pageicon . '"></i>'; ?>
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
		<?php $anchor = 'admin/' . $this->router->class; ?>
	</section>


	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<h3 align="center">Socios</h3>

							</div>
						</div>

					</div>
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo anchor($anchor . '/create', '<i class="fa fa-plus"></i> ' . $texto_btn_create, array('class' => 'btn btn-block btn-success btn-flat')); ?></h3>
					</div>
					<div class="box-body">

						<table class="table table-striped table-hover datatable">
							<thead>
								<tr>
									<!--<th>ID</th>-->
									<th>Nome</th>
									<th>CPF</th>
									<th>Email</th>
									<th>Telefone</th>
									<th>Endereço</th>
									<th>Data Nasc.</th>
									<th>Ação</th>
								</tr>
							</thead>

							<tbody>

								<?php foreach ($pessoa as $apa) : ?>
									<tr>

										<td><?php echo htmlspecialchars($apa['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($apa['cpf'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($apa['email'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($apa['telefone'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($apa['endereco'], ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($apa['data_nasc'], ENT_QUOTES, 'UTF-8'); ?></td>
										
										<!-- Opções -->
										<td>
											<?php echo anchor($anchor . '/edit/' . $apa['id'], "<button class=\"btn btn-danger\"><i class=\"fa fa-pencil\"></i> Editar</button>"); ?>
										</td>

									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>