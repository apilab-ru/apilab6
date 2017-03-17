<li class='{if $item.childNodes}treeview{/if} {if $item.check}active{/if}'>
    {if $prefix}
         {assign var='alias' value=$prefix|cat:$item.alias:"/"}
    {else}
        {if $item.alias}
            {assign var='alias' value="/"|cat:$item.alias:"/"}
        {else}
            {assign var='alias' value="/"}
        {/if}
    {/if}
    <a myid="{$item.id}" onclick='{$func}({$item.id},"{$alias}",this)'>
        <span class='n'> {$item.name} </span>
        {if $item.childNodes}
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
        {/if}
    </a>
    {if $item.childNodes}
        <ul class="nav nav-list">
            {foreach from=$item.childNodes item=it}
                {include file="item"|getTpl:$tplPath item=$it prefix=$alias}
            {/foreach}
        </ul>
    {/if}
</li>