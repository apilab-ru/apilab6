function admin() {

    var self = this;
    this.name = 'admin';
    this.curModule = null;

    this.init = function () {
        $(document).on('click', '.adminMenu a', function (event) {
            event.preventDefault();
            var data = $(this).attr('href');
            if (data) {
                self.history(data, null, $(this).find('span').text());
                data = data.split("/");
                self.curModule = {module: data[2], action: data[3]};
                self.reloadModule();
            }

            var $li = $(this).parents('li:first');
            $li.siblings('.active').removeClass('active');
            $li.find('.active').removeClass('active');
            $li.addClass('active');

        });

        $(document).on('click', '.structNav li', function (event) {
            event.stopPropagation();
            $(this).siblings('.active').removeClass('active');
            $(this).find('.active').removeClass('active');
            $(this).addClass('active');
        })

    }

    this.reloadModule = function () {

        if (!self.curModule) {
            var data = location.pathname.split('/');
            self.curModule = {module: data[2], action: data[3]};
        }

        self.post('getContent', self.curModule, function (re) {
            $('.boxContent').html(re);
        })
    }

    this.struct = function (module, act) {
        return function (id) {
            var filter = self.getFilter();
            filter.struct = id;
            filter.page = 1;
            self.history(null, filter);
            self.post('module', {
                module: module,
                action: act,
                param: filter
            }, function (re) {
                $('.pageContentBox').html(re);
            })
        }
    }

    this.pageModule = function (module, action) {
        return function (id) {
            var prevLink = self.getLink();
            self.history('/admin/' + module + "/" + action, {id: id});
            self.post('getContent', {
                module: module,
                action: action,
                param: {id: id},
                prev: prevLink
            }, function (re, mas) {
                $('.boxContent').html(re);
            })
        }
    }

    this.page = function (module, action) {
        return function (page) {
            var filter = self.getFilter();
            filter.page = page;
            self.history('/admin/' + module + "/" + action, filter);
            self.post('module', {
                module: module,
                action: action,
                param: filter
            }, function (re) {
                $('.pageContentBox').html(re);
            })
        }
    }

    this.call = function (module) {
        return function (action, param, callback) {
            self.history(null, param);
            self.post('module', {
                module: module,
                action: action,
                param: param,
            }, callback)
        }
    }

    this.ajax = function (module) {
        return function (action, param, callback) {
            self.post('module', {
                module: module,
                action: action,
                param: param,
            }, callback)
        }
    }

    this.translete = function (word, callback) {
        self.post('translete', {word: word}, function (re, mas) {
            if (mas.res) {
                callback(mas.res);
            }
        })
    }

}
admin.prototype = base;
admin = new admin();