<?php view('layouts.header', ['title' => 'Home']) ?>

<h3>User List</h3>

<ul>
    <?php foreach ($users as $user) { ?>
        <li><?php echo $user->name; ?></li>
    <?php } ?>
</ul>

<?php view('layouts.footer') ?>