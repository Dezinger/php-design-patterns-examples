<?php

/*
 * Паттерны - Структурные
 * 
 * Определение: 
 * 
 * Паттерн адаптер преобразует интерфейс класса к другому интерфейсу, 
 * на который рассчитан клиент. Адаптер обеспечивает совместную работу классов, 
 * невозможную в обычных условиях из-за несовместимости интерфейсов.
 * 
 * Паттерн адаптер очень прост и удобен, цель и назначение понятны из его определения. 
 * Осталось только понять, где его использовать и почему НЕЛЬЗЯ менять интерфейс класса, 
 * а нужно писать второй класс-адаптер?
 * 
 * Классы должны быть закрыты для изменения и открыты для расширения, 
 * гласит принцип проектирования, он так и называется: "принцип открытости-закрытости". 
 * Чтобы защитить свой код от возникновения ошибок, однажды спроектировав класс, 
 * он должен быть максимально закрыт к последующим изменениям. Конечно не всегда получается 
 * спроектировать класс так, чтобы учесть все аспекты его последующего использования. 
 * И не нужно к этому стремиться: пытаясь спроектировать класс-бог, мы рано или поздно 
 * столкнемся с проблемой его сопровождения! Важно понимать, что после этапа 
 * проектирования, наступит этап написания кода, вслед за которым наступит этап 
 * оптимизации кода и тестирования. Пройдя все этапы класс как правило получает 
 * стабильную версию, дальнейшие изменения которого неизвестно как скажутся на 
 * его работе, если конечно не проводить тестирование без конца. Другое правило 
 * проектирование гласит "Класс должен иметь только одну ответственность", что 
 * позволяет максимально избежать изменения кода (2 ответственности у класса == 
 * 2 повода для изменения кода класса). Если класс умеет слишком много на этапе 
 * проектирования, пересмотрите архитектуру.
 * 
 * А как же тогда в последствии наделить его новым поведением или изменить его поведение?
 * 
 * Для этого существуют паттерны-обёртки, которые позволяют изменить интерфейс, 
 * либо поведение, без изменения кода класса, который наверняка уже участвует 
 * в работе и менять его крайне нежелательно:
 * 
 * Необходимо новое поведение: паттерн "Декоратор".
 * Необходимо предоставить единый упрощенный интерфейс: паттерн "Фасад".
 * Необходимо изменить интерфейс, пожалуйста: паттерн "Адаптер".
 * 
 * Диаграмма классов:
 * 
 * Что мы имеем: Класс, интерфейс которого нужно изменить и класс, 
 * чей интерфейс нужно использовать.
 * 
 * Есть интерфейс утка с прототипами методов, которые реализует конкретная утка:
 */

interface Duck {
 
    /**
    * @name quack
    * Утка умеет крякать
    */
    public function quack();
     
    /**
    * @name fly
    * и летать
    */
    public function fly();
}


/*
 * Вот и сама утка:
 */

class MallardDuck implements Duck{
 
    /**
    * @name quack
    */
    public function quack(){

        echo "Quack!<br>";
    }
     
    /**
    * @name fly
    */
    public function fly(){
 
        echo "I'm flying!<br>";
    }
}


/*
 * В отличие от утки индюшка не крякает:
 */

interface Turkey {
 
    /**
    * @name gobble
    */
    public function gobble();
     
    /**
    * @name fly
    */
    public function fly();
}

class WildTurkey implements Turkey {
 
    /**
    * @name gobble
    */
    public function gobble(){
     
        echo "Gobble gobble!<br>";
    }
     
    /**
    * @name fly
    */
    public function fly(){
 
         
        echo "I'm flying too!<br>";
    }  
}

/*
 * Все, что необходимо, это адаптер (теперь индюшка реализует интерфейс Duck):
 */

class TurkeyAdapter implements Duck {
 
    public $turkey = null;
 
    public function __construct(Turkey $turkey){
 
        $this->turkey = $turkey;
    }
 
    /**
    * @name quack
    */
    public function quack(){
     
        $this->turkey->gobble();
    }
     
    /**
    * @name fly
    */
    public function fly(){
 
         
        $this->turkey->fly();
    }  
}


/*
 * Тест драйв:
 */

/**
* Утка
*/
$duck = new MallardDuck();
 
/**
* Индюшка
*/
$turkey = new WildTurkey();
 
/**
* Индюшка-утка
*/
$turkeyAdapter = new TurkeyAdapter($turkey);
 
//Тест
$duck->quack();
$turkey->gobble();
$turkeyAdapter->quack();