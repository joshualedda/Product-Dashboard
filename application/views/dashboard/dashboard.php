<div class="container mt-2">
	<div class="row justify-content-center">

		<div class="col-md-8">




			<form action="<?= base_url('dashboards/search') ?>" method="GET" class="w-100">
				<div class="input-group mb-3">
					<input type="text" name="keyword" class="form-control" placeholder="Search by name" aria-label="Search" aria-describedby="basic-addon2" value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">

					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="submit">
							<i class="bi bi-search"></i>
						</button>
					</div>
				</div>
			</form>




			<div class="card">

				<div class="card-header d-flex justify-content-between align-items-center">

					<?php if ($role == 0) : ?>


					<?php elseif ($role == 1) : ?>
						<h5 class="mb-0">Manage Products</h5>

						<a href="<?= base_url('products/new') ?>" class="btn btn-sm btn-success">Add New</a>
					<?php endif; ?>



				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Id</th>
									<th>Name</th>
									<th>Inventory Count</th>
									<th>Quantity Sold</th>

									<?php if ($role == 0) : ?>
									<?php elseif ($role == 1) : ?>
										<th>Action</th>

									<?php endif; ?>

								</tr>
							</thead>
							<tbody>
								<?php if (empty($products)) : ?>
									<tr>
										<td colspan="4">No Search Result.</td>
									</tr>
								<?php else : ?>

									<?php foreach ($products as $product) : ?>
										<tr>
											<td><?= $product['id']; ?></td>
											<td><a href="<?= base_url('product/show/' . $product['id']); ?>"><?= $product['name']; ?></a></td>
											<td><?= $product['quantity']; ?></td>
											<td><?= $product['total_sold']; ?></td>
											<?php if ($role == 0) : ?>
											<?php elseif ($role == 1) : ?>

												<td>
													<a class="btn btn-success btn-sm" href="<?= base_url('products/edit/' . $product['id']); ?>">Edit</a>


													<a href="<?= base_url('products/delete/' . $product['id']); ?>" class="btn btn-sm btn-danger">Delete</a>
												</td>
											<?php endif; ?>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
