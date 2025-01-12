<?php
// phpcs:ignore PEAR.Commenting.FunctionComment.Missing

//2

/*
⁃    Написать фабрику животных. Фабрика создает экземпляры с 
набором свойств (Царство - звери, рыбы, птицы, количество лап, хвостов, крыльев).
Нужен класс базового животного и расширенные классы для царств.
Реализуем классы “клеток” для каждого царства, в которые можно 
“поместить” или получить животное. Для клеток реализуем класс, содержащий
в себе все клетки, с методами получения или создания ну жной клетки для царства.
Далее реализуем класс “смотрителя зоопарка”, который может поместить 
созданное животное в нужную клетку, а также выбрать животное из нужной 
клетки по набору базовых признаков. Также нужно реализовать класс “менеджер”, 
который будет получать из фабрики экземпляр, и отдавать “смотрителю”.
*/
#[AllowDynamicProperties]
// phpcs:ignore PEAR.Commenting.ClassComment.WrongStyle

class Animal //phpcs:ignore PEAR.Commenting.ClassComment.WrongStyle
{
        
    private static $_count_animals = 0;


    public function __construct(
        public string $species, 
        public int $count_of_tail,
        public int $count_of_wings 
    ) {
        self::$_count_animals++;
    }

    public static function getCount() : int
    {
        return self::$_count_animals;
    }

    public function __destruct()
    {
        self::$_count_animals--;
    }

    public function __toString()
    {
        return "$this->species" . "$this->count_of_tail" . "$this->count_of_wings";
    }
    public function iterateVisible()
    {

        $in_arr = [];
        foreach ($this as $key => $value) {
            array_push($in_arr, $value);
        }
        return (implode($in_arr));
    }

    public  function getSpecies()
    {
        echo $this->species;
    }
}


class Beasts extends Animal
{
    public function __construct(string $species,int $count_of_legs , int $count_of_tail, $count_of_wings)
    {
        parent::__construct(
            $species, 
            $count_of_tail,
            $count_of_wings
        );
        $this->count_of_legs = $count_of_legs;
    }
        
}    

class Fishes extends Animal
{
}

class Birds extends Animal
{
    public function __construct(string $species,int $count_of_legs , int $count_of_tail, $count_of_wings)
    {
        parent::__construct(
            $species, 
            $count_of_tail,
            $count_of_wings
        );
        $this->count_of_legs = $count_of_legs;
    }
}

class CageStatus
{
    const EMPTY = 0;
    const FULL = 1;
    const HALF = 2;
}

class Cage
{
    protected int $capacity = 0;
    protected int $max_capacity = 3;
    public $status = CageStatus::EMPTY;
    public static $arr = [];
    public static int $cages_index = 0;

    function __construct(Animal $animal)
    {
        self::$arr[] = $animal;
    }

    public function ifFull()
    {
        return $this->status == CageStatus::FULL;
    }

    public function ifHalf()
    {
        return $this->status == CageStatus::HALF;
    }

    public static function getOneAnimalCageByName(string $name) : mixed
    {

        $arrExistAnimal = array_map( 
            function ($animal) {
                foreach($animal as $value) {
                    return ($value);
                };
            }, self::$arr
        );

        return  array_filter($arrExistAnimal, fn($value) => $value == $name);
    }

    public static function getAllAnimalCage(): array
    {
        return (self::$arr);
    }
}

class Beast_Cage extends Cage
{
    public array $beast_cage = [];
    public int $cage_index;
    
    function __construct( public Beasts|Birds $animal)
    {
        $this->animal = $animal;
        $this->beast_cage[] = $this->animal;
        $this->status = CageStatus::HALF;
        $this->capacity++;  
        $this->cage_index = self::$cages_index;
        self::$cages_index++;
    }

    public function status()
    {
        echo "<pre>";
        echo "status: $this->status";
        echo " capacity: $this->capacity" . PHP_EOL;
        echo " index: $this->cage_index" . PHP_EOL;
        print_r($this->beast_cage);
        echo "</pre>";
    }

