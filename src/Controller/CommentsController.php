<?php

namespace App\Controller;

use Cake\Filesystem\File;

class CommentsController extends AppController
{
    public function add($id){
        $content = $this->getRequest()->getData('content');
        $data = Array(
            'picture_id' => $id,
            'content' => $content
        );
        $comment = $this->Comments->newEmptyEntity();
        $this->Comments->patchEntity($comment, $data);
        $this->Comments->save($comment);
        $this->Flash->success('commentaire ajouté');
        return $this->redirect($this->referer());
    }

    public function delete(){
        $idUser = $this->getRequest()->getSession()->read("Auth.id");

        $request = $this->getRequest()->getData();
        if ($request != null) {
            $comment = $this->Comments
                ->get($request['idComment']);
            $this->Comments
                ->delete($comment);
        }
        if($idUser == 1){
            $comments = $this->Comments
                ->find()
                ->toArray();
        } else {
            $comments = $this->Comments
                ->find()
                ->where(["user_id LIKE" => $idUser])
                ->toArray();
        }
        $this->set(compact('comments'));
    }
}
