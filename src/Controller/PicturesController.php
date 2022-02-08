<?php

namespace App\Controller;

use App\Model\Entity\Pictures;
use Cake\Http\Exception\BadRequestException;
use PhpParser\Node\Expr\Array_;

class PicturesController extends AppController {
    public function index(int $page) {
        $pictures = $this->Pictures
            ->find()
            ->all()
            ->toArray();
        $index = 0;
        if ($page * 10 - 10 >= sizeof($pictures))
            throw new BadRequestException;
        for ($cpt = $page * 10 - 10; $cpt < $page * 10; $cpt++){
            if($cpt < sizeof($pictures)){
                $result[$index] = '<img src=\\..\\'. $pictures[$cpt]->path .' alt="image">';
                $index++;
            }
        }
        $array = Array(
            'title' => 'Accueil | Page ' . $page,
            'content' => $result
        );
        $this->set(compact('array'));
    }

    public function view() {
        $limit = $_GET['limit']??-1;
        $name = $_GET['name']??-1;
        $exif = array();
        $cpt = 0;

        if ($name == -1) {
            $pictures = $this->Pictures
                ->find()
                ->contain('Comments')
                ->toArray();
        }
        else {
            $pictures = $this->Pictures
                ->find()
                ->contain('Comments')
                ->where(['name LIKE' => $name])
                ->toArray();
        }

        if ($pictures == null){
            throw new BadRequestException;
        }

        foreach($pictures as $image) {
            if ($cpt < $limit || $limit == -1) {
                $exif[$image->name]['description'] = exif_read_data($image->path)['ImageDescription']??'No description';
                $exif[$image->name]['comment'] = exif_read_data($image->path)['COMPUTED']['UserComment']??'No Comment';
                $exif[$image->name]['author'] = exif_read_data($image->path)['Artist']??'No author';
                $exif[$image->name]['width'] = exif_read_data($image->path)['COMPUTED']['Width']??'No width';
                $exif[$image->name]['height'] = exif_read_data($image->path)['COMPUTED']['Height']??'No height';
                $exif[$image->name]['html'] = '<img src=..\\' . $image->path . ' alt=' . $exif[$image->name]['comment'] . '>';
                $cpt2 = 0;
                foreach($image['comments'] as $comment){
                    $exif[$image->name]['comments'][$cpt2] = $comment->content;
                    $cpt2++;
                }
                $cpt++;
            }
        }
        $json = json_encode($exif);
        $response = $this->response->withStringBody($json);
        return $response;
    }

    public function select($name) {
        $pictures = $this->Pictures
            ->find()
            ->contain('Comments')
            ->where(['name LIKE' => $name])
            ->toArray();
        if ($pictures == null){
            throw new BadRequestException;
        }
        else {
            foreach($pictures as $image) {
                $exif[$image->name]['name'] = exif_read_data($image->path)['FileName']??'No name';
                $exif[$image->name]['description'] = exif_read_data($image->path)['ImageDescription']??'No descritpion';
                $exif[$image->name]['comment'] = exif_read_data($image->path)['COMPUTED']['UserComment']??'No Comment';
                $exif[$image->name]['author'] = exif_read_data($image->path)['Artist']??'No author';
                $exif[$image->name]['width'] = exif_read_data($image->path)['COMPUTED']['Width']??'No width';
                $exif[$image->name]['height'] = exif_read_data($image->path)['COMPUTED']['Height']??'No height';
                $exif[$image->name]['html'] = '<img src=\\..\\' . $image->path . ' alt=' . $exif[$image->name]['comment'] . '>';
                $cpt = 0;
                foreach($image['comments'] as $comment){
                    $comments[$image->name][$cpt] = $comment->content;
                }
                //dd($comments[$image->name][0]);
                $this->set(compact('image'));
                $this->set(compact('exif'));
                $this->set(compact('comments'));
            }
        }
    }

    public function add() {
        $title = 'Add Picture';
        $request = $this->getRequest()->getData();
        if ($request != null){
            if (!file_exists(WWW_ROOT.'/img/imgAPI/'.$request['picture']->getClientFilename())){
                $file = $this->getRequest()->getData('picture');
                $file->moveTo(WWW_ROOT. 'img/imgAPI/'.$request['picture']->getClientFileName());
                $exif = exif_read_data((WWW_ROOT. 'img/imgAPI/'.$request['picture']->getClientFileName()));
                $data = Array(
                'name' => $request['name'],
                'path' => 'imgAPI/'.$request['picture']->getClientFileName(),
                'description' => $request['description'],
                'width' => $exif['COMPUTED']['Width'],
                'height' => $exif['COMPUTED']['Height']
                );
                $picture = $this->Pictures->newEmptyEntity();
                $this->Pictures->patchEntity($picture, $data);
                $this->Pictures->save($picture);
            } else {
                $error = 'fichier déjà existant';
                $this->set(compact('error'));
            }
            $this->set(compact('request'));
        }
        $this->set(compact('title'));
    }

    public function test() {
        $pictures = $this->Pictures
            ->find()
            ->first();
        dd($pictures);
    }
}
