<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Atander Chamado</title>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="../../../bootstrap/css/cd.css" rel="stylesheet" type="text/css"/>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="../../../bootstrap/css/cd.css" rel="stylesheet" type="text/css"/>
        
        <link href="../../../bootstrap/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        
        <script src="../../../bootstrap/js/jquery.js" type="text/javascript"></script>
        <script src="../../../bootstrap/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../../../bootstrap/js/bootbox.js" type="text/javascript"></script>
        <script src="../../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../../bootstrap/js/jquery.forms.js" type="text/javascript"></script>
        <script src="../../../bootstrap/js/bootbox.min.js" type="text/javascript"></script>
        
        <script src="../../../bootstrap/js/jquery.validate.js" type="text/javascript"></script>
        
        <script src="../../../sweet/sweetalert-dev.js" type="text/javascript"></script>
        <script src="../../../sweet/sweetalert.min.js" type="text/javascript"></script>
        
        <link href="../../../sweet/sweetalert.css" rel="stylesheet" type="text/css"/>
        
        <link href="../../../craftpip-jquery/css/jquery-confirm.css" rel="stylesheet" type="text/css"/>
        <script src="../../../craftpip-jquery/js/jquery-confirm.js" type="text/javascript"></script>
        
        <script type="text/javascript">
        
     $(document).ready(function(){
                    $('.dropdown-toggle').dropdown();
                        });
                        
     $(document).ready(function(){
                    $("#formulario_chamado").validate({
            rules : {
                  nomechamado:{
                         required:true,
                         minlength:3
                  },
                  gravadora:{
                         required:true,
                         minlength:3
                  }                               
            },
            messages:{
                  nomechamado:{
                         required:"Informe o nome do CD!",
                         minlength:"O nome deve ter pelo menos 3 caracteres"
                  },
                  gravadora:{
                         required:"Informe a gravadora!",
                         minlength:"O nome deve ter pelo menos 3 caracteres"
                  }    
            }
     });
});
        
    $(document).ready(function(){
            $('table.display').dataTable();
    });
    $(document).ready(function(){
            $('#tabela').dataTable({
                
             
                
            });
    });
    
        function minhaCallCack(){
         swal({   title: "Registro salvo com sucesso!",
             text: "Exito ao realizar operação.",
             timer: 1000, 
             showConfirmButton: false 
         });
        }
        //http://t4t5.github.io/sweetalert/
        /*
    	 * Função que carrega após o DOM estiver carregado.
    	 * Como estou usando o ajaxForm no formulário, é aqui que eu o configuro.
    	 * Basicamente somente digo qual função será chamada quando os dados forem postados com sucesso.
    	 * Se o retorno for igual a 1, então somente recarrego a janela.
    	 */
    	$(function(){
    		$('#formulario_chamado').ajaxForm({
    			success: function(data) {
    				if (data == 1 || data == 11) {
    					
    					//Algo esta acontecendo no controller que está trazendo 11 no lugar de 1.
    					//Faço esse if com || pq preciso que atualize a pagina.
    					//se for sucesso, simplesmente recarrego a página. Aqui você pode usar sua imaginação.
    					
    					//Algo esta acontecendo no controller que está trazendo 11 no lugar de 1.
                                        
    					//document.location.href = document.location.href;
                                        success: minhaCallCack();
                                        //limparCampo();
				    	
    				}else{
                                    alert(data);
                                }
    			}
    		});
    	});
    
    	//Aqui eu seto uma variável javascript com o base_url do CodeIgniter, para usar nas funções do post.
    	var base_url = "<?= base_url() ?>";
    	
	    /*
	     *	Esta função serve para preencher os campos do cliente na janela flutuante
	     * usando jSon.  
	     */
    	function carregaDadosCdJSon(idchamado){
    		$.post(base_url+'/index.php/chamado/chamado_controller/dados_chamado', {
    			idchamado: idchamado
    		}, function (data){
    			$('#nomechamado').val(data.nomechamado);
    			$('#idchamado').val(data.idchamado);//aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
    			$('#nome').val(data.nome); 
    			$('#codusuario').val(data.codusuario); 
    			$('#email').val(data.email); 
    			$('#ramal').val(data.ramal); 
    			$('#descricao').val(data.descricao); 
    			$('#nometec').val(data.nometec); 
    			$('#emailtec').val(data.emailtec); 
    			$('#ramaltec').val(data.ramaltec); 
                        $('#'+data.statuschamado).prop('checked', true);
    			$('#setor_fk').val(data.setor_fk); 
    			$('#subcategoria').val(data.subcategoria_fk); 
    			$('#categoria_fk').val(data.categoria_fk); 
                        
                if( data.statuschamado == 'ematendimento'){
                        $("#salvar").removeAttr('disabled');
                        $("#amarrar").hide();
                }else{
                        $("#salvar").addAttr('disabled');
                }
                        
    		}, 'json');
    	}
    
    	function janelaNovoCd(idchamado){
    		
    		//antes de abrir a janela, preciso carregar os dados do chamado e preencher os campos dentro do modal
    		carregaDadosCdJSon(idchamado);
                
                carregaTabelaJSon(idchamado);
    		//alert(idchamado);
    		
	    	$('#modalEditarCliente').modal('show');
    	}
        
         function carregaTabelaJSon(idchamado){
            $.post(base_url+'/index.php/chamado/chamado_controller/historico', {
    			idchamado: idchamado
    		}, function (data){
    		var buscarvalor = '';

                for(var i in data['justificativa','nometecnico','statuschamado', 'data']){
                    if(data['justificativa'][i] == '0'){
                        data['justificativa'][i] = 'Nenhuma Justificativa a exibir.';
                    }
                    buscarvalor += '<div id="divjustificativa"><span><u><b>Responsável:</b></u> '+data['nometecnico'][i]+'</span><br><span> <u><b>Status:</b></u> '+data['statuschamado'][i]+'</span><br><span> <u><b>Data:</b></u> '+data['data'][i] +'</span><br> <u><b>Justificativa:</b></u> ' + data['justificativa'][i] + '</div><br>';
                }

                $('.add-info').html(buscarvalor);

                // console.log(data);

    		}, 'json');
    	}
        
        function limparCampo(){
            $("#idchamado").val(''); 
            $("#nomechamado").val(''); 
        }
        
        function carregaDadosNovoJSon(id){
    		$.post(base_url+'/index.php/usuario/usuario_controller/dados_usuario', {
    			id: id
    		}, function (data){
    			$('#nome').val(data.nome); 
    			$('#email').val(data.email); 
    			$('#ramal').val(data.ramal); 
    			$('#setor_fk').val(data.setor_fk); 
    		}, 'json');
    	}
        
        function amarrar(id){
    		$.post(base_url+'/index.php/usuario/usuario_controller/dados_usuario', {
    			id: id
    		}, function (data){
    			$('#codusuario').val(data.id); 
    			$('#nometec').val(data.nome); 
    			$('#emailtec').val(data.email); 
    			$('#ramaltec').val(data.ramal);  
    		}, 'json');
    	}
        
    	function novo(id){
            // na função limparCampo() eu apago os valores que estão no modal
            // devido ter aberto o modal anteriormente, fica salvo os valores.
                carregaDadosNovoJSon(id);
            
    		$('#modalEditarCliente').modal('show');
    	}
        
        function confirma(idchamado){
        resposta = confirm("Deseja realmente excluir esse aluno?");
        if (resposta){
            $.ajax({
                type: "POST",
                data: {
                    idchamado: idchamado
                },
                
                url: "http://localhost/cd/index.php/chamado/chamado_controller/excluir_chamado/"+idchamado,
                success: function(data) {
                    if(data == 1 || data == 11){
                        swal("Excluído!", "Dado excluída com sucesso!", "success"); 
                    }else{
                        swal("Erro ao excluir", "Houve algum erro ao excluir!", "error"); 
                        alert("Houve algum erro ao excluir!");
                    }
                },
                error: function(){
                    alert("Houve algum erro ao excluir!");
                }
            });
        }
    }

        function refresh(){
            //document.location.href = document.location.href;
            location.reload();
        }
        
        
        
        function buscar_subcategoria(idcategoria){
          $.post(base_url+"/index.php/subcategoria/subcategoria_controller/ajax_dados_subcategoria", {
            idcategoria : idcategoria
            }, function(data){
            $('#subcategoria').html(data);
            });
        }
        
        function buscar_sla(idsubcategoria){
          $.post(base_url+"/index.php/subcategoria/subcategoria_controller/ajax_dados_sla", {
            idsubcategoria : idsubcategoria
            }, function(data){
            $('#sla').html(data);
            });
        }
        
        $(function(){
            $("#amarrar").click(function(){
                    $("#salvar").removeAttr('disabled');
            });	
        });
        
         $(function(){
            $(".allinput input:radio").click(function(){
                for( i=0; i < $(this).length; i++ ){
                    if($(this).is(":checked")){
                        if($(this).val() == 'encerrar' || $(this).val() == 'aguardando'){
                          $("#justificativa").removeAttr("disabled");               
                        } else{
                          $("#justificativa").attr("disabled","disabled");
                        }
                     }
                 }                     
            });
            
        });
        
        </script>

