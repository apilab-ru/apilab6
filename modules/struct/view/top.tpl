{strip}
<div class="menu JQDblock">
    <ul>
        {foreach from=$list item=item name=foo}
        <li class="item {if $item.check}check{/if}">
            <a href="/{$item.alias}{if $item.alias}/{/if}"> {$item.name} </a>
            {if $item.childNodes}
                {if $item.alias && $item.alias!=''}
                    {assign var='prefix' value='/'|cat:$item.alias:'/'}
                {else}
                    {assign var='prefix' value='/'}
                {/if}
                {include file="sub"|getTpl:$tplPath list=$item.childNodes prefix=$prefix}
            {/if}
        </li>
        {/foreach}
    </ul>
</div>
{/strip}