

        angular.module("hardware").controller("hardwarecrtl", function($scope, hardwareValidate, hardwareInterceptor, hardwareAPI){
            
            $scope.dados = [];
            var carregaHardware = function(){
                hardwareAPI.getCarregaHardware().success(function(data, status){
                   $scope.dados = data;
                }).error(function(data){
                    $scope.error = "Aconteceu um erro:"+data;
                });
            };   
        
            
            
            $scope.registraInventario = function(registro){
                hardwareAPI.getRegistraInventario(registro).success(function(data){
                hardwareValidate.messageHardware(data);
                 if(data === '    1')
                 {
                 delete $scope.registro;
                 delete $scope.selectedIndex;
                 hardwareInterceptor.cleanInputHardware();
                 }
                carregaHardware();
                //$scope.dados.unshift(angular.copy(registro));
                }).error(function(data){
                    $scope.error = "Aconteceu um erro ao carregar as marcar:"+data;
                });
            };
            
            $scope.edit = function(dados){
               hardwareInterceptor.fillInputHardware();
               $scope.registro = dados;
            };
            
            $scope.new = function(){
                delete $scope.registro;
                delete $scope.selectedIndex;
                hardwareInterceptor.cleanInputHardware();
            };
            
            //$scope.selectedIndex = 0;
            $scope.itemClicked = function(idinventario){
                $scope.selectedIndex = idinventario;
            };
            
            $scope.apagarRegistro = function(idinventario){
                hardwareAPI.getApagarRegistro(idinventario).success(function(data){
                hardwareValidate.deleteHardware(data);
                 if(data === '    1')
                 {
                 delete $scope.registro;
                 delete $scope.selectedIndex;
                 hardwareInterceptor.cleanInputHardware();
                 }
                  carregaHardware();
              }).error(function(data){
                  $scope.error = "Aconteceu um erro: "+data;
              });
              
            };
         
            $scope.ordenarPor = function(campo){
                $scope.criterioDeOrdenacao = campo;
                $scope.ordenacao = !$scope.ordenacao;
            };           
            
            $scope.registroSelecionado = function(dados){
                return dados.some(function(registro){
                    return registro.selecionado;
                });
            };

            var LoadConfig =  function(){
                hardwareAPI.getLoadConfig().success(function(data){
                $scope.dataconfig = data;
              }).error(function(data){
                $scope.error = "Aconteceu um erro ao carregar as marcar:"+data;
              });
            };
            
            LoadConfig();
            
            carregaHardware();
            
        });
        
        
        /*
        $scope.marca = [
                {nome:"sony", codigo: 1},
                {nome:"sansung", codigo: 2},
                {nome:"LG", codigo:3},
                {nome:"lenovo", codigo:4}
            ];
        */