<?php

  error_reporting(E_ALL);

  require('GExtenso.php');
  
  try {

      $valor = 558966; //mt_rand(1, GExtenso::VALOR_MAXIMO);
      echo $valor, ': ', GExtenso::numero($valor), '<br /><br />';

      $valor = 268.54; //mt_rand(1, GExtenso::VALOR_MAXIMO);
      echo 'R$ ', $valor, ': ', GExtenso::moeda($valor), '<br /><br />';

  }
  catch(Exception $e) {
    echo $e->getMessage();
  }

