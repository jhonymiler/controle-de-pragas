<?
echo md5('commaster');

$form1=array( //Contém a tag form
      "title"=>"Título do formulário",
      "name"=>"f_input.php",
      "action"=>"acao.php",
      "method"=>"get",
      "fieldsets"=>array( //Contém as tags fieldset
         array(//fieldset 1
            "title"=>"Fieldset 1",
            "id"=>"fieldset1",
            "elements"=>array( //Array contendo os elementos do fieldset
               array(
                  "field"=>"input",//contém o tipo de campo
                  "label"=>"Campo 1", //contém a legenda que vai pertencer ao campo
                  "name"=>"campo1",
                  "type"=>"text",
                  "value"=>"Texto do campo",
                  "size"=>"50"
               ),//fim campo1
               array(
                  "field"=>"input",
                  "label"=>"Campo 2",
                  "name"=>"campo2",
                  "type"=>"password",
                  "value"=>"Texto do campo",
                  "size"=>"50"
               ),//fim campo2
               array(
                  "field"=>"input",
                  "type"=>"checkbox",
                  "label"=>"Campo 3",
                  "name"=>"campo3",
                  "value"=>"3"
               ),//fim campo3
               array(
                  "field"=>"input",
                  "type"=>"checkbox",
                  "label"=>"Campo 4",
                  "name"=>"campo4",
                  "value"=>"4",
                  "checked"=>"true"
               ),//fim campo4
               array(
                  "field"=>"textarea",
                  "label"=>"Campo 5",
                  "name"=>"campo5",
                  "cols"=>"40",
                  "rows"=>"10",
                  "value"=>"Conteúdo do campo 5"
               ),//fim campo 5
               array(
                  "field"=>"select",
                  "label"=>"Campo 6",
                  "name"=>"campo6",
                  "options"=>array(//array contendo as opções no formato value,selected,rótulo, separados por ponto-e-vírgula. Para as opões não selecionadas, coloque um espaçoem branco entre os ponto-e-vírgula
                     "0; ;Zero",
                     "1;selected;Um",
                     "2; ;Dois",
                     "3; ;Três"
                  )//fim array options
               )//fim campo6
            )//fim array elements
         ),//fim do fieldset1
         array(//fieldset 1
            "title"=>"Fieldset 2",
            "id"=>"fieldset2",
            "elements"=>array( //Array contendo os elementos do fieldset
               array(
                  "field"=>"input",//contém o tipo de campo
                  "label"=>"Campo 1", //contém a legenda que vai pertencer ao campo
                  "name"=>"campo1",
                  "type"=>"text",
                  "value"=>"Texto do campo",
                  "size"=>"50"
               ),//fim campo1
               array(
                  "field"=>"input",
                  "label"=>"Campo 2",
                  "name"=>"campo2",
                  "type"=>"password",
                  "value"=>"Texto do campo",
                  "size"=>"50"
               ),//fim campo2
               array(
                  "field"=>"input",
                  "type"=>"checkbox",
                  "label"=>"Campo 3",
                  "name"=>"campo3",
                  "value"=>"3"
               ),//fim campo3
               array(
                  "field"=>"input",
                  "type"=>"checkbox",
                  "label"=>"Campo 4",
                  "name"=>"campo4",
                  "value"=>"4",
                  "checked"=>"true"
               ),//fim campo4
               array(
                  "field"=>"textarea",
                  "label"=>"Campo 5",
                  "name"=>"campo5",
                  "cols"=>"40",
                  "rows"=>"10",
                  "value"=>"Conteúdo do campo 5"
               ),//fim campo 5
               array(
                  "field"=>"select",
                  "label"=>"Campo 6",
                  "name"=>"campo6",
                  "options"=>array(//array contendo as opções no formato value,selected,rótulo, separados por ponto-e-vírgula. Para as opões não selecionadas, coloque um espaçoem branco entre os ponto-e-vírgula
                     "0; ;Zero",
                     "1;selected;Um",
                     "2; ;Dois",
                     "3; ;Três"
                  )//fim array options
               )//fim campo6
            )//fim array elements
         )//fim do fieldset2
      )//fim array fieldsets
);// fim array form1;

function fieldConstructor($fields){
   while(list($n,$tag)=each($fields)){
      $type=$tag[field];
      $campos.='<label for="'.$tag[name].'">'.$tag[label].': </label>';
      if($type=='textarea'){
         $campos.="<$type ";
         while(list($prop,$value)=each($tag)){
            if($prop!="field" && $prop!="value"){
               $campos.=$prop.'="'.$value.'" ';
            }else{}
         }
         $campos.='>'.$tag[value].'</textarea><br>';
      }elseif($type=='select'){
         $options=$tag[options];
         $campos.="<$type ";
         while(list($prop,$value)=each($tag)){
            if($prop!="field" && $prop!="options"){
               $campos.=$prop.'="'.$value.'" ';
            }else{}
         }
            $campos.=">";
            while(list($nn,$o)=each($options)){
               $oo=explode(';',$o);
               $value=$oo[0];
               $selected=$oo[1];
               $label=$oo[2];
               $campos.='<option value="'.$value.'" '.$selected.'>'.$label.'</option>';
            }
            $campos.='</select><br>';
      }else{
         $campos.="<$type ";
               while(list($prop,$value)=each($tag)){
                  if($prop!="field"){
                     $campos.=$prop.'="'.$value.'" ';
                  }
               }
         $campos.="><br>";
      }
   }
   return $campos;
}

function formConstructor($form){
//Monta o cabeçalho da página/formulário
   $f_title=$form[title];
   $print="<h1>$f_title</h1><hr>";
//Monta a tag form
   $print.="<form ";
   while(list($key,$val)=each($form)){
      if($key!="fieldsets"){
         $print.=$key.'="'.$val.'" ';
      }else{}
   }
   $print.='>';
//Monta os fieldsets
   $fieldsets=$form[fieldsets];
   while(list($k,$atual)=each($fieldsets)){
      $print.='<fieldset ';
      while(list($key,$val)=each($atual)){
         if($key!="elements"){
            $print.=$key.'="'.$val.'" ';
         }else{}
      }
      $print.='>';
      $print.="<legend>".$atual[title]."</legend>";
      $print.=fieldConstructor($atual[elements]);//Insere os campos
      $print.='</fieldset>';
   }
//Fecha o formulário e imprime a página   
   $print.='<input name="voltar" type="button" onClick="javascript:history.back();" value="Voltar"><input name="limpar" type="reset" value="Limpar"><input name="enviar" type="submit" value="Enviar">';
   $print.='</form>';
   echo $print;
}

formConstructor($form1);