</head>
<body>

<div id="container">
    <h1><?php foreach($preenche_dados -> result() as $dados):?> <img src="../../.<?php echo $dados->imagem;?>" class="img-circle" width="50px" height="50px"> <?php endforeach;?> <?php echo $this->session->userdata('nome');?> </h1>

              <?php 
              
                  include 'C:\xampp\htdocs\cd\application\views\menu_head\administrador\menu_inicial.php';
             
              ?>

<div id="container">
	
        <div id="body">
            
             <div id="atendimento">
               <nav class="navbar navbar-inverse">
                    <div class="navbar-header">
                      <a class="navbar-brand" href="#">Lista de chamados aguardando atendimento</a>
                    </div>
                 
              </nav>
      
           <table class="display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="">
                <thead>
                    <tr>
                    <th style="text-align: center;">Código do Chamado</th>
                    <th style="text-align: center;">Título do Chamado</th>
                    <th style="text-align: center;">Data e Hora Inicial</th>
                    <th style="text-align: center;">Data e Hora Final</th>
                    <th style="text-align: center;">SLA</th>
                    <th style="text-align: center;">Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php foreach ($atendimento  as $linha): ?> 
                    
                <tr>
                    <td style="text-align: center;"><?php echo $linha['idchamado']?></td>
                    <td style="text-align: center;"><?php echo $linha['nomechamado'] ?></td>
                    <td style="text-align: center;"><?php $i = $linha['datainicial']; echo date('d/m/Y H:i:s', strtotime($i));?></td>
                    <td style="text-align: center;"><?php $j = $linha['datafinal']; echo date('d/m/Y H:i:s', strtotime($j));?></td>
                    <td>
                    <div class="progress">
                        <div class="progress-bar-<?php echo $linha['class']?>" role="progressbar" aria-valuenow="70"
                        aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $linha['porcentagem']?>%">
                          <?php echo  number_format($linha['porcentagem'], 2), PHP_EOL,'%';?>
                        </div>
                      </div>
                    </td>
                    <td style="text-align: center;"><a style="text-align: center;" href="javascript:;"  onclick="janelaNovoCd(<?= $linha['idchamado']?>)"><button type="button" class="glyphicon glyphicon-eye-open"></button></a></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
             </div>
             <div id="aguardando">
               <nav class="navbar navbar-inverse">
                    <div class="navbar-header">
                      <a class="navbar-brand" href="#">Lista de chamados em atendimento</a>
                    </div>
                 
              </nav>
            
           <table class="display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="">
                <thead>
                    <tr>
                    <th style="text-align: center;">Código do Chamado</th>
                    <th style="text-align: center;">Título do Chamado</th>
                    <th style="text-align: center;">Data e Hora Inicial</th>
                    <th style="text-align: center;">Data e Hora Final</th>
                    <th style="text-align: center;">SLA</th>
                    <th style="text-align: center;">Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php foreach ($consulta  as $linha): ?> 
                    
                <tr>
                    <td style="text-align: center;"><?php echo $linha['idchamado']?></td>
                    <td style="text-align: center;"><?php echo $linha['nomechamado'] ?></td>
                    <td style="text-align: center;"><?php $i = $linha['datainicial']; echo date('d/m/Y H:i:s', strtotime($i)); ?></td>
                    <td style="text-align: center;"><?php $j = $linha['datafinal']; echo date('d/m/Y H:i:s', strtotime($j));?></td>
                    <td>
                    <div class="progress">
                        <div class="progress-bar-<?php echo $linha['class']?>" role="progressbar" aria-valuenow="70"
                        aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $linha['porcentagem']?>%">
                          <?php echo  number_format($linha['porcentagem'], 2), PHP_EOL,'%';?>
                        </div>
                      </div>
                    </td>
                    <td style="text-align: center;"><a style="text-align: center;" href="javascript:;"  onclick="janelaNovoCd(<?= $linha['idchamado']?>)"><button type="button" class="glyphicon glyphicon-eye-open"></button></a></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
          </div>
	</div>
        
         <!--START MODAL-->
        <div class="modal fade bs-example-modal-lg" id="modalEditarCliente" data-backdrop="static" >
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Atander Chamado</h4>
	      </div>
                <ul class="nav nav-tabs">
                        <li class="active"><a href="#first-tab" data-toggle="tab">Dados do chamado</a></li>
                        <li><a href="#second-tab" data-toggle="tab">Dados do Usuário</a></li>
                        <li><a href="#third-tab" data-toggle="tab">Dados do Técnico</a></li>
                        <li><a href="#fourth-tab" data-toggle="tab">Justificativa</a></li>
                        <li><a href="#fifth-tab" data-toggle="tab">Histórico</a></li>
                </ul>
	      <div class="modal-body">
	      	
			<form role="form" method="post" action="<?= base_url('index.php/chamado/chamado_controller/salvar_chamado')?>" id="formulario_chamado">
                        <div class="tab-content">
                            <div class="tab-pane active in" id="first-tab">
			  <div class="form-group">
			    <label for="nome">Título do Chamado</label>
			    <input type="text" class="form-control" id="nomechamado"  name='nomechamado'>
			  </div>
                            
			 
                            <div class="form-group">
			    <label for="categoria">Categoria</label>
                            <select class="form-control" name="categoria_fk" id="categoria_fk" required="required" onchange='buscar_subcategoria($(this).val())'>
                                
                                <option value="">Selecione uma categoria</option>
                                <!--AQUI!-->
                                 <?php foreach ($categoria -> result() as $linha): ?> 
                                
                                <option value="<?php echo $linha->idcategoria?>"><?php echo $linha->nomecategoria?></option>
                                
                                <?php endforeach;?>
                                
                            </select>
			  </div>
                            
                             
                            <div class="form-group">
                            <label for="exampleSelect1">Subcategoria</label>
                            
                            <select class="form-control" name="subcategoria_fk" id="subcategoria" required="required" onchange='buscar_sla($(this).val())'>
                             <option value="">Selecione uma categoria</option>
                                <!--AQUI!-->
                                 <?php foreach ($subcategoria -> result() as $linha): ?> 
                                
                                <option value="<?php echo $linha->idsubcategoria?>"><?php echo $linha->nomesubcategoria?></option>
                                
                                <?php endforeach;?>
                            </select>
                          </div>
                                <div id="sla" class="form-group">
                               
                                </div>     
                                
                          <div class="form-group">
                            <label for="exampleTextarea">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="3" maxlength="499"></textarea>
                          </div>
                            
			  <input type="hidden" name="idchamado" id="idchamado" value="" />
                          
                          </div>
                          <div class="tab-pane" id="second-tab">
                          
                                <div class="form-group">
                                    <label for="nome">Nome do Solicitante</label>
                                    <input type="text" class="form-control" id="nome"  name='nome'readonly="true">
                                </div>
                                <div class="form-group">
                                    <label for="nome">Ramal</label>
                                    <input type="text" class="form-control" id="ramal"  name='ramal' readonly="true">
                                </div>
                              
                           <div class="form-group">
			    <label for="setor">Setor</label>
                            <select class="form-control" name="setor_fk" id="setor_fk" required="required">
                                
                                <option value="">Selecione um Setor</option>
                                
                                 <?php foreach ($setor_ativo -> result() as $linha): ?> 
                                
                                <option value="<?php echo $linha->idsetor?>"><?php echo $linha->nomesetor?></option>
                                
                                <?php endforeach;?>
                                
                            </select>
			  </div>
                             <div class="form-group">
                                    <label for="nome">E-mail</label>
                                    <input type="text" class="form-control" id="email"  name='email' readonly="true">
                                </div>
                         </div>  
                            <!--DADOS AO AMARRAR CHAMADO AO TECNICO-->
                            <div class="tab-pane" id="third-tab">
                                 <div class="form-group">
                                    <label for="nome">Código do Técnico</label>
                                    <input type="text" class="form-control" id="codusuario"  name='usuarios_fk'readonly="true">
                                </div>
                            
                                 <div class="form-group">
                                    <label for="nome">Nome do Técnico</label>
                                    <input type="text" class="form-control" id="nometec"  name='nometecnico'readonly="true">
                                </div>
                                <div class="form-group">
                                    <label for="nome">Ramal do Técnico</label>
                                    <input type="text" class="form-control" id="ramaltec"  name='ramaltecnico' readonly="true">
                                </div>
                         
                             <div class="form-group">
                                    <label for="nome">E-mail do Técnico</label>
                                    <input type="text" class="form-control" id="emailtec"  name='emailtecnico' readonly="true">
                                </div>
                                
                            <div class="form-group">
                            <label for="email">Status:</label><br>
                            <div class="allinput">
			    <label class="radio-inline">
                                <input type="radio" name="statuschamado" id="aguardando" value="aguardando" checked="checked"> Aguardando atendimento
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="statuschamado" id="ematendimento" value="ematendimento"> Atender
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="statuschamado" id="encerrar" value="encerrar"> Encerrar
                              </label>
                            </div>
                            </div>
                                
                            </div>
                            
                            <div class="tab-pane" id="fourth-tab">
                              
                            <div class="form-group">
                            <label for="exampleTextarea">Justificativa</label>
                            <textarea class="form-control" id="justificativa" name="justificativa" rows="3" maxlength="499" disabled required="required"></textarea>
                            </div>
                          
                            </div>
                            <div class="tab-pane" id="fifth-tab">
                                
                                 
                                <div id="char"  class="add-info"></div>
                                          
                                     
                            </div>
                        </div>  
			</form>	    
			    
	      </div>
	      <div class="modal-footer">
                  <?php $id = $this->session->userdata('id')?>
	        <button type="button"  class="btn btn-default" data-dismiss="modal" onclick="refresh()" >Fechar</button>
              
	        <button type="button" id="amarrar" class="btn btn-default" onclick="amarrar(<?= $id?>)">Amarrar</button>
                
	       
              <!-- <button type="button" id="salvar" class="btn btn-primary"  disabled="disabled" onclick="$('#formulario_chamado').submit()">Salvar</button>-->
               <button type="button" disabled="disabled" id="salvar" class="btn btn-primary"   onclick="$('#formulario_chamado').submit()">Salvar</button>
	      </div>
	    </div>
	  </div>
	</div>
         <style>
             
          
             
         </style>
        
	<p class="footer"></p>
</div>

</body>
</html>
