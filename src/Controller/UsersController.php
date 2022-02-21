<?php

namespace App\Controller;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['login', 'signin']);
    }

    public function login(){
        $user = $this->Users->newEmptyEntity();
        $result = $this->Authentication->getResult();
        if($result->isValid()){
            $target = $this->Authentication->getLoginRedirect() ?? '/';
            return $this->redirect($target);
        }
        if($this->getRequest()->is('Post') && !$result->isValid()){
            $this->Flash->error('Password incorrect');
        }
        $this->set(compact('user'));
    }

    public function signin(){
        $user = ['email' => 'mail@gmail.com', 'password' => 'azef'];
        $userEntity = $this->Users->newEntity($user);
        $this->Users->save($userEntity);
        die('ok');
    }
}
