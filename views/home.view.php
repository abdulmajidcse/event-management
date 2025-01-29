<?php view('layouts.header', ['title' => 'Home']) ?>

<div class="d-flex justify-content-center" style="min-height: calc(100vh - 154px);">
    <div class="align-self-center card border-secondary w-100 my-3">
        <div class="card-header">
            <h5>All Event List</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo url('/') ?>" method="get">
                <div class="d-md-flex gap-3">
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

            <div>
                <?php if (count($events) > 0) {
                    foreach ($events as $key => $event) { ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $event->title; ?></h5>
                                <p class="card-text"><strong>Max Attendees:</strong> <?php echo $event->max_attendees; ?></p>
                                <p class="card-text"><strong>Event Date:</strong> <?php echo $event->event_date ?></p>
                                <p class="card-text"><strong>Address:</strong> <?php echo $event->address; ?></p>
                                <a href="<?php echo url('/event-details?id=' . $event->id); ?>" class="btn btn-primary">See Details</a>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Opps!</h5>
                            <p class="card-text text-danger">No event found! Please, broaden your search.</p>
                            <a href="<?php echo url('/') ?>" class="btn btn-primary">Back to home</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Pagination -->
            <div class="table-responsive mt-4">
                <nav>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link <?php echo $page > 1 ? '' : 'disabled' ?>" href="<?php echo url('/?page=' . (($page - 1) < 1 ? 1 : ($page - 1)) . '&per_page=' . $perPage) ?>">Previous</a></li>

                        <?php if ($totalPages > 0) {
                            for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <li class="<?php echo $i == $page ? 'active' : '' ?>"><a class="page-link" href="<?php echo url('/?page=' . $i . '&per_page=' . $perPage) ?>"><?php echo $i ?></a></li>
                            <?php }
                        } else { ?>
                            <li class="<?php echo 1 == $page ? 'active' : '' ?>"><a class="page-link" href="<?php echo url('/') ?>">1</a></li>
                        <?php } ?>

                        <li class="page-item"><a class="page-link <?php echo $page < $totalPages ? '' : 'disabled' ?>" href="<?php echo url('/?page=' . ($page + 1) . '&per_page=' . $perPage) ?>">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php view('layouts.footer') ?>