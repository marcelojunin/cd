<?php $id = $this->session->userdata('id');
      $ip = $this->session->userdata('ip');?>
<div id="body">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="http://localhost/cd/index.php/perfil/p_administrador">Início</a>
            </div>
            <ul class="nav navbar-nav">
                
              <li class="dropdown">
                <a class="dropdown-toggle " data-toggle="dropdown" href="#"> Opções de Usuário
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/cd/index.php/perfil_pessoal/perfil_pessoal_controller/alterar_perfil" class="glyphicon glyphicon-user"> Config. de Perfil</a></li>
                    <li><a href="/cd/index.php/perfil_pessoal/perfil_pessoal_controller/alter_photo" class="glyphicon glyphicon-user"> Alterar Foto</a></li>
                    <li><a href="/cd/index.php/usuario/usuario_controller/listar_usuario" class="glyphicon glyphicon-user"> Config. de Usuário</a></li>
                </ul>
              </li>
              
              <li class="dropdown">
                <a class="dropdown-toggle " data-toggle="dropdown" href="#"> Opções de Configuração
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/cd/index.php/setor/setor_controller/listar_setor" class="glyphicon glyphicon-cog"> Config. de Setor</a></li>
                    <li><a href="/cd/index.php/categoria/categoria_controller/exibir_categoria" class="glyphicon glyphicon-cog"> Config. de Categoria</a></li>
                    <li><a href="/cd/index.php/subcategoria/subcategoria_controller/exibir_subcategoria" class="glyphicon glyphicon-cog"> Config. de Subcategoria</a></li>
                </ul>
              </li>
              
              <li class="dropdown">
                <a class="dropdown-toggle " data-toggle="dropdown" href="#"> Opções de chamado
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/cd/index.php/chamado/chamado_controller/meus_chamados" class="glyphicon glyphicon-floppy-saved"> Meus Chamados</a></li>
                    <li><a href="/cd/index.php/chamado/chamado_controller/listar_chamado" class="glyphicon glyphicon-eye-open"> Atender Chamado</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle " data-toggle="dropdown" href="#"> Indicadores
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/cd/index.php/indicadores/indicadores_controller/localizador" class="glyphicon glyphicon-sort"> Localizador de Chamados</a></li>
                    <li><a href="/cd/index.php/indicadores/indicadores_controller/indicadores" class="glyphicon glyphicon-sort"> Chamado x Data</a></li>
                    <li><a href="/cd/index.php/indicadores/indicadores_controller/indicadores" class="glyphicon glyphicon-sort"> Chamado x Técnico</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle " data-toggle="dropdown" href="#"> Inventário
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/cd/index.php/inventario/inventario_controller/hardware_list" class="glyphicon glyphicon-hdd"> Hardware</a></li>
                    <li><a href="/cd/index.php/inventario/inventario_controller/software_list" class="glyphicon glyphicon-folder-open"> Software</a></li>
                    <li><a href="/cd/index.php/inventario/inventario_controller/configuracao_inventario_list" class="glyphicon glyphicon-cog"> Configuração</a></li>
                </ul>
              </li>
              <li><a href="/cd/index.php/login/login_controller/sair"><span class="glyphicon glyphicon-off"></span> Sair</a></li>
            </ul>
          </div>
        </nav>
           
</div>