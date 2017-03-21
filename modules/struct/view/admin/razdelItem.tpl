{strip}
<li class="dd-item" data-id="{$item.id}">
    <div class="dd-handle"></div>
    <span class="dd-content"> 
        <span>
            {$item.name} 
        </span>
        <a class="glyphicon glyphicon-pencil" onclick="struct.controlEdit({$item.id},this)"></a>
        <a class="glyphicon glyphicon-trash" onclick="struct.controlRemove({$item.id},this)"></a>
    </span>
    {if $item.childNodes}
        <ol class="dd-list">
            {foreach from=$item.childNodes item=it}
                {include file="razdelItem"|getTpl:$tplPath item=$it}
            {/foreach}
        </ol>
    {/if}
</li>
{/strip}