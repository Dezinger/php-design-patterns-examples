<?php

/*
 * Паттерны - Порождающие
 * 
 * Паттерн Одиночка (singleton)
 * Определение: 
 * паттерн гарантирует создание только одного экземпляра 
 * класса и предоставляет к нему глобальную точку доступа.
 * 
 * Описание: 
 * предоставляет класс, которому разрешается создавать 
 * только один объект (конструктор класса объявляется private или protected, 
 * а метод, в котором создается объект объявляется статическим).
 * 
 * Область применения:
 * - Альтернатива глобальным переменным.
 * - Хранение дескриптора для подключения к бд, файлам....
 * - Любой случай создания объекта с глобальным доступом в единственном числе.
 * 
 * Диаграмма классов:
 * 
 * Пример использования:
 */

/**
* @name Singleton
* Простейший пример использования одиночки
*/

class Singleton {
 
  protected static $obj = null;
 
  /**
  * Конструктор объявлен закрытым
  */
  protected function __construct(){}
 
  /**
  * @name getInstance
  * Этот метод принято называть getInstance
  * @todo создание объекта
  * @return Singleton
  */
  public static function getInstance(){
 
    if(self::$obj === null){
      self::$obj = new Singleton();
    }
 
    return self::$obj;
  }
  
  
  public function doSomeThing()
  {
      return 'Hello world!';
  }
  
}

/**
 * Создание объекта:
 */
$obj = Singleton::getInstance();
$result = $obj->doSomeThing();


var_dump($obj);
var_dump($result);