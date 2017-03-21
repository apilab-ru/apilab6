function struct(){
    this.name = "struct";
    var self = this;
    this.from = "/";
    this.nav = null;
    this.alias = null;
    
    this.ajax = admin.ajax('struct');
    
    this.selectNav = function(id,alias,myb){
        $('#page').attr({src:alias});
        self.nav = id;
        self.alias = alias;
        $('.curNav').html( $(myb).find('.n').text() );
    }
    
    this.iframeLoad = function(myb){
        myb.contentWindow.window.PageScripts.load('/modules/struct/structClinent.js',function(){ 
            self.client = myb.contentWindow.window.structClient;
            self.initClient();
        })
    }
    
    this.openCurrent = function(){
        if(self.alias == null){
            popUp('Выберите раздел структуры');
            return false;
        }
        window.open(self.alias);
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
        if(self.nav == null){
            popUp('Выберите раздел структуры');
            return false;
        }
        var block = {model:null};
        var $win = self.createPop('Добавление блока', null);
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
        console.log('selectOptions',list);
        $.each(list,function(n,i){
            var name = ($.type(i)=='string') ? i : i.name;
            html+= "<option value='"+n+"' "+((n==check)?'selected':'')+" >"+name+"</option>";
        });
        return html;
    }
    
    this.initRazdels = function(){
        regRes.load('nestable',function(){
            $('.structList')
                .nestable()
                .on('change', function() {
                    var list = $('.structList').nestable('serialize');
                    console.log('list',list);
                });
        })
    }
    
    this.reloadStruct = function(){
        self.ajax('reloadStruct',{},function(re){
            $('.pageContentBox').html(re);
            struct.initRazdels();
        });
    }
    
    this.controlEdit = function(id,myb){
        if(id==0){
            var title = 'Создание раздела';
        }else{
            var title= 'Редактирование раздела '+id;
        }
        var $win = self.createPop(title,null);
        self.ajax('editStruct',{id:id},function(re){
            $win.update( re );
        });
        $win.on('change','[name=name]',function(){
            if($win.find('[name=alias]').val() == '' && id!=2){
                admin.translete($(this).val(),function(re){
                    $win.find('[name=alias]').val(re);
                });
            }
        })
        $win.on('submit','form',function(event){
            event.preventDefault();
            var form = self.serialize($(this));
            self.loader( $(this).find('.submitForm') );
            self.ajax('controlEdit',{form:form,id:id},function(re,mas){
                console.log(re,mas);
                if(mas.stat){
                    self.reloadStruct();
                    $win.close();
                }else{
                    popUp('Ошибка');
                }
            })
        })
    }
    
    this.controlRemove = function(id,myb){
        var $par = $(myb).parents('li:first');
        if($par.find('li').length > 0){
            popUp('Нельзя удалить раздел с вложенными разделами');
            return false;
        }else{
            $par.remove();
            self.ajax('removePage',{id:id});
        }
    }
}
struct.prototype = base;
struct = new struct();