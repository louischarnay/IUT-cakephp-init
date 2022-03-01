<?php
$this->assign('title', 'Modify')?>
    <h1><?= $picture->name ?></h1>
<?php
    echo $this->Form->create($picture, array('type'=>'file'));
    echo $this->Form->control('description');
    echo $this->Form->button('modify');
    echo $this->Form->end();