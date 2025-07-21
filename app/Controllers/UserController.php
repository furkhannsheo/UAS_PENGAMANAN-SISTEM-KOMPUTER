<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json';

    public function show($id = null)
    {
        return $this->respond($this->model->find($id));
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON();
        $this->model->update($id, [
            'username' => $data->username,
            'email' => $data->email,
        ]);

        return $this->respond(['message' => 'Updated']);
    }
}
