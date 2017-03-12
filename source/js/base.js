function base(){
    
    this.post = function(action,send,callback){
        var hxr =  $.post("/ajax/"+this.name+"/"+action, {send: send},
        function (re) {
            
            var data = base.parseSend(re);
            
            if (typeof (callback) == 'function') {
                callback(data.re, data.mas)
            }
        });
        return hxr;
        
    }
    
    this.parseSend = function (re) {
        var res = re.split('<ja>');
        if (res[1] != undefined) {
            var text = res[0];
            res = res[1].split('</ja>');
            text += res[1];
            re = text;
            var mas = $.parseJSON(res[0]);
        } else {
            var mas = {};
        }
        return {
            re: re,
            mas: mas
        };
    }
    
    this.getDataPage = function(){
        var data={};
        
        var query = location.search.substr(1);
        
        if(query == ''){
            return {};
        }else{
            var list = query.split('&'); 
            $.each(list,function(n,i){ 
                var names = i.split('='); 
                data[names[0]]=names[1]  
            })
        }
        return data;
    }
    
    this.getFilter = function(){
        var data = this.getDataPage();
        if(data.param){
            var set = JSON.parse(decodeURIComponent(data.param));
        }else{
            var set = {};
        }
        return set;
    }
    
    
    this.history = function (link, param, title) {

        if (title) {
            $('title').html(title);
        }

        if (link == null) {
            link = location.pathname;
        }

        if (param) {
            var set = this.getFilter();

            $.each(param, function (key, it) {
                set[key] = it;
            });

            var data = this.getDataPage();
            
            data.param = JSON.stringify(set);
            
            var arr = [];
            $.each(data,function(n,i){
                arr.push(n+"="+i);
            })
            link += "?"+arr.join('&');
        }

        history.replaceState(null, title, link);
    }
    
    this.getLink = function(){
        return location.pathname + location.search;
    }
    
    this.createPop = function(title,html,width){
        var $div = $("<div/>",{
            class: 'popWin'
        });

        var $close = $('<div/>',{
            class: 'close',
            title: 'Закрыть',
            html : "Х"
        })

        if(title){
            var $title = $("<div/>",{
                class : 'popTitle',
                html: title
            })
            $div.append($title);
            $div.title = function(re){
                $title.html( re );
            }
        }

        if($.type(html)=='object' && html.iframe){
            html = "<iframe src="+html.iframe+" class='popIframe'></iframe>"
        }

        var $content = $('<div/>',{
            class : 'popContent',
            html  : html
        })
        $div.append($content);
        $div.append($close);

        var calbacks = [];

        $div.close = function(){
            $div.remove();
            $.each(calbacks,function(n,i){
                i( $div );
            })
        }
        $div.data('close',function(){
            $div.close();
        })
        $close.on('click', function(){
            $div.close()
        });

        $div.update = function(re){
            $content.html( re );
        }
        
        $div.addCallback = function(call){
            calbacks.push(call);
        }

        var $box = $('.popBox');
        if($box.length == 0){
            $box = $('<div/>',{
            class: 'popBox'
            });
            $('body').append($box);
        }
        $box.append($div);

        if(width){
           $div.css({width:width}); 
        }

        $div.toCenter = function(width){
            var width = (width) ? width : $div.outerWidth();
            var left = (screen.width - width ) / 2;
            $div.css({left:left});
        }
        
        $div.setBack = function(){
            var $back = $('<div/>',{
                class:'staticBack'
            });
            $box.append($back);
            $('body').css({overflow:'hidden'});
            $div.addCallback(function(){
               $back.remove();
               $('body').css({overflow:'auto'});
            });
        }
        
        $div.toCenter();

        return $div;
    }
}
base = new base();

popUp = function(message, type){
    
}

PageStyles = new (function () {
    function fn() {
        var self = this;
        this.load = function (h, success, force) {
            if (typeof (h) == 'string') {
                var isLoad = false;
                for (var i = 0; i < document.styleSheets.length; i++) {
                    if (document.styleSheets[i].href !== null) {
                        if (new URL(document.styleSheets[i].href).pathname == h) {
                            isLoad = i;
                            break;
                        }
                    }
                }
                if (isLoad === false || force === true) {
                    if (isLoad !== false) {
                        $(document.styleSheets[isLoad].ownerNode).remove();
                    }
                    var el = $('<link rel="stylesheet" type="text/css" href="' + h + ((force) ? '?sum=' + ("0123456789".gen(3)) : "") + '" />');
                    el.on('load', function () {
                        if (typeof (success) == 'function') {
                            success();
                        }
                    });
                    $('head').append(el);
                } else {
                    if (typeof (success) == 'function') {
                        success();
                    }
                }
            } else if (typeof (h) == 'object' && h.constructor.name == 'Array') {
                var l = 0;
                var onload = function () {
                    l++;
                    if (l == h.length) {
                        if (typeof (success) == 'function') {
                            success();
                        }
                    }
                }
                for (var i = 0; i < h.length; i++) {
                    self.load(h[i], onload, force);
                }
            }
        }
    }
    return new fn();
});

var PageScripts = new (function () {
    function fn() {
        var self = this;

        var loadStack = {};

        var CallSuccess = function (h) {
            if (h in loadStack) {
                for (var i = 0; i < loadStack[h].length; i++) {
                    loadStack[h][i]();
                }
                delete(loadStack[h]);
            }
        }

        this.load = function (h, success, force) {
            if (typeof (h) == 'string') {
                if (typeof (success) == 'function') {
                    if (!(h in loadStack)) {
                        loadStack[h] = [];
                    }
                    loadStack[h].push(success);
                }
                var isLoad = false;
                for (var i = 0; i < document.scripts.length; i++) {
                    if (document.scripts[i].src) {
                        if (new URL(document.scripts[i].src).pathname == h) {
                            isLoad = i;
                            break;
                        }
                    }
                }
                if (isLoad === false || force === true) {
                    if (isLoad !== false) {
                        $(document.scripts[isLoad].ownerNode).remove();
                    }
                    $.getScript(h + ((force) ? '?sum=' + ("0123456789".gen(3)) : ""), function () {
                        CallSuccess(h);
                    });
                } else {
                    CallSuccess(h);
                }
            } else if (typeof (h) == 'object' && h.constructor.name == 'Array') {
                var l = 0;
                var onload = function () {
                    l++;
                    if (l == h.length) {
                        if (typeof (success) == 'function') {
                            success();
                        }
                    }
                }
                for (var i = 0; i < h.length; i++) {
                    self.load(h[i], onload, force);
                }
            }
        }
    }
    return new fn();
})();


function regRes(){
    var self = this;
    
    var aviable = {};
    
    var init = {};
    
    this.add = function(name,link){
       aviable[name] = link; 
    }
    
    this.load = function(name,callback){
        PageScripts.load(aviable[name],callback);
    }
    
    this.waitLoad = function(name,callback){
        var func = function(){
            if(name in window){
                callback();
            }else{
                setTimeout(func,100);
            }
        }
        
        func();
    }
    
    this.getAviable = function(){
        return aviable;
    }
}
regRes = new regRes();