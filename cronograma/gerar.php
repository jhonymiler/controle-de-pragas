<?
    
    require_once $_SESSION['RAIZ'].'acesso.php';
    require_once dirname(__FILE__).DS.'cronograma.class.php';

    $ORD = new ordemServico;
    $ORC = new orcamento;

    $CRO = new cronograma;
    
    function getFreq($qtdMeses,$freqDias){
        if($freqDias > 0 && $qtdMeses > 0){
            return number_format(($qtdMeses*30.41666666666667)/$freqDias,0,'','');
        }
    }

    function getSemanas($data){
            $data = explode('/',$data);
            $_dia = $data[0];
            $_mes = $data[1];
            $_ano = $data[2];
            $ultimo_dia = date("t",mktime(0, 0, 0, $_mes, 1, $_ano));
            $semanas = array();

            $j = 1;
            for ($i=1; $i<=$ultimo_dia; $i++) {
                     $semanas[$j][$i] = date('w',mktime(0,0,0,$_mes,$i,$_ano));
                     if($i == $_dia) $dia[$j] = date('w',mktime(0,0,0,$_mes,$i,$_ano));
                     if (date('w',mktime(0,0,0,$_mes,$i,$_ano))==6) $j++;
            }
            return array($dia,$semanas);
            /*echo date('w',mktime(0,0,0,$_mes,$_dia,$_ano))."<br>";
            print_r($dia);
            echo "<pre>";
            print_r($semanas);
            echo "</pre>";*/
    }

    // funcção gera cronograma
    
    function cronograma($data,$duracaoContrato,$freqMonit,$tipoVisita = false,$tipoAtividade = false){

            // conversão da frequencia
            
            $frequencia = array(
                7 => 7,
                14 => 14,
                14 => 15,
                28 => 30,
                56 => 60,
                84 => 90,
                168 => 180
            );

            if($qtdDias = array_search($freqMonit,$frequencia)){
                $somaDias = $qtdDias;
            }else{
                echo "Erro na frequencia das visitas. Num de frequência: ".$freqMonit;
                exit;
            }

            // primeira data
            $inicio = explode('/',$data);
           
            $d[0] =  array('tipoVisita'=>$tipoVisita,'tipoAtividade'=>$tipoAtividade,'data'=>date('d/m/Y', mktime(0, 0, 0, $inicio[1], $inicio[0], $inicio[2])));

            /* 
                    calcula quantidade de semana no mes,
                    dias da semana e dias do mes
            */
            $semInicio = getSemanas($data);
            foreach($semInicio[0] as $key=>$val){
                $numSemInicio = $key;
                $diaSemInicio = $val;
            }

            for($i=1;$i < getFreq($duracaoContrato,$freqMonit);$i++){

                    if(!is_array($data)) $data = explode('/',$data);
                    if($i==1){$mes = $inicio[1];}else{$mes = $data[1];}

                    $data = date('d/m/Y', mktime(0, 0, 0, $data[1], $data[0]+$somaDias, $data[2]));
                    //$data = date("d/m/Y", strtotime("+".$frequenciaSemana[$freqMonit]." week",strtotime($data)));

                    /* 
                            calcula quantidade de semana no mes,
                            dias da semana e dias do mes
                    */
                    $sem = getSemanas($data);
                    foreach($sem[0] as $key=>$val){
                        $numSem = $key;
                        $diaSem = $val;
                    }

                    // se for mensal e cair 2 visitas no mesmo mês, soma mais 7 dias
                    if($freqMonit == 30 || $freqMonit == 60 || $freqMonit == 90 ){
                            $novoMes = explode('/',$data);
                            if($mes == $novoMes[1]) {
                                    $data = date('d/m/Y', mktime(0, 0, 0, $novoMes[1], $novoMes[0]+7, $novoMes[2]));
                            }
                            // verifica se na PRIMEIRA semana do mes existe o dia da semana desejado
                            if($numSemInicio == 1){
                                $novoMes = explode('/',$data);
                                if(!in_array($diaSem,$sem[1][$numSemInicio])){
                                        $data = date('d/m/Y', mktime(0, 0, 0, $novoMes[1], $novoMes[0]+7, $novoMes[2]));
                                }
                            }
                            // verifica se na ÚLTIMA semana do mes existe o dia da semana desejado
                            if($numSemInicio == 5 ){
                                $novaData = explode('/',$data);
                                if(!in_array($diaSem,$sem[1][$numSemInicio])){
                                        $data = date('d/m/Y', mktime(0, 0, 0, $novaData[1], $novaData[0]-7, $novaData[2]));
                                }else{
                                        $data = date('d/m/Y', mktime(0, 0, 0, $novaData[1], array_search($diaSem,$sem[1][$numSemInicio]), $novaData[2]));
                                }
                            }
                    }
                    
                    //if($tipoVisita !=false || $tipoAtividade !=false){
                        $d[$i] = array('tipoVisita'=>$tipoVisita,'tipoAtividade'=>$tipoAtividade,'data'=>$data);
                        
                    //}else{
                        //$d[$i] = $data;
                    //}
            }
           
            return $d;
    }

    if(is_numeric($_GET['ord_id'])){
        // pegar a ordem de serviço
        $ordemServico = $ORD->getOs($_GET['ord_id']);
        // pega o orçamento vinculado
        $orcamento = $ORC->getOrcamento($ordemServico['ORC_id']);
        $contrato  = $ORC->getContrato($orcamento['CON_id']);
        $cliente  = $ORC->getCliente($orcamento['CLI_id']);
        
        $dataVisita = $ordemServico['ORD_data_visita'];
        $ordemServico['ORC_id'];
        $duracaoContrato = $contrato['CON_duracao'];
        $freqMonit = $contrato['CON_monitoramento'];
        $freqGest =  $contrato['CON_visita_gestor'];
        $tratQuim =  $contrato['CON_tratamento_quimico'];
        $visExtr =   $contrato['CON_visitas_extras_qtd'];

        /*echo "1-".getFreq($duracaoContrato,$freqMonit)."<Br>";
        echo "2-".getFreq($duracaoContrato,$freqGest)."<Br>";
        echo "3-".getFreq($duracaoContrato,$tratQuim)."<Br>";
        echo "4-".$visExtr."<Br>";
        echo getFreq($duracaoContrato,$freqMonit)+getFreq($duracaoContrato,$freqGest)+getFreq($duracaoContrato,$tratQuim);
        echo $dataVisita."<br><br>";
        echo "$dataVisita $duracaoContrato $freqMonit";*/
        //$listaDatas = cronograma($dataVisita,$duracaoContrato,$freqMonit);
        $monitoramento = array();
        $monitoramento[0] = cronograma($dataVisita,$duracaoContrato,$freqMonit,4,0);
        $monitoramento[1] = cronograma($dataVisita,$duracaoContrato,$freqGest,4,14);
        $monitoramento[2] = cronograma($dataVisita,$duracaoContrato,$tratQuim,4,8);
        
        // visita adicional
        if($visExtr > 0){
            if($visExtr == 1){
                $visExtr = 180;
            }else{
                $visExtr = intval(360/$visExtr);
            }
            $monitoramento[3] = cronograma($dataVisita,$duracaoContrato,$visExtr,7,2);
        }
        
        
        //echo "<pre>";
        //print_r($monitoramento);
        //echo "</pre>";
        
        $listaDatas = array_merge($monitoramento[0],$monitoramento[1],$monitoramento[2],$monitoramento[3]);
        
    }
    
    //print_r($listaDatas);
    
    $i = 0;
    $id_pai = 0;
    $os = new Registro('ordem_servico');
    $rec = new Registro('recursos_materiais');
    
    exibe($listaDatas);
    if(is_array($listaDatas)){
        foreach($listaDatas as $datas){
            //echo $datas."<br>";
            $ordemServico['ORD_data_visita'] = $os->filtroData($datas['data']);
            $ordemServico['ORD_duracao_visita'] = $contrato['CON_duracao_visita'];
            if($i==0){
                    $tipoVisita = $ORD->tipoVisita[ $ordemServico['ORD_tipo_visita'] ];
                    $ordemServico['ORD_tipo_visita'] = 0;
                    $ordemServico['ORD_atividade'] = $datas['tipoAtividade'];
                    // verifica se tem id do pai
                    if($ordemServico['id_pai'] >= 0){
                        $ordemServico['id_pai'] = $ordemServico['ORD_id'];
                    }
                    
                    // grava order de serviço
                    if($_POST['cronograma'] == 1){
                        $ordemServico['id_pai'] = 0;
                        $os->_load($ordemServico);
                        $id_pai = $os->_grava();
                    }
                    
                    // verifica se o id_pai é zero, ou seja, primeiro registro
                    // se não for o primeiro registrto significa que é pai de outro já existente.
                    if($ordemServico['id_pai'] > 0){
                        $id_pai = $ordemServico['id_pai'];
                    }
                    
            }else{
                    $tipoVisita = $ORD->tipoVisita[$datas['tipoVisita']];
                    $ordemServico['ORD_tipo_visita'] = $datas['tipoVisita'];
                    $ordemServico['ORD_atividade'] = $datas['tipoAtividade'];
                    $ordemServico['id_pai'] = $id_pai;
                    
                     // grava order de serviço
                    if($_POST['cronograma'] == 1){
                        $os->_load($ordemServico);
                        $os->_grava();
                    }
            }

            $dados = array(
                'id_pai',
                'ORC_id',
                'ORD_data_visita',
                'ORD_hora_visita',
                'ORD_duracao_visita',
                'ORD_aguardando',
                'ORD_agendado',
                'ORD_tipo_visita',
                'ORD_atividade',
                'EQU_id',
                'VEI_id'
            );
             $i++; 
       }
       
//      if(!empty($_POST['REC_dados_recursos'])){
//          if(count($rec->_select('ORD_id',)))
//          $rec->_load($_POST);
//          $rec->_grava();
//      }
       
    }
    
    
    
