<ul class="dropdown-menu">
    {foreach from=$list item=item}
        <li class='item {if $item.check}check{/if}'> 
            <a href="{$prefix}{$item.alias}/"> {$item.name} </a> 
            {if $item.childNodes}
                {include file='cust:menu/sub' list=$item.childNodes prefix=$prefix|cat:$item.alias|cat:"/"}
            {/if}
        </li>
    {/foreach}
</ul>