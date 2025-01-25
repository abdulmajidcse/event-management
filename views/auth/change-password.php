<?php view('layouts.header', ['title' => 'Change password']) ?>

<div class="d-flex justify-content-center" style="min-height: calc(100vh - 154px);">
    <div class="align-self-center card border-secondary page-flex-card my-3">
        <div class="card-header">
            <h5>Change your password</h5>
        </div>
        <div class="card-body">
            <form action="<?php url('/change-password') ?>" method="post">
                <fieldset>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        <div class="text-danger small"><?php echo errors('current_password') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="text-danger small"><?php echo errors('password') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        <div class="text-danger small"><?php echo errors('password_confirmation') ?></div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-dark">Confirm</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php view('layouts.footer') ?>