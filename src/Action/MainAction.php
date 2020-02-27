<?php

declare(strict_types=1);

namespace App\Action;

class MainAction
{
    public function handle(): int
    {
        return require_once 'templates/main.html.php';
    }
}
