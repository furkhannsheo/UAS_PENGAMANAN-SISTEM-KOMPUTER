<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $authHeader);

        if (!$token) {
            return Services::response()->setStatusCode(401)->setJSON(['error' => 'Token not found']);
        }

        try {
            $decoded = JWT::decode($token, getenv('JWT_SECRET'), ['HS256']);
            return;
        } catch (\Exception $e) {
            return Services::response()->setStatusCode(401)->setJSON(['error' => 'Invalid token']);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