//    foreach($CRO->_dados[ $_GET['ord_id'] ] as $id => $item){
//        
//        $dadosCalendario[] = "{
//            title: '".$item['ORD_agendado']."',
//            start: new Date('".$item['ORD_data_visita']." ".$item['ORD_hora_visita']."')
//            
//        }";
//    }
//    
//    $todosDados = '['.implode(',',$dadosCalendario).']';
    /*
?>
<script>
 $(document).ready(function(){
	//===== Calendar =====//
	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
        //alert(new Date('2013-11-19 17:37'));
        
	$('#calendar').fullCalendar({
            header: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
            },
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'],
            buttonText: {
                prev: '&nbsp;&#9668;&nbsp;',
                next: '&nbsp;&#9658;&nbsp;',
                prevYear: '&nbsp;&lt;&lt;&nbsp;',
                nextYear: '&nbsp;&gt;&gt;&nbsp;',
                today: 'hoje',
                month: 'mês',
                week: 'semana',
                day: 'dia'
            },		
            titleFormat: {
                month: 'MMMM yyyy',
                week: "d [ yyyy]{ '&#8212;'[ MMM] d MMM yyyy}",
                day: 'dddd, d MMM, yyyy'
            },
            columnFormat: {
                month: 'ddd',
                week: 'ddd d/M',
                day: 'dddd d/M'
            },
            allDayText: 'dia todo',
            axisFormat: 'H:mm',
            timeFormat: {
                '': 'H(:mm)',
                agenda: 'H:mm{ - H:mm}'
            },
            editable: true,
            events: <?=$todosDados?>
	});
 })
</script>
    <div class="wrapper">
        <!-- Calendar -->
        <!-- Simple head with dark head -->
        
        <div class="widget">
            
            <div class="whead"><h6>Cronograma de visitas: <i class="red"><?=$cliente['CLI_nome']?></i></h6><div class="clear"></div></div>
           
            <? 
                $CRO->getList();
                
                
        	 //echo $CRO->_listaItens;  
            ?>      
            </div>
        <div class="divider"><span></span></div>
    	
  <!-- Main content ends -->
        
        <div class="widget">
            <div class="whead"><h6>Calendar</h6><div class="clear"></div></div>
            <div id="calendar"></div>
        </div>
    </div>
<? */?>