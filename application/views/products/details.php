<section>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-12 mb-3">
				<div class="text-decoration-none text-dark">

					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Product Name: <?= $product['name'] ?></h5>
							<p class="card-text">Product Id: <?= $product['productId'] ?></p>
							<p class="card-text">Added Since: <?= date('F j, Y', strtotime($product['productCreated'])); ?></p>
							<p class="card-text">Description: <?= $product['description'] ?></p>
							<p class="card-text">Total Sold: <?= $product['total_sold'] ?></p>
							<p class="card-text">Number Of Available Stocks: <?= $product['quantity'] ?> </p>
							<p class="card-text">Price: <?= $product['price'] ?></p>
						</div>

					</div>


				</div>
			</div>

		</div>



		<div class="card mt-5 my-5">
			<div class="card-header">
				Leave a review
			</div>
			<div class="row">
				<div class="col-md-12">
					<form action="<?= base_url('review') ?>" method="POST">
						<div class="card-body">
							<input type="hidden" name="product_id" value="<?= $product['productId'] ?>">
							<div class="mb-3">
								<textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
							</div>
							<div class="d-flex justify-content-end">
								<input type="submit" name="review" value="Post A Review" class="btn btn-primary btn-sm">
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>




		<?php if (empty($reviews)) : ?>
			<div class="card-header text-center">
				<p class="card-text">No reviews yet.</p>
			</div>
		<?php else : ?>



			<?php foreach ($reviews as $review) : ?>



				<div class="card mb-3">




					<div class="card ">
						<div class="card-header">
							<div class="d-flex justify-content-between align-items-center">
								<p class="m-0 fw-bold">Review</p>
								<?php
								$reviewTimestamp = strtotime($review['created_at']);
								$timeDiff = time() - $reviewTimestamp;
								$weeks = floor($timeDiff / (7 * 24 * 60 * 60));

								if ($weeks >= 1) {
									echo '<span class="text-muted">' . date('F d Y', $reviewTimestamp) . '</span>';
								} else {
									echo '<span class="text-muted">' . timespan($reviewTimestamp, time()) . ' ago</span>';
								}
								?>
							</div>
						</div>
					</div>





					<div class="card-body">
						<p class="card-text ">
							<?= $review['first_name']; ?> <?= $review['last_name']; ?> wrote:

						</p>
						<p class="card-text"><?= $review['content']; ?></p>
					</div>


					<div class="card-header fw-bold">
						Replies
					</div>
					<?php if (isset($review['replies']) && !empty($review['replies'])) : ?>
						<?php foreach ($review['replies'] as $reply) : ?>

							<div class="card-body">
								<div class="d-flex justify-content-between align-items-center">
									<p class="card-text "><?= $reply['first_name']; ?> <?= $reply['last_name']; ?> wrote: </p>


									<span class="text-muted">
										<?php
										$replyTimestamp = strtotime($reply['created_at']);
										$timeDiff = time() - $replyTimestamp;
										$weeks = floor($timeDiff / (7 * 24 * 60 * 60));

										if ($weeks >= 1) {
											echo date('F d Y', $replyTimestamp);
										} else {
											echo timespan($replyTimestamp, time()) . ' ago';
										}
										?>
									</span>




								</div>

								<p class="card-text"><?= $reply['content']; ?></p>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<div class="card-body">
							<p class="card-text">No replies yet.</p>
						</div>
					<?php endif; ?>








					<div class="card-header">
						Post A Reply.
					</div>
					<div class="card-body">
						<form action="<?= base_url('reply') ?>" method="POST">
							<input type="hidden" name="review_id" value="<?= $review['id']; ?>">
							<div class="mb-3">
								<textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
							</div>
							<div class="d-flex justify-content-end">
								<input type="submit" name="review" value="Post Reply" class="btn btn-primary btn-sm">
							</div>
						</form>
					</div>
				</div>


			<?php endforeach; ?>


		<?php endif; ?>






	</div>
</section>
