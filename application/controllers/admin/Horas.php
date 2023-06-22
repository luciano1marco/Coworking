<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class horas extends Admin_Controller {

	public function __construct()    {
        parent::__construct();

        /* Title Page :: Common */
        $this->page_title->push(lang('horas'));
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
            
            $this->data['hora'] = R::findAll("horas");
 
           /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();

			/* Nome do Botão Criar do INDEX */
			$this->data['texto_btn_create'] = 'Novo Horário';

			/* Data */
			$this->data['error'] = NULL;

			//$this->data['aparelhos'] = R::findAll('aparelhos');


			/* Load Template */
			$this->template->admin_render($this->anchor . '/index', $this->data);
        }
    }

    public function create() {
        /* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Novo Horário", 'admin/horas/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->data['texto_create'] = 'Novo Horário';
		/* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
                
        /* cria a tabela com seus campos */
		if ($this->form_validation->run()) {
			$option = R::dispense("horas");
            $option->descricao = $this->input->post('descricao');
            
			R::store($option);

			$this->session->set_flashdata('message', "Dados gravados");
            redirect('admin/horas', 'refresh');
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
        $this->template->admin_render('admin/horas/create', $this->data);
    }
    
    public function deleteyes($id) {
		if ( ! $this->ion_auth->logged_in() ) {
			return show_error('voce não esta logado');
		}

		//$id = $this->input->get("id");

		if (!isset($id) || $id == null) {
            return show_error('id não confere');
			redirect('admin/horas', 'refresh');
		}

		if ($this->ion_auth->logged_in()) {
			$lixo = R::load("horas", $id);
			R::trash($lixo);
		}
		redirect('admin/horas', 'refresh');
	}

    public function edit($id) {
		$id = (int) $id;

		if (! $this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		}

		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, "Editar Horário", 'admin/horas/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		 /* Titulo */
		 $this->data['texto_edit'] = 'Editar Horário';
		/* Validate form input */
		$this->form_validation->set_rules('descricao', 'descricao', 'required');
		
		$option = R::load("horas", $id);

		if (isset($_POST) && ! empty($_POST)) {
			if ($this->form_validation->run()) {
				$option->descricao = $this->input->post('descricao');
					
				R::store($option);

				redirect('admin/horas/', 'refresh');
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
		$this->template->admin_render('admin/horas/edit', $this->data);
	}
	function activate($id) {
		$id = (int) $id;
	
		$item = R::load("horas", $id);

		$item->ativo = 1;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Horário ativado");
		redirect('admin/horas', 'refresh');
	}

	public function deactivate($id) {
		$id = (int) $id;

		$item = R::load("horas", $id);
		$item->ativo = 0;
		
		R::store($item);
		
		$this->session->set_flashdata('message', "Item de Horário desativado");		
		redirect('admin/horas', 'refresh');
	}

}
