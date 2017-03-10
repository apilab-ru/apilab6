{strip}
    <div class='uploadImageArea' ondrop="imageArea.ondrop(this,event)" ondragover="imageArea.ondrag(this,event)" ondragleave="imageArea.dragLeave(this,event)">
        <div class='image'>
        {if $image}
            <div class='clearBut btn btn-primary' title='Очистить выбор' onclick='files.clearSelect(this)'> Очистить </div>
            <img src="{img id=$image.id type=$image.type tpl=admprev}" class='img-rounded'>
        {/if}
        </div>
        <input type='file' onchange="imageArea.changeFiles(files)" multiple/>
        <div class="status"></div>
    </div>
    <script>
        /*document.addEventListener("DOMContentLoaded", function(event) { 
            window.imageArea = files.initImageArea();
        });*/
    </script>
{/strip}