<?php

/*
 * Паттерны - Порождающие
 * 
 * Определение: 
 * 
 * Паттерн Строитель инкапсулирует конструирование продукта 
 * и позволяет разделить его не этапы.
 * 
 * Основные принципы паттерна 
 * Стратегия:
 * - Инкапсуляция процесса создания сложного объекта,
 * - Возможность поэтапного конструирования объекта с переменным набором этапов (В отличие от однородных фабрик),
 * - Сокрытие внутреннего представления продукта от клиента,
 * - Реализации продуктов могут свободно изменяться, потому что клиент имеет дело только с абстрактным интерфейсом.
 * 
 * С виду паттерн Строитель напоминает Итератор: 
 * Строитель инкапсулирует конструирование продукта в отдельном объекте, а Итератор инкапсулирует перебор,
 * 
 * Строитель часто используется совместно с паттерном Компоновщик: 
 * Компоновщик позволяет объединять объекты в древовидные структуры, 
 * а Строитель обеспечить ее поэтапное построение. Добавьте Итератор, и вы получите очень мощный 
 * и гибкий механизм для работы с структурами данных любой сложности.
 * 
 * 
 * Но для начала рассмотрим пример использования паттерна Строитель для создания простого планировщика задач.
 * 
 * Календарь событий:
 */

class Calendar{
     
    public $data = array();
    public $taskManager = null;
     
    public function __construct(){
         
        $this->taskManager = new TaskManager($this);
        
    }
}

/**
 * Абстрактный строитель:
 */

abstract class Builder{
     
    /**
     * @name buildDay
     * @todo Создать день
     * @param date $date Дата дня события
     */
    public function addDay($date){
         
        $this->currentDate = $date;
        $this->calendar->data[$this->currentDate]=array();
    }
     
    /**
     * @name addEvent
     * @todo Добавить событие
     * @param string $desc Описание события
     * @param date $date Время события
     */
    public function addEvent($desc, $time){
        
        $this->calendar->data[$this->currentDate][] = array(
            'desc'  => $desc,
            'time'  => $time,
        );
    }
}

/**
 * Менеджер задач:
 */

class TaskManager extends Builder{
     
    public $calendar = null;
    public $currentDate;
     
    public function __construct(Calendar $calendar){
         
        $this->calendar = $calendar;
    }
     
}


/**
 * Тестим:
 */

$calendar = new Calendar();
 
$calendar->taskManager->addDay(date('Y-m-d'));
$calendar->taskManager->addEvent('task1', date('h:i:s'));
$calendar->taskManager->addEvent('task2', date('h:i:s', strtotime("+1 hour")));
 
$calendar->taskManager->addDay(date('Y-m-d', strtotime("+1 day")));
$calendar->taskManager->addEvent('task1', date('h:i:s'));
$calendar->taskManager->addEvent('task2', date('h:i:s', strtotime("+1 hour")));
$calendar->taskManager->addEvent('task3', date('h:i:s', strtotime("+2 hour")));
 
var_dump($calendar->data);






/*
 * Еще пример
 */

class product {
    protected $_type = ''; 
    protected $_size = ''; 
    protected $_color = '';

    public function setType($type) {
        $this->_type = $type;
    }

    public function setSize($size) {
        $this->_size = $size;
    }

    public function setColor($color) {
        $this->_color = $color;
    }
}


$productConfigs = array('type'=>'shirt', 'size'=>'XL', 'color'=>'red');
    

//Плохой способ
/*
$product = new product(); 
$product->setType($productConfigs[‘type’]); 
$product->setSize($productConfigs[‘size’]); 
$product->setColor($productConfigs[‘color’]);
*/


//Лучше делаем билдер

class productBuilder {

    protected $_product = NULL;
    protected $_configs = array();

    public function __construct($configs) {
        $this->_product = new product();
        $this->_configs = $configs;
    }

    public function build() {
        $this->_product->setSize($this->_configs['size']); 
        $this->_product->setType($this->_configs['type']); 
        $this->_product->setColor($this->_configs['color']);
    }

    public function getProduct() {
        return $this->_product;
    }

}

$builder = new productBuilder($productConfigs); 
$builder->build();
$product = $builder->getProduct();
var_dump($product);
