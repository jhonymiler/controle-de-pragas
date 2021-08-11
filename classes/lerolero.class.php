<?

class lerolero {

    private $bloco = array(
        0 => array(
            "Caros amigos, ",
            "Por outro lado, ",
            "Assim mesmo, ",
            "No entanto, não podemos esquecer que ",
            "Do mesmo modo, ",
            "A prática cotidiana prova que ",
            "Nunca é demais lembrar o peso e o significado destes problemas, uma vez que ",
            "As experiências acumuladas demonstram que ",
            "Acima de tudo, é fundamental ressaltar que ",
            "O incentivo ao avanço tecnológico, assim como ",
            "Não obstante, ",
            "Todas estas questões, devidamente ponderadas, levantam dúvidas sobre se ",
            "Pensando mais a longo prazo, ",
            "O que temos que ter sempre em mente é que ",
            "Ainda assim, existem dúvidas a respeito de como ",
            "Gostaria de enfatizar que ",
            "Todavia, ",
            "A nível organizacional, ",
            "O empenho em analisar ",
            "Percebemos, cada vez mais, que ",
            "No mundo atual, ",
            "É importante questionar o quanto ",
            "Neste sentido, ",
            "Evidentemente, ",
            "Por conseguinte, ",
            "É claro que ",
            "Podemos já vislumbrar o modo pelo qual ",
            "Desta maneira, ",
            "O cuidado em identificar pontos críticos n",
            "A certificação de metodologias que nos auxiliam a lidar com "
        ),
        1 => array(
            "a execução dos pontos do programa ",
            "a complexidade dos estudos efetuados ",
            "a contínua expansão de nossa atividade ",
            "a estrutura atual da organização ",
            "o novo modelo estrutural aqui preconizado ",
            "o desenvolvimento contínuo de distintas formas de atuação ",
            "a constante divulgação das informações ",
            "a consolidação das estruturas ",
            "a consulta aos diversos militantes ",
            "o início da atividade geral de formação de atitudes ",
            "o desafiador cenário globalizado ",
            "a mobilidade dos capitais internacionais ",
            "o fenômeno da Internet ",
            "a hegemonia do ambiente político ",
            "a expansão dos mercados mundiais ",
            "o aumento do diálogo entre os diferentes setores produtivos ",
            "a crescente influência da mídia ",
            "a necessidade de renovação processual ",
            "a competitividade nas transações comerciais ",
            "o surgimento do comércio virtual ",
            "a revolução dos costumes ",
            "o acompanhamento das preferências de consumo ",
            "o comprometimento entre as equipes ",
            "a determinação clara de objetivos ",
            "a adoção de políticas descentralizadoras ",
            "a valorização de fatores subjetivos ",
            "a percepção das dificuldades ",
            "o entendimento das metas propostas ",
            "o consenso sobre a necessidade de qualificação ",
            "o julgamento imparcial das eventualidades "
        ),
        2 => array(
            "nos obriga à análise ",
            "cumpre um papel essencial na formulação ",
            "exige a precisão e a definição ",
            "auxilia a preparação e a composição ",
            "garante a contribuição de um grupo importante na determinação ",
            "assume importantes posições no estabelecimento ",
            "facilita a criação ",
            "obstaculiza a apreciação da importância ",
            "oferece uma interessante oportunidade para verificação ",
            "acarreta um processo de reformulação e modernização ",
            "pode nos levar a considerar a reestruturação ",
            "representa uma abertura para a melhoria ",
            "ainda não demonstrou convincentemente que vai participar na mudança ",
            "talvez venha a ressaltar a relatividade ",
            "prepara-nos para enfrentar situações atípicas decorrentes ",
            "maximiza as possibilidades por conta ",
            "desafia a capacidade de equalização ",
            "agrega valor ao estabelecimento ",
            "é uma das consequências ",
            "promove a alavancagem ",
            "não pode mais se dissociar ",
            "possibilita uma melhor visão global ",
            "estimula a padronização ",
            "aponta para a melhoria ",
            "faz parte de um processo de gerenciamento ",
            "causa impacto indireto na reavaliação ",
            "apresenta tendências no sentido de aprovar a manutenção ",
            "estende o alcance e a importância ",
            "deve passar por modificações independentemente ",
            "afeta positivamente a correta previsão "
        ),
        3 => array(
            "das condições financeiras e administrativas exigidas.",
            "das diretrizes de desenvolvimento para o futuro.",
            "do sistema de participação geral.",
            "das posturas dos órgãos dirigentes com relação às suas atribuições.",
            "das novas proposições.",
            "das direções preferenciais no sentido do progresso.",
            "do sistema de formação de quadros que corresponde às necessidades.",
            "das condições inegavelmente apropriadas.",
            "dos índices pretendidos.",
            "das formas de ação.",
            "dos paradigmas corporativos.",
            "dos relacionamentos verticais entre as hierarquias.",
            "do processo de comunicação como um todo.",
            "dos métodos utilizados na avaliação de resultados.",
            "de todos os recursos funcionais envolvidos.",
            "dos níveis de motivação departamental.",
            "da gestão inovadora da qual fazemos parte.",
            "dos modos de operação convencionais.",
            "de alternativas às soluções ortodoxas.",
            "dos procedimentos normalmente adotados.",
            "dos conhecimentos estratégicos para atingir a excelência.",
            "do fluxo de informações.",
            "do levantamento das variáveis envolvidas.",
            "das diversas correntes de pensamento.",
            "do impacto na agilidade decisória.",
            "das regras de conduta normativas.",
            "do orçamento setorial.",
            "do retorno esperado a longo prazo.",
            "do investimento em reciclagem técnica.",
            "do remanejamento dos quadros funcionais."
    ));

    // pega o um titulo randomico curto
    function getTitulo() {
        // mistura os arrays somente do bloco 1
        shuffle($this->bloco[1]);
        return ucfirst($this->bloco[1][0]); // deixa a primeira letra da string maiúscula
    }

    // pega um mine texto para chamadas ou descrções
    function getChamada() {
        return $this->getFrase(2);
    }

    // pega um texto longo
    function getTexto() {
        return $this->getFrase(20);
    }

    // mistura os arras dentro dos blocos
    function mistura() {
        for ($i = 0; $i < count($this->bloco); $i++) {
            shuffle($this->bloco[$i]);
        }
    }

    // pega i texto e o titulo randomicamente
    function getFrase($numFrazes) {
        $paragrafo = 0;
        $fraze = '';
        // gera as linhas
        for ($a = 0; $a < $numFrazes; $a++) {
            // embaralha o array
            $this->mistura();
            //determina um numero randomico de 3 a 4
            $qtdFrazes = rand(3, 4);
            for ($i = 0; $i < count($this->bloco[0]); $i++) {
                // add espaço para paragrafo
                if ($paragrafo == 0) {
                    $fraze .= ("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                }
                $fraze .= ($this->bloco[0][$i] . $this->bloco[1][$i] . $this->bloco[2][$i] . $this->bloco[3][$i] . " ");
                // se paragrafo = ao numero de frazes geradas randomicamente
                // adiciona quebra de linha e inicia um novo paragrafo.
                if (++$paragrafo == $qtdFrazes) {
                    $fraze .= ("<br>");
                    $paragrafo = 0;
                }
                // se o numero de frazes for 0 encerra o loop
                if (--$numFrazes <= 0)
                    break;
            }
        }
        return $fraze;
    }

}

$l = new lerolero;
echo '<h3>'.$l->getTitulo().'</h3>';
echo $l->getChamada().'<br><br>';
echo $l->getTexto();

