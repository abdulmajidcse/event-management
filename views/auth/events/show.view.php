<?php view('layouts.header', ['title' => 'Event Information']) ?>

<div class="d-flex justify-content-center" style="min-height: calc(100vh - 154px);">
    <div class="align-self-center card border-secondary w-100 my-3">
        <div class="card-header d-md-flex justify-content-between">
            <h5>Event Information</h5>
            <a href="<?php echo url('/events') ?>" class="btn btn-sm btn-primary">Event List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="title" class="form-label"><strong>Title</strong></label>
                    <div><?php echo $event->title; ?></div>
                </div>

                <div class="mb-3 col-md-4">
                    <label for="event_date" class="form-label"><strong>Event Date</strong></label>
                    <div><?php echo $event->event_date; ?></div>
                </div>

                <div class="mb-3 col-md-4">
                    <label for="max_attendees" class="form-label"><strong>Max Attendees</strong></label>
                    <div><?php echo $event->max_attendees; ?></div>
                </div>

                <div class="mb-3 col-md-4">
                    <label for="attendees_count" class="form-label"><strong>Registered</strong></label>
                    <div><?php echo $event->attendees_count; ?></div>
                </div>

                <div class="mb-3 col-md-12">
                    <label for="address" class="form-label"><strong>Address</strong></label>
                    <div><?php echo $event->address; ?></div>
                </div>

                <div class="mb-3 col-md-12">
                    <label for="description" class="form-label"><strong>Description</strong></label>
                    <div><?php echo $event->description; ?></div>
                </div>
            </div>

            <div class="d-md-flex justify-content-between mt-4 mb-2">
                <h5><strong>Attendee Information</strong></h5>
                <form method="POST" action="<?php echo url('/events/download-attendee-csv?id=' . $event->id); ?>">
                    <input type="hidden" name="_token" value="<?php echo getCsrfToken(); ?>">
                    <a href="<?php echo url('/events/download-attendee-csv?id=' . $event->id); ?>"
                        class="btn btn-warning btn-sm"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Download CSV
                    </a>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($attendees) > 0) {
                            foreach ($attendees as $key => $attendee) { ?>
                                <tr>
                                    <th scope="row"><?php echo $key + 1; ?></th>
                                    <td><?php echo $attendee->name; ?></td>
                                    <td><?php echo $attendee->email ?></td>
                                    <td><?php echo $attendee->address; ?></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="4" class="text-danger text-center">No data found!</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php view('layouts.footer') ?>