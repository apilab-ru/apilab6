{strip}
    <table class="table table-striped table-bordered table-white table-hover table-central">
        <tr>
            <th>#</th>
            {foreach from=$labels item=name}
                <th>{$name}</th>
            {/foreach}
            <th></th>
        </tr>
        <tr class="filters">
            <td></td>
            {foreach from=$labels item=name key=key}
                <td>
                    {if $filters[$key]}
                        {if $filters[$key]=='text'}
                            <input type="text" name="{$key}" class="form-control">
                        {elseif $filters[$key]=='numeric'}
                            <input type="numeric" name="{$key}" class="form-control">
                        {elseif $filters[$key]=='checkbox'}
                            <input type="checkbox" name="{$key}">
                        {elseif $filters[$key]=='date'}  
                            <input type="text" name="{$key}" class="form-control">
                        {/if}
                    {/if}
                </td>
            {/foreach}
            <td>
            </td>
        </tr>
        {foreach from=$list item=item name=foo}
            <tr>
                <td> {$smarty.foreach.foo.iteration} </td>
                
               {foreach from=$labels item=name key=key}
                <td>
                    {$item[$key]}
                </td>
                {/foreach}
                
                <td>
                    {if $actions.view}
                    <a title="Просмотр" class="linkBox">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a> 
                    {/if}
                    {if $actions.edit}
                    <a title="Редактировать" onclick="{$actions.edit}({$item.id})" class="linkBox">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a> 
                    {/if}
                    {if $actions.delete}
                    <a title="Удалить" onclick="{$actions.delete}({$item.id})" class="linkBox">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                    {/if}
                </td>
            </tr>
        {/foreach}
    </table>
{/strip}