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
}
base = new base();

popUp = function(message, type){
    
}

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
}
regRes = new regRes();