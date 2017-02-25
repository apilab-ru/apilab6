{strip}
    <p> 
        <button type="button" class="btn btn-success">Добавить сотрудника</button> 
    </p>
    <table class="table table-striped table-bordered table-white">
        <tr>
            <th>#</th>
            <th>id</th>
            <th>name</th>
            <th>mail</th>
            <th>acess</th>
            <th>vk_id</th>
            <th></th>
        </tr>
        <tr class="filters">
            <td></td>
            <td>
                <input type="text" name="id" class="form-control">
            </td>
            <td>
                <input type="text" name="name" class="form-control">
            </td>
            <td>
                <input type="text" name="email" class="form-control">
            </td>
            <td>
                <input type="text" name="acess" class="form-control">
            </td>
            <td>
                <input type="text" name="vk_id" class="form-control">
            </td>
            <td>
            </td>
        </tr>
        {foreach from=$list item=item name=foo}
            <tr>
                <td> {$smarty.foreach.foo.iteration} </td>
                <td> {$item.id} </td>
                <td> {$item.name} </td>
                <td> {$item.mail} </td>
                <td> {$item.acess} </td>
                <td> {$item.vk_id} </td>
                <td>
                    <a href="" title="Просмотр">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a> 
                    <a href="" title="Редактировать">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a> 
                    <a href="" title="Удалить" data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="post">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        {/foreach}
    </table>
{/strip}