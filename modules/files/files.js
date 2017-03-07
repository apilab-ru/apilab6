function files(){
    this.name = "files";
    var self = this;
    this.from = "/";

    this.call = admin.call("files");

    this.selectImg = function(id,myb){
        if(myb){
            $(myb).addClass('active')
                  .siblings('.active').removeClass('active');
        }
        
        self.call("selectImage",{
            image:id
        },function(re,mas){
            $('.selectImgBox').html(re);
            self.initImageArea();
            //console.log('selectImg',re,mas);
        });
    }
    
    this.changeMode = function(myb){
        var mode = $(myb).attr('mode');
        $(myb).addClass('active')
              .siblings('.active').removeClass('active');
        $('.listFiles').attr({'mode':mode});
        self.history(null,{mode:mode});
    }
    
    this.clearSelect = function(myb){
        $(myb).parent().html('');
        $('.listFiles .active').removeClass('active');
        self.history(null,{image:0});
    }
    
    this.initImageArea = function(){
        var imageArea = {
            link : "/ajax/files/uploadImage",
            box : function(){
                return $('.uploadImageArea');
            }(),
            getParam : function(){
                return {
                    struct : self.getFilter().struct ? self.getFilter().struct : 0
                };
            },
            files : null,
            ondrop : function(myb,event){
                event.preventDefault();
                this.files = event.dataTransfer.files;
                this.uploadFiles();
            },
            changeFiles : function(files){
                imageArea.files = files; 
                imageArea.uploadFiles();
            },
            ondrag : function(myb){
                $(myb).addClass('drag');
            },
            dragLeave : function(myb){
                $(myb).removeClass('drag');
            },
            uploadProgress : function(event){
                var percent = parseInt(event.loaded / event.total * 100);
                imageArea.box.find('.status').text('Загрузка: ' + percent + '%');
            },
            stateChange : function(event,n1,n2){
                if (event.target.readyState == 4) {
                    if (event.target.status == 200) {
                        popUp('Успешно');
                        imageArea.box.find('.status').text('');
                        
                        var data = files.parseSend(this.response);
                        if(data.mas.stat){
                            if(imageArea.callback){
                               imageArea.callback(data.re,data.mas)
                            }
                        }else{
                            console.log('data',data);
                            popUp('Ошибка ','error');
                        }
                    } else {
                        popUp('Ошибка подключения');
                    }
                }
            },
            uploadFiles : function(){
                this.box.removeClass('drag');
                
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', this.uploadProgress, false);
                xhr.onreadystatechange = this.stateChange;
                xhr.open('POST', this.link, true);
                
                var formData = new FormData();
                $.each(this.files,function(n,i){
                     formData.append("file["+n+"]", i);
                });
                $.each(this.getParam(),function(n,i){
                    formData.append(n, i);
                })
                
                xhr.send(formData);
            }
        };
        
        imageArea.callback = function(re,mas){
            admin.page('files','images')(1);
        }
        
        return imageArea;
    }
    
    this.removeImage = function(id,myb,e){
        e.stopPropagation();
        e.preventDefault();
        $(myb).parents('.item:first').remove();
        self.post('removeImage',id,function(re){
            console.log('remove image',re);
        })
    }
    
}
files.prototype = base;
files = new files();