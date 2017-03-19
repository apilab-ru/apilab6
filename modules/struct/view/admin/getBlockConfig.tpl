{foreach from=$set item=item key=key}
    <div class="line">
        <div class='nameCell'> {$item.name} </div>
        <div class='cell'>
        {if $item.type == 'select' || $item.type == 'multiselect'}
            <select name='{$key}' {if $item.type == 'multiselect'}multiple{/if}>
                {if $item.podtype=='struct'}
                    <option value='my' selected> -- Из текущего -- </option>
                    {widget name='struct' tpl='select' struct=$config[$key] all=1}
                {else}
                    <option value=""> --- </option>
                    {foreach from=$item.list item=it key=itemKey}
                        <option value="{$itemKey}" {if $itemKey|checked:$config[$key]}selected{/if}> {$it} </option>
                    {/foreach}
                {/if}
            </select>
        {/if}
        {if $item.type == 'number'}
            <input type='number' name='{$key}' value='{$config[$key]}'/>
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