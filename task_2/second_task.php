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
    public function __construct(string $species , int $count_of_tail, $count_of_wings, int $count_of_legs = 0)
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

abstract class FactoryAbstract
{
    public function create($type, ...$params)
    {
        switch ($type) {
            case 'Beast':
                return new Beasts(...$params);
            case 'Fish':
                return new Fishes(...$params);
            case 'Bird':
                return new Birds(...$params);
            default:
            return null;
        }
    }
}

class Factory extends FactoryAbstract
{
}

$factory = new Factory();
$factory->create('Beast', 'bear', 1, 0, 4);
$factory->create('Fish', 'som', 1, 0, 4);




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

    public function getArr() 
    {
        return $this->beast_cage;
    }

    public function addAnimalInBeastCage(Beasts|Birds $animal)
    {

        if ($this->capacity < $this->max_capacity) {
            $this->capacity++;
            $animal && $this->beast_cage[] = $animal;
        }
        
        if ($this->capacity == $this->max_capacity) {
            $this->status = CageStatus::FULL;
            echo "Cage $this->cage_index is Full; " . PHP_EOL;
        } 
    }
}

class Fish_Cage extends Cage
{
    protected $fish_cage = [];
    public int $cage_index;
    
    function __construct( public Fishes $animal)
    {
        $this->animal = $animal;
        $this->fish_cage[] = $this->animal;
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
        print_r($this->fish_cage);
        echo "</pre>";
    }

     public function getArr() 
    {
        return $this->fish_cage;
    }

    public function addAnimalInFishCage(Fishes $animal)
    {

        if ($this->capacity < $this->max_capacity) {
            $this->capacity++;
            $animal && $this->fish_cage[] = $animal;
        }
        
        if ($this->capacity == $this->max_capacity) {
            $this->status = CageStatus::FULL;
            echo "Cage $this->cage_index is Full; " . PHP_EOL;
        } 
    }
}

class Bird_Cage extends Cage
{
    protected $bird_cage = [];
    public int $cage_index;
    
    function __construct( public Beasts|Birds $animal)
    {
        $this->animal = $animal;
        $this->bird_cage[] = $this->animal;
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
        print_r($this->bird_cage);
        echo "</pre>";
    }

    public function getArr() 
    {
        return $this->bird_cage;
    }

    public function addAnimalInBirdCage(Beasts|Birds $animal)
    {

        if ($this->capacity < $this->max_capacity) {
            $this->capacity++;
            $animal && $this->bird_cage[] = $animal;
        }
        
        if ($this->capacity == $this->max_capacity) {
            $this->status = CageStatus::FULL;
            echo "Cage $this->cage_index is Full; " . PHP_EOL;
        } 
    }
}

class Zookeeper
{
    public $beast_cage = null;
    public $fish_cage = null;
    public $bird_cage = null;
    function __construct()
    {
    }

    // public function moveAnimalByClass($animalCage,$animal)
    // {
    //     if ($animalCage == null) {
    //             $animalCage = new Beast_Cage($animal);
    //             Cage::$arr[$animalCage->cage_index] = $animalCage;
    //     } else {
    //         $animalCage->addAnimalInBeastCage($animal);
    //         Cage::$arr[$animalCage->cage_index] = $animalCage;
    //     }

    //     if ($animalCage->status == CageStatus::FULL) {
    //         Cage::$arr[$animalCage->cage_index] = $animalCage;
    //         $animalCage = null;
    //     }
    // }

