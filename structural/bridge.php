<?php


/*
 * URL: http://phpshnik.ru/design-patterns/structural/bridge
 * 
 * Паттерны - Структурные
 * 
 * Паттерн Мост
 * 
 * Определение: паттерн Мост позволяет изменять и абстракцию, и реализацию, 
 * инкапсулируя их в отдельные иерархии классов.
 * 
 * Паттерн используется, когда:
 * неизбежны изменения как абстракции, так и реализации,
 * необходимо реализовать систему, работающую на разных платформах.
 * 
 * Чтобы понять основную идею паттерна Мост, необходимо проанализировать, 
 * когда появляется необходимость разделения абстракции от реализации 
 * в различные иерархии.
 * 
 * Принципы проектирования учат нас программировать на уровне интерфейса, 
 * а также закладывать удобство сопровождения на уровне проектирования системы, 
 * создавая гибкие архитектурные модели. А иначе как быть с постоянно меняющимися 
 * требованиями? А если конечный продукт вообще не определен на стадии проектирования? 
 * Как строить здание, если не известно, сколько у него будет этажей? 
 * Тут понадобится паттерн мост - связка между абстракциями и реализациями!
 * 
 * Допустим, вы разрабатываете новейший телевизор, но вот беда, чтобы он был 
 * конкурентоспособным маркетологи постоянно меняют требования его основному функционалу. 
 * И это еще не все, специалисты по юзабилити постоянно меняют интерфейс ПДУ. 
 * Вы, конечно, уже отделили интерфейс от реализации, но этого мало, вы только что узнали, 
 * что в вашей системе контроля версий будет разрабатываться несколько независимых 
 * веток как абстракций, так и конкретных реализаций. Теперь без паттерна мост просто не обойтись.
 * 
 * 
 * Иерархия ПДУ:
 * 
 */


abstract class RemoteControl {

    /**
     * Телевизор
     * @var TV
     */
    public $tv = null;

    public function __construct(TV $tv) {

        $this->tv = $tv;
    }

    /**
     * @name on
     * @todo Включить
     */
    public function on() {
        //Реализация
    }

    /**
     * @name off
     * @todo Выключить
     */
    public function off() {
        //Реализация
    }

    /**
     * @name setChanel
     * @todo переключить канал
     * @param int $chanel Канал
     */
    public abstract function setChanel($chanel);
}


class PDU1 extends RemoteControl {

    /**
     * @name setChanel
     * @todo переключить канал
     */
    public function setChanel() {

        $this->tv->setChanel();
    }

}


class PDU2 extends RemoteControl {

    /**
     * @name setChanel
     * @todo переключить канал
     * @param int $chanel Канал
     */
    public function setChanel($chanel) {
        $this->tv->setChanel($chanel);
    }

    /**
     * @name prevChanel
     * @todo Включить предыдущий канал
     */
    public function prevChanel() {
        $this->tv->prevChanel();
    }

}



/*
 * Иерархия телевизоров:
 */

abstract class TV {

    /**
     * @name on
     * @todo Включить
     */
    public function on() {
        //Реализация
    }

    /**
     * @name off
     * @todo Выключить
     */
    public function off() {
        //Реализация
    }

    /**
     * @name setChanel
     * @todo переключить канал
     * @param int $chanel Канал
     */
    public abstract function setChanel($chanel);
}


class TV1 extends TV {

    /**
     * @name setChanel
     * @todo переключить канал
     * @param int $chanel Канал
     */
    public function setChanel($chanel) {
        //Реализация
    }

}


class TV2 extends TV {

    /**
     * @name setChanel
     * @todo переключить канал
     * @param int $chanel Канал
     */
    public function setChanel($chanel) {
        //Реализация
    }

    /**
     * @name prevChanel
     * @todo Включить предыдущий канал
     */
    public function prevChanel() {
        //Реализация
    }

}


/*
 * Тестим
 */

$tv1 = new TV1();
$tv2 = new TV2();
 
$pdu1 = new PDU1($tv1);
$pdu2 = new PDU2($tv2);
 
$pdu1->on();
$pdu1->setChanel(1);
$pdu1->off();
 
$pdu2->on();
$pdu2->setChanel(1);
$pdu2->setChanel(2);
$pdu2->prevChanel();
$pdu1->off();