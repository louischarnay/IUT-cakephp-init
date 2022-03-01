<?php
foreach ($users as $user) {
    echo 'Name : ' . $user['name'] . '</br>' . ' Last name : ' . $user['last_name'] . '</br>' . ' Email : ' . $user['email'] . '</br>';
    echo $this->Form->postlink('delete', ['controller' => 'Users', 'action' => 'delete', $user['id']],
        ['confirm' => 'Etes-vous sur de vouloir supprimer cet utilisateur ?']) . '</br>';
}
