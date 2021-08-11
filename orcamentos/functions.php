<?php
    require_once dirname(dirname(__FILE__)).'\acesso.php';
 if($_GET['valores'] == true){   
    $valores = new Registro('valores');
    $valores->_select('VAL_id', 8);
    $valor = $valores->_getReg();

    $v = new stdClass();
    $v->refeicao       = $valor['VAL_refeicao'];
    $v->hora_operador  = $valor['VAL_dia_operador'];
    $v->dia_hotel      = $valor['VAL_hotel'];
    $v->hora_gestor    = $valor['VAL_dia_gestor'];
    $v->km             = $valor['VAL_km'];
    $v->mat_escritorio = $valor['VAL_material_escritorio'];
    $v->lucro          = $valor['VAL_lucro'];
    $v->comissao       = $valor['VAL_comissao'];

    echo json_encode($v);
}

// retorna um serviço
if(is_numeric($_GET['SER_id'])){
    
    $servicos = new Registro('pragas');
    echo json_encode($servicos->_busca('SER_id',$_GET['SER_id']));
}

// retorna um produto
if(isset($_GET['TRA_id'])&&isset($_GET['ep'])){
    
    $servicos = new Registro('produtos');
    echo json_encode($servicos->_select("WHERE TRA_id REGEXP '".$_GET['TRA_id']."' AND PRA_id REGEXP '".$_GET['ep']."'"));
}