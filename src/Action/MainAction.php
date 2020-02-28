<?php

declare(strict_types=1);

namespace App\Action;

class MainAction
{
    public function handle(): string
    {
        ob_start();
        require_once 'templates/main.html.php';
        $content = ob_get_contents();
        ob_end_clean();

        return (string) $content;
    }
}
