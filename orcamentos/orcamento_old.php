<?
	define('DS',DIRECTORY_SEPARATOR);
	require_once $_SESSION['RAIZ'].'acesso.php';
	require_once dirname(__FILE__).DS.'cronograma.class.php';
	
	
	$ORD = new ordemServico;
	$ORC = new orcamento;
	
	$CRO = new cronograma;
	
	 
	if(is_numeric($_GET['ord_id'])){
            // pegar a ordem de serviço
            $ordemServico = $ORD->getOs($_GET['ord_id']);
            // pega o orçamento vinculado
            $orcamento = $ORC->getOrcamento($ordemServico['ORC_id']);
            $contrato  = $ORC->getContrato($orcamento['CON_id']);
            $cliente  = $ORC->getCliente($orcamento['CLI_id']);

            function getFreq($qtdMeses,$freqDias){
                    return number_format(($qtdMeses*30.41666666666667)/$freqDias,0,'','');
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

            function cronograma($data,$duracaoContrato,$freqMonit){

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
                            echo "Erro na frequencia das visitas.";
                            exit;
                    }


                    // primeira data
                    $inicio = explode('/',$data);
                    $d[0] = date('d/m/Y', mktime(0, 0, 0, $inicio[1], $inicio[0], $inicio[2]));

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

                            $d[$i] = $data;
                    }
                    return $d;
            }

            $dataVisita = $ordemServico['ORD_data_visita'];
            $ordemServico['ORC_id'];
            $duracaoContrato = $contrato['CON_duracao'];
            $freqMonit = 30; //$contrato['CON_monitoramento'];
            $freqGest = $contrato['CON_visita_gestor'];
            $tratQuim = $contrato['CON_tratamento_quimico'];
            $visExtr = $contrato['CON_visitas_extras_qtd'];

            /*echo "1-".getFreq($duracaoContrato,$freqMonit)."<Br>";
            echo "2-".getFreq($duracaoContrato,$freqGest)."<Br>";
            echo "3-".getFreq($duracaoContrato,$tratQuim)."<Br>";
            echo "4-".$visExtr."<Br>";
            echo getFreq($duracaoContrato,$freqMonit)+getFreq($duracaoContrato,$freqGest)+getFreq($duracaoContrato,$tratQuim);
            echo $dataVisita."<br><br>";*/
            //echo "$dataVisita $duracaoContrato $freqMonit";
            $listaDatas = cronograma($dataVisita,$duracaoContrato,$freqMonit);
		
	}
	
?>
<script>
 $(document).ready(function(){
	//===== Calendar =====//
	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
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
            editable: false,
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1)
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d-5),
                    end: new Date(y, m, d-2)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d-3, 16, 0),
                    allDay: false
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d+4, 16, 0),
                    allDay: false
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: true
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d+1, 19, 0),
                    end: new Date(y, m, d+1, 22, 30),
                    allDay: false
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/'
                }
            ]
	});
 })
</script>
    <div class="wrapper">
        <!-- Calendar -->
        <!-- Simple head with dark head -->
        
        <div class="widget">
            
            <div class="whead"><h6>Cronograma de visitas: <i class="red"><?=$cliente['CLI_nome']?></i></h6><div class="clear"></div></div>
           <table cellpadding="0" cellspacing="0" width="100%" class="tDark">
                <thead>
                    <tr>
                        <td>Data Visita</td>
                        <td>Hora</td>
                        <td>Duração</td>
                        <td>Tipo de Visita</td>
                        <td>Tipo de Atividade</td>
                        <td>Opções</td>
                    </tr>
                </thead>
                <tbody>
                
                <? $i = 0;
                    $id_pai = 0;
                    $orcam = new Registro('ordem_servico');
                    foreach($listaDatas as $datas){

                        $ordemServico['ORD_data_visita'] = $orcam->filtroData($datas);
                        $ordemServico['ORD_duracao_visita'] = $contrato['CON_duracao_visita'];
                        if($i==0){
                                $tipoVisita = $ORD->tipoVisita[ $ordemServico['ORD_tipo_visita'] ];
                                $ordemServico['ORD_tipo_visita'] = 0;

                                $orcam->_load($ordemServico);
                                $id_pai = $orcam->_grava();
                        }else{
                                $tipoVisita = $ORD->tipoVisita[4];
                                $ordemServico['ORD_tipo_visita'] = 4;
                                $ordemServico['id_pai'] = $id_pai;

                                $orcam->_load($ordemServico);
                                $orcam->_grava();
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
                ?>
                    <tr>
                        <td><?=$datas?></td>
                        <td><?=$ordemServico['ORD_hora_visita']?></td>
                        <td><?=$contrato['CON_duracao_visita']?></td>
                        <td><?=$tipoVisita?></td>
                        <td><?=$ORD->tipoAtividade[ $ordemServico['ORD_atividade'] ]?></td>
                        <td>
                            <ul class="btn-group toolbar">
                                <li>
                                    <a href="index.php?cat=os&amp;pg=registro&amp;ord_id=<?=$ordemServico['ORD_id'];?>" class="tablectrl_small bDefault">
                                            <span class="iconb" data-icon=""></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?cat=os&amp;pg=lista&amp;remove=<?=$ordemServico['ORD_id'];?>" class="tablectrl_small bDefault">
                                            <span class="iconb" data-icon=""></span>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                  <? $i++; }?>
                </tbody>
            </table>
            <? 
                $CRO->getList();
        	 echo $CRO->_listaItens;  
            ?>      
            </div>
        <div class="divider"><span></span></div>
    	
  <!-- Main content ends 
        
        <div class="widget">
            <div class="whead"><h6>Calendar</h6><div class="clear"></div></div>
            <div id="calendar"></div>
        </div>-->
    </div>
