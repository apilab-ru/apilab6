function article(){
    this.name = "article";
    var self = this;
    this.from = "/";
    
    this.initEditPage = function(){
        regRes.load('ckeditor',function(){ 
            CKEDITOR.replace('artEditPre',ckmin);
            CKEDITOR.replace('artEditText',ckdef);
        });
        /*regRes.load('datepicker',function(){
            $('.datePicker').datepicker({
                format: {
            });
        })*/
        regRes.load('datetimepicker',function(){
            $.datetimepicker.setLocale('ru');
            $('.datePicker').datetimepicker({
                format:'d.m.Y H:i',
            });
            $('.dateTimePickerItem').on('click',function(){
                $('.datePicker').datetimepicker('show');
            })
        })
    }
    
    this.saveArticle = function(myb,event){
        event.preventDefault();
        var data = {};
        $(myb).find('input').each(function(n,i){
            var $inp = $(i);
            data[$inp.attr('name')] = $inp.val();
        })
        $(myb).find('textarea').each(function(n,i){
            var $inp = $(i);
            var id = $inp.attr('id');
            data[$inp.attr('name')] = CKEDITOR.instances[id].getData();
        })
        console.log('saveArt',data)
    }
    
    this.selectImage = function(myb){
        self.selectArtImage = function(image){
            $('.imgBox img').attr({src:'/content/images/'+image.id+"_0x0."+image.type});
            $win.close();
        }
        var $win = self.createPop('Выбор картинки',{
                iframe:'/module/files/imageBrowser?act=selectImage'+'&func=selectArtImage&module=article'
            },screen.width - 300);
        $win.setBack();
    }
}
article.prototype = base;
article = new article();