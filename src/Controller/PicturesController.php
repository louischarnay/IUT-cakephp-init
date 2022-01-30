<?php

namespace App\Controller;

class PicturesController extends AppController {
    public function index() {
        $pictures = glob('img/*.jpg');
        $json = json_encode($pictures);
        print_r($json);
        $response = $this->response->withStringBody($json);
        return $response;
    }

    public function view() {
        $pictures = glob('img\*.jpg');
        $limit = $_GET['limit']??-1;
        $name = $_GET['name']??-1;
        $cpt = 0;
        foreach($pictures as $image) {
            if ($cpt < $limit || $limit == -1) {
                $exif[$image]['description'] = exif_read_data($image)['ImageDescription']??'No descritpion';
                $exif[$image]['comment'] = exif_read_data($image)['COMPUTED']['UserComment']??'No Comment';
                $exif[$image]['author'] = exif_read_data($image)['Artist']??'No author';
                $exif[$image]['width'] = exif_read_data($image)['COMPUTED']['Width']??'No width';
                $exif[$image]['height'] = exif_read_data($image)['COMPUTED']['Height']??'No height';
                $exif[$image]['html'] = '<img src=..\\' . $image . ' alt=' . $exif[$image]['comment'] . '>';
                $cpt++;
            }
        }
        if ($name == -1){
            $json = json_encode($exif);
        }
        else {
            $json = json_encode($exif['img\\' . $name]);
        }
        $response = $this->response->withStringBody($json);
        return $response;
    }
}