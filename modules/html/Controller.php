<?php

namespace modules\html;
use core\controllers\ControllerBase;

class Controller extends ControllerBase{
    
    function __construct($param = null) {
        $this->model = new Model($param);
    }

    function getAdminActions()
    {
        return [
            "act"=>"list",
            "name"=>"Html блоки",
            "icon"=>"admin-icon-files",
            "description"=>'Управление Html блоками',
        ];
    }
    
    function adminList()
    {
        $list = $this->model->getList();
        echo $this->render('admin/list',[
            'list'=>$list
        ]);
    }
    
    function adminAjaxEditHtmlBlock($send)
    {
        if($send['id']){
            $block = $this->model->getHtmlBlock($send['id']);
        }else{
            $block = array();
        }
        echo $this->render('admin/editHtmlBlock',[
            'block'=>$block
        ]);
    }
    
    function adminAjaxSaveHtmlBlock($send){
        $stat = $this->model->saveHtmlBlock($send['block'],$send['id']);
        unset($set['html']);
        return [
            'stat'=>$stat,
            'id'=>$send['id'],
            'mas'=>$send['block']
        ];
    }
    
    //Blocks
    public $actions = [
        'html'=>[
            'name'=>'HTML блок'
        ],
    ];
    
    function blockConfigHtml()
    {
        return [
            'id'=>[
                'name'=>'Выбор блока',
                'type'=>'select',
                'list'=>$this->model->getListOptions(),
                'actions'=>[
                    [
                        'class'=>'add',
                        'name'=>'Добавить',
                        'func'=>'struct.addHtmlBlock'
                    ],
                    [
                        'class'=>'edit',
                        'name'=>'Редактировать',
                        'func'=>'struct.editHtmlBlock'
                    ]
                ]
            ]
        ];
    }
    
    function blockHtml($block,$config)
    {
        return [
            'data'=>['html'=>$this->model->getHtmlBlock($config['id'])],
            'tpl'=>'html'
        ];
    }
    
    
}

