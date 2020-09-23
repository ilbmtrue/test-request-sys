<?php

class SiteController
{
    public function actionIndex()
    {
        require_once(ROOT . '/views/index.php');
        return true;
    }
    public function actionSuccess()
    {
        require_once(ROOT . '/views/success.php');
        return true;
    }
}
