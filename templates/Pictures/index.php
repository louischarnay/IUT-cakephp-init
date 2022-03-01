<?php $this->assign('title', $array['title']) ?>
<h1><?= $array['title'] ?></h1>
<?php for ($cpt = 0; $cpt < 10; $cpt++){
    if(isset($array['content'][$cpt])){
        echo $this->Html->link(
            $array["content"][$cpt],
            ['controller' => 'Pictures', 'action' => 'select', $array["name"][$cpt]]
        );

        echo $array['content'][$cpt];
        echo '<a href="/pictures/image">'.$array["content"][$cpt].'</a>';
        echo $array['author'][$cpt];
    }
}
echo $this->Html->link(
        'Previous',
        ['controller' => 'Pictures', 'action' => 'index', '?'=>["page" => ($page - 1)]]
    );
echo $this->Html->link(
        'Next',
        ['controller' => 'Pictures', 'action' => 'index', '?'=>["page" => ($page + 1)]]
    );
