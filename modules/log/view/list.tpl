<html>
    <head>
        <title> log </title>
        {utils name=css}
        {utils name=js}
        {utils name=js module=admin}
    </head>
    <body>
        <span class="btn btn-success" onclick="log.clear()">Очистить</span>
        <table class="table table-striped table-bordered table-white">
            <tr>
                <th style="width:40px">#id</th>
                <th class="t2">date</th>
                <th>name</th>
                <th>param</th>
                <th></th>
            </tr>
            {foreach from=$list item=item}
                <tr>
                    <td style="width:40px"> {$item.id} </td>
                    <td class="t2"> {$item.date_create} </td>
                    <td> {$item.name} </td>
                    <td> <pre>{$item.log}</pre></td>
                    <td></td>
                </tr>
            {/foreach}
        </table>
    </body>
    <style>
        .t2{
            width:100px;
        }
    </style>
</html>