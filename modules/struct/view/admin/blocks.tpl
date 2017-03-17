{strip}
<div class='adminBlocks'>
    <div class='rightPanel togleBox'>
        <div class='togleLine'>
            <span class='togle' title='Показать/Скрыть навигацию' onclick='struct.togle(this)'></span>
            <span class='name'>Навигация</span>
        </div>
        {widget name='struct' func='struct.selectNav'}
        <div class='curNav'></div>
    </div>
    <div class='page'>
        <iframe id='page' class='popIframe' onload='struct.iframeLoad(this)'></iframe>
    </div>
    <div class='botPanel'>
        <span class="btn btn-success" onclick="struct.saveNav()"> Сохранить </span>
    </div>
</div>
{/strip}