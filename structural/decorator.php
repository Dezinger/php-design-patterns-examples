<?php

/*
 * Паттерны - Структурные
 * 
 * Определение: 
 * 
 * Паттерн декоратор динамически наделяет объект новыми возможностями и является 
 * гибкой альтернативой субклассированию в области расширения функциональности.
 * 
 * Наверняка многие уже встречали различные декораторы: Zend Form, кэширующие 
 * декораторы и т.д, все они схожи по своему принципу, - они наделяют объекты 
 * новыми функциональными возможностями.
 * 
 * Но зачем он нужен, не проще написать новый метод или изменить старый, 
 * потратив при этом 2 минуты времени? Проще! И быстрее! Однако тогда мы нарушим 
 * принцип проектирования, который гласит...
 * 
 * Принцип проектирования: Классы должны быть открыты для расширения и закрыты 
 * для редактирования и есть ряд причин для этого:
 * 
 * Добавить функционал, значит добавить лишнюю ответственность, что нарушает еще 
 * один принцип проектирования: У класса должна быть только одна ответственность.
 * 
 * Добавляя ответственность, мы добавляем как минимум еще один повод для изменения 
 * кода, что приведет к необходимости тестирования.
 * 
 * Внося изменения в рабочий код, мы знаем, как поведет себя система, в которой он завязан.
 * 
 * И самое главное, создавая классы, закрытые для изменения, мы получаем гибкую систему, 
 * которую просто и легко будет в последствие сопровождать.
 * 
 * Как быть, если, к примеру, в кафе, где подают свежий молотый кофе, появится 
 * новый вид кофе? Придется писать новый класс. А если два вида, три, десять? 
 * Тогда десять классов. А если подорожает сахар, придется для каждого из десяти 
 * (а может двадцати) видов менять стоимость. А если подорожает молоко? 
 * Нужно инкапсулировать молоко, сахар, кофе в отдельные классы. А если наименований 
 * ну очень много? Строить иерархию из сотни классов, когда нам нужен, скажем, 
 * всего один метод, чтобы выставить счет? 
 * 
 * Пора использовать декоратор:
 * 
 */

interface Coffee {
 
    /**
    * @name getCost
    * @todo Возвращает стоимость
    * @return double
    */
    public function getCost();
}

class Espresso implements Coffee{
 
    public $cost = 20;
 
    /**
    * @name getCost
    * @todo Возвращает стоимость
    * @return double
    */
    public function getCost(){
        return $this->cost;
    }
}

class Kapuchino  implements Coffee{
 
    public $cost = 15;
 
    /**
    * @name getCost
    * @todo Возвращает стоимость
    * @return double
    */
    public function getCost(){
        return $this->cost;
    }
}

/*
 * Пока хватит и двух сортов, теперь мы будем их наделять новыми вкусами:
 */

abstract class Condiments implements Coffee {
 
    /**
    * @name getCost
    * @todo Возвращает стоимость
    * @return double
    */
    public function getCost(){
        //.....
    }
}

class HasMilk extends Condiments{
     
    public $coffee;
 
    public function __construct(Coffee $coffee){
         
        $this->coffee = $coffee;
    }
 
    /**
    * @name getCost
    * @todo Возвращает стоимость
    * @return double
    */
    public function getCost(){
        return 5 + $this->coffee->getCost();
    }
}
 
class HasSugar extends Condiments{
     
    public $coffee;
 
    public function __construct(Coffee $coffee){
         
        $this->coffee = $coffee;
    }
 
    /**
    * @name getCost
    * @todo Возвращает стоимость
    * @return double
    */
    public function getCost(){
        return 3 + $this->coffee->getCost();
    }
}

/*
 * Все готово. Приступим к приготовлению:
 */

$espresso = new Espresso(); 
$kapuchino = new Kapuchino();  
$espressoWithMilk = new HasMilk($espresso); 
$kapuchinoWithMilk = new HasMilk($kapuchino); 
$kapuchinoWithMilkWithSugar = new HasSugar($kapuchinoWithMilk);   
 
echo $espresso->getCost()."руб. <br>";
echo $kapuchino->getCost()."руб. <br>";
echo $espressoWithMilk->getCost()."руб. <br>";
echo $kapuchinoWithMilk->getCost()."руб. <br>";
echo $kapuchinoWithMilkWithSugar->getCost()."руб. <br>";

/*
 * Что мы получаем в итоге?
 * 
 * Нет необходимости хранить множество классов, объекты которых можно получить 
 * объединяя их с уже существующими ингридиентами.
 * 
 * Не нарушается заповедь программиста "Don't repeat your self."
 * 
 * Мы получаем очень гибкую структуру, которую легко сопровождать.
 */