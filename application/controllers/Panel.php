<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends Public_Controller {

    public function __construct() {
        parent::__construct();
        // Carrega helper URL
        $this->load->helper("url");
        $this->load->helper("html");
        $this->load->helper("form");

        $this->load->helper('configuracao');
        $this->load->helper('utilidades');

        $this->form_validation->set_error_delimiters('<div class="form_val_error">', '</div>'); 
    }
           
    public function index() {
        $this->cfg = configuracao();
        $php = configuracao_PHP();
        $this->cfg['arq_js'] = base_url().'public/javascript/controllers/home.js';
   
    }
}