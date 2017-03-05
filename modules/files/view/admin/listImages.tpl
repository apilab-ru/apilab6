{strip}
    <div class='listFiles' mode="{$mode}">
        {if $list}
        {foreach from=$list item=item}
            <div class="item panel panel-default {if $image==$item.id}active{/if}" myid='{$item.id}' onclick="files.selectImg({$item.id},this)">
                <img src='{img tpl='admlist' id=$item.id type=$item.type}' class="img-rounded">
                <div class='info'>
                    <div class="line">
                        <div class="name">Название</div>
                        <div class="descr">
                            {$item.name}
                        </div>
                    </div>
                    {if $item.descr}
                        <div class="line">
                            <div class="name">Описание</div>
                            <div class="descr">
                                {$item.descr}
                            </div>
                        </div>
                    {/if}
                    <div class="line">
                        <div class="name">Дата</div>
                        <div class="descr">
                            {$item.date_add}
                        </div>
                    </div>
                </div>
            </div>
        {/foreach} 
        {else}
            <div class="alert alert-info">
                Нет файлов
            </div>
        {/if}
    </div>
   {widget name=pagination count=$count limit=$limit func="admin.page('files','images')"}
{/strip}