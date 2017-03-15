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
                    $this->model->removeImage($id);
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
    
    function ajaxRemoveImage($id)
    {
        $this->model->removeImage($id);
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
    
    function ActionImageUpload($param)
    {
        if($_SESSION['user']){
            $file = $_FILES['upload'];
            $file['type'] = $this->model->getImgType($file);
            $id = $this->model->addImage($file['name'],$file['type'],0);
            $move = $this->model->saveImage($file,$id);
            dlog('image params',array(
                $file,$id,$move
            ));
            $funcNum = $_GET['CKEditorFuncNum'];
            $url = $this->model->getImageSrc($id,$file['type'],'original');
            $message = 'Файл успешно загружен';
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
        }
    }
    
    function ActionImageBrowser($param)
    {
        ob_start();
        $this->imageBrowser();
        $html = ob_get_clean();
        echo $this->render('admin/actionImageBrowser',array(
            'html'=>$html,
            'act'=>$_REQUEST['act'],
            'param'=>$_REQUEST
        ));
    }
    
    function adminImages($param)
    {
        $this->imageBrowser($param);
    }
    
    function imageBrowser($param=null)
    {
        ob_start();
        $this->adminAjaxImages($param);
        $param['content'] = ob_get_clean();
        
        ob_start();
        $this->adminAjaxSelectImage($param);
        $param['selectImage'] = ob_get_clean();
        
        if(!$param['struct']){
            $param['struct'] = 0;
        }
        
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
            'image'=>$image,
            'act'=>$param['act'],
            'tpls'=>$this->model->getListTpls()
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
    
    //BLOCKS
    function blockListDocs($block,$config,$pages)
    {
        if($config['struct_id']=='my'){
           $config['struct_id'] =  $pages[0]['id'];
        }
        $data = $this->model->getListDocs($config);
        return [
            'data'=>$data,
            'tpl'=>'listFiles'
        ];
    }
    
    function blockListImages($block,$config,$pages)
    {
        if($config['struct_id']=='my'){
           $config['struct_id'] =  $pages[0]['id'];
        }
        $data = $this->model->getListImages($config);
        if(!$config['imageTpl']){
            $config['imageTpl'] = 'list';
        }
        $data['imageTpl'] = $config['imageTpl'];
        return [
            'data'=>$data,
            'tpl'=>'listImages',
        ];
    }
}