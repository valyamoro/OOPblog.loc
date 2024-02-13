<?php

namespace app\Controllers;

class ErrorController extends BaseController
{
    public function _404(): string
    {
        return $this->view->render('_404', 'error');
    }

}
