function simple(){
    this.name = "simple";
    var self = this;
    this.from = "/";
    
}
simple.prototype = base;
simple = new simple();