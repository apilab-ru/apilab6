{strip}
{foreach from=$list item=item}
    <option value="{$item.id}" {if $item.id==$struct}selected{/if}>{$before} {$item.title} </option>
    {if $item.childNodes}
        {include file="select"|getTpl:$tplPath list=$item.childNodes before=$before|cat:"--"}
    {/if}
{/foreach}
{/strip}