<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil_pessoal_controller extends CI_Controller {
    
    function alterar_perfil(){
        
       $this->load->model('perfil_pessoal/perfil_pessoal_model');
       $this->load->model('usuario/usuario_model');
       
       $this->load->helper('valida_login/valida_helper');
        
       $variaveis['validacao'] = getValida();
       
       
       $this->load->helper('preenche_dados/preenche_dados_helper');
        
       $variaveis['preenche_dados'] = getPreencheDados();
       
       
       $this->load->view('perfil_pessoal/perfil_pessoal_view', $variaveis);
        
    }
    
    public function load_image() {
        
        $this->load->model('perfil_pessoal/perfil_pessoal_model');
    
        echo $this->perfil_pessoal_model->m_load_image();
    }

    
    function  alter_photo_profile(){
        
        $this->load->library('form_validation');
        
         if (empty($_FILES['imagem']['name'])) {
            $this->form_validation->set_rules('imagem', 'Document', 'required');
            echo 'Selecione ao menos uma imagem.';
        }else{
        
        $this->load->model('perfil_pessoal/perfil_pessoal_model');
 
        echo $this->perfil_pessoal_model->m_alter_photo_profile();

        }
    }

    
    public function load_profile() {
        
        $this->load->model('perfil_pessoal/perfil_pessoal_model');
        
        echo  $this->perfil_pessoal_model->m_load_profile();
    }
    
    
    
    public function update_profile() {
        
        $_POST = json_decode(file_get_contents('php://input'), true);
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome','required');
        $this->form_validation->set_rules('email', 'Email','required');
        $this->form_validation->set_rules('senha', 'Senha','required');
        $this->form_validation->set_rules('ramal', 'Ramal','required');
        $this->form_validation->set_rules('setor_fk', 'Setor','required');
        
        if($this->form_validation->run()== FALSE){
            
            echo 'Preencha todos os campos!';
            
        }else{
        
        $this->load->model('perfil_pessoal/perfil_pessoal_model');
        
        echo $this->perfil_pessoal_model->m_update_profile();
                    
        }
    }
    
    
    public function alter_photo() {
        
       $this->load->model('perfil_pessoal/perfil_pessoal_model');
       $this->load->model('usuario/usuario_model');
       
       $this->load->helper('valida_login/valida_helper');
        
       $variaveis['validacao'] = getValida();
       
       
       $this->load->helper('preenche_dados/preenche_dados_helper');
        
       $variaveis['preenche_dados'] = getPreencheDados();
       
       $variaveis['consulta'] = $this->display_user_data();
       
       $this->load->view('perfil_pessoal/alter_photo_view', $variaveis);
        
    }
    
        function display_user_data(){
        
        $this->load->model('perfil_pessoal/perfil_pessoal_model');
        
        $id = $this->session->userdata('id');
        
        $dados = $this->perfil_pessoal_model->m_list_usuario($id);
        
        return $dados;
        
    }

    
}