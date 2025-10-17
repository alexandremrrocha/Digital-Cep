# Digital CEP — Biblioteca de busca de CEP (PHP)

Biblioteca em PHP para consulta de CEPs brasileiros usando a API pública do ViaCEP.

## Requisitos

- PHP >= 7.2
- Composer
- Extensão/config `allow_url_fopen` habilitada (para `file_get_contents`)
- Acesso à internet (requisições ao ViaCEP)

## Instalação

- Packagist:
  - `composer require alexandremrrocha/digital-cep`
- Local/clone do repositório:
  1. Clone este repositório
  2. Rode `composer install`
  3. Inclua o autoloader do Composer no seu projeto (`require_once 'vendor/autoload.php';`)

## Uso básico

Exemplo mínimo (veja também `exemplo.php`):

```php
<?php
require_once 'vendor/autoload.php';

use Alexandre\DigitalCep\Search;

$busca = new Search();

// Aceita CEP com ou sem hífen; prefira 8 dígitos
$resultado = $busca->getAddressFromZipcode('01001000');

if (isset($resultado->erro) && $resultado->erro === true) {
    echo 'CEP não encontrado.';
} else {
    echo $resultado->logradouro . ', ' . $resultado->bairro . ' - '
        . $resultado->localidade . '/' . $resultado->uf;
}
```

Resposta típica do ViaCEP:

```json
{
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
}
```

## Detalhes de implementação

- Endpoint utilizado: `https://viacep.com.br/ws/{CEP}/json`
- Método principal: `Alexandre\DigitalCep\Search::getAddressFromZipcode(string $zipCode): object`
- Retorno: objeto (resultante do `json_decode`) com os campos do ViaCEP; verifique a propriedade `erro` para CEPs inválidos

## Testes

1. Instale as dependências de desenvolvimento: `composer install`
2. Execute: `vendor/bin/phpunit`

Observação: os testes realizam chamadas reais ao ViaCEP (necessário acesso à internet).

## Licença

Este projeto está licenciado sob a licença MIT. Consulte `LICENSE` para mais detalhes.

## Créditos

- Dados de CEP: [ViaCEP](https://viacep.com.br)


