<?php
use Model\TasksModel;

class SiteController extends Core\AbstractController
{
    public function actionIndex()
    {
        $model = new TasksModel();
        $this->renderView('index', ['model'=>$model->findAll()]);
    }

    public function actionLogin()
    {
        if (isset($_POST['uname']))
        {
            if (($_POST['uname'] == 'admin') && ($_POST['pswd'] == '123'))
            {
                $_SESSION['isAdmin'] = true;
                header('Location: index.php?r=site/index');
                exit;
            }

            $message = "Вы указали не верный логин или пароль";
        }

        $this->renderView('login_form', isset($message) ? ['message'=>$message] : null);
    }

    public function actionLogout()
    {
        if ($_SESSION['isAdmin'])
            unset($_SESSION['isAdmin']);
            header('Location: index.php?r=site/index');
            exit;
    }
}