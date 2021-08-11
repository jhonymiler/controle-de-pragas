<?
$texto = '
	<div id="vm-video-actions-bar2" class="goog-scrollfloater" style="width:100%;">
      <div id="vm-video-actions-inner2" style="float:right;"> <span class="yt-uix-overlay">
        <button type="button" id="vm-history-more" class=" yt-uix-button yt-uix-button-default" role="button" onclick="document.location=\'?pg=cliente&novo=true\';"><span class="yt-uix-button-content"><font><font>Novo cadastro</font></font></span></button>
        <button type="submit" class="yt-uix-button yt-uix-button-default" role="button"><span class="yt-uix-button-content"><font><font>Enviar</font></font></span></button>
        </span>
        </div>
        <br class="limpa">
    </div>
  <input name="tab" type="hidden" value="produtos">
    <fieldset id="geral">
      <legend>Cadastro de Produto</legend>
      <ul class="bloco-form">
        <li>
            <label for="PRO_sigla_nome">Sigla/Nome ::</label>
            <input type="text" class="inputText" name="PRO_sigla_nome" value="" id="sigla_nome" autocomplete="on" obrigatorio="on">
        </li>
        <li>
            <label for="PRO_nome_fantasia">Nome Fantasia ::</label>
            <input type="text" class="inputText" name="PRO_nome_fantasia" value="" id="nome_fantasia"  obrigatorio="on">
        </li>
        <li>
            <label for="PRO_fabricante">Fabricante ::</label>
            <input type="text" class="inputText" name="PRO_fabricante" value="" id="fabricante"  obrigatorio="on">
        </li>
        <li>
            <label for="PRO_modelo">Modelo ::</label>
            <input type="text" class="inputText" name="PRO_modelo" value="" id="modelo"  >
        </li>
        <li>
            <label for="PRO_grupo">Grupo ::</label>
            <input type="text" class="inputText" name="PRO_grupo" value="" id="grupo"  >
        </li>
        <li>
            <label for="PRO_descria_a_o">Descri&ccedil;&atilde;o ::</label>
            <input type="text" class="inputText" name="PRO_descria_a_o" value="" id="descria_a_o"  >
        </li>
        <li>
            <label for="PRO_patrima_nio">Patrim&ocirc;nio ::</label>
            <input type="text" class="inputText" name="PRO_patrima_nio" value="" id="patrima_nio"  >
        </li>
        <li>
            <label for="PRO_estoque_minimo">Estoque minimo ::</label>
            <input type="text" class="inputText" name="PRO_estoque_minimo" value="" id="estoque_minimo"  obrigatorio="on">
        </li>
        <li>
            <label for="PRO_cas">CAS ::</label>
            <input type="text" class="inputText" name="PRO_cas" value="" id="cas"  obrigatorio="on">
        </li>
        <li>
            <label for="PRO_un_estoque">Un. Estoque ::</label>
            <input type="text" class="inputText" name="PRO_un_estoque" value="" id="un_estoque"  obrigatorio="on">
        </li>
        <li>
            <label for="PRO_un_cliente">Un. Cliente ::</label>
            <input type="text" class="inputText" name="PRO_un_cliente" value="" id="un_cliente"  obrigatorio="on">
        </li>
       </ul>
        <fieldset style="width:370px; margin-left:0;" >
          <legend>Conversor Unidade de Medida</legend>
          <ul class="bloco-form">
              <li>
                <label for="PRO_baixa">baixa ::</label>
                <input type="text" class="inputText" name="PRO_baixa" value="" id="baixa" autocomplete="on" obrigatorio="on">
            </li>
            <li>
                <label for="PRO_conv">conv ::</label>
                <input type="text" class="inputText" name="PRO_conv" value="" id="conv"  obrigatorio="on">
            </li>
            <li>
                <label for="PRO_conv_estoque">conv. estoque ::</label>
                <input type="text" class="inputText" name="PRO_conv_estoque" value="" id="conv_estoque"  obrigatorio="on">
            </li>
            <li>
                <label for="PRO_conv_cliente">conv. cliente ::</label>
                <input type="text" class="inputText" name="PRO_conv_cliente" value="" id="conv_cliente"  obrigatorio="on">
            </li>
          </ul>
        </fieldset>
    </fieldset>
    <fieldset >
          <legend>Margem de Lucro</legend>
        <ul class="bloco-form">
            <li>
                <label for="PRO_prea_o">Pre&ccedil;o ::</label>
                <input type="text" class="inputText" name="PRO_prea_o" value="" id="prea_o"  obrigatorio="on">
            </li>
            <li>
                <label for="PRO_markup">MarkUp ::</label>
                <input type="text" class="inputText" name="PRO_markup" value="" id="markup"  obrigatorio="on">
            </li>
        </ul>
    </fieldset>
    <fieldset >
        <legend>Parecer T&eacute;cnico</legend>
        <ul class="bloco-form">
            <li>
                <textarea style="width:396px;" name="PRO_parecer_tecnico" id="parecer_tecnico"   cols="" rows=""></textarea>
            </li>
        </ul>
    </fieldset>
    <fieldset >
        <legend>Grupo Quimico</legend>
        <ul class="bloco-form">
            <li>
                <label for="PRO_grupo_quimico">Grupo Quimico ::</label>
                <input type="text" class="inputText" name="PRO_grupo_quimico" value="" id="grupo_quimico"  obrigatorio="on">
            </li>
            <li>
                <label for="PRO_principio_ativo">Principio Ativo ::</label>
                <input type="text" class="inputText" name="PRO_principio_ativo" value="" id="principio_ativo"  obrigatorio="on">
            </li>
            <li>
                <label for="PRO_concentraa_a_o">Concentra&ccedil;&atilde;o ::</label>
                <input type="text" class="inputText" name="PRO_concentraa_a_o" value="" id="concentraa_a_o"  obrigatorio="on">
            </li>
            <li>
                <label for="PRO_registro">Registro ::</label>
                <input type="text" class="inputText" name="PRO_registro" value="" id="registro"  obrigatorio="on">
            </li>
            <li>
                <label for="PRO_antidoto">Antidoto ::</label>
                <input type="text" class="inputText" name="PRO_antidoto" value="" id="antidoto"  obrigatorio="on">
            </li>
        </ul>
    </fieldset>
    <fieldset >
        <legend>Dilui&ccedil;&atilde;o</legend>
        <ul class="bloco-form">
            <li>
                <label for="PRO_diluia_a_o_fispq">Dilui&ccedil;&atilde;o Fispq ::</label>
                <input type="text" class="inputText" name="PRO_diluia_a_o_fispq" value="" id="diluia_a_o_fispq"  obrigatorio="on">
            </li>
            <li>
                <label for="PRO_qtd_p_a_rea">Qtd p/ &Aacute;rea ::</label>
                <input type="text" class="inputText" name="PRO_qtd_p_a_rea" value="" id="qtd_p_a_rea"  obrigatorio="on">
            </li>
       </ul>
    </fieldset>
    

';
preg_replace('/name\=\"(.*)+\" value(\=\"\")? /','name="${1}" value="${1}"',$texto);


echo $texto;
?>

