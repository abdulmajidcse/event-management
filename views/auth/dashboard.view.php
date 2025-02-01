<?php view('layouts.header', ['title' => 'Dashboard']) ?>

<h3>Welcome, <?php echo auth()->user()->name; ?>!</h3>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">This is your Admin Dashboard</h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">Your event management panel!</h6>
        <p class="card-text">If you need quick interaction, please, click links below.</p>
        <a href="<?php echo url('/events') ?>" class="card-link">Go to Event List</a>
        <a href="<?php echo url('/events/create') ?>" class="card-link">Create Event</a>
    </div>
</div>

<?php view('layouts.footer') ?>