<?php

/*
 * classe ELEMENTO
 * classe para abastração de tags html
 */

/**
 * Description of elemento
 *
 * @author Jonatas
 */
class html {
    private   $name;        // nome da tag
    private   $properties;  // propriedades da tag
    protected $children;    // array de elementos filhos

        /**
    * método construtor
    * instancia uma tag html
    * @param $name = nome da tag
    */
   public function __construct($name) {
       // define o nome do elemento
       $this->name = $name;
   }
   /**
    * método __set()
    * intercepta as atribuições à propriedades do objeto
    * @param $name  = nome da propriedade
    * @param $value = valor
    */
   public function __set($name, $value) {
       // armazena os valores atribuidos
       // ao array properties
       $this->properties[$name] = $value;
   }
   /**
    * método add()
    * adiciona um elemento filho
    * @param $child  = objeto filho
    */
   public function add($child) {
       $this->children[] = $child;
   }
    /**
    * método open()
    * exibe a tag de abertura na tela
    */
   private function open() {
       // exibe a tag de abertura
       echo "<{$this->name}";
       if($this->properties){
           // percorre as propriedades
           foreach ($this->properties as $name => $value) {
               echo " {$name}=\"{$value}\"";
           }
       }
       echo '>';
   }
   
   /**
    * método show()
    * exibe a tag na tela, juntamente com seu conteudo
    */
    public function show(){
       // abre tag
       $this->open();
       echo "\n";

       //se possuir conteudo
       if($this->children){
           //percorre todos objetos filhos
           foreach ($this->children as $child) {
               // se for objeto
               if(is_object($child)){
                   $child->show();
               }else if(is_string($child) or is_numeric($child)){
                   // se for texto
                   echo $child."\n";
               }
           }
           // fecha tag
           $this->close();
           echo "\n";
       }
    }
    
    /**
    * método close()
    * Fecha uma tag HTML
    */
   private function close() {
       echo "</{$this->name}>\n";
   }
   
}



