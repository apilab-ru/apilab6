{strip}
    <div class="JQDblock" myid="{$block.id}">
        {if $list}
            <div class="container">
                <div class="row">

                    <div class="col-md-8">
                        
                        {if $title}
                        <h1 class="page-header">
                            {$title}
                            {if $smallTitle}
                            <small>{$smallTitle}</small>
                            {/if}
                        </h1>
                        {/if}

                        {foreach from=$list item=item}
                        <section class='article'>
                            <h2>
                                <a href='?art={$item.id}'>
                                    {$item.title}
                                </a>
                            </h2>
                            {if $item.authorName}
                            <p class="lead">
                                Автор {$item.authorName}
                            </p>
                            {/if}
                            {if $item.date_start}
                            <p><span class="glyphicon glyphicon-time"></span> Добавлено {$item.date_start|date:"d.m.Y H:i"}</p>
                            {/if}
                            {if $item.image}
                                <img src='{img type=$item.image.type id=$item.image.id tpl=$imgTpl}'/>
                                <hr>
                            {/if}
                            <p>
                                {$item.pre|nl2br}
                            </p>
                            <a  href="?art={$item.id}" class="btn btn-primary">
                                Читать дальше <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                            <hr>
                        </section>
                        {/foreach}

                    {widget name=pagination count=$count limit=$limit link=$block|linkPage}
                </div>
            </div>
        </div>
    {/if}
</div>
{/strip}