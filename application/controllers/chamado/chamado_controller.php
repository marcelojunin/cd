<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chamado_controller extends CI_Controller {

        public function salvar_chamado(){
            
            $this->load->model('chamado/chamado_model');
            
           // $result = $this->chamado_model->m_salvar_chamado();
            
            if($this->chamado_model->m_salvar_chamado()){
                
                echo 1;
                
            }else{
                
                 echo 0;
                
            }
            
        }
        
        public function listar_chamado(){
            
            $this->load->model('chamado/chamado_model');

            $variaveis['consulta'] = $this->chamado_model->exibe_chamado();
            
            $variaveis['atendimento'] = $this->chamado_model->exibe_chamado_atendimento();
            
            
            $this->load->helper('valida_login/valida_helper');
        
            $variaveis['validacao'] = getValida();
            
            
            $this->load->helper('preenche_dados/preenche_dados_helper');
        
            $variaveis['preenche_dados'] = getPreencheDados();
            
            
            $this->load->model('categoria/categoria_model');
        
            $variaveis['categoria'] = $this->categoria_model->m_exibir_categoria();
            
            
            $this->load->model('subcategoria/subcategoria_model');
        
            $variaveis['subcategoria'] = $this->subcategoria_model->m_exibir_subcategoria();
            
            
            $this->load->model('usuario/usuario_model');
            
            $this->load->helper('setor_ativo/setor_ativo_helper');
        
            $variaveis['setor_ativo'] = getSetorAtivo();
        
            
            $this->load->view("menu_chamado/listar_chamado_view",$variaveis);
            
        }
        
        public function excluir_chamado($idchamado) {
            
            $this->load->model('chamado/chamado_model');
            
            if($this->chamado_model->excluir($idchamado)){
                
               echo 1;
                
            }else{
                
                 echo 0;
                
            }
            
        }
        
        public function dados_chamado() {
            
            $idchamado = $this->input->post("idchamado");
            
            $this->load->model("chamado/chamado_model");
            
            $consulta = $this->chamado_model->m_list_chamado($idchamado);
            
            if($consulta->num_rows() == 0){
                die("Chamado não encontrado");
            }
            
            $array_clientes = array(
                
                "idchamado" => $consulta->row()->idchamado,
                "nomechamado" => $consulta->row()->nomechamado,
                "gravadora" => $consulta->row()->gravadora,
                "nome" => $consulta->row()->nome,
                "email" => $consulta->row()->email,
                "ramal" => $consulta->row()->ramal,
                "nometec" => $consulta->row()->nometec,
                "emailtec" => $consulta->row()->emailtec,
                "ramaltec" => $consulta->row()->ramaltec,
                "descricao" => $consulta->row()->descricao,
                "statuschamado" => $consulta->row()->statuschamado,
                "subcategoria_fk" => $consulta->row()->subcategoria_fk,
                "categoria_fk" => $consulta->row()->categoria_fk,
                "setor_fk" => $consulta->row()->setor_fk
            );
            
            echo json_encode($array_clientes);
        }
        
}


        

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */