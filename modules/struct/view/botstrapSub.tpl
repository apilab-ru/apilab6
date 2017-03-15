{strip}
<ul class="dropdown-menu">
    <li class='active'> <a href="/{if $first.alias}{$first.alias}/{/if}">{$first.name}</a></li>
    <li role="separator" class="divider"></li>
    {foreach from=$list item=item}
        <li class='{if $item.check}active{/if}'> 
            <a href="{$prefix}{$item.alias}/"> {$item.name} </a> 
            {if $item.childNodes}
                {include file='cust:menu/sub' list=$item.childNodes prefix=$prefix|cat:$item.alias|cat:"/"}
            {/if}
        </li>
    {/foreach}
</ul>
{/strip}