{strip}
    <form class="editForm">
        <div class="line">
            <label class="nameCell">Активен/Скрыт</label>
            <div class="cell">
                <label class="checkboxLabel">
                    <input type="checkbox" name="active" value="1" {if !$page || $page.active}checked{/if}>
                    <span class="checkIt"></span>
                </label>
            </div>
        </div>
        <div class="line">
            <label class="nameCell">Название</label>
            <div class="cell">
                <textarea rows="1" type="text" name="name" class="form-control">{$page.name}</textarea>
            </div>
        </div>
        <div class="line">
            <label class="nameCell">Ссылка</label>
            <div class="cell">
                <textarea rows="1" type="text" name="alias" class="form-control">{$page.alias}</textarea>
            </div>
        </div>
        <div class="line">
            <label class="nameCell">Заголовок</label>
            <div class="cell">
                <textarea rows="1" type="text" name="title" class="form-control">{$page.title}</textarea>
            </div>
        </div>
        <h3> SEO </h3>
        <div class="line">
            <label class="nameCell">Ключевые слова</label>
            <div class="cell">
                <textarea rows="1" type="text" name="keywords" class="form-control">{$page.keywords}</textarea>
            </div>
        </div>
        <div class="line">
            <label class="nameCell">Описание</label>
            <div class="cell">
                <textarea rows="1" type="text" name="description" class="form-control">{$page.description}</textarea>
            </div>
        </div>
        <div class="line flexSubmit">
            <button class="btn btn-success"> Сохранить </button>
        </div>
    </form>
{/strip}