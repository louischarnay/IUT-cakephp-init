<?php
$this->assign('title', $title)?>
    <h1><?= $title ?></h1>
<?php
if(!isset($tmp)){
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
    <p>Picture <?= $tmp['name'] ?> has been successfully added with the following description : <?= $tmp['description'] ?></p>
<?php }}
