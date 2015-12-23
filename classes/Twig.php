<?php 

require_once('/Twig/lib/Twig/Autoloader.php');

class Printer {

    private $data, $twig, $loader, $target;

    function __construct($data = []){
        Twig_Autoloader::register();
        $this->loader = new Twig_Loader_Filesystem('templates/');
        $this->twig = new Twig_Environment($this->loader);
        $this->data = $data;
    }

    function render($target='index.php'){
        return $this->twig->render($target, $this->data);
    }
}