<?php

namespace App\Controller;

class PicturesController extends AppController {
    public function index() {
        $pictures = glob('img/*.jpg');
        $json = json_encode($pictures, JSON_PRETTY_PRINT);
        print_r($json);
        $response = $this->response->withStringBody($json);
        return $response;
    }

    public function view() {
        $pictures = glob('img/*.jpg');
        foreach($pictures as $image) {
            $exif[$image]['description'] = exif_read_data($image)['ImageDescription']??'No descritpion';
            $exif[$image]['comment'] = exif_read_data($image)['Comment']??'No comment';
            $exif[$image]['author'] = exif_read_data($image)['Artist']??'No author';
            $exif[$image]['width'] = exif_read_data($image)['width']??'No width';
            $exif[$image]['height'] = exif_read_data($image)['height']??'No height';
            $exif[$image]['html'] = '<img src=\"' . $image . '\" alt=\"' . $exif[$image]['comment'] . '\">';
        }
        $json = json_encode($exif, JSON_PRETTY_PRINT);
        $response = $this->response->withStringBody($json);
        return $response; 
    }
}