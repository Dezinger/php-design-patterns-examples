<?php

/*
 * URL: http://phpshnik.ru/design-patterns/structural/composite
 * 
 * Паттерны - Структурные
 * 
 * Определение: Паттерн Компоновщик объединяет объекты в древовидные структуры, 
 * для представления иерархий "часть/целое". Компоновщик позволяет выполнять 
 * однородные операции с отдельными объектами и их совокупностями.
 * 
 * Это значит, что в такой структуре одни и те же операции могут применяться как 
 * к комбинациям, так и к отдельным объектам. (Во многих случаях различия между 
 * комбинациями и отдельными объектами игнорируются)
 * 
 * Компоновщик,- один из самых полезных паттернов, он помогает упростить решение 
 * нетривиальных задач по группировке объектов в деревья и работы с ними.
 * 
 * Рассмотрим пример работы с древовидным меню, узлами которой могут быть как 
 * отдельные объекты, так и агрегатные,- подменю, которые в свою очередь могут 
 * состоять из объектов и подменю...
 * 
 * Для перебора элементов меню, будем использовать паттерн Итератор.
 * 
 * Итератор:
 */

class MenuIterator {

    public $menu;
    public $cursor;

    public function __construct(MenuComponent $menu) {

        $this->menu = $menu;

        $this->cursor = -1;
    }

    /**
     * @name next
     * @todo Возвращает следующий объект меню
     * @return Menu
     */
    public function next() {

        if ($this->hasNext()) {
            return $this->menu->menuComponents[++$this->cursor];
        }
    }

    /**
     * @name hasNext
     * @todo Проверяет, существует ли сдедующий элемент
     * @return bool
     */
    public function hasNext() {

        if (isset($this->menu->menuComponents[$this->cursor + 1]))
            return true;

        return false;
    }

}


/*
 * Абстрактное меню:
 */

abstract class MenuComponent {

    /**
     * @name add
     * @todo Добавление эелемента меню
     * @param MenuComponent $menuComponent
     */
    public function add(MenuComponent $menuComponent) {

        throw new Exception('Нет реализации');
    }

    /**
     * @name remove
     * @todo Удаление эелемента меню
     * @param MenuComponent $menuComponent
     */
    public function remove(MenuComponent $menuComponent) {

        throw new Exception('Нет реализации');
    }

    /**
     * @name printMenu
     * @todo Вывод информации об элементе меню
     */
    public function printMenu() {

        throw new Exception('Нет реализации');
    }

    /**
     * @name getIterator
     * @todo Возвращает объект-итератор меню
     * @return MenuIterator
     */
    public function getIterator() {

        return new MenuIterator($this);
    }

}

/*
 * Конкретное блюдо:
 */

class MenuItem extends MenuComponent {

    public $name;

    public function __construct($name) {

        $this->name = $name;
    }

    /**
     * @name printMenu
     * @todo Вывод информации об элементе меню
     */
    public function printMenu() {

        echo $this->name . "<br>";
    }

}


/*
 * Меню
 */

class Menu extends MenuComponent {

    public $name;
    public $menuComponents = array();

    public function __construct($name) {

        $this->name = $name;
    }

    /**
     * @name add
     * @todo Добавление эелемента меню
     * @param MenuComponent $menuComponent
     */
    public function add(MenuComponent $menuComponent) {

        $this->menuComponents[] = $menuComponent;
    }

    /**
     * @name remove
     * @todo Удаление эелемента меню
     * @param MenuComponent $menuComponent
     */
    public function remove(MenuComponent $menuComponent) {

        foreach ($this->menuComponents as $key => $menu) {

            if ($menu->name == $menuComponent->name) {

                unset($this->menuComponents[$key]);

                break;
            }
        }
    }

    /**
     * @name printMenu
     * @todo Вывод информации об элементе меню
     */
    public function printMenu() {

        echo $this->name . "<br>";

        $iterator = $this->getIterator();

        while ($iterator->hasNext()) {

            $menu = $iterator->next();

            $menu->printMenu();
        }
    }

    /**
     * @name getIterator
     * @todo Возвращает итератор объекта
     * @return ManuIterator
     */
    public function getIterator() {

        return new MenuIterator($this);
    }

}

/*
 * Тестим:
 */

$menu = new Menu('Главное меню');

$drinks = new Menu('Напитки'); 

$alc = new Menu('Алкогольные');
$alc->add(new MenuItem("Пиво"));
$alc->add(new MenuItem("Вино"));
 
$notAlc = new Menu('Безалкогольные');
$notAlc->add(new MenuItem("Чай"));
$notAlc->add(new MenuItem("Компот"));
 
$drinks->add($alc);
$drinks->add($notAlc);
 
$menu->add($drinks);
 
$menu->add(new MenuItem('Первое'));
$menu->add(new MenuItem('Второе'));
 
$menu->printMenu();