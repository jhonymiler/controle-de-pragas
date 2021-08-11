<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orcamento
 *
 * @author Jonatas
 */
class orcamento {
    
	/**
	* Array com todas as tabelas e seus campos
	*/
    private $orcamento;
    private $clientes;
	private $vistoria;
	private $contrato;
	private $recursos_materiais;
	private $formacao_preco;
   
    public function __construct(){
   		$this->orcamento 			= new Registro('orcamentos');
   		$this->clientes				= new Registro('clientes');
   		$this->vistoria 			= new Registro('vistoria');
   		$this->contrato 			= new Registro('contrato');
   		$this->recursos_materiais 	= new Registro('recursos_materiais');
   		$this->formacao_preco 		= new Registro('formacao_preco');
    }
	
	/*
	*	ORÇAMENTOS
	*/
	public function getOrcamento($id){
		$dados = $this->orcamento->_select('ORC_id',$id,'ORDER BY ORC_id ASC');
		return $dados[0];
	}
	
	public function listOrcamento($ordem = 'ORDER BY ORC_data_criacao ASC'){
		return $this->orcamento->_select($ordem);
	}
	/*
	*	VISTORIAS
	*/
	public function getVistoria($id){
		$dados = $this->vistoria->_select('VIS_id',$id);
		return $dados[0];
	}
	/*
	*	CONTRATO
	*/
	public function getContrato($id){
		$contrato = $this->contrato->_select('CON_id',$id);
		$contrato = $contrato[0];
		
		$contrato['CON_inicio'] 	 = $this->filtroData($contrato['CON_inicio']);
		$contrato['CON_termino'] 	 = $this->filtroData($contrato['CON_termino']);
		$contrato['CON_prorrogacao'] = $this->filtroData($contrato['CON_prorrogacao']);
		return $contrato;
	}
	/*
	*	RECURSOS MATERIAIS
	*/
	public function getRecursos($id){
		$dados = $this->recursos_materiais->_select('REC_id',$id);
		return $dados[0];
	}
	
	public function getCliente($id){
		$dados = $this->clientes->_select('CLI_id',$id);
		return $dados[0];
	}
	
	public function delete($ids){
		if(is_array($ids)){
			$ID = $ids;
		}
		if(is_numeric($ids)){
			$ID[] = $ids;
		}
		foreach($ID as $id){
			$orcamento = $this->orcamento->_select('ORC_id',$id);
			$orc = $orcamento[0];
			$this->vistoria->_delete('VIS_id',$orc['VIS_id']);
			$this->contrato->_delete('CON_id',$orc['VISCON_id_id']);
			$this->recursos_materiais->_delete('REC_id',$orc['REC_id']);
			$this->formacao_preco->_delete('FOR_id',$orc['FOR_id']);
			$this->orcamento->_delete('ORC_id',$id);
		}
	}
	
	/*
	*	FORMAÇÃO DE PREÇO
	*/
	public function getPreco($id){
		$dados = $this->formacao_preco->_select('FOR_id',$id);
		return $dados[0];
	}
	
	// FERRAMENTAS
	public function filtroData($data){
		return $this->orcamento->filtroData($data);
	}
	
	public function getListaOrcamentos(){
		$reg = $this->listOrcamento();
		for ($i = 0;$i < count($reg);$i++) {
			  
			  // seleciona o cliente
			  $cliente = new Registro('clientes');
			  $cli 	   = $cliente->_select('CLI_id',$reg[$i]['CLI_id']);
			  $cli 	   = $cli[0];
			  
			  // determina o status
			  $status = array(0=>'Aguardando',1=>'Orçamento',2=>'Aprovado',3=>'Reprovado');
			  //pega valor
			  $valores = $this->getPreco($reg[$i]['FOR_id']);
			  // soma valor total da lista
			  $valorTotal += $valores['FOR_total'];
			  
			  $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$reg[$i]['ORC_id'].'" />';
			  $colum[$i]['Codigo'] = $reg[$i]['ORC_id'];
			  $colum[$i]['Cliente'] = $cli['CLI_nome'];
			  $colum[$i]['Data Criação'] = $this->filtroData($reg[$i]['ORC_data_criacao']);
			  $colum[$i]['Fone'] = $reg[$i]['ORC_'];
			  $colum[$i]['Cel.'] = $reg[$i]['ORC_'];
			  $colum[$i]['Valor'] = 'R$ '.number_format($valores['FOR_total'],2,',',' ');
			  $colum[$i]['Status'] = $status[ $reg[$i]['ORC_status'] ];
			  if($edit = true){
				  $colum[$i]['Opções'] = '
						<ul class="btn-group toolbar">
							<li>
								<a href="index.php?cat=orcamentos&pg=orcamentos&orc_id='.$reg[$i]['ORC_id'].'" class="tablectrl_small bDefault">
									<span class="iconb" data-icon="&#xe1db;"></span>
								</a>
							</li>
							<li>
								<a href="index.php?cat=orcamentos&pg=lista&remove='.$reg[$i]['ORC_id'].'" class="tablectrl_small bDefault">
									<span class="iconb" data-icon="&#xe136;"></span>
								</a>
							</li>
						</ul> 
				  ';
					   
			  }
		}
		if(count($reg)>0){
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
					  <h6>Lista de Orçamentos</h6>
					  <div class="clear"></div>
					</div>
					<div  class="dyn hiddenpars"> 
						<a class="tOptions" title="Options">
							<img src="images/icons/options.png" alt="" />
						</a>
						<form id="remover"  method="post" action="index.php?cat=orcamentos&pg=lista&remove=true">';
						 if(is_object($tab)){
							 $tab->show();
						  }
						echo '
							<input type="submit" name="remover"  value="Remover Selecionados" class="buttonM  bRed floatR">
					  </form>
					  
					  
					</div>
				</div>
				<div class="divider"><span></span></div>
				<div class="fluid">
					<div class="grid10"><span>.</span></div>
					<div class="widget grid2">
						<div class="whead"><h6>Valor Total</h6><div class="clear"></div></div>
						<div class="body">
							<h4 class="green">R$ '.number_format( $valorTotal,2,',',' ').'</h4></li>
						</div>
					</div>
				</div>
				
					  
			';
			$html = ob_get_contents();
			ob_get_clean();
			
			echo $html;
			
		}else{
			return false;
		}

	}
	
}

