<!DOCTYPE html>
<html ng-app="hardware">
<head>
	<meta charset="utf-8">
	<title>Inventário - Hardware</title>

        <script src="../../../angular/lib/angular.min.js" type="text/javascript"></script>
        <script src="../../../angular/lib/dirPagination.js" type="text/javascript"></script>
        <script src="../../../angular/js/app.js" type="text/javascript"></script>
        <script src="../../../angular/js/controllers/inventario/hardwarecrtl.js" type="text/javascript"></script>
        <script src="../../../angular/js/services/inventario/hardwareAPIService.js" type="text/javascript"></script>
        <script src="../../../angular/js/value/configValue.js" type="text/javascript"></script>
        <!--<script src="../../../angular/js/config/interceptorconfig.js" type="text/javascript"></script>-->
        <!--<script src="../../../angular/js/interceptors/loadingInterceptors.js" type="text/javascript"></script>-->
        
        <script src="../../../bootstrap/js/jquery.js" type="text/javascript"></script>
        <script src="../../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../../craftpip-jquery/js/jquery-confirm.js" type="text/javascript"></script>
         <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
       <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
        <link href="../../../bootstrap/css/cd.css" rel="stylesheet" type="text/css"/>
        <link href="../../../craftpip-jquery/css/jquery-confirm.css" rel="stylesheet" type="text/css"/>
        
        <script type="text/javascript">
        
        $(document).ready(function(){
            $('.dropdown-toggle').dropdown();
        });
     
         </script>
       
</head>

<body ng-controller="hardwarecrtl">
    
<div id="container">
   <!-- <div ng-repeat="datauser in datauser">
        <h1> <img src="{{datauser.imagemmenu}}" class="img-circle" width="50px" height="50px"> {{datauser.nomemenu}}</h1>
    </div>-->
	<h1><?php foreach($preenche_dados -> result() as $dados):?> <img src="../../.<?php echo $dados->imagem;?>" class="img-circle" width="50px" height="50px"> <?php endforeach;?> <?php echo $this->session->userdata('nome');?></h1>
       
        <?php include 'C:\xampp\htdocs\cd\application\views\menu_head\administrador\menu_inicial.php'; ?>
        
        <div id="container">

             <div class="" id="form_padrao" data-backdrop="static" >
	  
	      <div class="modal-header">
	        <h4 class="modal-title">Inventário - Hardware</h4>
	      </div>
                 <div>{{error}}</div>   
	      <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6">
                        <form role="form" name="inventarioForm" method="post" id="formulario_usuario" enctype="multipart/form-data">
                            <div class="height-form">  
                                <div class="form-group">

                                    <input type="hidden" class="form-control" ng-model="registro.idinventario" name="idinventario">
                                </div>
                                <div class="form-group">

                                    <input type="text" class="form-control" ng-model="registro.nome" name="nome"  placeholder="Nome do produto" ng-required="true">
                                </div>
                                  <div class="form-group">

                                    <input type="text" class="form-control" ng-model="registro.modelo" name="modelo" placeholder="Modelo do produto" ng-required="true">
                                </div>
                                  <div class="form-group">
                                      <select type="text" class="form-control" ng-model="registro.inventario_config_fk" name="inventario_config_fk" ng-required="true">
                                          <option value="">Selecione uma marca.</option>
                                          <option ng-repeat="dataconfig in dataconfig" value="{{dataconfig.idconfig}}" >{{dataconfig.nome_config}}</option>
                                      </select>
                                  </div>
                            </div>
                               <div>
                                   <button type="button" ng-click="new()" class="btn btn-secondary">Novo</button>
                                   <button type="button" ng-click="registraInventario(registro)" ng-disabled="inventarioForm.$invalid" class="btn btn-secondary">Registrar</button>
                                   <button type="button" ng-click="apagarMultiplosRegistro(dados)" ng-if="registroSelecionado(dados)"  class="btn btn-secondary">Apagar</button>
                               </div>  
			</form>	   
                      </div>
                      <div class="col-md-6">
                          <div class="margin-top-table">
                            <div class="margin-top-table">
                               <input class="form-control" id="search" type="text" ng-model="search" placeholder="Pesquise o pelo nome do Hardware."/>
                            </div>
                        <!--<div ng-show="loading">
                            <h5><div class="loader"></div></h5>
                        </div>
                        <div ng-hide="loading">-->
                        <div class="height-table">
                        <table ng-show="dados.length > 0" class="table">
                                <tr>
                                    <th style="text-align: center;" ng-click="ordenarPor('idinventario')"> ID
                                    <span class="glyphicon sort-icon" ng-show="criterioDeOrdenacao==='idinventario'" ng-class="{'glyphicon-triangle-bottom':ordenacao,'glyphicon-triangle-top':!ordenacao}"></span>
                                    </th>
                                    <th style="text-align: center;" ng-click="ordenarPor('nome')">Nome
                                    <span class="glyphicon sort-icon" ng-show="criterioDeOrdenacao==='nome'" ng-class="{'glyphicon-triangle-bottom':ordenacao,'glyphicon-triangle-top':!ordenacao}"></span>
                                    </th>
                                    <th style="text-align: center;" ng-click="ordenarPor('modelo')">Modelo
                                    <span class="glyphicon sort-icon" ng-show="criterioDeOrdenacao==='modelo'" ng-class="{'glyphicon-triangle-bottom':ordenacao,'glyphicon-triangle-top':!ordenacao}"></span>
                                    </th>
                                    <th style="text-align: center;" ng-click="ordenarPor('dataconfig')">Marca
                                    <span class="glyphicon sort-icon" ng-show="criterioDeOrdenacao==='dataconfig'" ng-class="{'glyphicon-triangle-bottom':ordenacao,'glyphicon-triangle-top':!ordenacao}"></span>
                                    </th>
                                    <th></th>
                                </tr>
                            </tbody>
                                <tr ng-click="edit(dados); itemClicked($index)"  ng-class="{ 'cinza negrito': $index === selectedIndex }" dir-paginate="dados in dados | filter:{nome:search} | orderBy:criterioDeOrdenacao:ordenacao| itemsPerPage:5">
                                    <td>{{dados.idinventario}}</td>
                                    <td>{{dados.nome}}</td>
                                    <td>{{dados.modelo}}</td>
                                    <td>{{dados.nome_config}}</td>
                                    <td>
                                    <a href="javascript:;"  ng-click="apagarRegistro(dados.idinventario)"><button type="button" class="glyphicon glyphicon-trash"></button></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                            </div>
                    <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true"></dir-pagination-controls>
                  </div>
                 <!--</div>-->
                 </div>
              </div>
	      </div>
	      <div class="modal-footer">
	      
              
	      </div>
	    </div>
	  </div>
	</div>
   </div>
    
<p class="footer"></p>
</div>
 
</body>
</html>
