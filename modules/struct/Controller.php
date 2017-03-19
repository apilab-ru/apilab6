<?php

namespace modules\struct;
use core\controllers\ControllerBase;

class Controller extends ControllerBase{
    
    function __construct($param) 
    {
        $this->model = new Model($param);
    }
    
    /* admin */
    function getAdminActions()
    {
        return [
            "name"=>"Структура",
            "icon"=>"admin-icon-list",
            "description"=>'Управление структурой',
            "list"=>array(
                "razdels"=>array(
                    "act"=>"razdels",
                    "name"=>"Разделы",
                    "icon"=>"admin-icon-list",
                ),
                "blocks"=>array(
                    "act"=>"blocks",
                    "name"=>"Визуальный редактор",
                    "icon"=>"admin-icon-paint-format",
                )
            )
        ];
    }
    
    function adminRazdels($param)
    {
        pr($param);
    }
    
    function adminBlocks()
    {
        echo $this->render('admin/blocks');
    }
    
    function ajaxGetBlockParam($send)
    {
        $block = $this->model->getBlock($send['id']);
        if($block['parent_id']!=$send['nav']){
           $block['is_default']=1; 
        }
        $block['config'] = json_decode($block['config'],1);
        
        echo $this->viewControlBlock($block);
        return $block;
    }
    
    function ajaxUpdatePage($send)
    {
        $this->model->db->setLogger();
        return [
            'stat'=>$this->model->updatePage($send['groups'],$send['page'])
        ];
    }
    
    function viewControlBlock($block){
        $block['name'] = $this->model->core->module->{$block['model']}->getNameAction($block['act']);
        $block['module'] = $this->model->core->module->{$block['model']}->getAdminActions()['name'];
        return $this->render('admin/blockControl',['block'=>$block]);
    }
    
    function ajaxEditBlock($send)
    {
        $modules = $this->model->getModules();
        $templates = $this->model->getTemplates();
        echo $this->render('admin/editBlock',[
            'block'=>$send['block'],
            'modules'=>$modules
        ]);
        return [
            'modules'=>$modules,
            'tpl'=>$templates
        ];
    }
    
    function ajaxGetBlockConfig($send)
    {
        $set = $this->model->core->module->{$send['model']}->blockConfig($send['act']);
        if(!$send['config']){
            $send['config'] = array();
        }
        foreach($set as $key=>$it){
            if($it['default'] && !$send['config'][$key]){
                $send['config'][$key] = $it['default'];
            }
        }
        
        echo $this->render('admin/getBlockConfig',[
            'set'=>$set,
            'config'=>$send['config']
        ]);
    }
    
    function ajaxRenderBlock($send)
    {
        $block = $send['block'];
        $page = $this->model->getPageById($send['nav']);
        $res = \core\Core::$app->module->{$block['model']}->block(
                                $block['act'],
                                $block,
                                $block['config'],
                                array($page));
        echo $res;
        return [
            'control'=>$this->viewControlBlock($block)
        ];
    }
    
    /* BLOCKS */
    public $actions = [
        'menu'=>[
            'name'=>'Меню'
        ]
    ];
    
    function blockConfigMenu()
    {
        return [
            'struct_id'=>[
                'name'=>'Раздел структуры',
                'type'=>'select',
                'podtype'=>'struct'
            ]
        ];
    }
    
    function blockMenu($block,$config,$pages)
    {
        return [
            'data'=>[
                'isChild'=>($pages[0]['parent']!=0),
                'list'=>$this->model->getStructList($pages[0])
             ]
        ];
    }
}

