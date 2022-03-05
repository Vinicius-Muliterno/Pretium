<?php

namespace Source\Controllers;

use League\Plates\Engine;

/**
 * ABSTRACT CLASS CONTROLLER
 */
abstract class Controller
{
    /**
     * @var
     */
    protected $view;
    /**
     * @var
     */
    protected $router;

    /**
     * @param $router
     */
    public function __construct($router)
    {
        $this->view = Engine::create(__DIR__ . "/../Views/", "php");
        $this->router = $router;
    }

    /**
     * @param string $param
     * @param array $values
     * @return string
     */
    public function ajaxResponse(string $param, array $values): string
    {
        return json_encode([$param=>$values]);
    }
}