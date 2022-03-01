<?php

namespace App\Controller;

use Cake\Http\Exception\UnauthorizedException;

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
                dd('Email already used');
            }
        }
    }

    public function logout(){
        $this->Authentication->logout();
        $target = $this->Authentication->getLoginRedirect() ?? '/';
        return $this->redirect($target);
    }

    public function delete($id){
        $this->getRequest()->allowMethod('post');
        if($this->getRequest()->getSession()->read("Auth.id") !=1){
            throw new UnauthorizedException();
        }
        $user = $this->Users
            ->get($id);
        if($id != 1){
            if($this->Users->delete($user)){
                $this->Flash->success('supprimé');
            }else{
                $this->Flash->error('error');
            }
        } else{
            $this->Flash->error('Impossible de supprimer l\'admnisitrateur');
        }
        return $this->redirect($this->referer());
    }

    public function view(){
        if($this->getRequest()->getSession()->read("Auth.id") !=1){
            throw new UnauthorizedException();
        }
        $users = $this->Users
            ->find()
            ->toArray();
        $this->set(compact('users'));
    }
}
