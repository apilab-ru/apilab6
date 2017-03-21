{strip}
<div class="dd structList">
    <ol class="dd-list">
        {foreach from=$list item=item}
            {include file="razdelItem"|getTpl:$tplPath item=$item}
        {/foreach}
    </ol>
</div>
<div class="btnControll">
    <span class="btn btn-success" onclick="struct.controlEdit(0)"> Добавить </span>
</div>
{/strip}