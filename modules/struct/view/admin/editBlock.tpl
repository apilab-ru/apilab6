{strip}
    <form class="editBlock editForm">
        <div class="line">
            <label class="nameCell" for="email">Модуль:</label>
            <div class="cell">
                <select name="model" id="model">
                    {foreach from=$modules item=item key=key}
                        <option value="{$key}" {if $block.model==$key}selected{/if}> {$item.name} </option>
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="line">
            <label class="nameCell" for="act">Блок:</label>
            <div class="cell">
                <select name="act" id="act"></select>
            </div>
        </div>

        <div class="line tpl">
            <label class="nameCell" for="tpl">Шаблон:</label>
            <div class="cell">
                <select name="tpl" id="tpl"></select>
            </div>
        </div>

        <div class="line config">

        </div>

        <div class='line'>
            <span class='btn btn-primary controlSet'> Применить </span>
        </div>
    </form>
{/strip}