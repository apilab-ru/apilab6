<div class="d-flex flex-column">
    <div class="f-1 pageContentBox">
        {include file="listContent"|getTpl:$tplPath}
    </div>
    <div class="f-right">
        <h3> Разделы </h3>
        {widget name=struct func='admin.struct("article","listContent")'}
    </div>
</div>