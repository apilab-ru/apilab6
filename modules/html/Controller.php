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
            "name"=>"Html блоки",
            "icon"=>"admin-icon-files",
            "description"=>'Управление Html блоками',
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

