function struct(){
    this.name = "struct";
    var self = this;
    this.from = "/";
    
    this.selectNav = function(id,alias,myb){
        $('#page').attr({src:alias});
        self.nav = id;
        $('.curNav').html( $(myb).find('.n').text() );
    }
    
    this.iframeLoad = function(myb){
        myb.contentWindow.window.PageScripts.load('/modules/struct/structClinent.js',function(){ 
            self.client = myb.contentWindow.window.structClient;
            self.initClient();
        })
    }
    
    this.initClient = function(){
        self.client.init(self);
    }
    
    this.saveNav = function(){
        var groups = self.client.getGroups();
        self.post('updatePage',{groups:groups,page:self.nav},function(re,mas){
            if(mas.stat){
                popUp('Успешно');
            }else{
                popUp('Ошибка');
            }
        })
    }
    
    this.togle = function(myb){
        var $box = $(myb).parents('.togleBox:first');
        if($box.hasClass('slide')){
            $box.removeClass('slide');
        }else{
            $box.addClass('slide'); 
        }
    }
    
    this.addBlock = function () {
        var block = {model:null};
        var $win = self.createPop('Добавление блока #', null);
        self.post('editBlock', {
            block: block
        }, function (re, mas) {
            $win.update(re);
            self.initEditBlock($win, mas, block);
        });

        $win.on('click', '.controlSet', function () {
            block.model = $win.find('#model').val();
            block.act = $win.find('#act').val();
            if ($win.find('#tpl').is(':visible')) {
                block.tpl = $win.find('#tpl').val();
            } else {
                block.tpl = null;
            }
            block.config = self.getFormConfig($win.find('.config'));
            
            var $block = self.client.addBlock(block);
            
            $block.setCallback(function(){
                self.post('renderBlock', {block: block, nav: self.nav}, function (re, mas) {
                    var $re = $(re);
                    $block.html($re.html());
                    $block.prepend(mas.control);
                })
            });
            
        })
    }
    
    this.editBlock = function(block,$block){
        var $win = self.createPop('Редактирование блока #'+block.id,null);
        
        $win.addCallback(function(){
            $block.deactiveEdit();
        });
        
        self.post('editBlock',{
            block:block
        },function(re,mas){
            $win.update(re);
            self.initEditBlock($win,mas,block);
        });
        
        $win.on('click','.controlSet',function(){
            block.model = $win.find('#model').val();
            block.act = $win.find('#act').val();
            if($win.find('#tpl').is(':visible')){
                block.tpl = $win.find('#tpl').val();
            }else{
                block.tpl = null;
            }
            block.config = self.getFormConfig($win.find('.config'));
            
            self.post('renderBlock',{block:block,nav:self.nav},function(re,mas){
                var $re = $(re);
                $block.html( $re.html() );
                $block.prepend(mas.control);
            })
        })
        //block.test = 1;
    }
    
    this.initEditBlock = function($win,data,block){
        $win.on('change','#model',function(){
            var model = $(this).val();
            $win.find('#act').html( self.selectOptions(data.modules[model].actions,block.act) );
            $win.find('#act').change();
        });
        $win.on('change','#act',function(){
            var act = $(this).val();
            var model =  $win.find('#model').val();
            if(model in data.tpl.templateToBlock){
                if(act in data.tpl.templateToBlock[model]){

                    var list = {};
                    $.each(data.tpl.templateToBlock[model][act],function(n,i){
                        list[i] = data.tpl.templates[model][i];
                    });
                    
                    $win.find('#tpl').html(self.selectOptions(list,block.tpl));
                    $win.find('.tpl').show();
                }else{
                    $win.find('.tpl').hide();
                }
            }else{
               $win.find('.tpl').hide(); 
            }
            self.post('getBlockConfig',{
               model:model,
               act:act,
               config:block.config
            },function(re){
                $win.find('.config').html(re);
            });
        });
        $win.find('#model').change();
    }
    
    this.editHtmlBlock = function(myb){
         var $win = self.createPop('Редактирование блока',null);
    }
    
    this.addHtmlBlock = function(myb){
        var $win = self.createPop('Добавление редактируемого блока',null);
    }
    
    this.getFormConfig = function($form){
        var data = {};
        $form.find('select,input').each(function(n,i){
            data[ $(i).attr('name') ] = $(i).val();
        })
        return data;
    }
    
    this.selectOptions = function(list,check){
        var html = '';
        $.each(list,function(n,i){
            var name = ($.type(i)=='string') ? i : i.name;
            html+= "<option value='"+n+"' "+((n==check)?'selected':'')+" >"+name+"</option>";
        });
        return html;
    }
}
struct.prototype = base;
struct = new struct();