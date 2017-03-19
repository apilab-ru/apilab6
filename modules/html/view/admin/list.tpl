<p> 
    <button type="button" 
            onclick="html.addHtmlBlockList()" 
            class="btn btn-success">
        Добавить HTML блок
    </button> 
</p>
{widget 
    name=tableList 
    list=$list
    labels=[
       "id"=>"ID",
       "author"=>"Автор",
       "name"=>"Название",
       "html"=>"Содержимое"
    ]
    filters=[
        "id"=>"numeric",
        "name"=>"text",
        "author"=>"select"
    ]
    actions = [
        "edit"=>"html.editHtmlBlockList",
        "delete"=>"admin.deleteItem('html','deleteHtml')"
    ]
}