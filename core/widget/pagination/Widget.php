<?php

namespace core\widget\pagination;


class Widget extends \core\widget\WidgetBase
{
     /*
     *  $args = [
     *      pages => pages, // Кол-во страниц
     *      page  => page, // Текущая страница
     *      count => count //Общее число записей
     *      func  => func // JS функция обработчик клика
     *  ]
     *  return $html;
     */
    function run($args=null)
    {
        
        $args['delta'] = 5;
        
        if(!$args['limit']){
            $args['limit'] = 10;
        }
        
        if(!$args['pages']){
            if($args['limit'] < $args['count']){
                $args['pages'] = ceil( $args['count'] / $args['limit'] );
            }
        }
        
        echo $this->render('pagination',$args);
    }
}  
