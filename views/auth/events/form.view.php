<?php view('layouts.header', ['title' => $event?->id ? 'Edit Event' : 'Create Event']) ?>

<div class="d-flex justify-content-center" style="min-height: calc(100vh - 154px);">
    <div class="align-self-center card border-secondary page-flex-card my-3">
        <div class="card-header d-md-flex justify-content-between">
            <h5>Create Event</h5>
            <a href="<?php echo url('/events') ?>" class="btn btn-sm btn-primary">Event List</a>
        </div>
        <div class="card-body">
            <form action="<?php echo $event?->id ? url('/events/update?id=' . $event->id) : url('/events/store'); ?>" method="post">
                <fieldset>
                    <input type="hidden" name="_token" value="<?php echo getCsrfToken(); ?>">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo old('title', $event?->title) ?>" required>
                        <div class="text-danger small"><?php echo errors('title') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="event_date" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="event_date" name="event_date" value="<?php echo old('event_date', $event?->event_date) ?>" required>
                        <div class="text-danger small"><?php echo errors('event_date') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="max_attendees" class="form-label">Max Attendees</label>
                        <input type="text" class="form-control" id="max_attendees" name="max_attendees" value="<?php echo old('max_attendees', $event?->max_attendees) ?>" required>
                        <div class="text-danger small"><?php echo errors('max_attendees') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo old('address', $event?->address) ?>" required>
                        <div class="text-danger small"><?php echo errors('address') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="5" class="form-control" required><?php echo old('description', $event?->description) ?></textarea>
                        <div class="text-danger small"><?php echo errors('description') ?></div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php view('layouts.footer') ?>