<style>
    #meiogeral {
        background-color: transparent;
        
    }
    #meiogeral h4{
        font-weight: bold;
        font-size: 36px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-align: center;
        margin-top: 5px;
        color: #fff;
    }
    #datatable{
        background-color: #123F60;
        color:#fff;
    }
   
    body{
        text-align: center;
        margin: 40px 10px;
		padding: 0;
		font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
		font-size: 14px;
    }
    #calendar {
		max-width: 800px;
		margin: 0 auto;
	}
</style>

<section class="content-header">
        <?php $anchor = 'public/'.$this->router->class; ?>
    </section>

<div id="meiogeral">
    <section class="container-fluid">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-white">
               
                <h4><strong>Reserve seu Epaço no Coworking</strong></h4>
                <br><br>
                
                <?php echo form_open(current_url(), array('class' => 'formgroup', 'id' => 'formgroup', 'name' => 'formgroup'  )); ?>
                <!--inicio dos forms--> 
                <h5>Preencha Todos os campos abaixo para reservar um espaço </h5>  <br> 
                <div class="flex-box">
                    <div class="formgroup">
                        <!--Formulários de Errros--> 
                        
                            <!--Erro do form nome--> 
                            <?php if (!empty(form_error('nome'))) : ?>
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo form_error('nome'); ?>
                                </div>
                            <?php endif; ?>
                            <!--Erro do form email--> 
                            <?php if (!empty(form_error('email'))) : ?>
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo form_error('email'); ?>
                                </div>
                            <?php endif; ?>
                            <!--Erro do form telefone--> 
                            <?php if (!empty(form_error('telefone'))) : ?>
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo form_error('telefone'); ?>
                                </div>
                            <?php endif; ?>
                            <!--Erro do form dia--> 
                            <?php if (!empty(form_error('dia'))) : ?>
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo form_error('dia'); ?>
                                </div>
                            <?php endif; ?>
                            <!--Erro do form horario(hora)--> 
                            <?php if (!empty(form_error('hora'))) : ?>
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo form_error('hora'); ?>
                                </div>
                            <?php endif; ?>
                            <!--Erro do form Espaço(mesa)--> 
                            <?php if (!empty(form_error('mesa'))) : ?>
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo form_error('mesa'); ?>
                                </div>
                            <?php endif; ?>
                            <!--espaço ja reservado mostra este erro(reservado) --> 
                            <?php if (!empty(form_error('reservado'))) : ?>
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo form_error('reservado'); ?>
                                </div>
                            <?php endif; ?>
                        <!-----Fim formulario de Erros------>
                        <!--Formulario de preenchimento -->
                        <div class="col-sm-12">
                            <div class="col-sm-4"> <?php echo form_input($nome); ?>     </div>
                            <div class="col-sm-4"> <?php echo form_input($telefone);?>  </div>
                            <div class="col-sm-4"> <?php echo form_input($email); ?>    </div>
                        </div> <br><br><br>
                        <div class="col-sm-12">
                            <div class="col-sm-4"> <?php echo form_input($dia);?>       </div>
                            <div class="col-sm-4"> <?php echo form_dropdown($hora,'required="required"');?> </div>
                            <div class="col-sm-4"> <?php echo form_dropdown($mesa,'required="required"');?> </div>
                        </div> <br><br><br>
                            <?php echo form_hidden($reservado=1);?>
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn-flat">Agendar</button>
                        </div>
                    </div>
                </div>
                <!--fim buton e do form--------->
                <?php echo form_close();?>
                <br><br><br><br>
                
                <h4 >Espaços Reservados </h4>
                <!-- consulta -->
                <div class="col-sm-12">
                    <div class="box-body">
                        <table id= "datatable" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <!--<th>Lista de Editais</th>-->
                                    <th>Nome</th>
                                    <th>Data</th>
                                    <th>Horário</th>
                                    <th>Espaço</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach ($agenda as $values) : ?>
                                    <tr>
                                        <td><?php echo $values['nome']; ?></td>
                                        <td><?php echo htmlspecialchars(date_format(date_create($values['dia']), "d/m/Y")); ?></td>
                                        <td><?php echo htmlspecialchars($values['descHora'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($values['descMesa'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    </tr>
                                <?php endforeach; ?>  
                            </tbody>
                        </table>
                    </div>    
                </div>      
                <!---fim da consulta----->
                                          
            </div>    
        </div>
    </section>
    <!--fim da seção-----> 
    <!---inicio da seção do calendario
    <section class="container-fluid">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-white">
                <tbody>
                    <?php echo $modulo_calendar; ?>
                </tbody>
            </div>
        </div>
    </section>--->

<!--       fim calendario-------->
    <section class="container-fluid" id="sobre">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-white" >
                <h4><strong>Coworking Público de Rio Grande</strong></h4>
                <p>Instalado dentro do Mercado Público de Rio Grande, o primeiro Espaço Público Coworking da zona sul teve 20 estações ocupadas e um workshop de cosméticos, após uma semana da sua inauguração. O local disponibiliza um espaço colaborativo e funcional com recursos de escritório, de uma forma gratuita para qualquer pessoa que precise de um ambiente com wi-fi livre, contendo bancadas para trabalho com tomadas, sala para reuniões e um pequeno auditório para palestras e workshops.</p>
                <p>A primeira-dama e vereadora Lu Compiani Branco, idealizadora do projeto, ressalta a importância dessa primeira semana de funcionamento do coworking. “Tem sido gratificante verificar que esse espaço está servindo as pessoas que precisam de um local, dentro do contexto do centro histórico, para empreender, se reunir e estudar. Logo, sentimos com essa busca e procura da comunidade, que o coworking realmente veio para atender uma demanda já existente na cidade”.</p>
                <p>O horário de funcionamento do Coworking Chalé 10 é de segunda a sexta-feira, das 8h30min às 18h, e no sábado das 8h30min às 13h. Para utilizar esse serviço é preciso fazer uma prévia reserva pelo WhatsApp 53 9120-5487. No site da Prefeitura, no topo da coluna da direita, foi disponibilizado um botão que direciona o interessado diretamente para o contato do Coworking. </p>
               
                 <!-- <p><strong>Contamos com a sua participação!</strong></p>-->
            </div>
        </div>
    </section>
</div>

<style>
.error{
    color: red;
}
</style>