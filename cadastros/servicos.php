<?
    $r = new Registro('servicos');
    switch($_GET){

            // ADICIONA UM REGISTRO
            case $_GET['add'] == true && $_POST['servicos'] && empty($_POST['SER_id']) :

                    $r->_load($_POST);
                    if($r->_grava()){
                            $note['tipo'] = 'nSuccess';
                            $note['msg']  = 'Gravado com sucesso!';
                    }else{
                            $note['tipo'] = 'nFailure';
                            $note['msg'] = $r->_getErro();
                    }
                    $mensagem = '
                                    <div class="nNote '.$note['tipo'].'">
                                            <p>'.$note['msg'].'</p>
                                    </div>                    
                    ';
                    break;
            // ATUALIZA UM REGISTRO
            case $_GET['add'] == true && $_POST['servicos'] && is_numeric($_POST['SER_id']) :
                    $r->_load($_POST);
                    if($r->_atualiza()>0){
                            $note['tipo'] = 'nSuccess';
                            $note['msg'] = 'Atualizado com sucesso!';
                    }else{
                            $note['tipo'] = 'nFailure';
                            $note['msg'] = $r->_getErro();
                    }
                    $mensagem = '
                                    <div class="nNote '.$note['tipo'].'">
                                            <p>'.$note['msg'].'</p>
                                    </div>                    
                    ';
                    break;

            // REMOVE UM OU VÁRIOS REGISTROS
            case ($_GET['remove'] == true) && (is_numeric($_GET['id']) || isset($_POST['remover'])):

                            // se houver um get id, remove apenas um registro
                      if(is_numeric($_GET['id']) && !isset($_POST['remover'])){
                              $linhas_afetadas = $r->_delete('SER_id', $_GET['id']);

                      // se hover um post remover, remove varios registros que foram selecionados na lista
                      }else if(!isset($_GET['id']) && isset($_POST['remover'])){
                            foreach($_POST['checkRow'] as $valor){
                                    $linhas_afetadas += $r->_delete('SER_id',$valor);
                            }
                      }
                      // verifica as linhas afetadas
                      if($linhas_afetadas > 0){
                              $note['tipo'] = 'nSuccess';
                              $note['msg'] = 'Excluido com Sucesso!';
                              Principal::Voltar();
                      }else{
                              $note['tipo'] = 'nFailure';
                              $note['msg'] = $r->_getErro();
                      }
                      $mensagem = '
                                      <div class="nNote '.$note['tipo'].'">
                                              <p>'.$note['msg'].'</p>
                                      </div>                    
                      ';
                      break;

            // SELECIONA UM REGISTRO PARA EDIÇÃO
            case is_numeric($_GET['id']) && ($_GET['tab'] == 'servicos'):
                     $r->_busca('SER_id', $_GET['id']);
                     $cliente = $r->_getReg();
                     break;		  
    }
?>
    <form id="cadastro" class="formPessoa grid6" method="post"  action="?cat=cadastros&pg=produtos&add=true&tab=servicos">
        <div class="widget">
            <div class="whead"><h6>Cadastro - Serviços</h6><div class="clear"></div></div>
                <?=$mensagem;?>
                <?=(is_numeric($_GET['id']))?'<input type="hidden" name="SER_id" value="'.(int)$_GET['id'].'"/>':'';?>
                <!--DADOS DA PESSOA JURIDICA OU JURIDICA!-->
                 <div  class="formRow">
                        <div id="razao-social" class="grid3"><label>Nome:<span class="req">*</span></label></div>
                        <div class="grid9"><input type="text" name="SER_nome" value="<?=$cliente['SER_nome']?>"  class="validate[required] grid4" /></div><div class="clear"></div>
                </div>
                <div class="formRow">
                    <div class="grid3"><label>Descrição:</label></div>
                    <div class="grid9"><textarea rows="8" cols="" class="validate[required]" name="SER_descricao"><?=$cliente['SER_descricao']?></textarea> </div>
                    <div class="clear"></div>
                </div> <div class="formRow">
                    <div class="grid3">
                        <label>Valor R$:</label>
                    </div>
                     <div class="grid9">
                         <input type="text" name="SER_valor" value="<?=isset($cliente['SER_valor']) ? $cliente['SER_valor'] : '0.00'?>"  class="validate[required] grid4 validNum" />
                     </div>
                    
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                     <div class="clear"></div>
                     <div class="divider"><span></span></div>

                    <div class="floatR">
                        <input type="submit" name="servicos" value="Submit" class="buttonM grid6 bGreen formSubmit">
                        <input type="button" class="buttonM grid6 bRed" value="Cancel">
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
          </div>
                <div class="clear"></div>
        </div>
    </form>
                 <? 
        $reg = $r->_select();
        for ($i = 0;$i < count($reg);$i++) {
              $columSER[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$reg[$i]['SER_id'].'" />';
              $columSER[$i]['Nome'] = $reg[$i]['SER_nome'];
              $columSER[$i]['Descricao'] = '<span style="font-size:10px;">'.$reg[$i]['SER_descricao'].'</span>';
              $columSER[$i]['Valor R$'] = number_format($reg[$i]['SER_valor'], 2, ',', '.');
              if($edit = true){
                  $columSER[$i]['Editar ou Excluir'] = '
                        <ul class="btn-group toolbar">
                            <li><a href="?cat=cadastros&pg=produtos&tab=servicos&id='.$reg[$i]['SER_id'].'&tab=servicos" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe1db;"></span></a></li>
                            <li><a href="?cat=cadastros&pg=produtos&tab=servicos&remove=true&id='.$reg[$i]['SER_id'].'&tab=servicos" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
                        </ul> 
                  ';

              }
        }
        if(count($reg)>0){
            // constroi a tabela
            $tab = new tabela($columSER);
                                        // adiciona atributos
                                        $tab->addAttr();
              echo '
                  <div class="widget grid6 check">
                    <div class="whead"> 
                      <span class="titleIcon">
                      <input type="checkbox" id="titleCheck" name="titleCheck" />
                      </span>
                      <h6>Lista de Serviços</h6>
                      <div class="clear"></div>
                    </div>
                    <div class="dyn"> 
                        <a class="tOptions" title="Options">
                            <img src="images/icons/options.png" alt="" />
                        </a>
                        <form id="remover"  method="post" action="?cat=cadastros&pg=produtos&tab=servicos&remove=true&tab=servicos">
              ';
             if(is_object($tab)){
                 $tab->show();
              }
            echo '
                            <input type="submit" name="remover"  value="Remover Selecionados" class="buttonM grid6 bRed formSubmit">
                      </form>
                    </div>
                </div>
            ';

        }
 ?>

