{foreach from=$set item=item key=key}
    <div class="line">
        <div class='nameCell'> {$item.name} </div>
        <div class='cell'>
        {if $item.type == 'select'}
            <select name='{$key}'>
                {if $item.podtype=='struct'}
                    <option value='my' checked> -- Из текущего -- </option>
                    {widget name='struct' tpl='select' struct=$config[$key] all=1}
                {else}
                    <option value=""> --- </option>
                    {foreach from=$item.list item=it key=itemKey}
                        <option value="{$itemKey}"> {$it} </option>
                    {/foreach}
                {/if}
            </select>
        {/if}
        </div>
        {if $item.actions}
            <div class="actions">
                {foreach from=$item.actions item=it}
                    <span class="control {$it.class}" onclick="{$it.func}(this)"> {$it.name} </span>
                {/foreach}
            </div>
        {/if}
    </div>
{/foreach}