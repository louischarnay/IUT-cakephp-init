<?php $this->assign('title', $array['title']) ?>
<h1><?= $array['title'] ?></h1>
<?php for ($cpt = 0; $cpt < 10; $cpt++){
    if(isset($array['content'][$cpt])){
        echo $array['content'][$cpt];
    }
}
echo $this->Html->link(
        'Previous',
        ['controller' => 'Pictures', 'action' => 'index/'.($page - 1), '_full' => true]
    );
echo $this->Html->link(
        'Next',
        ['controller' => 'Pictures', 'action' => 'index/'.($page + 1), '_full' => true]
    );
