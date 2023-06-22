<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

    public function __construct() {
        parent::__construct();
        // Carrega helper URL
        //$this->load->helper("url");
        $this->load->helper('configuracao');
        $this->load->helper('utilidades');
    }
	public function index() {
        $cfg = configuracao();
        $php = configuracao_PHP();

        //carregar dados 
        $this->data['mesa'] = R::findAll("mesas");
        $this->data['sala'] = R::findAll("salas");
        // Caso sistema funcione apenas logado, descomentar a linha abaixo e importar o helper URL no construtor
        // redirect("admin");
      
        $this->data['testeAgenda'] = R::findAll("agendas");
        $sqlAgenda = "  SELECT a.id, a.nome, a.telefone, a.email,a.dia, h.descricao as descHora, m.descricao as descMesa
                        FROM agendas as a

                        inner join mesas as m
                        on m.id = a.mesa  

                        inner join horas as h
                        on h.id = a.hora
                    
                        where DATE_FORMAT(a.dia,'%Y-%m-%d')  >= CURDATE()

                       order by descHora desc";
        $this->data['agenda'] = R::getAll($sqlAgenda);	
        
        //-------sql para calendario----------------------
       // load calendar
       $this->load->library('calendar');
		  
       $sql = "SELECT 	a.id,
                    te.descricao as hora ,
                    us.descricao as mesa,
                    a.dia as dagenda,
                    nome	     

                FROM agendas as a

                inner join mesas as us
                on us.id = a.mesa

                inner join horas as te
                on  te.id =a.hora";

        $this->data['agend'] = R::getAll($sql);

        //---- fim sql calendario-------------------------
        
        //----recebe valores dos forms
        $d = $this->input->post('dia');
        $h = $this->input->post('hora');
        $m = $this->input->post('mesa');
        //$t = $this->input->post('reservado');

        //---verifica validação dos forms
        $this->form_validation->set_rules('dia', 'Data', 'required');
        $this->form_validation->set_rules('hora', 'Horario', 'required');
        $this->form_validation->set_rules('mesa', 'Espaço', 'required');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        
        //verifica se a reserva existe cadastrada no banco
        $ag = R::findAll("agendas");
        foreach ($ag as $val):
            if(($val['dia'] == $d) && ($val['hora'] == $h) && ($val['mesa'] == $m ) ){
                $ret=null;
                $this->form_validation->set_rules('reservado', 'Reservado', 'callback_reserved');
                break;//--break impede que grave uma linha no banco igual
            }else{  
                //reserva com sucesso
                $ret = 1;
            }
        endforeach; 
      //---verifica validação dos forms e grava no banco se ret=1
       if ($this->form_validation->run()) {
            if($ret==1){
                $option = R::dispense("agendas");
                $option->nome = strtoupper($this->input->post('nome'));
                $option->email = $this->input->post('email');
                $option->telefone = strtoupper($this->input->post('telefone'));
                $option->dia = strtoupper($this->input->post('dia'));
                $option->hora = strtoupper($this->input->post('hora'));
                $option->mesa = strtoupper($this->input->post('mesa'));
                $option->vaga = 1;
                $option->ativo = 1;
                            
                R::store($option);
            }else{
                //mensagem de erro
            }

            // $this->session->set_flashdata('message', "Dados gravados");
            redirect('home', 'refresh');

        } else {
            /* cria os campos para o formulario  */
            $this->data['reservado'] = array(
                'name'  => 'reservado',
                'id'    => 'reservado',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('reservado'),
            );
            $this->data['nome'] = array(
                'name'  => 'nome',
                'id'    => 'nome',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('nome'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['telefone'] = array(
                'name'  => 'telefone',
                'id'    => 'telefome',
                'type'  => 'int',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('telefone'),
            );
		    $this->data['dia'] = array(
                'name'  => 'dia',
                'id'    => 'dia',
                'type'  => 'date',
                'class' => 'form-control',
                'placeholder' => 'Selecione uma Data',
                'value' => $this->form_validation->set_value('dia'),
            );
            $this->data['hora'] = array(
                'name'  => 'hora',
                'id'    => 'hora',
                'type'  => 'checkbox',
                'options'  => $this->getHora(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('hora'),
            );
            $this->data['mesa'] = array(
                'name'  => 'mesa',
                'id'    => 'mesa',
                'type'  => 'text',
                'options'  => $this->getMesa(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('mesa'),
            );
        } 
        /* cria os campos para o formulario sem o formvalidation */
            $this->data['reservado'] = array(
                'name'  => 'reservado',
                'id'    => 'reservado',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('reservado'),
            );
            $this->data['nome'] = array(
                'name'  => 'nome',
                'id'    => 'nome',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Seu Nome Completo',
                'value' => $this->form_validation->set_value('nome'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'Seu Email principal',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['telefone'] = array(
                'name'  => 'telefone',
                'id'    => 'telefome',
                'type'  => 'int',
                'class' => 'form-control',
                'data-mask'=>"(00)0-0000-0000",
                'data-mask-selectonfocus'=>"true",
                'placeholder' => 'Número do seu Celular',
                'value' => $this->form_validation->set_value('telefone'),
            );
		    $this->data['dia'] = array(
                'name'  => 'dia',
                'id'    => 'dia',
                'type'  => 'date',
                'class' => 'form-control',
                'placeholder' => 'Selecione uma Data',
                'value' => $this->form_validation->set_value('dia'),
            );
            $this->data['hora'] = array(
                'name'  => 'hora',
                'id'    => 'hora',
                'type'  => 'checkbox',
                'options'  => $this->getHora(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('hora'),
            );
            $this->data['mesa'] = array(
                'name'  => 'mesa',
                'id'    => 'mesa',
                'type'  => 'text',
                'options'  => $this->getMesa(),
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('mesa'),
            );
        //---chama os modulos--deve ser a ultima    
          //  $this->data['modulo_calendar'] = $this->load->view('public/includes/calendario.php', $this->data, TRUE);	
         
            $this->data['modulo_meiogeral'] = $this->load->view('public/includes/meiogeral.php', $this->data, TRUE);	
            $this->data['modulo_cabecalho'] = $this->load->view('public/includes/header.php', $cfg, TRUE);	
            $this->data['modulo_rodape'] = $this->load->view('public/includes/footer.php',$cfg, TRUE);      
            $this->data['modulo_menu'] = $this->load->view('public/includes/menu.php', $this->data, TRUE);	
            $this->data['modulo_meio'] = $this->load->view('public/includes/meio.php', $this->data, TRUE);	
            
        //-----Load template-----------
        $this->load->view('public/home', $this->data);
       
	}
    public function getHora() {
		$options = array("" => "Selecione um Horário");

        $option = R::findAll("horas","ativo=1");
		foreach ($option as $e) {
			$options[$e->id] = $e->descricao;
		}
		return $options;
    }
    public function getMesa() {
        $options = array("" => "Selecione um Espaço");
		$option = R::findAll("mesas","ativo=1");
		foreach ($option as $e) {
			$options[$e->id] = $e->descricao;
		}
		return $options;
    }
    function deletando($id){
        $retorno = $this->model_implantacao->deletar($id);
        if($retorno==true){
            $this->session->set_flashdata('sucesso', 'Registro deletado com sucesso!');
        }else{
            $this->session->set_flashdata('error', 'Erro ao deletar registro!');
        }
        echo redirect(base_url());
    }
 
    function load() {
        $event_data = $this->fullcalendar_model->fetch_all_event();
        foreach($event_data->result_array() as $row)
        {
            $data[] = array(
                'id' => $row['id'],
                'title' => $row['nome'],
                'start' => $row['dia'],
                'end' => $row['hora']
            );
        }
        echo json_encode($data);
    }
    function insert() {
        if($this->input->post('title'))
            {
                $data = array(
                'title'  => $this->input->post('nome'),
                'start_event'=> $this->input->post('dia'),
                'end_event' => $this->input->post('hora')
                );
             $this->fullcalendar_model->insert_event($data);
            }
    }
    function update()
        {
            if($this->input->post('id'))
            {
                $data = array(
                'title'   => $this->input->post('nome'),
                'start_event' => $this->input->post('dia'),
                'end_event'  => $this->input->post('hora')
                );
        
            $this->fullcalendar_model->update_event($data, $this->input->post('id'));
            }
    }
    function delete(){
            if($this->input->post('id'))
            {
                $this->fullcalendar_model->delete_event($this->input->post('id'));
            }
    }


//---fim classe-----    
}

