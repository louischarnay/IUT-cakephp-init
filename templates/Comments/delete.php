<?php
foreach ($comments as $comment) {
    echo 'Name : ' . $comment["content"] . '</br>' . ' Picture id : ' . $comment["picture_id"] . '</br>' . ' Author id : ' . $comment["author_id"];
    echo $this->Form->create(null, array('type' => 'file'));
    echo $this->Form->hidden('idComment', ['value' => $comment['id']]);
    echo $this->Form->button('delete');
    echo $this->Form->end();
}
