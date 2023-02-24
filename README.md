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
