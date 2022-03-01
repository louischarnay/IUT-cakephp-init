<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class UsersTable extends Table {
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
        $this->hasMany('Pictures')->setDependent(true);
    }
}
