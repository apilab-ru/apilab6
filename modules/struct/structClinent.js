function structClient(){
    this.name = "struct";
    var self = this;
    this.from = "/";
    
    this.parent = null;
    
    this.init = function(parent){
        
        regRes.load('ui',function(){
            $('.JQDblock').draggable({
                /*drag: function (e) {
                    console.log(e);
                }*/
            });
            
            $('.JQDgroup').droppable({
                tolerance:"pointer",
                over: function (e, i) {
                    var parent = $(e.target);
                    $(parent).addClass('onOver');
                },
                out: function (e, i) {
                    var parent = $(e.target);
                    $(parent).removeClass('onOver');
                },
                drop: function (e, i) {
                    var parent = $(e.target);
                    $(parent).removeClass('onOver');
                    var draggable = $(i.draggable[0]);
                    $(parent).append(draggable);
                    $(draggable).css({'top': '0px', 'left': '0px'});
                    if(draggable.data('callback')){
                        draggable.data('callback')();
                    }
                }
            });
        });
        
        self.parent = parent;
        PageStyles.load('/modules/struct/structClient.css?4');
        $('.JQDgroup').each(function(n,i){
            var myid = $(i).attr('myid');
            if(myid=='0'){
                var title= 'Модуль страницы';
            }else{
                var title = 'Группа '+myid;
            }
            $(i).prepend( $('<gr/>',{
                html:title
            }) );
        });
        
        $('.JQDblock').each(function (n, i) {
            var id = $(i).attr('myid');
            self.post('getBlockParam', {id: id, nav: self.parent.nav}, function (re, block) {
                var $re = $(re);
                $(i).prepend($re);
                $(i).on('click','.control.edit',function(){
                    $('.JQDblock.edit').removeClass('edit');
                    var $block = $(i);
                    $block.addClass('edit');
                    
                    $block.deactiveEdit = function(){
                        $block.removeClass('edit');
                    }
                    
                    self.parent.editBlock(block,$block);
                });
                
                $(i).on('click','.control.delete',function(){
                    $(i).remove();
                });
                
                $(i).data('getBlock',function(){
                    return block;
                })
            });
        });
    }
    
    this.getGroups = function(){
        var groups = {};
        $('.JQDgroup').each(function(n,i){
            var myid = $(i).attr('myid');
            groups[myid] = [];
            var weight = 0;
            $(i).find('.JQDblock').each(function(n2,i2){
                weight ++;
                var block = $(i2).data('getBlock')();
                block.weight = weight;
                block.group = myid;
                if(block.is_default){
                    block.id = 0;
                    delete(block.is_default);
                }
                groups[myid].push(block);
            })
        });
        return groups;
    }
    
    this.addBlock = function (block) {

        var $block = $('<div/>', {
            class: 'JQDblock newBlock',
            html: 'Ноый блок'
        }).draggable();

        $block.setCallback = function (call) {
            $block.data('callback', function(){
                call();
                $block.data('callback', null);
                $block.css({position:'relative'});
                $block.removeClass('newBlock');
            });
        }

        $block.on('click', '.control.edit', function () {
            $('.JQDblock.edit').removeClass('edit');
            $block.addClass('edit');
            $block.deactiveEdit = function () {
                $block.removeClass('edit');
            }
            self.parent.editBlock(block, $block);
        });
        $block.on('click', '.control.delete', function () {
            $block.remove();
        });
        $block.data('getBlock', function () {
            return block;
        })
        
        $block.css({
            top:$('body').scrollTop(),
            position:'absolute'
        });
        
        $('body').append( $block );

        return $block;
    }
    
}
structClient.prototype = base;
structClient = new structClient();