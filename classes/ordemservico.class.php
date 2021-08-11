<?
class ordemServico{
	private $os = array();
	public $db;
	private $orc;
        private $recursos_materiais_db;
	
	public 	$tipoVisita = array(
		'Implantação',
		'Aguardando Data',
		'Antecipada',
		'Encerramento',
		'Programada',
		'Reprogramação',
		'Reserva de Horário',
		'Visita Adicional'
	);
	public $tipoAtividade = array(
		'Assistência Técnica',
		'Coleta para Laudo',
		'Complemento',
		'Higienização de Reservatórios',
		'Inspeção',
		'Instalar Dispositivos',
		'Integração',
		'Integração Química',
		'Intervenção Química / Monitoramento',
		'Monitoramento',
		'Palestra',
		'Plano de Ação',
		'Retirar Dispositivos',
		'Reunião',
		'Visita do Gestor',
	);
        
        public $status = array(
            'Em Aberto',
            'Executado',
            'Não Executado',
            'Incompleto',
            'Cancelado'
        );

	
	public function __construct(){
            $this->db = new Registro('ordem_servico');
            $this->orc = new orcamento;
            $this->recursos_materiais_db = new Registro('recursos_materiais');

            $this->listar();		
	}
	
	public function listar($filhos = false){
	   /**
	    * coloca todos os registros da consulta
	    * em um array privado com a chave do array sendo a id do registro.
            */
//            $this->os = '';
//            if(is_numeric($filhos)){
//                $dados = $this->db->_select('WHERE id_pai = "'.$filhos.'" or ORD_id="'.$filhos.'" ORDER BY ORD_data_visita ASC');
//            }else{
//                $dados = $this->db->_select('WHERE id_pai = "0" ORDER BY ORD_data_visita ASC');
//            }
            
            $this->os = '';
            if(is_numeric($filhos)){
                $dados = $this->db->_select('WHERE id_pai = "'.$filhos.'"  ORDER BY ORD_data_visita ASC');
            }else{
                $dados = $this->db->_select('ORDER BY ORD_data_visita ASC');
            }
            if(is_array($dados)){
                foreach($dados as $ordens){
                    $ordens['ORD_data_visita'] = $this->db->filtroData($ordens['ORD_data_visita']);
                    $this->os[ $ordens['ORD_id'] ] = $ordens;
                }
            }else{

                $this->os  = false;
            }

            return $this->os;
	}
	
	public function filtroData($data){
		return $this->db->filtroData($data);
	}
	
	public function grava(array $dados){
                if(isset($dados['ORD_data_visita'])){ 
                    $dados['ORD_data_visita'] = $this->db->filtroData($dados['ORD_data_visita']);
                }
		$this->db->_load($dados);
		if(isset($dados['ORD_id'])){
			return $this->db->_atualiza();
		}else{
			return $this->db->_grava();
		}
	}
	
	public function excluir($ids){
		if(is_array($ids)){
			$id = implode(',',$ids);
		}else{
			$id = $ids;
		}
		
		if($this->db->_query('DELETE FROM ordem_servico WHERE ORD_id IN ('.$id.')')){
			$this->listar();
			return true;
		}else{
			return false;
		}
		
	}
        
        public function baixar($dados){
            $dados['ORD_chegada'] = $this->db->filtroData($dados['ORD_chegada']);
            $dados['ORD_termino'] = $this->db->filtroData($dados['ORD_termino']);
            
            $this->db->_load($dados);
            return $this->db->_atualiza();
        }
	
	public function getOs($id){
            $this->listar();
            return $this->os[ $id ];
	}
        	
	public function getLista(){
            return $this->listar();
	}
        
        public function listarPais(){
           if($this->os == false){
               foreach($this->os as $id => $valor){
                   if($valor['id_pai'] == 0){
                    $dados[$id] = $valor;
                   }
               }
           }
           
           return $dados;
        }
	
