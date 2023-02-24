# array-collection

A classe Collection é uma implementação de um tipo de coleção, onde é possível adicionar, filtrar e mapear elementos, além de concatenar com outras coleções. Ela é construída com um gerador que pode ser criado a partir de um array iterável ou uma função geradora.

Já a classe Arr é uma classe de utilitários para trabalhar com arrays. Ela contém métodos estáticos para busca de valores em arrays, verificar se um array associativo está vazio, verificar se um valor está presente em um array, combinar arrays e manipular chaves e valores de um array. Ela estende a classe Collection e por isso herda os métodos de adição, filtro e mapeamento.

The Collection class has the following methods:

fromIterable: creates a new instance of Collection from an iterable.
fromGenerator: creates a new instance of Collection from a generator function.
getIterator: returns an iterator for the current instance.
add: adds new items to the collection.
append: appends iterables to the collection.
map: applies a callback function to each item in the collection and returns a new instance of Collection.
filter: filters the items in the collection using a callback function and returns a new instance of Collection.
toArray: returns an array representation of the collection.
The Arr class has the following additional methods:

searchInArray: searches a multidimensional array using dot notation and returns the value of the key.
isEmptyAssoc: checks if an associative array is empty.
valueInArray: checks if a value exists in an array.
arrayKeysValues: removes all falsey values from an array and returns an array with only the truthy values and their keys.
combine: creates an associative array from two arrays, where the first array is the keys and the second array is the values.
set: sets a key-value pair in an array.
get: gets the value of a key in an array.
keyInArray: checks if a key exists in an array.


use omegaalfa\Collection;
use omegaalfa\Arr;

// Criando uma coleção a partir de um array
$collection = Collection::fromIterable([1, 2, 3, 4, 5]);
print_r($collection); // Output: Collection Object ( [items:protected] => Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 ) )

// Adicionando itens à coleção
$collection = $collection->add(6, 7, 8);
print_r($collection); // Output: Collection Object ( [items:protected] => Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 6 [6] => 7 [7] => 8 ) )

// Filtrando a coleção para conter apenas os números ímpares
$oddNumbers = $collection->filter(static fn($val) => $val % 2 !== 0);
print_r($oddNumbers); // Output: Collection Object ( [items:protected] => Array ( [0] => 1 [2] => 3 [4] => 5 [5] => 6 [6] => 7 [7] => 8 ) )

// Mapeando cada número para seu dobro
$doubledNumbers = $collection->map(static fn($val) => $val * 2);
print_r($doubledNumbers); // Output: Collection Object ( [items:protected] => Array ( [0] => 2 [1] => 4 [2] => 6 [3] => 8 [4] => 10 [5] => 12 [6] => 14 [7] => 16 ) )

// Obtendo a representação em array da coleção
$array = $collection->toArray();
print_r($array); // Output: Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 6 [6] => 7 [7] => 8 )

// Pesquisando um valor em um array multidimensional
$array = ['foo' => ['bar' => ['baz' => 42]]];
$value = Arr::searchInArray($array, 'foo.bar.baz');
echo $value; // Output: 42

// Verificando se um array associativo está vazio
$empty = Arr::isEmptyAssoc([]);
var_dump($empty); // Output: bool(true)

// Verificando se um valor está presente em um array
$inArray = Arr::valueInArray([1, 2, 3], 2);
var_dump($inArray); // Output: bool(true)

// Obtendo um subconjunto de um array com base em chaves
$subArray = Arr::arrayKeysValues(['foo' => 'bar', 'baz' => null]);
print_r($subArray); // Output: Array ( [foo] => bar )

// Combinando um array de chaves com um array de valores
$combinedArray = Arr::combine(['foo', 'bar', 'baz'], [1, 2, 3]);
print_r($combinedArray); // Output: Array ( [foo] =>
