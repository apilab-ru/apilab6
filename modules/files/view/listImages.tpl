{strip}
    <div class="JQDblock" myid="{$block.id}">
        <div class='listImage'>
        {foreach from=$list item=item}
            <a href="{img id=$item.id tpl='0x0' type=$item.type}" target='_blank' class="gallery license"> 
                <img src='{img id=$item.id tpl=$imageTpl type=$item.type}'/>
            </a>
        {/foreach}
        </div>
        {widget name=pagination count=$count limit=$limit link=$block|linkPage}
    </div>
{/strip}