/*
HTML tabela OUTPUT
<div class="widget check">


	<div class="whead"> 
	  <span class="titleIcon">
	  <input type="checkbox" id="titleCheck" name="titleCheck" />
	  </span>
	  <h6>Lista de Orçamentos</h6>
	  <div class="clear"></div>
	</div>
	
	
	<div  class="dyn hiddenpars"> 
		<a class="tOptions" title="Options">
			<img src="images/icons/options.png" alt="" />
		</a>
		<form id="remover"  method="post" action="?cat=cadastros&pg=funcionarios&remove=true"><table cellpadding="0" cellspacing="0" width="100%" class="tDefault checkAll tMedia dTable">
			<thead>
				<tr>
					<td class="sortCol"></td>
					<td class="sortCol">Cliente</td>
					<td class="sortCol">Data Criação</td>
					<td class="sortCol">Status</td>
					<td class="sortCol">Fone</td>
					<td class="sortCol">Cel.</td>
					<td class="sortCol">E-mail</td>
					<td class="sortCol">Opções</td>
				</tr>
			</thead>
			
			<tbody>
				<tr id="linha_0" class="linha">
					<td><input type="checkbox" name="checkRow[]" value="1" /></td>
					<td>Ki - Kakau Industria e comercia de chocolates LMTDA</td>
					<td>17/08/2013</td>
					<td>0</td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<ul class="btn-group toolbar">
							<li>
								<a href="?cat=cadastros&pg=clientes&id=7" class="tablectrl_small bDefault">
									<span class="iconb" data-icon="&#xe1db;"></span>
								</a>
							</li>
							<li>
								<a href="?cat=cadastros&pg=clientes&remove=true&id=7" class="tablectrl_small bDefault">
									<span class="iconb" data-icon="&#xe136;"></span>
								</a>
							</li>
						</ul> 
					</td>
				</tr>
				<tr id="linha_1" class="linha">
					<td><input type="checkbox" name="checkRow[]" value="2" /></td>
					<td>Ki - Kakau Industria e comercia de chocolates LMTDA></td>
					<td>18/08/2013</td>
					<td>0</td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<ul class="btn-group toolbar">
							<li>
								<a href="?cat=cadastros&pg=clientes&id=7" class="tablectrl_small bDefault">
									<span class="iconb" data-icon="&#xe1db;"></span>
								</a>
							</li>
							<li>
								<a href="?cat=cadastros&pg=clientes&remove=true&id=7" class="tablectrl_small bDefault">
									<span class="iconb" data-icon="&#xe136;"></span>
								</a>
							</li>
						</ul> 
					</td>
				</tr>

				<tr id="linha_2" class="linha">
					<td>
					<input type="checkbox" name="checkRow[]" value="3" />
					</td>
					
					<td>
					Ki - Kakau Industria e comercia de chocolates LMTDA
					</td>
					
					<td>
					18/08/2013
					</td>
					
					<td>
					0
					</td>
					
					<td>
					</td>
					
					<td>
					</td>
					
					<td>
					</td>
					
					<td>

						<ul class="btn-group toolbar">
							<li>
								<a href="?cat=cadastros&pg=clientes&id=7" class="tablectrl_small bDefault">
									<span class="iconb" data-icon="&#xe1db;"></span>
								</a>
							</li>
							<li>
								<a href="?cat=cadastros&pg=clientes&remove=true&id=7" class="tablectrl_small bDefault">
									<span class="iconb" data-icon="&#xe136;"></span>
								</a>
							</li>
						</ul> 
					</td>
				</tr>
			</tbody>
		</table>
		<input type="submit" name="remover"  value="Remover Selecionados" class="buttonM grid6 bRed formSubmit">
	  </form>
	</div>
</div>
*/