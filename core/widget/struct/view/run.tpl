{strip}
    <ul class="nav nav-list structNav">
    {foreach from=$list item=item}
        {include file="item"|getTpl:$tplPath}
    {/foreach}
    </ul>
{/strip}