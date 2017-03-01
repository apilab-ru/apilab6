function admin(){
    
    var self = this;
    this.name = 'admin';
    
    this.init = function(){
        $(document).on('click','.adminMenu a',function(event){
            event.preventDefault();
            var data = $(this).attr('href');
            self.history('/admin/'+data,null,$(this).find('span').text());
            
            data = data.split("/");
            
            var $li = $(this).parents('li:first');
            
            $li.siblings('.active').removeClass('active');
            $li.find('.active').removeClass('active');
            $li.addClass('active');
            
            self.post('getContent',{module:data[0],action:data[1]},function(re){
                $('.boxContent').html(re);
            })
        });
        
        $(document).on('click','.structNav li',function(event){
            event.stopPropagation();
            $(this).siblings('.active').removeClass('active');
            $(this).find('.active').removeClass('active');
            $(this).addClass('active');
        })
        
    }
    
    this.struct = function(module,act){
        return function(id){
            self.history(null,{struct:id});
            
            var filter = self.getFilter();
            
            self.post('module',{
                module:module,
                action:act,
                param : {struct:id}
            },function(re){
                $('.pageContentBox').html( re );
            })
        }
    }
    
    this.pageModule = function(module,action){
        return function(id){
            var prevLink = self.getLink();
            self.history('/admin/'+module + "/" + action,{id:id});
            self.post('getContent',{
                module:module,
                action:action,
                param:{id:id},
                prev:prevLink
            },function(re,mas){
                $('.boxContent').html(re);
            })
        }
    }
    
}
admin.prototype = base;
admin = new admin();