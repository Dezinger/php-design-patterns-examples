<?php

/*
 * Паттерны - Структурные
 * 
 * Определение: Паттерн заместитель предоставляет суррогатный объект, 
 * предоставляющий доступ к другому объекту.
 * 
 * Паттерн относится к категории структурных паттернов, то есть паттернов, 
 * объединяющих классы или объекты в более сложные структуры.
 * 
 * Заместитель очень похож на другие паттерны-обертчики (адаптер, фасад, декоратор), 
 * но имеет совершенно несхожее предназначение, как понятно из названия, паттерн 
 * предоставляет косвенный доступ к какому-либо объекту и очень часто применяется 
 * при решении различных задач:
 * 
 * Объект-заместитель управляет доступом с удаленному объекту, находящемуся, к примеру, на другом хосте.
 * Виртуальный заместитель управляет доступом к ресурсу, создание которого требуют большого количества ресурсов.
 * Защищенный заместитель контролирует доступом к ресурсу в соответствии с системой привилегий или прав доступа.
 * 
 * Рассмотрим пример с созданием объекта, требующим большого количества времени:
 */

interface Icon {
  
    /**
    * @name getImage
    * @todo Отображает изображение
    * @return void
    */
    public function displayImage();
}


class ImageComponent implements Icon { 
  
  
    public $url = null;
    
    public $file = 'source.jpg';
     
    public function __construct($url){
  
        $this->url = $url;
     }
  
    /**
    * @name prepareImage
    * @todo Загружает ресурсоемкое изображение
    * @return void
    */
    public function downloadImage(){
          
        $source = file_get_contents($this->url);
         
        file_put_contents($this->file, $source);
      
    }
  
    /**
    * @name displayImage
    * @todo Отображает ресурсоемкое изображение
    * @return void
    */
    public function displayImage(){
         
        header( 'Content-Type: image/jpeg' );
  
        echo file_get_contents($this->file);
      
    }
}


class ImagePreview implements Icon {
  
    public $image = null;
  
    public $preview = null;
     
  
    public function __construct(ImageComponent $image){
          
        $this->image = $image;
  
        $this->preview = $this->getPreview();
         
    }
     
     
    /**
     * @name getPreview
     * @todo Возвоащает сгенерированное preview-изображение
     * @return \Imagick
     */
    public function getPreview(){
         
        $image = new Imagick();
         
        $draw = new ImagickDraw();
         
        $pixel = new ImagickPixel( 'black' );
 
        /* New image */
        $image->newImage(145, 75, $pixel);
 
        /* Black text */
        $draw->setFillColor('white');
 
        /* Font properties */
        $draw->setFont('Bookman-DemiItalic');
        $draw->setFontSize( 30 );
 
        /* Create text */
        $image->annotateImage($draw, 10, 45, 0, 'Preview');
 
        /* Give image a format */
        $image->setImageFormat('jpg');
 
        return $image;
         
    }
  
     
    /**
    * @name displayImage
    * @todo Возвращает ресурсоемкое изображение
    * @return source
    */
    public function displayImage(){
  
        if(is_file($this->image->file)){
  
            echo $this->image->displayImage();
  
        }
        else{
             
            header( 'Content-Type: image/jpeg' );
             
            echo $this->preview;
             
            $this->image->downloadImage();
        }
          
    }
}



$image = new ImageComponent('http://www.dsbw.ru/public/site/images/photo/catalog/partition/info-section/5027.jpg');
 
$ImagePreview = new ImagePreview($image);
 
$ImagePreview->displayImage();

/*
 * Данный пример чересчур наивен, тем не менее он отражает суть паттерна Заместитель:
 * 
 * Обращение к объекту производится с помощью суррогатного объекта.
 * Ситуация, когда ресурс еще загружен обрабатывается, не вызывая ошибки.
 * Каждый из классов, расширяющих Icon, имеет свою собственную ответственность:
 * ImageComponent отвечает за загрузку объекта.
 * ImageProxy отвечает за доступ к нему.
 */