    public function addAnimalInBeastCage(Beasts|Birds $animal)
    {

        if ($this->capacity < $this->max_capacity) {
            $this->capacity++;
            $animal && $this->beast_cage[] = $animal;
        }
        
        if ($this->capacity == $this->max_capacity) {
            $this->status = CageStatus::FULL;
            echo "Cage $this->cage_index is Full";
        } 
    }
}


class Fish_Cage extends Cage
{
    protected $fish_cage = [];

    function __construct( public Fishes $fish)
    {   
        self::$arr[] = $this->fish_cage;

    }
}

class Bird_Cage extends Cage
{
    protected $bird_cage = [];

    function __construct( public Birds $bird)
    {
        self::$arr[] = $this->bird_cage;

    }
}


class Zookeeper
{
    public $beast_cage = null;
    function __construct()
    {
    }
    public function moveAnimalInCage(Animal $animal)
    {
        
        if ($this->beast_cage == null) {
            $this->beast_cage = new Beast_Cage($animal);
            Cage::$arr[$this->beast_cage->cage_index] = $this->beast_cage;
        } else {
            $this->beast_cage->addAnimalInBeastCage($animal);
            Cage::$arr[$this->beast_cage->cage_index] = $this->beast_cage;
        }

        if ($this->beast_cage->status == CageStatus::FULL) {
            Cage::$arr[$this->beast_cage->cage_index] = $this->beast_cage;
            $this->beast_cage = null;

        }

        //  echo '<pre>';   
        //     print_r($this->beast_cage);
        //     echo '</pre>';

    }

    // function selectAnimalInCage($base_params)
    // {
    //     $base_params->iterateVisible();
    //     $arrExistAnimal = [];
    //     foreach(Cage::$arr as $one_animal) {
    //         foreach($one_animal as $animal) {
    //             (array_push($arrExistAnimal, $animal));
    //         }
    //     }
    //     $chanked_array = array_chunk($arrExistAnimal, 4);
    //     $to_string_array_animal = array_map(fn($arr) => implode($arr), $chanked_array);

    //     foreach ($to_string_array_animal as $item) {
    //         if ($base_params == $item) {
    //             echo '<pre>';
    //             echo "Выбрано животное: " . "$item";
    //             echo '</pre>';
    //         } 
    //     }
    // }    
}

class Manager
{

    public function getInstanceZookeper(Animal $instance, Zookeeper $zookeper)
    {
        $zookeper ->moveAnimalInCage($instance);
    }
}

$lion = new Beasts('лев', 4, 1, 0);
$volk = new Beasts('volk', 4, 1, 0);
$puma = new Beasts('пума', 4, 1, 0);
$vorona = new Birds('vorona', 2, 1, 2);
$sova = new Birds('sova', 2, 1, 2);
$golub = new Birds('голубь', 2, 1, 2);
$fish = new Fishes('лещ', 1, 0);
$bird = new Birds('голубь', 2, 1, 2);

$zookeeper = new Zookeeper();
$manager = new Manager();

$zookeeper->moveAnimalInCage($lion);
$zookeeper->moveAnimalInCage($volk);
$zookeeper->moveAnimalInCage($puma);
$zookeeper->moveAnimalInCage($vorona);
$zookeeper->moveAnimalInCage($sova);
$zookeeper->moveAnimalInCage($golub);
$zookeeper->moveAnimalInCage($puma);



// $zookeeper->selectAnimalInCage(new Animal('ле', 4, 1, 0));

// $manager->getInstanceZookeper($puma, $zookeeper);


echo '</br>';
echo 'Животное в клетке по Имени';
echo '<pre>';
// print_r(Cage::getOneAnimalCageByName('голубь'));
echo '</pre>';

echo 'Все животные в клетках';
echo '<pre>';
print_r(Cage::getAllAnimalCage());
echo '</pre>';





?>