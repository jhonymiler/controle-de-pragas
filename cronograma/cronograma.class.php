<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menuModel
 *
 * @author Jonatas
 */
class cronograma{
    
    public 		$_db;
    public 		$itemAtual;
    public 		$_dados = array();
    protected 	$_itens;
    public 		$_listaItens;
    public 		$_optionItens;
	
    public $ORD;	
    public $ORC;	

    public function __construct() {
        $this->_db = new Registro('ordem_servico');
		
		$this->ORD = new ordemServico;
		$this->ORC = new orcamento;

        $this->loadDados();
    }
    
    public function novo($nome,$pai = ''){
        $this->_db->_load(
                "INSERT INTO `pais-filhos` VALUES " .
                "(null, '{$nome}', '{$pai}')"
                );
        $this->loadDados();
        return $this->_db->lastInsertId();
    }
    
    protected function loadDados(){
        $menu = $this->_db->_select("ORDER BY ORD_data_visita");
        foreach ($menu as $row) {
           $this->_itens[$row['ORD_id']] = $row;
           $this->_dados[ $row['id_pai'] ][ $row['ORD_id'] ] = $row;
       }
    }

    public function getItem($itemId){
        return $this->_itens[$itemId];
    }

    public function getFreq($qtdMeses,$freqDias){
            return number_format(($qtdMeses*30.41666666666667)/$freqDias,0,'','');
    }

    public function getSemanas($data){
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
	
   function getList($idPai = 0, $nivel = 0)
   {
	if($idPai == 0){
            $this->_listaItens .= '
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
            ';	
        }
	   foreach( $this->_dados[$idPai] as $idItem => $item){
                // imprime o item do menu
                if($idItem == $this->itemAtual){
                        $active = 'checked="checked"';
                }else{
                        $active = '';
                }
                $this->_listaItens .= '
                        <tr class="'.$active.'">
                           <td>'.$this->_db->filtroData($item['ORD_data_visita']).'</td>
                           <td>'.$item['ORD_hora_visita'].'</td>
                           <td>'.$item['ORD_duracao_visita'].'</td>
                           <td>'.$this->ORD->tipoVisita[ $item['ORD_tipo_visita'] ].'</td>
                           <td>'.$this->ORD->tipoAtividade[ $item['ORD_atividade'] ].'</td>
                           <td>
                                   <ul class="btn-group toolbar">
                                           <li>
                                                   <a href="index.php?cat=os&amp;pg=registro&amp;ord_id='.$idItem.'" class="tablectrl_small bDefault">
                                                           <span class="iconb" data-icon=""></span>
                                                   </a>
                                           </li>
                                           <li>
                                                   <a href="index.php?cat=os&amp;pg=lista&amp;remove='.$idItem.'" class="tablectrl_small bDefault">
                                                           <span class="iconb" data-icon=""></span>
                                                   </a>
                                           </li>
                                   </ul>
                           </td>
                   </tr>
                ';
                // se o menu desta iteração tiver submenus, chama novamente a função
                 if( isset( $this->_dados[$idItem] ) ) $this->getList($idItem);
                // fecha o li do item do menu

        }
        // fecha o ul do menu principal
		
		
         $this->_listaItens .=  '	
                 </tbody>
         </table>
         ';
    }
}


