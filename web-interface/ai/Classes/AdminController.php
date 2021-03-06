<?php

class AdminController
    extends AController
{

    public function actionSites()
    {
        $instUsers = Users::Instance();
        $user = $instUsers->Get();
        if(!isset($user) or (isset($user) and $user['admin'] != 1)) {   // проверка прав доступа
            header('Location: index.php?r=admin/denied');
            exit;
        }
        
        global $link;
        $view = new View();
        $model = Sites::Instance();

        //удаление сайта
        $id = mysqli_real_escape_string($link, $_GET['id']);
        $model->Sites_deleteOne($id);
        $view->sites = $model->Sites_getAll();

        //добавление сайта
        if(isset($_POST['insert']) and $_POST['name'] == ""){
            $new_error = true;
        }
        else{
            if(isset($_POST['insert']) and isset($_POST['name'])){
                $name = mysqli_real_escape_string($link, $_POST['name']);
                $url = mysqli_real_escape_string($link, $_POST['url']);
                $site_id = $model->Sites_setOne($name);
                $model->Pages_setOne($url, $site_id);
                $view->sites = $model->Sites_getAll();
            }
        }
        // Вывод в шаблон.
        $view->title = 'Интерфейс администратора';
        $view->user = $instUsers->Get();
        $html = $view->display('sites.php');
        echo $html;
    }

    public function actionPersons()
    {
        $instUsers = Users::Instance();
        $user = $instUsers->Get();
        if(!isset($user) or (isset($user) and $user['admin'] != 1)) {   // проверка прав доступа
            header('Location: index.php?r=admin/denied');
            exit;
        }

        global $link;
        $view = new View();
        $model = Persons::Instance();

        //удаление персоны
        $id = mysqli_real_escape_string($link, $_GET['id']);
        $model->Persons_deleteOne($id);
        $view->persons = $model->Persons_getAll();

        //добавление персоны
        if(isset($_POST['insert']) and $_POST['name'] == ""){
            $new_error = true;
        }
        else{
            if(isset($_POST['insert']) and isset($_POST['name'])){
                $name = mysqli_real_escape_string($link, $_POST['name']);
                $model->Persons_setOne($name);
                $view->persons = $model->Persons_getAll();
            }
        }
        // Вывод в шаблон.
        $view->title = 'Интерфейс администратора';
        $view->user = $instUsers->Get();
        $html = $view->display('persons.php');
        echo $html;
    }

    public function actionKeywords()
    {
        $instUsers = Users::Instance();
        $user = $instUsers->Get();
        if(!isset($user) or (isset($user) and $user['admin'] != 1)) {   // проверка прав доступа
            header('Location: index.php?r=admin/denied');
            exit;
        }

        global $link;
        $view = new View();
        $model = Keywords::Instance();

        $person_id = mysqli_real_escape_string($link, $_GET['person_id']);
        $view->person = $model->Persons_getOne($person_id);

        //удаление ключевых слов
        $id = mysqli_real_escape_string($link, $_GET['id']);
        $model->Keywords_deleteOne($id);
        $view->keywords = $model->Keywords_getAll($person_id);

        //добавление ключевых слов
        if(isset($_POST['insert']) and $_POST['name'] == ""){
            $view->new_error = "Заполните все поля";
        }
        else {
            if (isset($_POST['insert']) and isset($_POST['name'])) {
                $name = mysqli_real_escape_string($link, $_POST['name']);
                $name_2 = mysqli_real_escape_string($link, $_POST['name_2']);
                $distance = mysqli_real_escape_string($link, $_POST['distance']);
                $model->Keywords_setOne($name, $name_2, $distance, $person_id);
                $view->keywords = $model->Keywords_getAll($person_id);
            }
        }

        // Вывод в шаблон.
        $view->title = 'Интерфейс администратора';
        $view->user = $instUsers->Get();
        $html = $view->display('keywords.php');
        echo $html;
    }

    public function actionDenied(){
        // Вывод в шаблон.
        $view = new View();
        $view->title = ' >> СТОП';
        $html = $view->display('denied.php');
        echo $html;
    }
}
