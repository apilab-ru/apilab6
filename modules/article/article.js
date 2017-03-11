function article(){
    this.name = "article";
    var self = this;
    this.from = "/";
    
    this.initEditPage = function(){
        regRes.load('ckeditor',function(){ 
            CKEDITOR.replace('artEditPre',ckmin);
            CKEDITOR.replace('artEditText',ckdef);
        });
    }
    
    this.saveArticle = function(myb,event){
        event.preventDefault();
    }
    
    this.selectImage = function(myb){
        
    }
}
article.prototype = base;
article = new article();