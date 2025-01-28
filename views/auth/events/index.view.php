<?php view('layouts.header', ['title' => 'Event List']) ?>

<div class="d-flex justify-content-center" style="min-height: calc(100vh - 154px);">
    <div class="align-self-center card border-secondary w-100 my-3">
        <div class="card-header d-md-flex justify-content-between">
            <h5>Event List</h5>
            <a href="<?php echo url('/events/create') ?>" class="btn btn-sm btn-primary">Create Event</a>
        </div>
        <div class="card-body">
            <form action="<?php echo url('/events') ?>" method="get">
                <div class="d-md-flex gap-3">
                    <div class="mb-4">
                        <label for="per_page" class="form-label">Per Page</label>
                        <select class="form-select" id="per_page" name="per_page">
                            <option value="">Select one</option>
                            <option value="10" <?php echo $perPage == 10 ? 'selected' : '' ?>>10</option>
                            <option value="20" <?php echo $perPage == 20 ? 'selected' : '' ?>>20</option>
                            <option value="50" <?php echo $perPage == 50 ? 'selected' : '' ?>>50</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="sort_by" class="form-label">Sort By</label>
                        <select class="form-select" id="sort_by" name="sort_by">
                            <option value="">Select one</option>
                            <option value="latest" <?php echo $sortBy == 'latest' ? 'selected' : '' ?>>Latest</option>
                            <option value="oldest" <?php echo $sortBy == 'oldest' ? 'selected' : '' ?>>Oldest</option>
                            <option value="title_asc" <?php echo $sortBy == 'title_asc' ? 'selected' : '' ?>>Title (a to z)</option>
                            <option value="title_desc" <?php echo $sortBy == 'title_desc' ? 'selected' : '' ?>>Title (z to a)</option>
                            <option value="max_attendees_asc" <?php echo $sortBy == 'max_attendees_asc' ? 'selected' : '' ?>>Max Attendees (a to z)</option>
                            <option value="max_attendees_desc" <?php echo $sortBy == 'max_attendees_desc' ? 'selected' : '' ?>>Max Attendees (z to a)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="event_date" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="event_date" name="event_date" value="<?php echo $eventDate ?>">
                    </div>

                    <div class="mb-4">
                        <label for="search" class="form-label">Type here</label>
                        <input type="text" class="form-control" id="search" name="search" value="<?php echo $search ?>" placeholder="e.g., event title...">
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary search-button">Search</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Event Date</th>
                            <th scope="col">Address</th>
                            <th scope="col">Max Attendees</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($events) > 0) {
                            foreach ($events as $key => $event) { ?>
                                <tr>
                                    <th scope="row"><?php echo $key + 1; ?></th>
                                    <td><?php echo $event->title; ?></td>
                                    <td><?php echo $event->event_date ?></td>
                                    <td><?php echo $event->address; ?></td>
                                    <td><?php echo $event->max_attendees; ?></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="<?php echo url('/events/show?id=' . $event->id); ?>" class="btn btn-primary btn-sm">View</a>
                                            <a href="<?php echo url('/events/edit?id=' . $event->id); ?>" class="btn btn-success btn-sm">Edit</a>
                                            <form method="POST" action="<?php echo url('/events/delete?id=' . $event->id); ?>">
                                                <a href="<?php echo url('/events/delete?id=' . $event->id); ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault();
                                    confirm('Are you sure?') ? this.closest('form').submit() : '';">
                                                    Delete
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="5" class="text-danger text-center">No data found! Please, broaden your search.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php view('layouts.footer') ?>