<?/*
Шаблон страницы управления справочником ключевых слов
=======================

$keywords - массив строк ключевых слов

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
    <article>
        <h1>
            <?=$person['name'];?>
        </h1>
    </article>
    <br>
    Введите искомые слова:
    <br/>
    <br>
    <input size="30" name="name" placeholder="ключевое слово 1" value="" autofocus required/>
    <input size="30" name="name_2" placeholder="ключевое слово 2" value="" required/>
    <input name="distance" pattern="^[ 0-9]+$" placeholder="интервал, число" value="" required/>
    <br/>
    <br>
    <input type="submit" name="insert" value="Добавить" />
    <br>
    <?php if ($new_error): ?>
        <p style="color:red; font-weight:bold;">Заполните все поля формы</p>
    <?php else: ?>
        <table>
            <tr>
                <td>Ключевое слово 1</td>
                <td>Ключевое слово 2</td>
                <td>Интервал</td>
                <td>Действие</td>
            </tr>
            <?php foreach ($keywords as $keyword): ?>
                <tr>
                    <td width="300">
                        <?=$keyword['name'];?>
                    </td>
                    <td width="300">
                        <?=$keyword['name_2'];?>
                    </td>
                    <td width="250">
                        <?=$keyword['distance'];?>
                    </td>
                    <td>
                        <a href="index.php?r=admin/keywords&person_id=<?=$person['id'];?>&id=<?=$keyword['id']?>">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php endif ?>
</form>
</body>
</html>