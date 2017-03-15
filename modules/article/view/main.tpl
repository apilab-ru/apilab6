{strip}
<div class="JQDblock" myid="{$block.id}">
    {if $item.image}
        <img src='{img id=$item.image.id type=$item.image.type tpl='mainart'}'/>
    {/if}
    <h2> {$item.title} </h2>
    <p>{$item.text}</p>
</div>
{/strip}