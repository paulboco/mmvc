<?php self::inject('layout/header') ?>

<h1><?php e($salutation) ?>, <?php e($endearment) ?>!</h1>
<p>
    <?php e($greeting) ?>
</p>

<?php self::inject('layout/footer') ?>
