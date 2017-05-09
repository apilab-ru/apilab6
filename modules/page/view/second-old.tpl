{strip}
<html>
    <head>
        <title>{$title}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="{$keywords}" />
        <meta name="description" content="{$description}" />
        <link rel="shortcut icon" href="/favicon.ico?1" type="image/x-icon">
    </head>
    <body>
        <div class='JQDgroup' myid='10'>
            {$group[10]}
        </div>
        <div class='JQDgroup' myid='1'>
            {$group[1]}
        </div>
        <div class="mainContent JQDgroup" myid='0'>
            {$group[0]}
        </div>
        <div class="footer">
            <div class="contacts">
                <div class="mainContent JQDgroup" myid='5'>
                {$group[5]}
                </div>
                <a class='creator' target='_blank' href='http://apilab.ru/'>
                    <span>Разработка</span>
                </a>
            </div>
        </div>
    </body>
    {utils name=js}
    {utils name=css}
</html>
{/strip}