    public function moveAnimalInCage(Animal $animal)
    {
        switch(get_class($animal)) {
        case 'Beasts':
            // $this->moveAnimalByClass($this->beast_cage, $animal);
            if ($this->beast_cage == null) {
                $this->beast_cage = new Beast_Cage($animal);
                Cage::$arr[$this->beast_cage->cage_index] = $this->beast_cage->getArr();
            } else {
                $this->beast_cage->addAnimalInBeastCage($animal);
                Cage::$arr[$this->beast_cage->cage_index] = $this->beast_cage->getArr();
            }
            if ($this->beast_cage->status == CageStatus::FULL) {
                Cage::$arr[$this->beast_cage->cage_index] = $this->beast_cage->getArr();
                $this->beast_cage = null;

            }
            break;
        case 'Fishes':
            if ($this->fish_cage == null) {
                $this->fish_cage = new Fish_Cage($animal);
                Cage::$arr[$this->fish_cage->cage_index] = $this->fish_cage->getArr();
            } else {
                $this->fish_cage->addAnimalInFishCage($animal);
                Cage::$arr[$this->fish_cage->cage_index] = $this->fish_cage->getArr();
            }

            if ($this->fish_cage->status == CageStatus::FULL) {
                Cage::$arr[$this->fish_cage->cage_index] = $this->fish_cage->getArr();
                $this->fish_cage = null;
            }   
            break;
        case 'Birds' :
            if ($this->bird_cage == null) {
                $this->bird_cage = new Bird_Cage($animal);
                Cage::$arr[$this->bird_cage->cage_index] = $this->bird_cage->getArr();

            } else {
                $this->bird_cage->addAnimalInBirdCage($animal);
                Cage::$arr[$this->bird_cage->cage_index] = $this->bird_cage->getArr();

            }
            if ($this->bird_cage->status == CageStatus::FULL) {
                Cage::$arr[$this->bird_cage->cage_index] = $this->bird_cage->getArr();
                $this->bird_cage = null;
            } 
            break;  
            
        }
    }

    function selectAnimalInCage($base_params)
    {
        $arrExistAnimal = [];
        foreach (Cage::$arr as $one_cage_animal) {
            foreach ($one_cage_animal as $animal) {
                foreach ($animal as $params) {
                    (array_push($arrExistAnimal, $params));
                }
            }
        }

        $chanked_array = array_chunk($arrExistAnimal, 4);
        $to_string_array_animal = array_map(fn($arr) => implode($arr), $chanked_array);
        foreach ($to_string_array_animal as $item) {
            if ($base_params->iterateVisible() == $item) {
                echo '<pre>';
                echo "Выбрано животное: " . "$item";
                echo '</pre>';
            } 
        }
    }    
}

class Manager
{

    public function getInstanceZookeper(Animal $instance, Zookeeper $zookeper)
    {
        $zookeper ->moveAnimalInCage($instance);
    }
}

$lion = new Beasts('lion', 1, 0, 4);
$volk = new Beasts('volk', 1, 0, 4);
$puma = new Beasts('puma', 1, 0, 4);
$vorona = new Birds('vorona', 2, 1, 2);
$sova = new Birds('sova', 2, 1, 2);
$golub = new Birds('golub', 2, 1, 2);
$bird = new Birds('bird', 2, 1, 2);
$lesch = new Fishes('lesch', 1, 0);

$zookeeper = new Zookeeper();
$manager = new Manager();

$zookeeper->moveAnimalInCage($lion);
$zookeeper->moveAnimalInCage($volk);
$zookeeper->moveAnimalInCage($puma);
$zookeeper->moveAnimalInCage($vorona);
$zookeeper->moveAnimalInCage($sova);
$zookeeper->moveAnimalInCage($golub);
$zookeeper->moveAnimalInCage($puma);
$zookeeper->moveAnimalInCage($lesch);

$zookeeper->selectAnimalInCage($factory->create('Beast', 'lion', 1, 0, 4));
$zookeeper->selectAnimalInCage($factory->create('Fish', 'lesch', 1, 0));
$zookeeper->selectAnimalInCage($factory->create('Bird', 'vorona', 2, 1, 2));

$manager->getInstanceZookeper($puma, $zookeeper);
$manager->getInstanceZookeper($lesch, $zookeeper);
$manager->getInstanceZookeper($vorona, $zookeeper);


echo '<pre>';
echo 'Все животные в клетках';
echo '<pre>';
print_r(Cage::getAllAnimalCage());
echo '</pre>';


?>