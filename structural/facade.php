<?php

/*
 * URL: http://phpshnik.ru/design-patterns/structural/facade
 * 
 * Паттерны - Структурные
 * 
 * Определение: Паттерн Фасад предоставляет унифицированный интерфейс к группе 
 * интерфейсов подсистемы. Фасад определяет высокоуровневый интерфейс, у
 * прощяющий работу с подсистемой.
 * 
 * Фасад позволяет соблюсти принцип проектирования "Общайся только с друзьями",- 
 * клиент должен быть минимально информирован о системе. Фасад скрывает сложный 
 * интерфейс от клиента.
 * 
 * Диаграмма классов:
 * Данный паттерн предельно прост и удобен. Допустим у нас есть телевизор, 
 * стереосистема и световые приборы. Каджый день в 20:00 мы смотрим кино, 
 * для чего необходимо проделать одну и ту же монотонныу работу: включить телевизор, 
 * выбрать канал, включить стереосистему, застроить громкость и выключить свет. 
 * Давайте реализуем простой интерфейс для выполнения этих операций:
 * 
 */

class TV {

    /**
     * @name on
     * @todo Включить
     */
    public function on() {
        //реализация
    }

    /**
     * @name off
     * @todo Включить
     */
    public function off() {
        //реализация
    }

    /**
     * @name setChanel
     * @todo Выбрнать канал
     */
    public function setChanel() {
        //реализация
    }

}


class Stereo {

    /**
     * @name on
     * @todo Включить
     */
    public function on() {
        //реализация
    }

    /**
     * @name off
     * @todo Включить
     */
    public function off() {
        //реализация
    }

    /**
     * @name tuneVolume
     * @todo Настроить громкость
     */
    public function tuneVolume() {
        //реализация
    }

}


class Lights {

    /**
     * @name on
     * @todo Включить
     */
    public function on() {
        //реализация
    }

    /**
     * @name off
     * @todo Включить
     */
    public function off() {
        //реализация
    }

}



/*
 * А вот и фасад:
 */


interface MovieControl {

    /**
     * @name beginWatching
     * @todo Смотреть фильм
     */
    public function beginWatching();

    /**
     * @name stopWatching
     * @todo Выключить
     */
    public function stopWatching();
}

class MovieWatcher implements MovieControl {

    /**
     * @var TV
     */
    public $tv;

    /**
     * @var Stereo
     */
    public $stereo;

    /**
     * @var Lights
     */
    public $lights;

    public function __construct(TV $tv, Stareo $stereo, Lights $lights) {

        $this->tv = $tv;

        $this->stereo = $stereo;

        $this->lights = $lights;
    }

    /**
     * @name beginWatching
     * @todo Смотреть фильм
     */
    public function beginWatching() {

        $this->tv->on();
        $this->tv->setChanel();

        $this->stereo->on();
        $this->stereo->tuneVolume();

        $this->lights->off();
    }

    /**
     * @name stopWatching
     * @todo Выключить
     */
    public function stopWatching() {

        $this->tv->off();

        $this->stereo->off();

        $this->lights->on();
    }

}


/*
 * Тестим
 */

$tv = new TV();
$stereo = new Stereo();
$lights = new Lights();
 
$movieWatcher = new MovieWatcher($tv, $stereo, $lights);
 
$movieWatcher->beginWatching();
 
$movieWatcher->stopWatching();

/*
 * Что мы получили:
 * Все интерфейсы классов максимально скрыты от клиента.
 * Клиент получает собственный упрощенный интерфейс.
 */