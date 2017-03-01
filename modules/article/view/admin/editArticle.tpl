<style>

</style>
<form class="editForm">
    {*<div class="d-flex">
    <div class="f-1">
    <img src="{img id=0 type=jpg tpl=0x0}"/>
    </div>
    </div> *}
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Заголовок</h3>
                </div>
                <div class="panel-body">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Ключевые слова</h3>
                </div>
                <div class="panel-body">
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="imgBox">
                <img class="img-thumbnail" src="{img id=0 type=jpg tpl=0x0}"/>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Раздел</h3>
                </div>
                <div class="panel-body">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Время публикации</h3>
                </div>
                <div class="panel-body">
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control">
                        <div class="input-group-addon">
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
                <textarea name="text" id="artEditText"></textarea>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Превью
                </div>
                <textarea name="pre" id="artEditPre"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Теги
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <button class="btn btn-success"> Сохранить </button>
        </div>
    </div>
</form>
