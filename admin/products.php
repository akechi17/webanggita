<?php include('db_connect.php'); ?>

<div class="container-fluid">

	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">

			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List produk</b>
						<span class="float:right">
							<a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="index.php?page=manage_product" id="new_product">
								<i class="fa fa-plus"></i> Tambah Data
							</a>
						</span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Img</th>
									<th class="">Category</th>
									<th class="">Product</th>
									<th class="">Info</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$cat = array();
								$cat[] = '';
								$qry = $conn->query("SELECT * FROM categories ");
								while ($row = $qry->fetch_assoc()) {
									$cat[$row['id']] = $row['name'];
								}
								$products = $conn->query("SELECT * FROM products order by name asc ");
								while ($row = $products->fetch_assoc()) :
									$get = $conn->query("SELECT * FROM lelangs where product_id = {$row['id']} order by harga_lelang desc limit 1 ");
									$lelang = $get->num_rows > 0 ? $get->fetch_array()['harga_lelang'] : 0;
									$tbid = $conn->query("SELECT distinct(user_id) FROM lelangs where product_id = {$row['id']} ")->num_rows;
								?>
									<tr data-id='<?= $row['id'] ?>'>
										<td class="text-center"><?= $i++ ?></td>
										<td class="">
											<div class="row justify-content-center">
												<img src="<?= 'assets/uploads/' . $row['img_fname'] ?>" alt="">
											</div>
										</td>
										<td>
											<p> <b><?= ucwords($cat[$row['category_id']]) ?></b></p>
										</td>
										<td class="">
											<p>Name: <b><?= ucwords($row['name']) ?></b></p>
											<p><small>Description: <b><?= $row['description'] ?></b></small></p>
										</td>
										<td>
											<p><small>Harga Normal: <b><?= number_format($row['harga_normal'], 2) ?></b></small></p>
											<p><small>Harga Awal: <b><?= number_format($row['harga_awal'], 2) ?></b></small></p>
											<p><small>Waktu Penutupan: <b><?= date("M d,Y h:i A", strtotime($row['bid_end_datetime'])) ?></b></small></p>
											<p><small>Tawaran Tertinggi: <b class="highest_bid"><?= number_format($lelang, 2) ?></b></small></p>
											<p><small>Jumlah Penawar: <b class="total_bid"><?= $tbid ?> user/s</b></small></p>
										</td>
										<td class="text-center">
											<button class="btn btn-sm btn-outline-primary edit_product" type="button" data-id="<?= $row['id'] ?>">Edit</button>
											<button class="btn btn-sm btn-outline-danger delete_product" type="button" data-id="<?= $row['id'] ?>">Delete</button>
										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>

</div>
<style>
	td {
		vertical-align: middle !important;
	}

	td p {
		margin: unset
	}

	table td img {
		max-width: 100px;
		max-height: 150px;
	}

	img {
		max-width: 100px;
		max-height: 150px;
	}
</style>
<script>
	$(document).ready(function() {
		$('table').dataTable()
	})

	$('.view_product').click(function() {
		uni_modal("product Details", "view_product.php?id=" + $(this).attr('data-id'), 'mid-large')

	})
	$('.edit_product').click(function() {
		location.href = "index.php?page=manage_product&id=" + $(this).attr('data-id')

	})
	$('.delete_product').click(function() {
		_conf("Are you sure to delete this product?", "delete_product", [$(this).attr('data-id')])
	})

	function delete_product($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_product',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>