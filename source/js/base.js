function base(){
    
    this.post = function(action,send,callback){
        var hxr =  $.post("/ajax/"+this.name+"/"+action, {send: send},
        function (re, my) {
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

            if (typeof (callback) == 'function') {
                callback(re, mas)
            }
        });
        return hxr;
        
    }
}
base = new base();