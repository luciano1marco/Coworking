<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class agendas extends Admin_Controller {

	public function __construct()    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('agendas'));
        $this->data['pageicon'] = 'ul-list';
        $this->data['pagetitle'] = $this->page_title->show();

        $this->anchor = 'admin/' . $this->router->class;

		$this->load->helper('utilidades');

		$this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>');

        /* Breadcrumbs :: Common */
       // $this->breadcrumbs->unshift(1, 'apoiador', 'admin/apoiador');
    }
	
	public function index()	{ 
		 
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* dados  */
            
            $this->data['agenda'] = R::findAll("agendas");
 
           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Criar Agenda';

			/* Data */
			$this->data['error'] = NULL;

			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }

    public function create() {
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Agendamento ", 'admin/agendas/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Criar Agenda';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
                
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			$option = R::dispense("agendas");
            $option->nome = $this->input->post('nome');
            $option->email = $this->input->post('email');
            $option->telefone = $this->input->post('telefone');
			$option->dia = $this->input->post('dia');
			$option->hora = $this->input->post('hora');
            $option->mesa = $this->input->post('mesa');
            $option->vaga = 1;
			$option->ativo = 1;
			
			R::store($option);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/agendas', 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

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
        /* Load Template */
        $this->template->admin_render('admin/agendas/create', $this->data);
    }
    
    public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/agendas', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("agendas", $id);
			R::trash($lixo);
		}
		redirect('admin/agendas', 'refresh');
	}

    public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Agenda", 'admin/agendas/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Agenda';
		/* Validate form input */
		$this->form_validation->set_rules('nome', 'nome', 'required');
		
		$option = R::load("agendas", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$option->nome = $this->input->post('nome');
				$option->email = $this->input->post('email');
				$option->telefone = $this->input->post('telefone');
				$option->dia = $this->input->post('dia');
				$option->hora = $this->input->post('hora');
				$option->mesa = $this->input->post('mesa');
				$option->vaga = 1;
				$option->ativo = 1;
				
				R::store($option);

				redirect('admin/agendas/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $option->id,
		);

		$this->data['nome'] = array(
			'name'  => 'nome',
			'id'    => 'nome',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $option->nome,
		);
		
		$this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $option->email,
		);

		$this->data['telefone'] = array(
			'name'  => 'telefone',
			'id'    => 'telefome',
			'type'  => 'int',
			'class' => 'form-control',
			'value' => $option->telefone,
		);
		$this->data['dia'] = array(
			'name'  => 'dia',
			'id'    => 'dia',
			'type'  => 'date',
			'class' => 'form-control',
			'value' => $option->dia,
		);
		$this->data['hora'] = array(
			'name'  => 'hora',
			'id'    => 'hora',
			'type'  => 'checkbox',
			'selected'=>$option->hora,				
			'options' => $this->getHora(),
			'class' => 'form-control',
			'value' => $option->hora,
		);
		$this->data['mesa'] = array(
			'name'  => 'mesa',
			'id'    => 'mesa',
			'type'  => 'text',
			'selected'=>$option->mesa,				
			'options' => $this->getMesa(),
			'class' => 'form-control',
			'value' => $option->mesa,
		);

	
		/* Load Template */
		$this->template->admin_render('admin/agendas/edit', $this->data);
	}
	function activate($id) {
		$id = (int) $id;
	
		$item = R::load("agendas", $id);

		$item->ativo = 1;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item da Agenda ativado");
		redirect('admin/agendas', 'refresh');
	}
	public function deactivate($id) {
		$id = (int) $id;

		$item = R::load("agendas", $id);
		$item->ativo = 0;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item da Agenda desativado");		
		redirect('admin/agendas', 'refresh');
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
        $options = array("" => "Selecione uma Espaço");
		$option = R::findAll("mesas","ativo=1");
		foreach ($option as $e) {
			$options[$e->id] = $e->descricao;
		}
		return $options;
    }
}
