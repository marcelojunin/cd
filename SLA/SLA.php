<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php

/* 
 * 1º - Criar cálculo onde eu pego o valor inicial(hora) da abertura do chamado, seto o valor final(hora) e faço o calculo onde 
 * verifico quanto do valor inicial falta para chegar no final, ou vice versa.
 * 2º - Cria o progress bar http://opensource.locaweb.com.br/locawebstyle/documentacao/componentes/barra-de-progresso/
 * 3º - Busco o valor da 1ª função e jogo dentro do progress bar dentro do style="width:<?php $valor ?>%" 
 * 4º - Coloco a div para atualizar por segundo
 * 5º - Para mudar a cor, devo salvar os nomes das class no banco e varificar, se tempo for igual a X atualizo o valor da class
 * <div class="progress-bar progress-bar-<?php $valor_da_class?>">
*/

$dataInicial = '16/09/2016';
$sla = 1;


$horaAtual = date('H');
$minutoAtual = date('i');

$final =  date( 'H', strtotime( $sla ." hours" ) ); 

$sla = $sla * 60;//converte o periodo da SLA para minutos.

$porcentagem = ($minutoAtual * 100)/$sla;

echo $horaAtual,':';
echo $minutoAtual,'</br>';
echo $porcentagem = (int)$porcentagem;
$class = 'success';
/*
 * 3 x 100 = 300 
 * 300 : 60 = 5% 
 */
?>


<div class="progress">
  <div class="progress-bar-<?php echo $class;?>" role="progressbar" aria-valuenow="70"
  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $porcentagem;?>%">
    <?php echo $porcentagem,'%';?>
  </div>
</div>

</body>
</html>