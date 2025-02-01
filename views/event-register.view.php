<?php view('layouts.header', ['title' => 'Event Register']) ?>

<div class="d-flex justify-content-center" style="min-height: calc(100vh - 154px);">
    <div class="align-self-center card border-secondary page-flex-card my-3">
        <div class="card-header">
            <h5>Event Register</h5>
            <p>Event Title: <?php echo $event->title; ?></p>
        </div>
        <div class="card-body">
            <form id="event_register_form" action="<?php echo url('/event-register?id=' . $event->id) ?>" method="post">
                <fieldset id="event_register_fieldset">
                    <input type="hidden" name="_token" value="<?php echo getCsrfToken() ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo old('name') ?>" required>
                        <div id="name_error" class="text-danger small"><?php echo errors('name') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo old('email') ?>" required>
                        <div id="email_error" class="text-danger small"><?php echo errors('email') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo old('address') ?>" required>
                        <div id="address_error" class="text-danger small"><?php echo errors('address') ?></div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo asset('/js/axios.min.js') ?>"></script>
<script>
    // uppercase first letter
    function upFirst(string) {
        if (!string) return string;
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // sweet alert message
    function showSweetMessage(message, type) {
        Swal.fire({
            icon: type,
            title: upFirst(type),
            text: message,
            showConfirmButton: true,
        });
    }

    const form = document.querySelector('#event_register_form');
    form?.addEventListener('submit', function(e) {
        e.preventDefault();

        const url = `<?php echo url('/event-register?id=' . $event->id) ?>`;
        const formData = new FormData(form);

        // reset error messages
        document.querySelector(`#name_error`).innerHTML = '';
        document.querySelector(`#email_error`).innerHTML = '';
        document.querySelector(`#address_error`).innerHTML = '';

        // start loading spinner
        const pageLoader = document.querySelector('#page_loader');
        pageLoader?.classList.remove('bg-light');
        pageLoader?.classList.remove('d-none');

        // disable form
        const formFieldset = document.querySelector('#event_register_fieldset');
        formFieldset?.setAttribute('disabled', true);

        axios.post(url, formData, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function(response) {
                showSweetMessage(response.data.message, 'success');
                form.reset();
            })
            .catch(function(error) {
                if (error.response?.data?.errors) {
                    const errors = error.response?.data?.errors ?? {};
                    Object.keys(errors).forEach(key => {
                        document.querySelector(`#${key}_error`).innerHTML = errors[key];
                    });
                } else {
                    showSweetMessage(error.response?.data?.message ?? 'Something went wrong!', 'error');
                }
            })
            .finally(function() {
                // stop loading spinner
                pageLoader?.classList.add('d-none');
                // enable form
                formFieldset?.removeAttribute('disabled');
            });
    });
</script>

<?php view('layouts.footer') ?>