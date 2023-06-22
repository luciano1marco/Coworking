<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
        <?php $anchor = 'admin/' . $this->router->class; ?>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Visualizar Relatórios</h3>
                    </div>

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab1">Geral</a></li>
                        <li><a data-toggle="tab" href="#tab2">Reservas por Datas</a></li>
                       
                    </ul>

                    <div class="box-body">
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active">
<!----------------------------relatorio quantidade de questionarios-->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>Quantidade Reservada</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div id="chart-container">
                                                    <canvas id="relgeralbar"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">&nbsp;</div>
                                </div>
                            </div> 
                            <!-- END TAB -->
<!----------------------------relatorio Grupo de Risco da Covid-19-->
                            <div id="tab2" class="tab-pane fade">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>Quantidade de Reservas por Dia</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            
                                            <div class="col-sm-6">
                                                <div id="chart-container">
                                                    <canvas id="reldiariabar"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-footer">&nbsp;</div>
                                </div>
                            </div>
           
<!-----------fim--------------------------------->
                               
                            </div>
                        </div>
                    </div>
    </section>
</div>