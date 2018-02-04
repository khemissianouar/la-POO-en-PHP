<?= $renderer->render('header')?>

<h1>Binevune KHemissi anouar</h1>
<ul>
    <li><a href="<?= $router->generateUri('blog.show',['slug'=>'aaa0-0A']);?>">Article</a></li>

    <li> Article 1</li>

    <li> Article 1</li>
    <li> Article 1</li>

</ul>
<?= $renderer->render('footer')?>