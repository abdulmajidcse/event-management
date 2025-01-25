<?php view('layouts.header', ['title' => 'Profile']) ?>

<div class="d-flex justify-content-center" style="min-height: calc(100vh - 154px);">
    <div class="align-self-center card border-secondary page-flex-card my-3">
        <div class="card-header">
            <h5>Update your profile</h5>
        </div>
        <div class="card-body">
            <form action="<?php url('/profile') ?>" method="post">
                <fieldset>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo old('name', auth()->user()->name) ?>">
                        <div class="text-danger small"><?php echo errors('name') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo old('email', auth()->user()->email) ?>">
                        <div class="text-danger small"><?php echo errors('email') ?></div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php view('layouts.footer') ?>