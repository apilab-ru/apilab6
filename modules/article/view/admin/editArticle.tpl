{strip}
<form class="editForm" onsubmit="article.saveArticle(this,event)">
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Заголовок</h3>
                </div>
                <div class="panel-body">
                    <input type="text" name="title" class="form-control" value="{$article.title}">
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Ключевые слова</h3>
                </div>
                <div class="panel-body">
                    <input type="text" name="keywords" class="form-control" value="{$article.keywords}">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="imgBox" onclick="article.selectImage(this)">
                <input type="hidden" name="img_id" value="{$article.image.id|default:0}">
                <img class="img-thumbnail" src="{img id=$article.image.id|default:0 type=$article.image.type|default:0 tpl=0x0}"/>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Раздел</h3>
                </div>
                <div class="panel-body">
                    <select name="struct_id">
                    {widget name=struct tpl=select struct=$article.struct_id}
                    </select>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Время публикации</h3>
                </div>
                <div class="panel-body">
                    <div class="input-group date" data-provide="datepicker" style="width:170px">
                        <input type="text" name="date_start" class="form-control datePicker" value="{if $article.date_start}
                               {$article.date_start|date:"d.m.Y H:i"}
                               {else}
                               {$smarty.now|date:"d.m.Y H:i"}    
                               {/if}">
                        <div class="input-group-addon dateTimePickerItem">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Текст статьи
                </div>
                <textarea name="text" id="artEditText">{$article.text}</textarea>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Превью
                </div>
                <textarea name="pre" id="artEditPre">{$article.pre}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Теги
                </div>
                <div class="panel-body tags">
                    {foreach from=$article.tags item=tag}
                        <tag myid="{$tag.id}"> {$tag.name} </tag>
                    {/foreach}
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <button class="btn btn-success"> Сохранить </button>
        </div>
    </div>
</form>
<script>
    if('article' in window){
        article.initEditPage();
    }else{
        document.addEventListener("DOMContentLoaded", function(event) { 
            article.initEditPage();
        });
    }
</script>
{/strip}