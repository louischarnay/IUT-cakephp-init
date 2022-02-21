<?php
$this->assign('title', $title)?>
    <h1><?= $title ?></h1>
<?php
if(!isset($data)){
    echo $this->Form->create(null, array('type'=>'file'));
    echo $this->Form->control('name');
    echo $this->Form->control('description');
    echo $this->Form->input('picture', array('type' => 'file'));
    echo $this->Form->button('add');
    echo $this->Form->end();
}
else{
    if (isset($error)) {
        echo $error;
    }else {?>
    <p>Picture <?= $data['name'] ?> has been successfully added with the following description : <?= $data['description'] ?></p>
<?php }}
