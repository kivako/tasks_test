<script>
    $(document).ready(function() {
        $('#table-tasks').DataTable({
                "pageLength": 3,
                "bLengthChange": false,
                "searching": false
        }
        );
    } );
</script>

<div style="margin: 10px 0px">
    <a href="index.php?r=tasks/create" class="btn btn-success" role="button">Добавить...</a>
</div>
<table id="table-tasks" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Имя</th>
            <th>Email</th>
            <th>Текст</th>
            <th>Статус</th>
            <?php if (Core\App::$isAdmin) : ?>
                <th>Действия</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($model as $item) {
            ?>
            <tr>
                <td><?= $item['name']?></td>
                <td><?= $item['email']?></td>
                <td><?= $item['text']?></td>
                <td><?php
                    if ($item['completed']) echo 'Выполнено <br>';
                    if ($item['text_modified']) echo 'Отредактировано администратором';
                    ?>
                </td>
                <?php if (Core\App::$isAdmin) : ?>
                    <td>
                        <a href="index.php?r=tasks/update&id=<?= $item['id'] ?>" class="btn btn-warning" role="button">Редактировать</a>
                        <a href="index.php?r=tasks/delete&id=<?= $item['id'] ?>" class="btn btn-danger" role="button">Удалить</a>
                    </td>
                <?php endif; ?>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
