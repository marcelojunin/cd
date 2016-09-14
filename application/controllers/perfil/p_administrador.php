<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class P_administrador extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model("login/login_model");
        $this->login_model->logado();
    }
    
    public function index() {
        $this->load->helper('valida_login/valida_administrador_helper');
      
        $variaveis['validacao'] = getValidaAdministrador();
        
        $this->load->helper('preenche_dados/preenche_dados_helper');
        
        $variaveis['consulta'] = getPreencheDados();
        
        $this->load->view('perfil/administrador', $variaveis);
    }
}

	