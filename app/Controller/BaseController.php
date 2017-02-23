<?php

namespace Controller;


abstract class BaseController
{
    /** @var array */
    private $viewData = [];

    protected function view($viewName, $dataArray = NULL)
    {

        $dataArray = $dataArray ? $dataArray : $this->viewData;
        extract($dataArray, EXTR_PREFIX_ALL, 'view');
        if (is_file(__DIR__ . '/../view/' . $viewName . '.php')) {
            require_once(__DIR__ . '/../view/' . $viewName . '.php');
        }

        return;
    }
}