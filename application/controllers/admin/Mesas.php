<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mesas extends Admin_Controller {

	public function __construct()    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('mesas'));
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
            
            $this->data['mesa'] = R::findAll("mesas");
 
           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Novo Espaço';

			/* Data */
			$this->data['error'] = NULL;

			//$this->data['aparelhos'] = R::findAll('aparelhos');


			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }

    public function create() {
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Espaço", 'admin/mesas/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Novo Espaço';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
                
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			$option = R::dispense("mesas");
            $option->descricao = $this->input->post('descricao');
            
			R::store($option);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/mesas', 'refresh');
		} 
        else {
            $this->data['message'] = (validation_errors() ? validation_errors() : "");

            $this->data['descricao'] = array(
                'name'  => 'descricao',
                'id'    => 'descricao',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('descricao'),
            );
         }         
        /* Load Template */
        $this->template->admin_render('admin/mesas/create', $this->data);
    }
    
    public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/mesas', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("mesas", $id);
			R::trash($lixo);
		}
		redirect('admin/mesas', 'refresh');
	}

    public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Espaço", 'admin/horas/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Espaço';
		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
		
		$option = R::load("mesas", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$option->descricao = $this->input->post('descricao');
					
				R::store($option);

				redirect('admin/mesas/', 'refresh');
			}
		}
	
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : "");

		$this->data['id'] = array(
			'id' => $option->id,
		);

		$this->data['descricao'] = array(
			'name'  => 'descricao',
			'id'    => 'descricao',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $option->descricao,
		);

		/* Load Template */
		$this->template->admin_render('admin/mesas/edit', $this->data);
	}
	function activate($id) {
		$id = (int) $id;
	
		$item = R::load("mesas", $id);

		$item->ativo = 1;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Espaço ativado");
		redirect('admin/mesas', 'refresh');
	}

	public function deactivate($id) {
		$id = (int) $id;

		$item = R::load("mesas", $id);
		$item->ativo = 0;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Espaço desativado");		
		redirect('admin/mesas', 'refresh');
	}

}