	public function gerarTabela($dados){
            if(is_array($dados)){
                $i = 0;
                foreach($dados as $id=>$campos){
                    
                    $ORC = $this->orc->getOrcamento($campos['ORC_id']);
                    $CLI = $this->orc->getCliente($ORC['CLI_id']);
                        
                    if($campos['id_pai'] == 0 && !isset($_GET['filhos'])){
                        $ordem = $this->db->_query('SELECT * FROM ordem_servico WHERE id_pai="'.$campos['ORD_id'].'"  ORDER BY ORD_data_visita ASC');
                        if(count($ordem)>0){
                            $filho = '
                            <li><a href="index.php?cat=os&pg=lista&filhos='.$campos['ORD_id'].'" class=""><span class="icos-list"></span>Listar Cronograma</a></li>
                            ';
                        }else{ $filho = '';}
                    }else{ $filho = '';}
                    
                    //echo $campos['ORD_data_visita']."<br>";
                    
                    $colum[$i][' '] = '<input type="hidden" value="'.$campos['ORD_data_visita'].'"/><input type="checkbox" name="checkRow[]" value="'.$campos['ORD_id'].'" />';
                    $colum[$i]['Codigo'] = $campos['ORD_id'];
                    $colum[$i]['Cliente'] = $CLI['CLI_nome'];
                    $colum[$i]['1ª Visita'] = ($campos['ORD_data_visita']);
                    $colum[$i]['Hora'] = $campos['ORD_hora_visita'];
                    
                    $colum[$i]['Tipo visita'] = $this->tipoVisita[ $campos['ORD_tipo_visita'] ];
                    $colum[$i]['Atividade'] = $this->tipoAtividade[ $campos['ORD_atividade'] ];
                    
                    $colum[$i]['Efetuado:'] = ($campos['ORD_termino'] == '0000-00-00')?'':$this->db->filtroData($campos['ORD_termino']);
                    if($campos['ORD_status'] == 4){
                        $status = '<strong style="color:red">'.$this->status[ $campos['ORD_status'] ].'</strong>';
                    }elseif($campos['ORD_status'] == 1){
                        $status = '<strong style="color:green">'.$this->status[ $campos['ORD_status'] ].'</strong>';
                    }else{
                        $status =$this->status[ $campos['ORD_status'] ];
                    }
                    $colum[$i]['Status:']  = $status ;

                    if($edit = true){
                          $colum[$i]['Opções'] = '
                              <div class="btn-group" style="display: inline-block; margin-bottom: -4px;">
                                    <a class="buttonS bDefault" data-toggle="dropdown" href="#">Actions<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index.php?cat=os&pg=registro&ord_id='.$campos['ORD_id'].'" class=""><span class="icos-pencil"></span>Editar</a></li>
                                        <li><a href="index.php?cat=os&pg=lista&remove='.$campos['ORD_id'].'"><span class="icos-trash"></span>Remover</a></li>
                                        <li><a href="index.php?cat=os&pg=baixa&id='.$campos['ORD_id'].'"><span class="icos-download"></span>Baixar</a></li>
                                        <li><a href="'.$_SESSION['URL'].'impressao/os.php?ord_id='.$campos['ORD_id'].'" target="_blank" class=""><span class="icos-printer"></span>Imprimir</a></li>
                                        '.$filho.'
                                    </ul>
                                </div>
                               
                          ';

                    }

                    $i++;
                }
                
                if(count($colum)>0){
                    // constroi a tabela
                    ob_start();
                    $tab = new tabela($colum);
                    $tab->addAttr();
                    echo '
                        <div class="widget check">
                              <div class="whead"> 
                                <span class="titleIcon">
                                <input type="checkbox" id="titleCheck" name="titleCheck" />
                                </span>
                                <h6>Lista de Ordem de Serviços</h6>
                                <div class="clear"></div>
                              </div>
                              <div  class="dyn hiddenpars"> 
                                      <a class="tOptions" title="Options">
                                              <img src="images/icons/options.png" alt="" />
                                      </a>
                                      <form id="remover"  method="post" action="index.php?cat=os&pg=lista&remove=true">';
                                       if(is_object($tab)){
                                               $tab->show();
                                        }
                                      echo '
                                              <input type="submit" name="remover"  value="Remover Selecionados" class="buttonM  bRed floatR">
                                </form>


                              </div>
                      </div>
                      <div class="divider"><span></span></div>
                    ';
                    $html = ob_get_contents();
                    ob_get_clean();

                    echo $html;
                }
            }else{
                    return false;
            }
	}
        
        public function getRecursos($os_id = false) {
            if($os_id != false){
                $os = $this->getOs($os_id);
                if(count($os)>0){
                    return utf8_decode($os['ORD_defensivos']);
                }else{
                    return false;
                }
            }
        }

        public function getTratamentos($os_id = false) {
            if($os_id != false){
                $os = $this->getOs($os_id);
                if(count($os)>0){
                    return ($os['ORD_detalhes_tratamento']);
                }else{
                    return false;
                }
            }
        }
        
//        public function getRecursos($os_id) {
//            if($os_id != false){
//                $os = $this->getOs($os_id);
//                if(count($os)>0){
//                    $id = ($os['id_pai'] == 0)? $os['ORD_id']: $os['id_pai'];
//
//                    $tratamento = $this->recursos_materiais_db->_select('ORD_id',$id);
//                    return $tratamento[0]['REC_dados_recursos_produtos'];
//                }else{
//                    return false;
//                }
//            }
//        }
//
//        public function getTratamentos($os_id = false) {
//            if($os_id != false){
//                $os = $this->getOs($os_id);
//                $id = ($os['id_pai'] == 0)? $os['ORD_id']: $os['id_pai'];
//                
//                $tratamento = $this->recursos_materiais_db->_select('ORD_id',$id);
//                return $tratamento[0]['REC_dados_recursos'];
//            }
//        }
}
