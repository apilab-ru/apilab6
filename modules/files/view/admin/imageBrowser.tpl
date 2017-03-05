{strip}
<div class="d-flex flex-column">
    <div class="f-1 pageContentBox">
        {$content}
    </div>
    <div class="f-right">
        <h3> Разделы </h3>
        {widget name=struct func='admin.struct("files","images")' all=1 struct=$struct}
        <div class='selectImgBox'>
            {$selectImage}
        </div>
        <h3>
            Режим 
        </h3>
        <div class="btn-group">
            <button type="button" class="btn btn-default {if !$mode || $mode=='tile'}active{/if}" onclick="files.changeMode(this)" mode="tile"> Плитка </button>
            <button type="button" class="btn btn-default {if $mode=='list'}active{/if}" onclick="files.changeMode(this)" mode="list">Список</button>
        </div>
    </div>
</div>
{/strip}