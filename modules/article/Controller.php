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
    
    function ajaxSaveArticle($param)
    {
        if($_SESSION['user']){
            $this->model->db->setLogger();
            $stat = $this->model->saveArticle($param['article'],$param['id'],$error);
            return ['stat'=>$stat,'error'=>$error];
        }
    }
    
    function adminList($param = null)
    {
        $data = $this->model->getListArticle($param);
        if($param){
            foreach($param as $key=>$item){
                if(!$data[$key]){
                    $data[$key] = $item;
                }
            }
        }
        if(!$data['struct']){
            $data['struct'] = 0;
        }
        echo $this->render('admin/list',$data);
    }
    
    function adminAjaxListContent($param=null)
    {
        $data = $this->model->getListArticle($param);
        if($param){
            foreach($param as $key=>$item){
                if(!$data[$key]){
                    $data[$key] = $item;
                }
            }
        }
        echo $this->render('admin/listContent',$data);
    }
    
    function adminEditArticle($param)
    {
        $article = $this->model->getArticle($param['id']);
        
        echo $this->render("admin/editArticle",[
            'article'=>$article
        ]);
        
        return [
            'prev'=>'/admin/article/list',
            'title'=>'Редактирование статьи',
            'action'=>'Редактирование статьи ' . ( ($param['id'])?"#{$param['id']}":"" )
        ];
    }
    
    
    /* blocks */
    public $actions = [
        'main'=>[
            'name'=>'Центральная статья'
        ]
    ];
    
    function blockConfigMain()
    {
        return [
            'struct_id'=>[
                'name'=>'Раздел структуры',
                'type'=>'select',
                'podtype'=>'struct'
            ],
            'article'=>[
                'name'=>'Конкретная статья',
                'type'=>'select',
                'list'=>$this->model->getListArticleSelect()
            ]
        ];
    }
    
    function blockMain($block,$config,$pages)
    {
        $page = $pages[0];
        $item = $this->model->getLastArticleByStruct($page['id']);
        return [
            'title'=>$item['title'],
            'data'=>['item'=>$item]
        ];
    }
}