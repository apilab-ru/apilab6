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
        input[type=text],input[type=password]{
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
        
        label.checkbox span{
            position: relative;
        }
        
        label.checkbox span:before {
            content: "";
            display: inline-block;
            width: 15px;
            height: 15px;
            border: 1px solid #ccc;
            float: left;
            margin-right: 10px;
            border-radius: 2px;
        }
        label.checkbox input {
            display: none;
        }
        label.checkbox input:checked + span:after{
            content: "x";
            position: absolute;
            top: -2px;
            left: -22px;
            color: #136b84;
        }
        .vkAuth{
            margin-top: 15px;
        }
    </style>
    <body>
        <form onsubmit="user.auth(this,event)">
            <h2> Авторизация </h2>
            <input type="text" name="login" id="name" placeholder="Логин">
            <input type="password" name="password" id="pass" placeholder="Пароль">
            <label class="checkbox">
                <input type="checkbox" name="remember" value="1" id="remember">
                <span> Запомнить меня </span>
            </label>
            <div class="submitLine">
                <button> Войти </button>
            </div>
            <div id="vk_auth" class="vkAuth"></div>
        </form>
        <div id="error"></div>
        
        {if $vkapid}
            <script type="text/javascript" src="//vk.com/js/api/openapi.js?139"></script>
            <script type="text/javascript">
              VK.init({ apiId: {$vkapid} });
            </script>
            <script type="text/javascript">
            VK.Widgets.Auth("vk_auth", { width: "200px", onAuth: function(data){ user.vkAuth(data) } });
            </script>
        {/if}
        
    </body>
    {utils name=js}
    <script>
        user.from = "{$from}";
    </script>
</html>
{/strip}