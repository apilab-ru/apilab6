<?php

namespace modules\files;

class Controller extends \core\controllers\ControllerBase
{
    function __construct($param=null) 
    {
        $this->model = new Model($param);
    }
    
    function ajaxUploadImage($send,$request)
    {
        $files = $this->model->getFiles($_FILES['file']);
        $errors = array();
        foreach($files as $file){
            $file['type'] = $this->model->getImgType($file);
            $id = $this->model->addImage($file['name'],$file['type'],$request['struct']);
            if($id){
                $move = $this->model->saveImage($file,$id);
            }else{
                $errors[] = 'Ошибка записи файла';
            }
            if(!$move){
                if($id){
                    $this->model->removeFile($id);
                }
                $errors[] = 'Ошибка добавления файла';
            }
        }
        if(!$errors){
            return ['stat'=>1];
        }else{
            return ['stat'=>0,'errors'=>$errors];
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