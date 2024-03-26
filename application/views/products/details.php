<section>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-4 mb-3">
				<div class="text-decoration-none text-dark">
					<div class="card">
						<form action="<?= base_url('addtocart')  ?>" method="POST">
							<div class="card-body">
								<h5 class="card-title">Product Name: <?= $product['name'] ?></h5>
								<p class="card-text">
									Product Id: <?= $product['id'] ?>
								</p>
								<p class="card-text">Added Since: </p>

								<p class="card-text">Description: <?= $product['description'] ?></p>
								<p class="card-text">Total Sold: </p>
								<p class="card-text">Number Of Available Stocks: </p>


								<p class="card-text"><?= $product['price'] ?></p>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
