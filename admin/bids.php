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
						<b>List barang lelang</b>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Produk</th>
									<th class="">Nama</th>
									<th class="">Harga</th>
									<th class="">Status</th>
									<th class=""></th>
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
								$books = $conn->query("SELECT b.*, u.name as uname,p.name,p.bid_end_datetime bdt FROM lelangs b inner join users u on u.id = b.user_id inner join products p on p.id = b.product_id ");
								while ($row = $books->fetch_assoc()) :
									$get = $conn->query("SELECT * FROM lelangs where product_id = {$row['product_id']} order by harga_lelang desc limit 1 ");
									$uid = $get->num_rows > 0 ? $get->fetch_array()['user_id'] : 0;
								?>
									<tr>
										<td class="text-center"><?= $i++ ?></td>
										<td class="">
											<p> <b><?= ucwords($row['name']) ?></b></p>
										</td>
										<td class="">
											<p> <b><?= ucwords($row['uname']) ?></b></p>
										</td>
										<td class="text-right">
											<p> <b><?= number_format($row['harga_lelang'], 2) ?></b></p>
										</td>
										<td class="text-center">
											<?php if ($row['status'] == 1) : ?>
												<?php if (strtotime(date('Y-m-d H:i')) < strtotime($row['bdt'])) : ?>
													<span class="badge badge-secondary">Sedang dilelang</span>
												<?php else : ?>
													<?php if ($uid == $row['user_id']) : ?>
														<span class="badge badge-success">Menang lelang</span>
													<?php else : ?>
														<span class="badge badge-secondary">Kalah lelang</span>
													<?php endif; ?>
												<?php endif; ?>
											<?php elseif ($row['status'] == 2) : ?>
												<span class="badge badge-primary">Dikonfirmasi</span>
											<?php else : ?>
												<span class="badge badge-danger">Dibatalkan</span>
											<?php endif; ?>
										</td>
										<td>
											<button class="btn btn-primary btn-sm view_user" type="button" data-id='<?= $row['user_id'] ?>'>Lihat detail pembeli</button>
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

	img {
		max-width: 100px;
		max-height: 150px;
	}
</style>
<script>
	$(document).ready(function() {
		$('table').dataTable()
	})

	$('.view_user').click(function() {
		uni_modal("<i class'fa fa-card-id'></i> Buyer Details", "view_udet.php?id=" + $(this).attr('data-id'))

	})
	$('#new_book').click(function() {
		uni_modal("New Book", "manage_booking.php", "mid-large")

	})
	$('.edit_book').click(function() {
		uni_modal("Manage Book Details", "manage_booking.php?id=" + $(this).attr('data-id'), "mid-large")

	})
	$('.delete_book').click(function() {
		_conf("Are you sure to delete this book?", "delete_book", [$(this).attr('data-id')])
	})

	function delete_book($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_book',
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