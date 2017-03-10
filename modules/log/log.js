function log(){
    this.name = "log";
    var self = this;
    this.from = "/";
    
    this.clear = function(){
        self.post('clear',null,function(){
            location.reload();
        })
    }
    
}
log.prototype = base;
log = new log();