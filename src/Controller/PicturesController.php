<?php

namespace App\Controller;

use App\Model\Entity\Pictures;
use Cake\Http\Exception\BadRequestException;
use PhpParser\Node\Expr\Array_;
use function PHPUnit\Framework\stringEndsWith;

class PicturesController extends AppController {
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['view', 'index', 'select', 'api']);
    }

    public function index(){
        $page = $this->getRequest()->getQuery('page')??1;
        $isConnected = $this->Authentication->getresult();
        $this->set(compact($isConnected->isValid()));
        $pictures = $this->Pictures
            ->find()
            ->all()
            ->toArray();
        $index = 0;
        if ($page * 10 - 10 >= sizeof($pictures))
            throw new BadRequestException;
        for ($cpt = $page * 10 - 10; $cpt < $page * 10; $cpt++){
            if($cpt < sizeof($pictures)){
                $result[$index] = '<img class="imgAPI" src=\\..\\img\\'. $pictures[$cpt]->path .' alt="image">';
                $index++;
            }
        }
        $array = Array(
            'title' => 'Accueil | Page ' . $page,
            'content' => $result
        );
        $this->set(compact('array'));
        $this->set(compact('page'));
    }

    public function api($name = null) {
        $page = $this->getRequest()->getQuery('page')??1;
        $limit = $this->getRequest()->getQuery('limit')??10;
        $isConnected = $this->Authentication->getresult();
        $this->set(compact($isConnected->isValid()));
        
        if ($name == null){
            $pictures = $this->Pictures
                ->find()
                ->all()
                ->toArray();
            $index = 0;
            if ($page * $limit - $limit >= sizeof($pictures))
                throw new BadRequestException;
            for ($cpt = $page * $limit - $limit; $cpt < $page * $limit; $cpt++){
                if($cpt < sizeof($pictures)){
                    $result[$index]['path'] = $pictures[$cpt]->path;
                    $result[$index]['name'] = $pictures[$cpt]->name;
                    $result[$index]['description'] = $pictures[$cpt]->description;
                    $result[$index]['width'] = $pictures[$cpt]->width;
                    $result[$index]['height'] = $pictures[$cpt]->height;
                    $result[$index]['created'] = $pictures[$cpt]->created;
                    $result[$index]['modified'] = $pictures[$cpt]->modified;
                    $index++;
                }
            }
        }
        else {
            $pictures = $this->Pictures
                ->find()
                ->where(['name LIKE' => $name])
                ->toArray();
            $index = 0;
            if ($page * $limit - $limit >= sizeof($pictures))
                throw new BadRequestException;
            for ($cpt = $page * $limit - $limit; $cpt < $page * $limit; $cpt++){
                if($cpt < sizeof($pictures)){
                    $result[$index]['path'] = $pictures[$cpt]->path;
                    $result[$index]['name'] = $pictures[$cpt]->name;
                    $result[$index]['description'] = $pictures[$cpt]->description;
                    $result[$index]['width'] = $pictures[$cpt]->width;
                    $result[$index]['height'] = $pictures[$cpt]->height;
                    $result[$index]['created'] = $pictures[$cpt]->created;
                    $result[$index]['modified'] = $pictures[$cpt]->modified;
                    $index++;
                }
            }
        }
        
        $json = json_encode($result);
        $response = $this->response->withStringBody($json);
        return $response;
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
                $path = 'img/' . $image->path;
                $exif[$image->name]['description'] = exif_read_data($path)['ImageDescription']??'No description';
                $exif[$image->name]['comment'] = exif_read_data($path)['COMPUTED']['UserComment']??'No Comment';
                $exif[$image->name]['author'] = exif_read_data($path)['Artist']??'No author';
                $exif[$image->name]['width'] = exif_read_data($path)['COMPUTED']['Width']??'No width';
                $exif[$image->name]['height'] = exif_read_data($path)['COMPUTED']['Height']??'No height';
                $exif[$image->name]['html'] = 'src=../' . $path . ' alt=' . $exif[$image->name]['comment'];
                $exif[$image->name]['created'] = $image->created;
                $exif[$image->name]['modified'] = $image->modified;
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
                $path = 'img/' . $image->path;
                $exif[$image->name]['name'] = exif_read_data($path)['FileName']??'No name';
                $exif[$image->name]['description'] = exif_read_data($path)['ImageDescription']??'No descritpion';
                $exif[$image->name]['comment'] = exif_read_data($path)['COMPUTED']['UserComment']??'No Comment';
                $exif[$image->name]['author'] = exif_read_data($path)['Artist']??'No author';
                $exif[$image->name]['width'] = exif_read_data($path)['COMPUTED']['Width']??'No width';
                $exif[$image->name]['height'] = exif_read_data($path)['COMPUTED']['Height']??'No height';
                $exif[$image->name]['html'] = 'class="imgAPI" src=/' . $path . ' alt=' . $exif[$image->name]['comment'];
                $exif[$image->name]['created'] = $image->created;
                $exif[$image->name]['modified'] = $image->modified;
                $cpt = 0;
                foreach($image['comments'] as $comment){
                    $comments[$image->name][$cpt]['name'] = $comment->content;
                    $comments[$image->name][$cpt]['created'] = $comment->created;
                    $comments[$image->name][$cpt]['modified'] = $comment->modified;
                    $cpt++;
                }
                $this->set(compact('image'));
                $this->set(compact('exif'));
                $this->set(compact('comments'));
            }
            $isConnected = false;
            $connection = $this->Authentication->getResult();
            if($connection->isValid()){
                $isConnected = true;
            }
            $this->set(compact('isConnected'));
            $root = WWW_ROOT.'img\imgAPI\\';
            $this->set(compact('root'));
        }
    }

    public function add() {
        $title = 'Add Picture';
        $request = $this->getRequest()->getData();
        if ($request != null){
            if (!file_exists(WWW_ROOT.'/img/imgAPI/'.$request['picture']->getClientFilename())){
                $file = $this->getRequest()->getData('picture');
                $file->moveTo(WWW_ROOT. 'img/imgAPI/'.$request['picture']->getClientFileName());
                $exif = exif_read_data((WWW_ROOT. 'img\\imgAPI\\'.$request['picture']->getClientFileName()));
                $data = Array(
                'name' => $request['name'],
                'path' => 'imgAPI/'.$request['picture']->getClientFileName(),
                'description' => $request['description']??null,
                'width' => $exif['COMPUTED']['Width']??null,
                'height' => $exif['COMPUTED']['Height']??null
                );
                $picture = $this->Pictures->newEmptyEntity();
                $this->Pictures->patchEntity($picture, $data);
                $this->Pictures->save($picture);
                $this->set(compact('data'));
            } else {
                $error = 'Fichier déjà existant';
                $this->set(compact('error'));
            }
        }
        $this->set(compact('title'));
    }

    public function modify($id) {
        $userId = $this->getRequest()->getSession()->read("Auth.id");
        $title = 'Modify Picture';
        $picture = $this->Pictures
        ->get($id);
        if ($picture->user_id == $userId || $userId == 1){
            $request = $this->getRequest()->getData();
            if ($request != null){
                $this->Pictures->patchEntity($picture, $this->getRequest()->getData());
                $this->Pictures->save($picture);
            }
            $this->set(compact('picture'));
        }
        else {
            throw new BadRequestException;
        }
    }
}