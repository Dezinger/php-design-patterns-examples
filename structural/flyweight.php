<?php


/*
 * URL: http://phpshnik.ru/design-patterns/structural/flyweight
 * 
 * Паттерны - Структурные
 * 
 * Паттерн Приспособленец
 * 
 * Определение: предоставляет систему, в которой только один экземпляр класса 
 * и объект, хранящий состояния всех объектов.
 * 
 * Иными словами, Приспобленец инкапсулирует переменные аспекты класса в отдельный класс. 
 * В отличие от Стратегии переменные аспекты всех объектов хранятся централизованно 
 * в объекте-менеджере. Менеджер в дальнейшем осуществляет работу с "виртуальными" 
 * объектами,- то есть с одним объектом, вызывая его методы с различными параметрами. 
 * Для реализации управляемого объекта можно даже использовать синглтон.
 * 
 * Паттерн может быть полезен, когда:
 * большое количество объектов занимает много памяти,
 * необходимо централизованное хранилище для объектов.
 * 
 * Из всего выше сказанного следует, что паттерн можно использовать, 
 * когда класс имеет много экземпляров, которыми можно управлять одинаково.
 * 
 * Рассмотрим пример, в котором необходимо отрисовывать множество однотипных объектов, 
 * скажем деревьев, на карте.
 * 
 * 
 * Интерфейс дерева:
 * 
 */

interface Tree {
     
    /**
     * @name display
     * @todo Отрисовка дерева 
     * @param double $longitude Долгота
     * @param double $latitude Широта
     */
    public function display($longitude, $latitude);
}

/*
 * Конкретные деревья:
 */

class Oak implements Tree {

    /**
     * @name display
     * @todo Отрисовка дуба
     * @param double $longitude Долгота
     * @param double $latitude Широта
     */
    public function display($longitude, $latitude) {
        echo "Отрисовка дерева по координатам: {$longitude}, {$latitude}<br>";
    }

}



/*
 * Менеджер
 */

abstract class TreeManader{
     
    /**
     * @name setOakCoords
     * @todo Задание координат  деревьев
     * @param array $coords Массив координат
     */
    public function setCoords(array $coords){
        $this->coords = $coords;
    }
     
    /**
     * @name displayTrees
     * @todo Отрисовка деревьев
     */
    public function displayTrees(){
        foreach($this->coords as $coord){
            $this->tree->display($coord['longitude'], $coord['latitude']);
        }
    }
}
 

class OakManager extends TreeManader{
     
    /**
     * Расположение деревьев
     * @var array 
     */
    public $coords = array();
     
    /**
     * Дерево
     * @var Tree
     */
    public $tree;
 
    public function __construct(){
         
        $this->tree = new Oak();
    }
}




/*
 * Тестим:
 */

$oakManager = new OakManager();
 
$oakManager->setCoords(array(
    array(
        "longitude" => 14.2345,
        "latitude"  => 56.3456,
    ),
    array(
        "longitude" => 15.2345,
        "latitude"  => 55.3456,
    ),
));
 
$oakManager->displayTrees();