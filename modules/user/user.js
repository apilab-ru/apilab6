function user(){
    this.name = "user";
    var self = this;
    this.from = "/";
    
    this.vkAuth = function (data) {

        self.post('authVk', data, function (re, mas) {
            if (mas.action == 'auth') {
                window.location = self.from;
            }
            if (mas.action == 'register') {

            }
        })

    }
    
    this.auth = function (myb, event) {
        event.preventDefault();

        var form = {
            login: $('#name').val(),
            password: $('#pass').val()
        };
        if ($('#remember').prop('checked')) {
            form.remember = 1;
        }

        self.post('auth', form, function (re, mas) {
            
            if (mas.stat) {

                if (mas.cookie) {
                    var date = new Date(new Date().getTime() + 864000 * 1000);
                    document.cookie = "apilabuser=" + mas.cookie + "; path=/; expires: " + date.toUTCString();
                }
                window.location = self.from;
            } else {
                $('#error').css({display: 'table'}).html(mas.error);
            }
        })
    }
    
}
user.prototype = base;
user = new user();