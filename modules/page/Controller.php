<?php

namespace modules\page;
use core\controllers\ControllerBase;

class Controller extends ControllerBase{
    
    public $title=array();
    public $keywords=array();
    public $description=array();
    
    function __construct($set) 
    {
        $this->set = $set;
        $this->model = new Model();
    }
    
    function getAdminActions()
    {
        return [];
    }
    
    function setTitle($title)
    {
        $this->title[] = $title;
    }
    
    function actionPage($url,$param)
    {
        $page = $this->model->getPage($url);
        $set = $this->searchBlockParam($param);
        if(!$page){
            return 404;
        }else{
            $blocks = $this->model->getBlocks($page,1);
            $groups = array();
            foreach($blocks as $gr=>$group){
                $groups[$gr] = '';
                foreach($group as $num=>$block){
                    //pr($block);
                    if($block['model']){
                        $res = \core\Core::$app->module->{$block['model']}->block(
                                $block['act'],
                                $block,
                                $this->reserializeConfig($block['config'],$set[$block['id']]),
                                $page);
                        if($res){
                            $groups[$gr].= $res;
                        }
                    }
                }
            }
            echo $this->render($page[0]['tpl'],[
                'group'=>$groups,
                'title'=>$this->getTitle($page),
                'keywords'=>$this->getKeywords($page),
                'description'=>$this->getDescription($page),
            ]);
        }
    }
    
    function searchBlockParam($param)
    {
        $data = array();
        foreach($param as $key=>$val){
            $keys = explode("_",$key);
            if(count($keys)==3){
                $data[$keys[1]][$keys[2]] = $val;
            }
        }
        return $data;
    }
    
    function getTitle($pages)
    {
        if($page[0]['title']){
            return $page[0]['title'];
        }
        return implode('.',$this->title);
    }
    
    function getKeywords($pages)
    {
        if($page[0]['keywords']){
            return $page[0]['keywords'];
        }
        return implode(',',$this->keywords);
    }
    
    function getDescription($pages)
    {
        if($page[0]['description']){
            return $page[0]['description'];
        }
        return implode('.',$this->description);
    }
    
    function reserializeConfig($config,$set)
    {
        $config = json_decode($config,1);
        if($set){
            foreach($set as $key=>$val){
                $config[$key] = $val;
            }
        }
        return $config;
    }
}