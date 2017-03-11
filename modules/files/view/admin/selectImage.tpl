{strip}
    <div class='uploadImageArea' ondrop="imageArea.ondrop(this,event)" ondragover="imageArea.ondrag(this,event)" ondragleave="imageArea.dragLeave(this,event)">
        <div class='image' myid="{$image.id}" mytype="{$image.type}">
        {if $image}
            <img src="{img id=$image.id type=$image.type tpl=admprev}" class='img-rounded' onclick="files.previewImage(this)">
            <div class='panel panel-default'>
                <div class='selectTplBox'>
                    <span class='name'> Шаблон </span>
                    <span class='value'>
                        <select class='no-search' id="tplSelectImage" onchange="files.changeSelectTpl(this)">
                            {foreach from=$tpls item=tpl}
                                <option value='{$tpl.alias}' {if $tpl.alias=='admprev'}selected{/if}> {$tpl.title} </option>
                            {/foreach}
                        </select>
                    </span>
                </div>
                <span class='btn btn-primary' title='Очистить выбор' onclick='files.clearSelect(this)'> Очистить </span>
                {if $act}
                    <span class='btn  btn-success' onclick='selectImage({$image.id},"{$image.type}")'> Выбрать </span>
                {/if}
            </div>
        {/if}
        </div>
        <input type='file' onchange="imageArea.changeFiles(files)" multiple/>
        <div class="status"></div>
    </div>
{/strip}