<?php
$data = "19-10-2014";
$limite = "15-10-2014";
$resultado = date('d/m/Y', strtotime("+2 days",strtotime($data)));
echo 'Resultado'. $resultado ;

if ($data>$limite){
    echo "limite maior";
}

// Array com os dias da semana
$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');

// Aqui usamos a data atual ou qualquer outra data no formato Y-M-D (2016-05-19)
$data = '2024/07/17';
//date('Y-m-d');
//$data = date('Y-m-d');

// Variável que recebe o dia da semana (0 = domingo, 1 = segunda, 2 = terca ...)
$diasemana_numero = date('w', strtotime($data));

// Mostra o dia da semana
echo $diasemana[$diasemana_numero];