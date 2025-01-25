<?php view('layouts.header', ['title' => 'Register']) ?>

<div class="d-flex justify-content-center" style="min-height: calc(100vh - 154px);">
    <div class="align-self-center card border-secondary page-flex-card my-3">
        <div class="card-header">
            <h5>Login to your account</h5>
        </div>
        <div class="card-body">
            <form action="<?php url('/login') ?>" method="post">
                <fieldset>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo old('email') ?>">
                        <div class="text-danger small"><?php echo errors('email') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="text-danger small"><?php echo errors('password') ?></div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-dark">Login</button>
                    </div>

                    <a href="<?php echo url('/register') ?>">Don't have an account?</a>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php view('layouts.footer') ?>