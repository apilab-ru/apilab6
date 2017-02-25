<li {if $item.childNodes}class='treeview'{/if}>
    <a myid="{$item.id}" onclick='{$func}({$item.id})'>
        <span> {$item.name} </span>
        {if $item.childNodes}
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
        {/if}
    </a>
    {if $item.childNodes}
        <ul class="nav nav-list">
            {foreach from=$item.childNodes item=it}
                {include file="item"|getTpl:$tplPath item=$it}
            {/foreach}
        </ul>
    {/if}
</li>