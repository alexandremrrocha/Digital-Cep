<?php

    require_once "vendor/autoload.php";
    
    use Alexandre\DigitalCep\Search;

    $busca = new Search;

    $resultado = $busca->getAddressFromZipcode('03624010');

    print_r($resultado);
?>