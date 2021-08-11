<?
class Form extends Conexao{
    var $nomeTab = '';


    # $nome = Nome da Tabela
    # $campos = array('NomeDoCampo'=>array('TipoDaTabela','Label'),); ==> TipoDaTabela = caracter, texto, data, inteiro, alternativa
    # 'titulo'=>array('caracter',1000),
    function CriarTabela($nome,$campos = array()){
        $pref = GerConteudo::Pref_camp($nome);
        $sql = 'CREATE TABLE IF NOT EXISTS '.$nome.' (';
        $sql  .= $pref.'_id int(11) NOT NULL AUTO_INCREMENT,';

        foreach($campos as $Camp){
            foreach($Camp as $camp=>$config){
                $tipo = $config[0];
                $Label = $config[1];

                switch($tipo) {
                    case 'data':
                            $tipo_real = 'date';
                            break;
                    case 'text':
                            $tipo_real = 'varchar(200)';
                            break;
                    case 'inteiro':
                            $tipo_real = 'int(11)';
                            break;
                    case 'textarea':
                            $tipo_real = 'text';
                            break;
                    case 'alternativa':
                            $tipo_real = 'ENUM(0,1,2)';
                            break;
                }
                $sql  .= $pref.'_'.$camp.' '.$tipo_real.' COLLATE utf8_unicode_ci NOT NULL COMMENT "'.$Label.'",';
            }
        }
        $sql  .= $pref.'_slug varchar(200) COLLATE utf8_unicode_ci NOT NULL,';
        $sql  .= 'SUB_slug varchar(200) COLLATE utf8_unicode_ci NOT NULL,';
        $sql  .= 'SUB_id int(11) NOT NULL,';
        $sql  .= 'PRIMARY KEY ('.$pref.'_id)';
        $sql  .= ') ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;';

        return $sql;
    }

}