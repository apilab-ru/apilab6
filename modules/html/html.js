function html(){
    this.name = "html";
    var self = this;
    this.from = "/";
    
    this.call = admin.call("html");
    this.ajax = admin.ajax("html");
    
    this.addHtmlBlockList = function(){
        self.addHtmlBlock(function(mas){
            admin.reloadModule();
        });
    }
    
    this.addHtmlBlock = function(callback){
        var $win = self.createPop('Добавление html блока',null,'90%');
        var textId = null;
        self.call('editHtmlBlock',{id:0},function(re,mas){
            $win.update(re);
            textId = $win.find('textarea').attr('id')
            regRes.load('ckeditor',function(){ 
                CKEDITOR.replace(textId,ckdef);
            });
        });
        $win.on('submit', function (event) {
            event.preventDefault();
            var send = {
                name: $win.find('[name=name]').val(),
                html: CKEDITOR.instances[textId].getData()
            };
            self.ajax('saveHtmlBlock', {block: send, id: 0}, function (re, mas) {
                console.log('saveHtmlBlock',re, mas);
                $win.close();
                popUp('Успешно');
                callback(mas);
            })
        })
    }
    
    this.editHtmlBlockList = function(id){
        self.editHtmlBlock(id,function(){
            admin.reloadModule();
        })
    }
    
    this.editHtmlBlock = function(id,callback){
        var $win = self.createPop('Редактирование html блока#'+id,null,'90%');
        var textId = null;
        self.call('editHtmlBlock', {id: id}, function (re, mas) {
            $win.update(re);
            textId = $win.find('textarea').attr('id');
            regRes.load('ckeditor', function () {
                CKEDITOR.replace(textId, ckdef);
            });
        });
        $win.on('submit',function(event){
            event.preventDefault();
            var send = {
                name : $win.find('[name=name]').val(),
                html : CKEDITOR.instances[textId].getData()
            };
            self.ajax('saveHtmlBlock',{block:send,id:id},function(re,mas){
                $win.close();
                popUp('Успешно');
                callback(mas);
            })
        });
    }
}
html.prototype = base;
html = new html();