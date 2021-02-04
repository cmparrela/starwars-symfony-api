<?php

namespace App\Controller;

use App\ResponsePayload;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    protected function respondSuccess($data = null, $statusCode = 200): JsonResponse
    {
        $payload = new ResponsePayload($data);
        return $this->json($payload, $statusCode);
    }

    protected function respondError($error = null, $statusCode = 400): JsonResponse
    {
        $payload = new ResponsePayload(null, $error);
        return $this->json($payload, !empty($statusCode) ? $statusCode : 400);
    }
}
