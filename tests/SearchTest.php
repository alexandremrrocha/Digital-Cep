<?php
    
    use PHPUnit\Framework\TestCase;
    use Alexandre\DigitalCep\Search;

    class SearchTest extends TestCase{
        
        public function testGetAddressFromZipcodeDefaultUsage(){
            
            $resultado = new Search;
            $resultado = $resultado->getAddressFromZipcode('01001000');
            $esperado  = '{
                "cep": "01001-000",
                "logradouro": "Praça da Sé",
                "complemento": "lado ímpar",
                "bairro": "Sé",
                "localidade": "São Paulo",
                "uf": "SP",
                "ibge": "3550308",
                "gia": "1004",
                "ddd": "11",
                "siafi": "7107"
              }';      
              
              $this->assertEquals(json_decode($esperado),$resultado);
            
        }
    }
?>