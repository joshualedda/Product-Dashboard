<div class="container mt-2">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					Product Details
				</div>

				<div class="card-body">
					<form id="editProductForm" action="<?= base_url('products/updateProduct/' . $product['id']); ?>" method="POST">
					
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
							<input id="editBtn" type="submit" name="submit" class="btn btn-sm btn-success" value="Update Product" />
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>



<script>
	$(document).ready(function() {
    $('#editBtn').click(function(e) {
        e.preventDefault();

        var formData = $('#editProductForm').serialize();

        $.ajax({
            url: $('#editProductForm').attr('action'),
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#alertMessage')
                    .removeClass('alert-warning')
                    .addClass('alert-success')
                    .text('Product Updated Succesfully!')
                    .removeClass('d-none')
                    .fadeOut(3000); // Fade out in 3 seconds

                $("#productForm")[0].reset(); // Clear form fields
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#alertMessage')
                    .removeClass('alert-warning')
                    .addClass('alert-danger')
                    .text('An error occurred while adding the product.')
                    .removeClass('d-none')
                    .fadeIn();
            }
        });
    });
});

</script>
