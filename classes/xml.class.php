<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of xml
 *
 * @author Jonatas
 */

class Xml extends XMLWriter{

    private $root;

    /**
     * Constructor.
     * @param string $root A root element's name of a current xml document
     * @param string $caminho Path of a XSLT file.
     * @access public
     * @param null
     */
    public function __construct($root = 'root', $caminho=''){
        $this->openMemory();
        $this->setIndent(true);
        $this->setIndentString(' ');
        $this->startDocument('1.0', 'UTF-8');

        if($caminho){
            $this->writePi('xml-stylesheet', 'type="text/xsl" href="'.$caminho.'"');
        }
        $this->root = $root;
        $this->startElement($root);
    }

    /**
     * Set an element with a text to a current xml document.
     * @access public
     * @param string $prm_elementName An element's name
     * @param string $prm_ElementText An element's text
     * @return null
     */
    public function setElement($prm_elementName, $prm_ElementText){
        $this->startElement($prm_elementName);
        $this->text($prm_ElementText);
        $this->endElement();
    }

    /**
     * Construct elements and texts from an array.
     * The array should contain an attribute's name in index part
     * and a attribute's text in value part.
     * @access public
     * @param array $prm_array Contains attributes and texts
     * @return null
     */
    public function fromArray($prm_array){
      if(is_array($prm_array)){
        foreach ($prm_array as $index => $element){
          if(is_array($element)){
            $this->startElement('row');
            $this->fromArray($element);
            $this->endElement();
          }
          else
            $this->setElement($index, $element);
         
        }
      }
    }

    /**
     * Return the content of a current xml document.
     * @access public
     * @param null
     * @return string Xml document
     */
    public function getDocument(){
        $this->endElement();
        $this->endDocument();
        return $this->outputMemory();
    }

    /**
     * Output the content of a current xml document.
     * @access public
     * @param null
     */
    public function output(){
        header('Content-type: text/xml');
        echo $this->getDocument();
    }
  

} 
$array = array("usuario"=>
    array(
        "nome"=>"jonatas",
        "email"=>"jonatas_m_o@hotmail.com"
    ),
    "usuario"=>
    array(
        "nome"=>"Teste",
        "email"=>"testando@hotmail.com"
    )
);
//$xml = new Xml("funcionarios");
//$xml->fromArray($array);
//$xml->output();
