<?php

declare(strict_types=1);

namespace App\Action;

use App\Service\Authenticity;

class CheckAuthenticityAction
{
    public function handle(): string
    {
        $content = json_decode(file_get_contents('php://input'), true);
        $inn = $content['inn'] ?? '';

        if ('' === $inn) {
            return $this->errorJsonResponse(['message' => 'ИНН не указан.']);
        }

        return $this->successJsonResponse(
            (new Authenticity())->get($inn)
        );
    }

    private function successJsonResponse(array $data = []): string
    {
        return $this->jsonResponse(array_merge(
            $data,
            ['status' => 'success']
        ));
    }

    private function errorJsonResponse(array $data = []): string
    {
        return $this->jsonResponse(array_merge(
            $data,
            ['status' => 'error']
        ));
    }

    private function jsonResponse(array $data = []): string
    {
        return json_encode($data);
    }
}
