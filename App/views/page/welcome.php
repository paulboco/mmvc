<?php include(__DIR__ . '/../../views/layout/header.php') ?>

<h1><?php e($salutation) ?>, <?php e($endearment) ?>!</h1>

<p><?php e($greeting) ?></p>

<div class="instructions">
    <p>
        Keep reloading this page to change values.
    </p>
</div>

<?php include(__DIR__ . '/../../views/layout/footer.php') ?>
