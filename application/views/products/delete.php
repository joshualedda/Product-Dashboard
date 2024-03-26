<div class="container mt-2">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					Product Details
				</div>

				<div class="card-body">
					<form action="<?= base_url('products/deleteProduct/' . $product['id']); ?>" method="POST">
					
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						<div class="mb-3">
							<label for="form-label">Name</label>
							<input name="name" class="form-control" value="<?= $product['name']; ?>" />
						</div>

						<div class="mb-3">
							<label for="description" class="form-label">Description</label>
							<textarea name="description" class="form-control" rows="4"><?= $product['description']; ?></textarea>
						</div>

						<div class="mb-3">
							<label for="form-label">Price</label>
							<input name="price" type="number" class="form-control" value="<?= $product['price']; ?>" />
						</div>

						<div class="mb-3">
							<label for="form-label">Inventory Count</label>
							<input name="quantity" type="number" class="form-control" value="<?= $product['quantity']; ?>" />
						</div>

						<div class="d-flex justify-content-end my-3">
							<a href="<?= base_url('dashboard/admin'); ?>" class="btn btn-success btn-sm mx-2">Back</a>
							<input type="submit" name="submit" class="btn btn-sm btn-danger" value="Delete Product" />
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
