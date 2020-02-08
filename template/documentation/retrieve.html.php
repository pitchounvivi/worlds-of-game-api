<h1>

    Coucou Documentation
    et là encore

</h1>

<!--<h4><?php var_dump($routes); ?></h4>-->

<!--autre écriture<h4><?= json_encode($routes)?></h4>-->


<ul>

    <?php foreach ($routes as $key => $value):?>

    <li><?= $key ?></li>

    <?php endforeach; ?>

</ul>