<?
if(file_exists('acesso.php')){
  require_once 'acesso.php';
}

if($_GET['remove'] == 'pessoa' && is_numeric($_GET['id'])){
      $r =  new clientes();
      $linhas_afetadas = $r->_delete('id', $_GET['id']);
      if($linhas_afetadas > 0){
          $note['tipo'] = 'nSuccess';
          $note['msg'] = 'Excluido com Sucesso!';
      }else{
          $note['tipo'] = 'nFailure';
          $note['msg'] = $r->_getErro();
      }
      $returnPessoa = '
              <div class="nNote '.$note['tipo'].'">
                  <p>'.$note['msg'].'</p>
              </div>                    
      ';
 }
 // gera a tabela 
  $pessoa = new cliente;
  $tab = $pessoa->_geraTabela();
?>
  <div class="widget check">
    <div class="whead"> 
      <span class="titleIcon">
      <input type="checkbox" id="titleCheck" name="titleCheck" />
      </span>
      <h6>Lista de Clientes</h6>
      <div class="clear"></div>
    </div>
    <div class="dyn hiddenpars"> 
        <a class="tOptions" title="Options">
            <img src="images/icons/options.png" alt="" />
        </a>
       <?
	   	 if(is_object($tab)){
			 $tab->show();
		  }
	   ?>
    </div>
</div>
