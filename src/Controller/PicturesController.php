<?php

namespace App\Controller;

use Cake\Http\Exception\BadRequestException;
use PhpParser\Node\Expr\Array_;

class PicturesController extends AppController {
    public function index(int $page) {
        $pictures = glob('img/imgAPI/*.jpg');
        $json = Array();
        $index = 0;
        if ($page * 10 - 10 >= sizeof($pictures))
            throw new BadRequestException;
        for ($cpt = $page * 10 - 10; $cpt < $page * 10; $cpt++){
            if($cpt < sizeof($pictures)){
                $json[$index] = '<img src=\\..\\'. $pictures[$cpt] .' alt="image">';
                $index++;
            }
        }
        $array = Array(
            'title' => 'Accueil | Page ' . $page,
            'content' => $json
        );
        $this->set(compact('array'));
    }

    public function view() {
        $limit = $_GET['limit']??-1;
        $name = $_GET['name']??-1;
        $exif = array();
        $cpt = 0;

        if ($name == -1) {
            $pictures = glob('img\*.jpg');
        }
        else {
            $pictures = glob('img\\'. $name . '.jpg');
        }

        foreach($pictures as $image) {
            if ($cpt < $limit || $limit == -1) {
                $exif[$image]['description'] = exif_read_data($image)['ImageDescription']??'No description';
                $exif[$image]['comment'] = exif_read_data($image)['COMPUTED']['UserComment']??'No Comment';
                $exif[$image]['author'] = exif_read_data($image)['Artist']??'No author';
                $exif[$image]['width'] = exif_read_data($image)['COMPUTED']['Width']??'No width';
                $exif[$image]['height'] = exif_read_data($image)['COMPUTED']['Height']??'No height';
                $exif[$image]['html'] = '<img src=..\\' . $image . ' alt=' . $exif[$image]['comment'] . '>';
                $cpt++;
            }
        }
        $json = json_encode($exif);
        $response = $this->response->withStringBody($json);
        return $response;
    }

    public function select($name) {
        $pictures = glob('img\\imgAPI\\'. $name . '.jpg');
        if ($pictures == null){
            throw new BadRequestException;
        }
        else {
            foreach($pictures as $image) {
                $exif[$image]['name'] = exif_read_data($image)['FileName']??'No name';
                $exif[$image]['description'] = exif_read_data($image)['ImageDescription']??'No descritpion';
                $exif[$image]['comment'] = exif_read_data($image)['COMPUTED']['UserComment']??'No Comment';
                $exif[$image]['author'] = exif_read_data($image)['Artist']??'No author';
                $exif[$image]['width'] = exif_read_data($image)['COMPUTED']['Width']??'No width';
                $exif[$image]['height'] = exif_read_data($image)['COMPUTED']['Height']??'No height';
                $exif[$image]['html'] = '<img src=\\..\\' . $image . ' alt=' . $exif[$image]['comment'] . '>';
                $this->set(compact('image'));
                $this->set(compact('exif'));
            }
        }
        
    }
}
