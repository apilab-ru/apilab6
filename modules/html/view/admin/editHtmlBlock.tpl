{strip}
<form class="editHtmlBlock editForm">
    <div class="line">
        <label class="nameCell" for="name">Название:</label>
        <div class="cell">
            <input class='form-control' type='text' name='name' value='{$block.name}'>
        </div>
    </div>
    <div class="line"> Содержимое </div>
    <div class='line'>
        <textarea  name='html' id='htmlBlock{$smarty.now}'>{$block.html}</textarea>
    </div>
    <div class='line right'>
        <button class='btn btn-success'> Сохранить </button>
    </div>
</form>
{/strip}