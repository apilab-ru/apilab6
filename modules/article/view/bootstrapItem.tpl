{strip}
<div class="JQDblock" myid="{$block.id}">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1>{$article.title}</h1>
                {if $article.authorName}
                    <p class="lead">
                        Автор: {$article.authorName} 
                    </p>
                {/if}
                <hr>
                <p><span class="glyphicon glyphicon-time"></span> Добавлено {$article.date_start|date:"d.m.Y H:i"}</p>
                {if $article.image}
                <hr>
                <img class="img-responsive" src="{img type=$article.image.type id=$article.image.id tpl=$imgTpl}" alt="">
                {/if}
                <hr>
                <p class="lead">
                    {$article.text}
                </p>
                <hr>
            </div>
        </div>
    </div>
</div>
{/strip}