<?php

namespace modules\files;

class Controller extends \core\controllers\ControllerBase
{
    function __construct($param=null) 
    {
        $this->model = new Model($param);
    }
    
    function ajaxUploadImage($send)
    {
        $files = $this->model->getFiles($_FILES['file']);
        //pr('files',$files);
        /*
            [1] => Array
        (
            [name] => mvc.png
            [type] => image/png
            [tmp_name] => D:\OpenServer\userdata\temp\php673.tmp
            [error] => 0
            [size] => 24331
        )
        */
        //foreach($_FILES)
        foreach($files as $file){
            //array('id' => '48','type' => 'jpg','name' => 'main2.jpg','descr' => NULL,'struct_id' => '2','date_add' => '2016-10-12 15:24:20','author' => '0'),
            //$file['']
        }
    }
    
    function getAdminActions()
    {
        
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
    
    function adminImages($param)
    {
        $this->imageBrowser($param);
    }
    
    function imageBrowser($param)
    {
        ob_start();
        $this->adminAjaxImages($param);
        $param['content'] = ob_get_clean();
        
        ob_start();
        $this->adminAjaxSelectImage($param);
        $param['selectImage'] = ob_get_clean();
        
        echo $this->render('admin/imageBrowser',$param);
    }
    
    function adminAjaxImages($param) 
    {
        $data = $this->model->getListImages($param);
        $data = $this->ext($data,$param);
        echo $this->render('admin/listImages',$data);
    }
    
    function adminAjaxSelectImage($param)
    {
        $image = $this->model->getImage($param['image']);
        
        echo $this->render("admin/selectImage",[
            'image'=>$image
        ]);
    }
    
    function adminTemplates($param)
    {
        pr('param',$param);
    }
    
    function adminDocs()
    {
        pr('param',$param);
    }
}