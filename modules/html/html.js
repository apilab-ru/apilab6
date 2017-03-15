function html(){
    this.name = "html";
    var self = this;
    this.from = "/";
    
}
html.prototype = base;
html = new html();