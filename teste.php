<?php
$hora = "12:30";
$TOTAL_HORAS = gmdate('H:i:s', strtotime($hora ) + strtotime('00:30') );
echo  $TOTAL_HORAS;
$data=strtotime('07/19/2024');
$today = date('w', strtotime($data))+1;
print_r($today);