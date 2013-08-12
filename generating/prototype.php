<?php

/*
 * Паттерны - Порождающие
 * 
 * Паттерн прототип (prototype)
 * 
 * Определение: паттерн позволяет создать экземпляры классов копируя существующие экземпляры.
 * Описание: Создает копии объектов с помощью ключевого слова clone
 * 
 * Используется в тех случаях, когда создание экземпляра класса требует 
 * больших затрат ресурсов или занимает много времени.
 * 
 * Диаграмма классов: url?
 * 
 * Пример использования:
 * 
 */



class Tree {};
class Sea {};
class Mountain {};

/**
* @name LandshaftStore
* Простейший пример использования прототипа
*/
class LandshaftStore {

    /**
     * Кэшированные объекты
     */
    public $tree = null;
    public $sea = null;
    public $mountain = null;

    /**
     * Конструктор
     */
    public function __construct(Tree $tree, Sea $sea, Mountain $mountain) {

        $this->tree = $tree;
        $this->sea = $sea;
        $this->mountain = $mountain;
    }

    /**
     * @name getLandshaft
     * @todo Генерация объектов
     * return Tree|Sea{Mountain|null
     */
   public function getLandshaft($type){

        if ($type == 'tree') {
            return clone $this->tree;
        } elseif ($type == 'sea') {
            return clone $this->sea;
        } elseif ($type == 'mountain') {
            return clone $this->mountain;
        }
        else
            return null;
    }

}


/*
 * Создание объекта:
 */

$tree = new Tree();
$sea = new Sea();
$mountain = new Mountain();

$landshaftStore = new LandshaftStore($tree, $sea, $mountain);
$landshaft = $landshaftStore->getLandshaft('tree');



/*
 * Бывают ситуации, когда объекты-прототипы содержат ссылки на другие объекты. 
 * Клон такого объекта будет ссылаться на тот же объект. Если это нежелательно, 
 * достаточно определить метод __clone() в классах объектов-клонов так, как необходимо.
 */


var_dump($landshaft);