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
        <li class="">Админка</li>
        <li class="{if !$action}active{/if}">{$module}</li>
        {if $action}
            <li class="active">{$action}</li>
        {/if}
    </ol>
</section>
<section class="content">
{$content}
</section>
{/strip}