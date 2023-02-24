# array-collection

A classe Collection é uma implementação de um tipo de coleção, onde é possível adicionar, filtrar e mapear elementos, além de concatenar com outras coleções. Ela é construída com um gerador que pode ser criado a partir de um array iterável ou uma função geradora.

Já a classe Arr é uma classe de utilitários para trabalhar com arrays. Ela contém métodos estáticos para busca de valores em arrays, verificar se um array associativo está vazio, verificar se um valor está presente em um array, combinar arrays e manipular chaves e valores de um array. Ela estende a classe Collection e por isso herda os métodos de adição, filtro e mapeamento.

### Collection Class

A classe Collection tem os seguintes métodos:

- `fromIterable`: cria uma nova instância de Collection a partir de um iterável.
- `fromGenerator`: cria uma nova instância de Collection a partir de uma função geradora.
- `getIterator`: retorna um iterador para a instância atual.
- `add`: adiciona novos itens à coleção.
- `append`: anexa iteráveis à coleção.
- `map`: aplica uma função de retorno de chamada a cada item na coleção e retorna uma nova instância de Collection.
- `filter`: filtra os itens na coleção usando uma função de retorno de chamada e retorna uma nova instância de Collection.
- `toArray`: retorna uma representação de array da coleção.

Você pode utilizar esses métodos da seguinte forma:

```php
use omegaalfa\Collection;

// Criando uma coleção a partir de um array
$collection = Collection::fromIterable([1, 2, 3, 4, 5]);
print_r($collection);

// Adicionando itens à coleção
$collection = $collection->add(6, 7, 8);
print_r($collection);

// Filtrando a coleção para conter apenas os números ímpares
$oddNumbers = $collection->filter(static fn($val) => $val % 2 !== 0);
print_r($oddNumbers);

// Mapeando cada número para seu dobro
$doubledNumbers = $collection->map(static fn($val) => $val * 2);
print_r($doubledNumbers);

// Obtendo a representação em array da coleção
$array = $collection->toArray();
print_r($array);
```





### Arr Class

A classe Arr tem os seguintes métodos adicionais:

- `searchInArray`: pesquisa em um array multidimensional usando notação de ponto e retorna o valor da chave.
- `isEmptyAssoc`: verifica se um array associativo está vazio.
- `valueInArray`: verifica se um valor existe em um array.
- `arrayKeysValues`: remove todos os valores falsey de um array e retorna um array apenas com os valores truthy e suas chaves.
- `combine`: cria um array associativo a partir de dois arrays, em que o primeiro array é as chaves e o segundo array é os valores.
- `set`: define um par de chave-valor em um array.
- `get`: obtém o valor de uma chave em um array.
- `keyInArray`: verifica se uma chave existe em um array.

Você pode utilizar esses métodos da seguinte forma:

```php
use omegaalfa\Arr;

// Criando um array multidimensional
$data = [
    'pessoas' => [
        'pessoa1' => [
            'nome' => 'João',
            'idade' => 30,
        ],
        'pessoa2' => [
            'nome' => 'Maria',
            'idade' => 25,
        ],
        'pessoa3' => [
            'nome' => 'Pedro',
            'idade' => 40,
        ],
    ],
];

// Pesquisando um valor em um array multidimensional
$searchResult = Arr::searchInArray($data, 'pessoas.pessoa1.nome');
echo $searchResult . PHP_EOL;

// Verificando se um array associativo está vazio
$isAssocArrayEmpty = Arr::isEmptyAssoc($data);
var_dump($isAssocArrayEmpty);

// Verificando se um valor existe em um array
$valueExists = Arr::valueInArray($data, 'Maria');
var_dump($valueExists);

// Removendo valores falsey de um array e retornando um array apenas com os valores truthy e suas chaves
$cleanArray = Arr::arrayKeysValues([false, 0, '', null, 'foo' => 'bar']);
print_r($cleanArray);

// Criando um array associativo a partir de dois arrays, em que o primeiro array é as chaves e o segundo array é os valores
$keys = ['foo', 'bar', 'baz'];
$values = [1, 2, 3];
$assocArray = Arr::combine($keys, $values);
print_r($assocArray);

// Definindo um par de chave-valor em um array
$array = ['foo' => 'bar'];
Arr::set($array, 'baz', 'qux');
print_r($array);

// Obtendo o valor de uma chave em um array
$value = Arr::get($array, 'foo');
echo $value . PHP_EOL;

// Verificando se uma chave existe em um array
$keyExists = Arr::keyInArray($array, 'baz');
var_dump($keyExists);
```
