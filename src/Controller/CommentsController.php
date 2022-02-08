<?php

namespace App\Controller;

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
}
