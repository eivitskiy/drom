<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Work Drom</title>
    <link rel="stylesheet" href="/css/layout.css">

    <?php if(isset($css)): ?>
    <?php foreach($css as $c): ?>
        <link rel="stylesheet" href="<?php echo $c ?>">
    <?php endforeach ?>
    <?php endif ?>
</head>
<body>
    <?php include($viewTemplate) ?>

    <?php if(isset($js)): ?>
        <?php foreach($js as $j): ?>
            <script src="<?php echo $j ?>"></script>
        <?php endforeach ?>
    <?php endif ?>
</body>
</html>
