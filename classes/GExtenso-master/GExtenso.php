<?php
/**
 * GExtenso class file
 *
 * @author Fausto Gon�alves Cintra (goncin) <goncin@gmail.com>
 * @link http://devfranca.ning.com
 * @link http://twitter.com/g0nc1n
 * @license http://creativecommons.org/licenses/LGPL/2.1/deed.pt
 */

/**
 * GExtenso � uma classe que gera a representa��o por extenso de um n�mero ou valor monet�rio.
 *
 * ATEN��O: A P�GINA DE C�DIGO DESTE ARQUIVO � UTF-8 (Unicode)!
 * 
 * Sua implementa��o foi feita como prova de conceito, utilizando:
 *
 *
 * <ul>
 * <li>M�todos est�ticos, implementando o padr�o de projeto (<i>design pattern</i>) <b>SINGLETON</b>;</li>
 * <li>Chamadas recursivas a m�todos, minimizando repeti��es e mantendo o c�digo enxuto;</li>
 * <li>Uso de pseudoconstantes ('private static') diante das limita��es das constantes de classe;</li>
 * <li>Tratamento de erros por interm�dio de exce��es; e</li>
 * <li>Utiliza��o do phpDocumentor ({@link http://www.phpdoc.org}) para documenta��o do c�digo fonte e
 * gera��o autom�tica de documenta��o externa.</li>
 * </ul>
 *
 * <b>EXEMPLOS DE USO</b>
 *
 * Para obter o extenso de um n�mero, utilize GExtenso::{@link numero}.
 * <pre>
 * echo GExtenso::numero(832); // oitocentos e trinta e dois
 * echo GExtenso::numero(832, GExtenso::GENERO_FEM) // oitocentas e trinta e duas
 * </pre>
 *
 * Para obter o extenso de um valor monet�rio, utilize GExtenso::{@link moeda}.
 * <pre>
 * // IMPORTANTE: veja nota sobre o par�metro 'valor' na documenta��o do m�todo!
 * echo GExtenso::moeda(15402); // cento e cinquenta e quatro reais e dois centavos
 * echo GExtenso::moeda(47); // quarenta e sete centavos
 * echo GExtenso::moeda(357082, 2,
 *   array('peseta', 'pesetas', GExtenso::GENERO_FEM),
 *   array('c�ntimo', 'c�ntimos', GExtenso::GENERO_MASC));
 *   // tr�s mil, quinhentas e setenta pesetas e oitenta e dois c�ntimos
 * </pre>
 *
 * @author Fausto Gon�alves Cintra (goncin) <goncin@gmail.com>
 * @version 0.1 2010-03-02
 * @package GUtils
 *
 */

 class GExtenso {

  const NUM_SING = 0;
  const NUM_PLURAL = 1;
  const POS_GENERO = 2;
  const GENERO_MASC = 0;
  const GENERO_FEM = 1;

  const VALOR_MAXIMO = 999999999;

  /* Uma vez que o PHP n�o suporta constantes de classe na forma de matriz (array),
    a sa�da encontrada foi declarar as strings num�ricas como 'private static'.
  */
  
  /* As unidades 1 e 2 variam em g�nero, pelo que precisamos de dois conjuntos de strings (masculinas e femininas) para as unidades */
  private static $UNIDADES = array(
    self::GENERO_MASC => array(
      1 => 'um',
      2 => 'dois',
      3 => 'tr�s',
      4 => 'quatro',
      5 => 'cinco',
      6 => 'seis',
      7 => 'sete',
      8 => 'oito',
      9 => 'nove'
    ),
    self::GENERO_FEM => array(
      1 => 'uma',
      2 => 'duas',
      3 => 'tr�s',
      4 => 'quatro',
      5 => 'cinco',
      6 => 'seis',
      7 => 'sete',
      8 => 'oito',
      9 => 'nove'
    )
  );

  private static $DE11A19 = array(
    11 => 'onze',
    12 => 'doze',
    13 => 'treze',
    14 => 'quatorze',
    15 => 'quinze',
    16 => 'dezesseis',
    17 => 'dezessete',
    18 => 'dezoito',
    19 => 'dezenove'
  );

  private static $DEZENAS = array(
    10 => 'dez',
    20 => 'vinte',
    30 => 'trinta',
    40 => 'quarenta',
    50 => 'cinquenta',
    60 => 'sessenta',
    70 => 'setenta',
    80 => 'oitenta',
    90 => 'noventa'
  );

  private static $CENTENA_EXATA = 'cem';

  /* As centenas, com exce��o de 'cento', tamb�m variam em g�nero. Aqui tamb�m se faz
    necess�rio dois conjuntos de strings (masculinas e femininas).
  */

  private static $CENTENAS = array(
    self::GENERO_MASC => array(
      100 => 'cento',
      200 => 'duzentos',
      300 => 'trezentos',
      400 => 'quatrocentos',
      500 => 'quinhentos',
      600 => 'seiscentos',
      700 => 'setecentos',
      800 => 'oitocentos',
      900 => 'novecentos'
    ),
    self::GENERO_FEM => array(
      100 => 'cento',
      200 => 'duzentas',
      300 => 'trezentas',
      400 => 'quatrocentas',
      500 => 'quinhentas',
      600 => 'seiscentas',
      700 => 'setecentas',
      800 => 'oitocentas',
      900 => 'novecentas'
    )
  );

  /* 'Mil' � invari�vel, seja em g�nero, seja em n�mero */
  private static $MILHAR = 'mil';

  private static $MILHOES = array(
    self::NUM_SING => 'milh�o',
    self::NUM_PLURAL => 'milh�es'
  );



 /**
 * Gera a representa��o por extenso de um n�mero inteiro, maior que zero e menor ou igual a GExtenso::VALOR_MAXIMO.
 *
 * @param int O valor num�rico cujo extenso se deseja gerar
 *
 * @param int (Opcional; valor padr�o: GExtenso::GENERO_MASC) O g�nero gramatical (GExtenso::GENERO_MASC ou GExtenso::GENERO_FEM)
 * do extenso a ser gerado. Isso possibilita distinguir, por exemplo, entre 'duzentos e dois homens' e 'duzentas e duas mulheres'.
 *
 * @return string O n�mero por extenso
 *
 * @since 0.1 2010-03-02
 */
  public static function numero($valor, $genero = self::GENERO_MASC) {

    /* ----- VALIDA��O DOS PAR�METROS DE ENTRADA ---- */

    if(!is_numeric($valor))
      throw new Exception("[Exce��o em GExtenso::numero] Par�metro \$valor n�o � num�rico (recebido: '$valor')");

    else if($valor <= 0)
      throw new Exception("[Exce��o em GExtenso::numero] Par�metro \$valor igual a ou menor que zero (recebido: '$valor')");

    else if($valor > self::VALOR_MAXIMO)
      throw new Exception('[Exce��o em GExtenso::numero] Par�metro $valor deve ser um inteiro entre 1 e ' . self::VALOR_MAXIMO . " (recebido: '$valor')");

    else if($genero != self::GENERO_MASC && $genero != self::GENERO_FEM)
      throw new Exception("Exce��o em GExtenso: valor incorreto para o par�metro \$genero (recebido: '$genero').");

    /* ----------------------------------------------- */

    else if($valor >= 1 && $valor <= 9)
      return self::$UNIDADES[$genero][$valor]; // As unidades 'um' e 'dois' variam segundo o g�nero

    else if($valor == 10)
      return self::$DEZENAS[$valor];

    else if($valor >= 11 && $valor <= 19)
      return self::$DE11A19[$valor];

    else if($valor >= 20 && $valor <= 99) {
      $dezena = $valor - ($valor % 10);
      $ret = self::$DEZENAS[$dezena];
      /* Chamada recursiva � fun��o para processar $resto se este for maior que zero.
       * O conectivo 'e' � utilizado entre dezenas e unidades.
       */
      if($resto = $valor - $dezena) $ret .= ' e ' . self::numero($resto, $genero);
      return $ret;
    }

    else if($valor == 100) {
      return self::$CENTENA_EXATA;
    }

    else if($valor >= 101 && $valor <= 999) {
      $centena = $valor - ($valor % 100);
      $ret = self::$CENTENAS[$genero][$centena]; // As centenas (exceto 'cento') variam em g�nero
      /* Chamada recursiva � fun��o para processar $resto se este for maior que zero.
       * O conectivo 'e' � utilizado entre centenas e dezenas.
       */
      if($resto = $valor - $centena) $ret .= ' e ' . self::numero($resto, $genero);
      return $ret;
    }

    else if($valor >= 1000 && $valor <= 999999) {
      /* A fun��o 'floor' � utilizada para encontrar o inteiro da divis�o de $valor por 1000,
       * assim determinando a quantidade de milhares. O resultado � enviado a uma chamada recursiva
       * da fun��o. A palavra 'mil' n�o se flexiona.
       */
      $milhar = floor($valor / 1000);
      $ret = self::numero($milhar, self::GENERO_MASC) . ' ' . self::$MILHAR; // 'Mil' � do g�nero masculino
      $resto = $valor % 1000;
      /* Chamada recursiva � fun��o para processar $resto se este for maior que zero.
       * O conectivo 'e' � utilizado entre milhares e n�meros entre 1 e 99, bem como antes de centenas exatas.
       */
      if($resto && (($resto >= 1 && $resto <= 99) || $resto % 100 == 0))
        $ret .= ' e ' . self::numero($resto, $genero);
      /* Nos demais casos, ap�s o milhar � utilizada a v�rgula. */
      else if ($resto)
        $ret .= ', ' . self::numero($resto, $genero);
      return $ret;
    }

    else if($valor >= 100000 && $valor <= self::VALOR_MAXIMO) {
      /* A fun��o 'floor' � utilizada para encontrar o inteiro da divis�o de $valor por 1000000,
       * assim determinando a quantidade de milh�es. O resultado � enviado a uma chamada recursiva
       * da fun��o. A palavra 'milh�o' flexiona-se no plural.
       */
      $milhoes = floor($valor / 1000000);
      $ret = self::numero($milhoes, self::GENERO_MASC) . ' '; // Milh�o e milh�es s�o do g�nero masculino
      
      /* Se a o n�mero de milh�es for maior que 1, deve-se utilizar a forma flexionada no plural */
      $ret .= $milhoes == 1 ? self::$MILHOES[self::NUM_SING] : self::$MILHOES[self::NUM_PLURAL];

      $resto = $valor % 1000000;

      /* Chamada recursiva � fun��o para processar $resto se este for maior que zero.
       * O conectivo 'e' � utilizado entre milh�es e n�meros entre 1 e 99, bem como antes de centenas exatas.
       */
      if($resto && (($resto >= 1 && $resto <= 99) || $resto % 100 == 0))
        $ret .= ' e ' . self::numero($resto, $genero);
      /* Nos demais casos, ap�s o milh�o � utilizada a v�rgula. */
      else if ($resto)
        $ret .= ', ' . self::numero($resto, $genero);
      return $ret;
    }

  }

 /**
 * Gera a representa��o por extenso de um valor monet�rio, maior que zero e menor ou igual a GExtenso::VALOR_MAXIMO.
 *
 * @param int O valor monet�rio cujo extenso se deseja gerar.
 * ATEN��O: PARA EVITAR OS CONHECIDOS PROBLEMAS DE ARREDONDAMENTO COM N�MEROS DE PONTO FLUTUANTE, O VALOR DEVE SER PASSADO
 * J� DEVIDAMENTE MULTIPLICADO POR 10 ELEVADO A $casasDecimais (o que equivale, normalmente, a passar o valor com centavos
 * multiplicado por 100)
 *
 * @param int (Opcional; valor padr�o: 2) N�mero de casas decimais a serem consideradas como parte fracion�ria (centavos)
 *
 * @param array (Opcional; valor padr�o: array('real', 'reais', GExtenso::GENERO_MASC)) Fornece informa��es sobre a moeda a ser
 * utilizada. O primeiro valor da matriz corresponde ao nome da moeda no singular, o segundo ao nome da moeda no plural e o terceiro
 * ao g�nero gramatical do nome da moeda (GExtenso::GENERO_MASC ou GExtenso::GENERO_FEM)
 *
 * @param array (Opcional; valor padr�o: array('centavo', 'centavos', self::GENERO_MASC)) Prov� informa��es sobre a parte fracion�ria
 * da moeda. O primeiro valor da matriz corresponde ao nome da parte fracion�ria no singular, o segundo ao nome da parte fracion�ria no plural
 * e o terceiro ao g�nero gramatical da parte fracion�ria (GExtenso::GENERO_MASC ou GExtenso::GENERO_FEM)
 *
 * @return string O valor monet�rio por extenso
 *
 * @since 0.1 2010-03-02
 */
  public static function moeda(
    $valor,
    $casasDecimais = 2,
    $infoUnidade = array('real', 'reais', self::GENERO_MASC),
    $infoFracao = array('centavo', 'centavos', self::GENERO_MASC)
  ) {

    /* ----- VALIDA��O DOS PAR�METROS DE ENTRADA ---- */
    $valor = number_format($valor,$casasDecimais,'.','');
	
    if(!is_numeric($valor))
      throw new Exception("[Exce��o em GExtenso::moeda] Par�metro \$valor n�o � num�rico (recebido: '$valor')");

    else if($valor <= 0)
      throw new Exception("[Exce��o em GExtenso::moeda] Par�metro \$valor igual a ou menor que zero (recebido: '$valor')");

    else if(!is_numeric($casasDecimais) || $casasDecimais < 0)
      throw new Exception("[Exce��o em GExtenso::moeda] Par�metro \$casasDecimais n�o � num�rico ou � menor que zero (recebido: '$casasDecimais')");

    else if(!is_array($infoUnidade) || count($infoUnidade) < 3) {
      $infoUnidade = print_r($infoUnidade, true);
      throw new Exception("[Exce��o em GExtenso::moeda] Par�metro \$infoUnidade n�o � uma matriz com 3 (tr�s) elementos (recebido: '$infoUnidade')");
    }

    else if($infoUnidade[self::POS_GENERO] != self::GENERO_MASC && $infoUnidade[self::POS_GENERO] != self::GENERO_FEM)
      throw new Exception("Exce��o em GExtenso: valor incorreto para o par�metro \$infoUnidade[self::POS_GENERO] (recebido: '{$infoUnidade[self::POS_GENERO]}').");

    else if(!is_array($infoFracao) || count($infoFracao) < 3) {
      $infoFracao = print_r($infoFracao, true);
      throw new Exception("[Exce��o em GExtenso::moeda] Par�metro \$infoFracao n�o � uma matriz com 3 (tr�s) elementos (recebido: '$infoFracao')");
    }

    else if($infoFracao[self::POS_GENERO] != self::GENERO_MASC && $infoFracao[self::POS_GENERO] != self::GENERO_FEM)
      throw new Exception("Exce��o em GExtenso: valor incorreto para o par�metro \$infoFracao[self::POS_GENERO] (recebido: '{$infoFracao[self::POS_GENERO]}').");

    /* ----------------------------------------------- */

    /* A parte inteira do valor monet�rio corresponde ao $valor passado dividido por 10 elevado a $casasDecimais, desprezado o resto.
     * Assim, com o padr�o de 2 $casasDecimais, o $valor ser� dividido por 100 (10^2), e o resto � descartado utilizando-se floor().
     */
	 
	$decimal = pow(10, $casasDecimais);
	if(strpos($valor,'.')) {
		$valor = floor($valor * $decimal);
	}
	
	$parteInteira = floor($valor / $decimal);
	/* A parte fracion�ria ('centavos'), por seu turno, corresponder� ao resto da divis�o do $valor por 10 elevado a $casasDecimais.
	 * No cen�rio comum em que trabalhamos com 2 $casasDecimais, ser� o resto da divis�o do $valor por 100 (10^2).
	 */
	$fracao = $valor % $decimal;
	
    /* O extenso para a $parteInteira somente ser� gerado se esta for maior que zero. Para tanto, utilizamos
     * os pr�stimos do m�todo GExtenso::numero().
     */
    if($parteInteira) {
      $ret = self::numero($parteInteira, $infoUnidade[self::POS_GENERO]) . ' ';
      $ret .= $parteInteira == 1 ? $infoUnidade[self::NUM_SING] : $infoUnidade[self::NUM_PLURAL];
    }

    /* De forma semelhante, o extenso da $fracao somente ser� gerado se esta for maior que zero. */
    if($fracao) {
      /* Se a $parteInteira for maior que zero, o extenso para ela j� ter� sido gerado. Antes de juntar os
       * centavos, precisamos colocar o conectivo 'e'.
       */
      if ($parteInteira) $ret .= ' e ';
      $ret .= self::numero($fracao, $infoFracao[self::POS_GENERO]) . ' ';
      $ret .= $parteInteira == 1 ? $infoFracao[self::NUM_SING] : $infoFracao[self::NUM_PLURAL];
    }

    return $ret;

  }

}
?>