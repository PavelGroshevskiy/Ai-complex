<?php
declare (strict_types=1);
require_once 'second_task.php';

/*2. Классы, объекты.
Понятия ООП, свойства, методы.
Расширение классов, принципы и особенности наследования в php, модификаторы доступа.
PHP. Основы ООП: поля и константы.
PHP. Основы ООП: конструктор и деструктор.
PHP: сериализация и десериализация данных.
Интерфейсы.
Статические поля и вызовы, объекты.
Магические методы.
Примеси.
Лямбда функции и замыкания.
Хэши, алгоритмы хэширования. Зачем нужны новые и какие недостатки у старых.
http://php.net/manual/ru/language.oop5.php
http://php.net/manual/ru/language.namespaces.php

Задания для самостоятельной проверки пройденного:
    ⁃    Написать класс, реализующий вывод текста, 
    написать наследников (вывод на принтер (образно), вывод на экран), 
    реализовать методы для вывода текста, использовать свойства классов.


*/


//1 ---------------------------------------------------------------------------------/ 

class PrintSomething
{
    public static function print($obj)
    {
        print_r($obj);
    }
}

PrintSomething::print(
    new class {
        public $text;
        public function __construct()
        {
            return $this->text = 'Anonim';
        }
    }
);

class PrintText
{
    function __construct()
    {
        
    }
    public function print($args)
    {
        var_dump($args);
    }
}

class Print_On_Screen extends PrintText
{
    function __construct()
    {
        
    }
}



$var1 = new PrintText();
// echo '<pre>';
// echo $var1->print('te');
// echo '</pre>';

$screen = new Print_On_Screen;
// $screen->print('Print on screen');


?>
