<?php
declare (strict_types=1);

/*
1. Основы.
Запуск php-скриптов, в консоли и в браузере.
Типы данных, переменные, преобразования типов.
Время жизни и видимость переменных
Работа с массивами, работа со строками, циклы, условия.
http://php.net/manual/ru/language.types.php
http://php.net/manual/ru/language.variables.php
http://php.net/manual/ru/language.control-structures.php
Функции и константы
Работа с датой и временем
Код-стандарт, PEAR standard, PSR.
https://pear.php.net/manual/en/standards.php
Git. https://proglib.io/p/git-for-half-an-hour 

Задания для самостоятельной проверки пройденного:
    ⁃    Разобрать заданный массив строк [...String...]. Если элемент содержит заданную подстроку $subString, кладем в массив A, если не содержит - в массив B. Вывести итоговые массивы. 
    Предложить варианты решения.
    ⁃    Реализовать алгоритм сортировки массива.
    ⁃    Программист придумал, как по никнейму определить пол собеседника. Вот его метод: если количество различных символов в имени пользователя нечетное, 
    тогда пользователь мужского пола, 
    иначе — женского. Вам дана строка, обозначающая имя пользователя, помогите нашему герою определить по ней пол пользователя по описанному методу.В 
    переменную запишите строку, состоящую из 
    случайных строчных букв латинского алфавита — имя пользователя, случайной длины от 10 до 100 букв. Напишите алгоритм определения пола по заданному правилу. Если пользователь оказался женского
пола по методу нашего героя, выведите “Girl!” (без кавычек), иначе, выведите «Boy!».

*/
//Helpers

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output)) {
        $output = implode(',', $output);
    }

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}



    // ⁃    Разобрать заданный массив строк [...String...]. Если элемент содержит заданную подстроку $subString, кладем в массив A, 
    // если не содержит - в массив B. Вывести итоговые массивы. Предложить варианты решения.




// В тупую перебором
echo "</bk></br> Разбор строки \n";

$array = array('str1asdd','abc', 'efdsddsds');
$sub_string = 'eas';
$array_a = [];
$array_b = [];


foreach ($array as $i => $value) {

    if (substr_compare($array[$i], $sub_string, 1, strlen($sub_string), true) === 1) {
        $array_a[] = $array[$i];
    } else {
        $array_b[] = $array[$i];
    };
    
}
// print_r( [$array_a, $array_b]).PHP_EOL;

// Функционально

function contain_substring($array, $subString)
{
    $startWordPosition = 1;
    $array_a = [];
    $array_b = [];

    foreach ($array as $i => $value) {
        if (substr_compare($array[$i], $subString, $startWordPosition, strlen($subString), true) === 1) {
            $array_a[] = $array[$i];
            if(strlen($subString) > strlen($array[$i])) {
                echo "Подстрока больше чем сама строка";
                return;
            };
        } else {
            $array_b[] = $array[$i];
            if(strlen($subString) > strlen($array[$i])) {
                echo '<pre>';
                echo "Подстрока больше чем сама строка";
                echo '</pre>';

                return;
            };
        };
    
    }
    echo '<pre>';
    var_dump($array_a);
    echo '</pre>';
    echo '<pre>';
    var_dump($array_b);
    echo '</pre>';
    echo '<p></p>';

};

contain_substring($array, $sub_string);

    // ⁃    Реализовать алгоритм сортировки массива.

echo "Aлгоритм сортировки массива </br>";

$array_num = [43,22,34,123,4];
$array_abc = ['c','d','a','b','e'];
$array_word = ['first','second','third','four','fives'];



function array_sort(&$array)
{
    for ($i=0; $i < count($array); $i++)
    {
        for ($j=($i+1); $j < count($array); $j++)
        {
            if ($array[$i] > $array[$j]) {
                // $c = $array[$i];
                // $array[$i] = $array[$j];
                // $array[$j] = $c;
                [$array[$i],$array[$j]] = [$array[$j],$array[$i]] ;
            }
        }
    }
}

array_sort($array_num);

echo '<pre>';
print_r($array_num);
echo '</pre>';



// ⁃    Программист придумал, как по никнейму определить пол собеседника. Вот его метод: если количество различных символов в имени пользователя нечетное, 
//     тогда пользователь мужского пола, 
//     иначе — женского. Вам дана строка, обозначающая имя пользователя, помогите нашему герою определить по ней пол пользователя по описанному методу.В 
//     переменную запишите строку, состоящую из 
//     случайных строчных букв латинского алфавита — имя пользователя, случайной длины от 10 до 100 букв. Напишите алгоритм определения пола по заданному правилу. Если пользователь оказался женского
// пола по методу нашего героя, выведите “Girl!” (без кавычек), иначе, выведите «Boy!».

echo " пол собеседника по никнейму </br>";

$nickname = "  Bill   " ;

function isEven($num)
{
    return boolval($num % 2 == 0);
};

function unicName(string $name):string
{ 
    $arrOfLetters = str_split($name);
    $arrUnicLetters = implode('', array_keys(array_count_values($arrOfLetters)));

    return($arrUnicLetters);

};

function genderByNickname($nickname)
{
    $nickname_trimmed = trim($nickname, " ");
    unicName($nickname_trimmed);
    $nickname_length = iconv_strlen($nickname_trimmed);
    if(empty($nickname_trimmed)) {
        echo '<pre>';
        echo "Введите имя";
        echo '</pre>';
        return;
    }
    if (isEven($nickname_length)) {
        echo '<pre>';
        echo "Girl!";
        echo '</pre>';
    } else {
        echo '<pre>';
        echo "Boy!";
        echo '</pre>';
    };
};



genderByNickname($nickname)
?>
