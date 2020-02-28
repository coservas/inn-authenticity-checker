<?php

declare(strict_types=1);

namespace App;

use App\Action\CheckAuthenticityAction;
use App\Action\MainAction;

class Application
{
    public function process(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST' && preg_match('#^\/check-authenticity$#', $uri)) {
            echo (new CheckAuthenticityAction())->handle();
            return;
        }

        if ($uri !== '/') {
            header('Location: /');
            return;
        }

        echo (new MainAction())->handle();
    }
}
