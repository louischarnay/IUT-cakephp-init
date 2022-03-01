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
        if($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/';
            return $this->redirect($target);
        }
        if($this->getRequest()->is('Post') && !$result->isValid()){
            $this->Flash->error('Password incorrect');
        }
        $this->set(compact('user'));
    }

    public function signin(){
        $result = $this->request->getData();
        if($result) {
            $allUsers = $this->Users
                ->find()
                ->all()
                ->toArray();
            $isExisting = false;
            for ($cpt = 0; $cpt < sizeof($allUsers); $cpt ++){
                if($allUsers[$cpt]['email'] == $result['email']) $isExisting = true;
            }
            if(!$isExisting){
                if($result['password'] == $result['confirm']){
                    $user = ['email' => $result['email'], 'password' => $result['password']];
                    $userEntity = $this->Users->newEntity($user);
                    $this->Users->save($userEntity);
                    $target = $this->Authentication->getLoginRedirect() ?? '/';
                    return $this->redirect($target);
                } else {
                    $this->Flash->error('Passwords don\'t match');
                }
            } else {
                $this->Flash->error('Email already used');
            }
        }
    }

    public function logout(){
        $this->Authentication->logout();
        $target = $this->Authentication->getLoginRedirect() ?? '/';
        return $this->redirect($target);
    }
}
