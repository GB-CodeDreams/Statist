<?/*
Шаблон страницы управления справочником личностей
=======================

$persons - массив строк личностей

*/?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Интерфейс администратора</title>
    <link rel="stylesheet" type="text/css" media="screen" href="view/style.css" />
</head>
<body>
<h1><?php echo "$title"; ?></h1>
<br/>
<?php 
if(isset($user)){
    echo 'Привет, '.$user['username'].'.<br/><br/><a href="index.php?r=user/logout">Выход</a>';
}else{
    echo '<a href="index.php?r=user/login">Вход</a>'; }
?> |
<a href="../../web-interface/ui/php/index.php?c=statistic&act=general_statistics">Панель пользователя</a> |
<a href="index.php?r=admin/sites">Справочник сайтов</a> |
<a href="index.php?r=admin/persons">Справочник личностей</a> |
<form method="post">
    <br>
    Введите имя:
    <br>
    <br>
    <input size="35" name="name" value="" autofocus/>
    <br>
    <br>
    <input type="submit" name="insert" value="Добавить" />
    <br>
    <table>
        <tr>
            <td>Имя личности</td>
            <td colspan="2">Действие</td>
        </tr>
        <?php foreach ($persons as $person): ?>
            <tr>
                <td>
                    <article>
                        <?=$person['name'];?>
                    </article>
                </td>
                <td width="100">
                    <a href="index.php?r=admin/persons&id=<?=$person['id']?>">Удалить</a>
                </td>
                <td>
                    <a href="index.php?r=admin/keywords&person_id=<?=$person['id']?>">Задать набор искомых слов</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>
</body>
</html>