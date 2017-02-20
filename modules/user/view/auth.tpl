{strip}
<html>
    <meta name="viewport" content="width=device-width">
    <style>
        html,body{
            padding: 0px;
            margin: 0px;
        }
        form{
            display: table;
            padding: 30px 50px;
            border: 1px solid #ddd;
            margin: 70px auto 30px;
            border-radius: 3px;
            background: linear-gradient(to bottom, #e0e0e0 3%,#ffffff 52%); 
        }
        input{
            display: block;
            margin: 10px 0;
            padding: 0 20px;
            line-height: 14px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            color: #333;
            height: 40px;
        }
        h2{
            margin: 0px;
            padding: 0 0 20px 0;
            text-align: center;
            font-family: serif;
        }
        button{
            margin-top: 20px;
            display: block;
            cursor: pointer;
            background: linear-gradient(to bottom, #1e8dac 0%,#1e8dac 100%);
            color:#fff;
            padding: 20px;
            border: none;
            width: 100%;
            font-size: 14px;
        }
        #error{
            display: none;
            margin: 0px auto 0;
            border:2px solid red;
            padding: 20px;
        }
    </style>
    <body>
        <form>
            <h2> Авторизация </h2>
            <input type="text" name="login" id="name" placeholder="Логин">
            <input type="password" name="password" id="pass" placeholder="Пароль">
            <div class="submitLine">
                <button> Войти </button>
            </div>
        </form>
        <div id="error"></div>
        
            {*<script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>

            <script type="text/javascript">
              VK.init({ apiId: 5732959 });
            </script>

            <div id="vk_auth"></div>
            <script type="text/javascript">
            VK.Widgets.Auth("vk_auth", { width: "200px", onAuth: function(data) {
             alert('user '+data['uid']+' authorized');
            } });
            </script>*}
        
    </body>
    {utils name=js current='jqary'}
    <script>
        $('form').on('submit',function(e){
            e.preventDefault();
            var form = {
                login: $('#name').val(),
                password: $('#pass').val()
            };
            
            $.post("/ajax/user/auth", { send:form },
                function (re, my) {
                    var tt = re.match(".*<ja>(.*?)<\/ja>.*");
                    if (tt != null) {
                        var mas = $.parseJSON(tt[1]);
                    } else {
                        mas = {};
                    }
                    
                    console.log('result',mas,re);
                    
                    if(mas.stat){
                        window.location = "/";
                    }else{
                        $('#error').css({ display:'table' }).html(mas.error);
                    }
                });
        })
    </script>
</html>
{/strip}