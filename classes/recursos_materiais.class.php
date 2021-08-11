<?


class recursos_materiais{




	 public function _gera_Tabela_Recursos($edit = false) {
		 $reg  = json_decode( utf8_encode($edit) );
                 $reg2 = json_decode( $edit );
                 
		 if(!is_array($reg)){
			 $objNeutro = new stdClass();
			 $objNeutro->ambiente = '';
			 $objNeutro->ep->nome = 0;
			 $objNeutro->ve = 0;
			 $objNeutro->ni = '';
			 $objNeutro->te = '';
			 $objNeutro->nAplic = '';
			 $reg[] = $objNeutro;
			 
		 }
		for ($i = 0; $i < count($reg); $i++) {
		
			$recursos = $reg[$i];
                        
			$colum[$i][''] = '';
			$colum[$i]['Ambientes'] = $recursos->ambiente;
			$colum[$i]['EP'] = array('nome'=>$recursos->ep->nome);
			$colum[$i]['VE'] = $recursos->ve;
			$colum[$i]['NI'] = $recursos->ni;
			$colum[$i]['TE'] = $recursos->te;
			$colum[$i]['Nº Apli.'] = $recursos->nAplic;
                        
                       
                          $json = '{
                                "ambiente":"'.$recursos->ambiente.'",
                                "ep":{"nome":"'.$recursos->ep->nome.'"},
                                "ve":"'.$recursos->ve.'",
                                "ni":"'.$recursos->ni.'",
                                "te":"'.$recursosteve.'",
                                "nAplic":"'.$recursos->nAplic.'"
                           }';
                        
			$colum[$i]['Op'] = '
				<textarea name="orcamento[recursos_materiais][REC_dados_recursos][]" style="display:none;">' . $json . '</textarea>
				<ul class="btn-group toolbar">
					<li><a href="#" onclick="return removeLinha(\'linha_' . $i . '\')" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
				</ul>
                        ';
                        
                        if($recursos->ep->nome > 0){
                            $especie_db = new Registro('pragas');
                            $especie = $especie_db->_select('PRA_id',$recursos->ep->nome);
                            $especie = $especie[0];
                            $colum[$i]['EP'] = '('.$especie['PRA_sigla'].') '.$especie['PRA_nome'];
                        }
                        
		   
		}
	
        
        if (count($reg) > 0) {
            // constroi a tabela
            $tab = new tabela($colum);
            $tab->addAttr('tDefault');
            echo '

                <div class="widget check">
                  <div class="whead">
                    <h6>Lista</h6>
                    <div class="clear"></div>
                  </div>
                  <div  class="dyn hiddenpars recursos_tab1">
                ';
            if (is_object($tab)) {
                $tab->show();
            }
            echo '
                        </div>
                </div>
              ';
        }
       
    }
    
    
     public function _gera_Tabela_Recursos_produtos($reg) {
		 $reg = json_decode($reg);
         if(!is_array($reg)){
			 $objNeutro = new stdClass();
			 $objNeutro->id = '';
			 $objNeutro->qtd = 0;
			 $objNeutro->valor = 0;
			 $objNeutro->disp = '';
			 $objNeutro->nAplic = '';
			 $objNeutro->med = '';
			 $objNeutro->ni = '';
			 $reg[] = $objNeutro;
			 
		 }
		
        for ($i = 0; $i < count($reg); $i++) {

                $recursos = ($reg[$i]);

                $colum[$i]['Prod'] = $recursos->disp.'<input type="hidden" name="id[]" value="'.$recursos->id.'"/>';
                $colum[$i]['Qtd'] = $recursos->qtd;
                $colum[$i]['Nº Apli.'] = $recursos->nAplic;
                $colum[$i]['Med'] = $recursos->med;
                $colum[$i]['Valor und'] = $recursos->valor;
                $colum[$i]['Valor total'] = $recursos->valor*$recursos->qtd;
				$REC_dados_recursos_produtos += $colum[$i]['Valor total'];
                $colum[$i]['Op'] = '
                        <textarea name="orcamento[recursos_materiais][REC_dados_recursos_produtos][]" style="display:none;">' . json_encode($recursos) . '</textarea>
                        <ul class="btn-group toolbar">
                                <li><a href="#" onclick="return removeLinha(\'linha3_' . $i . '\')" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
                        </ul>
          ';

        }

        
        if (count($reg) > 0) {
            // constroi a tabela
            $tab = new tabela($colum,'linha3');
			$attr = array(
				'cellpadding' => 0,
				'cellspacing' => 0,
				'width'       => "100%",
				'class'       => "tDefault"
				);
            $tab->addAttr($attr);
            echo '
                <div class="widget">
                  <div class="whead">
                    <h6>Lista</h6>
                    <div class="clear"></div>
					<script>$(document).ready(function(){formar_preco(valor);})</script>
                  </div>
                  <div  class="recursos_tab3">
                ';
            if (is_object($tab)) {
                $tab->show();
            }
            echo '
                        </div>
                </div>
				<div>
					<span style="float:right;font-size:16px !important;" id="total_recursos" class="green">Total <b>'.(($REC_dados_recursos_produtos > 0)?$REC_dados_recursos_produtos:"0.00").'</b><input type="hidden" value="'.$REC_dados_recursos_produtos.'" /></span>
					<div class="clear"></div> 
				</div>
              ';
        }
        
    }
    
    


}