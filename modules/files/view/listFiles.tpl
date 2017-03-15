<div class="listDocs JQDblock" myid="{$block.id}">
    {foreach from=$list item=item}
        <a href="{$item.path}" class="item {$item.type|strtolower}" title="Скачать" target="_blank">{$item.name}</a>
    {/foreach}
    {widget name=pagination count=$count limit=$limit link=$block|linkPage}
</div>