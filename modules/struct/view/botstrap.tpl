{strip}
<nav class="navbar navbar-default {if $fixed}navbar-fixed-top{/if} JQDblock" myid="{$block.id}">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Меню</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">На главную</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        {foreach from=$list item=item}
            <li class='{if $item.check}active{/if} {if $item.childNodes}dropdown{/if}'>
                {if $item.childNodes}
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        {$item.name} <span class="caret"></span>
                    </a>
                    {if $item.alias && $item.alias!=''}
                        {assign var='prefix' value='/'|cat:$item.alias:'/'}
                    {else}
                        {assign var='prefix' value='/'}
                    {/if}
                    {include file="botstrapSub"|getTpl:$tplPath list=$item.childNodes prefix=$prefix first=$item}
                {else}
                    <a href="/{if $item.alias}{$item.alias}/{/if}"> {$item.name} </a>
                {/if}
            </li>
        {/foreach}
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
{/strip}