<?php

namespace modules\files;

class Controller extends \core\controllers\ControllerBase
{
    function __construct($param=null) {
        $this->model = new Model($param);
    }
    
    function getAdminActions(){
        
        return [
            "name"=>"Файлы",
            "icon"=>"admin-icon-files",
            "description"=>'Управление файлами',
            "list"=>array(
                "images"=>array(
                    "act"=>"images",
                    "name"=>"Картинки",
                    "icon"=>"admin-icon-images",
                ),
                "templates"=>array(
                    "act"=>"templates",
                    "name"=>"Шаблоны картинок",
                    "icon"=>"",
                ),
                "docs"=>array(
                    "act"=>"docs",
                    "name"=>"Файлы",
                    "icon"=>"",
                )
            )
        ];
        
    }
    
    function adminImages($param){
        $this->imageBrowser($param);
    }
    
    function imageBrowser($param){
        
        $param = $this->model->extendFilter($param);
        
        echo $this->render('admin/imageBrowser',$param);
    }
    
    function adminTemplates($param){
        pr('param',$param);
    }
    
    function adminDocs(){
        pr('param',$param);
    }
}