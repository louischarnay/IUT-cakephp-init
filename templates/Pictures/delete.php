<?php
foreach ($pictures as $picture){
    echo 'Name : ' . $picture["name"] . '</br>' . ' Description : ' . $picture["description"];
    echo $this->Form->create(null, array('type'=>'file'));
    echo $this->Form->hidden('idPicture', ['value' => $picture['id']]);
    echo $this->Form->hidden('path', ['value' => $picture['path']]);
    echo $this->Form->button('delete');
    echo $this->Form->end();
}
