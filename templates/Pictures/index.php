<?php $this->assign('title', $array['title']) ?>
<h1><?= $array['title'] ?></h1>
<?php for ($cpt = 0; $cpt < 10; $cpt++){
    if(isset($array['content'][$cpt])){
        echo $array['content'][$cpt];
    } else {
        echo $error;
    }
}

