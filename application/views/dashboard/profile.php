<div class="container mt-2">
<div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card">
                <div class="card-header">
                    Edit Information
                </div>
                <div class="card-body">
				<form action="<?=base_url('update/profile') ?>" method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                        <div class="mb-3">
                            <label for="form-label">Email</label>
                            <input name="email" class="form-control" value="<?= $user_data['email']; ?>" />
                            <?= form_error('email', '<span class="error text-sm text-danger">', '</span>'); ?>
                        </div>

                        <div class="mb-3">
                            <label for="form-label">First Name</label>
                            <input name="first_name" class="form-control" value="<?= $user_data['first_name']; ?>" />
                            <?= form_error('first_name', '<span class="error text-sm text-danger">', '</span>'); ?>
                        </div>

                        <div class="mb-3">
                            <label for="form-label">Last Name</label>
                            <input name="last_name" class="form-control" value="<?= $user_data['last_name']; ?>" />
                            <?= form_error('last_name', '<span class="error text-sm text-danger">', '</span>'); ?>
                        </div>

                        <div class="d-flex justify-content-end my-3">
                            <a href="<?= base_url('dashboard/admin'); ?>" class="btn btn-success btn-sm mx-2">Back</a>
                            <input type="submit" name="submit" class="btn btn-sm btn-success" value="Save" />
                        </div>
                    </form>
                </div>
            </div>
		</div>
        <div class="col-md-5">

            <div class="card">
                <div class="card-header">
                    Change Password
                </div>
                <div class="card-body">
                    <form action="<?=base_url('changePassword') ?>" method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                        <div class="mb-3">
                            <label for="form-label">Old Password</label>
                            <input type="password" name="old_password" class="form-control" />
                            <?= form_error('old_password', '<span class="error text-sm text-danger">', '</span>'); ?>
                        </div>

                        <div class="mb-3">
                            <label for="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" />
                            <?= form_error('new_password', '<span class="error text-sm text-danger">', '</span>'); ?>
                        </div>

                        <div class="mb-3">
                            <label for="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" />
                            <?= form_error('confirm_password', '<span class="error text-sm text-danger">', '</span>'); ?>
                        </div>

                        <div class="d-flex justify-content-end my-3">
                            <a href="<?= base_url('dashboard/admin'); ?>" class="btn btn-success btn-sm mx-2">Back</a>
                            <input type="submit" name="submit" class="btn btn-sm btn-success" value="Save" />
                        </div>
                    </form>
                </div>
            </div>

		</div>

        </div>
    </div>
</div>
