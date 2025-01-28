<?php view('layouts.header', ['title' => 'Event Information']) ?>

<div class="d-flex justify-content-center" style="min-height: calc(100vh - 154px);">
    <div class="align-self-center card border-secondary page-flex-card my-3">
        <div class="card-header d-md-flex justify-content-between">
            <h5>Event Information</h5>
            <a href="<?php echo url('/events') ?>" class="btn btn-sm btn-primary">Event List</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="title" class="form-label"><strong>Title</strong></label>
                <div><?php echo $event->title ?></div>
            </div>

            <div class="mb-3">
                <label for="event_date" class="form-label"><strong>Event Date</strong></label>
                <div><?php echo $event->event_date ?></div>
            </div>

            <div class="mb-3">
                <label for="max_attendees" class="form-label"><strong>Max Attendees</strong></label>
                <div><?php echo $event->max_attendees ?></div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label"><strong>Address</strong></label>
                <div><?php echo $event->address ?></div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><strong>Description</strong></label>
                <div><?php echo $event->description ?></div>
            </div>
        </div>
    </div>
</div>

<?php view('layouts.footer') ?>