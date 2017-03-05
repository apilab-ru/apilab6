{strip}
    {if $pages>1}
        <div class='customPaginator'>
            <ul class="pagination">
                {if $page>1}
                    {if $page>5}
                        <li>
                            <a onclick="{$func}(1);">1</a>
                        </li>
                        <li>
                            <a>«</a>
                        </li>
                    {/if}
                    {if $page-$delta<0}
                        {assign var=delta value=$page}
                    {/if}
                    {section start=1 name=j loop=5}
                        {if $page-$smarty.section.j.index > 0}
                            <li>
                                <a  onclick="{$func}({$page-$delta+$smarty.section.j.index});"> 
                                    {$page-$delta+$smarty.section.j.index} 
                                </a>
                            </li>
                        {/if}
                    {/section}
                {/if}
                <li class='active'>
                    <a class='chek'>{$page}</a>
                </li>
                {if $page < $pages}
                    {section start=1 name=j loop=5}
                        {if $page + $smarty.section.j.index < $pages}
                            <li>
                                <a onclick="{$func}({$page+$smarty.section.j.index})"> 
                                    {$page+$smarty.section.j.index} 
                                </a>
                            </li>
                        {/if}
                    {/section}
                {/if}
                {if $page+5 < $pages}
                    <li>
                        <a>»</a>
                    </li>
                {/if}
                {if $page!=$pages}
                    <li>
                        <a  onclick="{$func}({$pages});">{$pages}</a>
                    </li>
                {/if}
            </ul>
            <div class="count">
                Всего: <b>{$count}</b>
            </div>
        </div>
    {/if}
{/strip}