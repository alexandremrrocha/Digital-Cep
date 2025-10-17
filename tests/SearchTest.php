<?php

use PHPUnit\Framework\TestCase;
use Alexandre\DigitalCep\Search;

class SearchTest extends TestCase
{
    public function testGetAddressFromZipcodeDefaultUsage()
    {
        $search = new Search();
        $resultado = $search->getAddressFromZipcode('01001-000');

        $this->assertTrue(is_object($resultado));
        $this->assertObjectHasAttribute('cep', $resultado);
        $this->assertEquals('01001-000', $resultado->cep);
        $this->assertObjectHasAttribute('uf', $resultado);
        $this->assertEquals('SP', $resultado->uf);
        // ViaCEP não retorna a chave "erro" quando encontra o CEP
        $this->assertFalse(isset($resultado->erro) && $resultado->erro === true);
    }

    public function testGetAddressFromZipcodeInvalidCep()
    {
        $search = new Search();
        $resultado = $search->getAddressFromZipcode('abc'); // inválido, não tem 8 dígitos

        $this->assertTrue(is_object($resultado));
        $this->assertTrue(isset($resultado->erro) && $resultado->erro === true);
    }
}
?>

