<?php
use Model\TasksModel;

class TasksController extends Core\AbstractController
{
    public function actionCreate()
    {
        if (isset($_POST["name"]))
        {
           $model = new TasksModel($_POST);
           echo $model->save() ? "Ваше задание сохранено" : '';
           exit;
        }

        $this->renderView('task_form');
    }

    public function actionUpdate()
    {
        if (\Core\App::$isAdmin) {
            $model = TasksModel::findOne($_GET['id']);

            if (isset($_POST["name"]) && $model) {
                $newData = $_POST;
                //Проверяем изменялся ли текст
                if (strcmp($model->fields['text'], $newData['text']) != 0) {
                    $newData['text_modified'] = 1;
                }
                //Проверяем флаг выполнения
                if (isset($newData['completed'])) $newData['completed'] = 1;
                else $newData['completed'] = 0;

                $model->fields = $newData;
                echo $model->save() ? "Ваше задание сохранено" : '';
                exit;
            }

            $this->renderView('task_form', ['model' => $model->fields]);
        }else{
            header('Location: index.php?r=site/login');
            exit;
        }
    }

    public function actionDelete()
    {
        if (\Core\App::$isAdmin) {
            $model = TasksModel::findOne($_GET['id']);
            $model->delete();

            header('Location: index.php?r=site/index');
            exit;
        }
    }
}