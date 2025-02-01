<?php view('layouts.header', ['title' => 'Event Register']) ?>

<div class="d-flex justify-content-center" style="min-height: calc(100vh - 154px);">
    <div class="align-self-center card border-secondary page-flex-card my-3">
        <div class="card-header">
            <h5>Event Register</h5>
            <p>Event Title: <?php echo $event->title; ?></p>
        </div>
        <div class="card-body">
            <form action="<?php echo url('/event-register?id=' . $event->id) ?>" method="post">
                <fieldset>
                    <input type="hidden" name="_token" value="<?php echo getCsrfToken() ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo old('name') ?>" required>
                        <div class="text-danger small"><?php echo errors('name') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo old('email') ?>" required>
                        <div class="text-danger small"><?php echo errors('email') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo old('address') ?>" required>
                        <div class="text-danger small"><?php echo errors('address') ?></div>
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