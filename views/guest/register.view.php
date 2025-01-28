<?php view('layouts.header', ['title' => 'Register']) ?>

<div class="d-flex justify-content-center" style="min-height: calc(100vh - 154px);">
    <div class="align-self-center card border-secondary page-flex-card my-3">
        <div class="card-header">
            <h5>Create an account</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo url('/register') ?>" method="post">
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
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="text-danger small"><?php echo errors('password') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        <div class="text-danger small"><?php echo errors('password_confirmation') ?></div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-dark">Register</button>
                    </div>

                    <a href="<?php echo url('/login') ?>">Already have an account?</a>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php view('layouts.footer') ?>