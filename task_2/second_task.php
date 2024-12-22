<?php
//2


/*
⁃	Написать фабрику животных. Фабрика создает экземпляры с 
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

class Animal {

		private static $count_animals = 0;

    function __construct(public string $species,
												public int $count_of_legs = 2, 
												public int $count_of_tail = 1,
												public int $count_of_wings = 0)
    {

				self::$count_animals++;
    }

		public static function getCount() : int
    {
        return self::$count_animals;
    }

		public function __destruct()
    {
        self::$count_animals--;
    }

		public function __toString()
		{
			return "$this->species" . "$this->count_of_legs" . "$this->count_of_tail" . "$this->count_of_wings";
		}
		public function iterateVisible() {

			$in_arr = [];
      foreach ($this as $key => $value) {
          array_push($in_arr,$value);
				}
				return (implode($in_arr));
    }

		public  function getSpecies () {
			echo $this->species;
		}
}


class Beasts extends Animal{}
class Fishes extends Animal{}
class Birds extends Animal{}

class Beast_Cage {
	function __construct( public Cage $species) {}
}

class Fish_Cage {
	function __construct( public Cage $species) {}
}

class Bird_Cage {
	function __construct( public Cage $species) {}
}

class Cage {

		public static $arr = [];

    function __construct(Animal $animal){
			self::$arr[] = $animal;
		}

		public static function getOneAnimalCageByName(string $name) : mixed {

			$arrExistAnimal = array_map( 
				function  ($animal) {
				foreach($animal as $value) {
					return ($value);
				};
			}, self::$arr);

			return  array_filter($arrExistAnimal, fn($value) => $value == $name ) ;
		}

		public static function getAllAnimalCage(): array {
			return (self::$arr);
		}
}

class Zookeeper {
		public $cage;
    function __construct( ){}

		public function moveAnimalInCage(Animal $animal ) {
			if (get_class($animal) === 'Beasts') return new Beast_Cage(new Cage($animal));
			if (get_class($animal) === 'Fishes') return new Fish_Cage(new Cage($animal));
			if (get_class($animal) === 'Birds') return new Bird_Cage(new Cage($animal));
	}

	function selectAnimalInCage($base_params){
		$base_params->iterateVisible();
		$arrExistAnimal = [];
		foreach(Cage::$arr as $one_animal) {
			foreach($one_animal as $animal) {
				(array_push($arrExistAnimal,$animal));
			}
		}
			$chanked_array = array_chunk($arrExistAnimal,4);
			$to_string_array_animal = array_map( fn($arr) => implode($arr) ,$chanked_array);

			foreach ($to_string_array_animal as $item) {
				if ($base_params == $item) {
					echo '<pre>';
					echo "Выбрано животное: " . "$item";
					echo '</pre>';
				} 
		}
	}	
}

	class Manager {

		public function getInstanceZookeper (Animal $instance, Zookeeper $zookeper) {
			$zookeper ->moveAnimalInCage($instance);
		}
	}


$lion = new Beasts('лев',4,1,0);
$puma = new Beasts('пума',4,1,0);
$fish = new Fishes('лещ',0,1,0);
$bird = new Birds('голубь',2,1,2);

$zookeeper = new Zookeeper();
$manager = new Manager();

$zookeeper->moveAnimalInCage($lion);
$zookeeper->moveAnimalInCage($fish);
$zookeeper->moveAnimalInCage($bird);
$zookeeper->moveAnimalInCage($bird);

$zookeeper->selectAnimalInCage(new Animal('ле',4,1,0));

$manager->getInstanceZookeper($puma, $zookeeper);


echo '</br>';
echo 'Животное в клетке по Имени';
echo '<pre>';
print_r(Cage::getOneAnimalCageByName('голубь'));
echo '</pre>';

echo 'Все животные в клетках';
echo '<pre>';
print_r(Cage::getAllAnimalCage());
echo '</pre>';





?>