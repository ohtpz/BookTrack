<?php
namespace Elpommier\BookTrack\controllers;


use Slim\Views\PhpRenderer;
use Elpommier\BookTrack\models\User;

abstract class BaseController {

    /**
     * @var PhpRenderer
     */
    protected PhpRenderer $view;

    /**
     * Constructor
     */
    function __construct()
    {
        $this->view = new PhpRenderer(__DIR__ . '/../../views', [
            'user' => User::current()
        ]);

        $this->view->setLayout("layout.php");
    }
}

