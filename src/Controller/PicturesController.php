<?php

namespace App\Controller;

class PicturesController extends AppController {
    public function index() {
        $json = json_encode(glob('img/*[.jpg]'));
        $response = $this->response->withStringBody($json);
        return $response;
    }
}