<?php

namespace modules\article;

class Controller extends \core\controllers\ControllerBase
{
    function __construct($param=null) {
        $this->model = new Model($param);
    }
    
    
    function getAdminActions(){
        
        return [
            "act"=>"list",
            "name"=>"Статьи",
            "icon"=>"admin-icon-quill",
            "description"=>'Управление новостями'
        ];
        
    }
    
    function adminList($param){
        $data = $this->model->getListArticle($param);
        echo $this->render('admin/list',$data);
    }
    
    function adminAjaxListContent($param){
        $data = $this->model->getListArticle($param);
        echo $this->render('admin/listContent',$data);
    }
    
    function adminEditArticle($id){
        
        $article = $this->model->getArticle($id);
        
        echo $this->render("admin/editArticle",[
            'article'=>$article
        ]);
        
        return [
            'title'=>'Редактирование статьи'
        ];
    }
}