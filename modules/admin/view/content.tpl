{strip}
<section class="content-header">
    <h1>
        {$title}
        {if $description}
            <small>{$description}</small>
        {/if}
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class=""><a href="/admin/"><u>Админка</u></a></li>
        <li class="{if !$action}active{/if}">
            {if $action}<a href="{$prev}"><u>{/if}{$module}{if $action}</u></a>{/if}
        </li>
        {if $action}
            <li class="active"><a href="">{$action}</a></li>
        {/if}
    </ol>
</section>
<section class="content">
{$content}
</section>
{/strip}