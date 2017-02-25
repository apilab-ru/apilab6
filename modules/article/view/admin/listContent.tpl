<p> 
    <button type="button" 
            onclick="admin.pageModule('article','editArticle')(0)" 
            class="btn btn-success">
        Добавить Статью
    </button> 
</p>
{widget 
    name=tableList 
    list=$list
    labels=[
       "id"=>"ID",
       "struct_name"=>"Раздел",
       "title"=>"Заголовок",
       "active"=>"Опубликованно",
       "date_change"=>"Дата изменения",
       "date_start"=>"Дата публикации"
    ]
    filters=[
        "id"=>"numeric",
        "title"=>"text",
        "active"=>"checkbox",
        "date_change"=>"date",
        "date_start"=>"date"
    ]
    actions = [
        "edit"=>"admin.pageModule('article','editArticle')",
        "delete"=>"admin.deleteItem('article','deleteArticle')"
    ]
}