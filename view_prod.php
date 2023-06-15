<?php include 'admin/db_connect.php' ?>
<?php
session_start();
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM products where id= " . $_GET['id']);
	foreach ($qry->fetch_array() as $k => $val) {
		$$k = $val;
	}
	$cat_qry = $conn->query("SELECT * FROM categories where id = $category_id");
	$category = $cat_qry->num_rows > 0 ? $cat_qry->fetch_array()['name'] : '';
}
?>
<style type="text/css">
	#bid-frm {
		display: none
	}

	p {
		font-size: 15px;
	}
</style>
<div class="container-fluid">
	<img src="admin/assets/uploads/<?= $img_fname ?>" class="d-flex w-100" alt="">
	<p>Nama produk: <large><b><?= $name ?></b></large>
	</p>
	<p>Category: <b><?= $category ?></b></p>
	<p>Harga Awal: <b><?= number_format($harga_awal, 2) ?></b></p>
	<p>Sampai: <b><?= date("m d,Y h:i A", strtotime($bid_end_datetime)) ?></b></p>
	<p>Tawaran Tertinggi: <b id="hbid"><?= number_format($harga_awal, 2) ?></b></p>
	<p>Deskripsi:</p>
	<p class=""><small><i style="font-size: 13px;"><?= $description ?></i></small></p>
	<div class="col-md-12">
		<button class="btn btn-primary btn-block btn-lg" type="button" id="bid">Lelang</button>
	</div>
	<div id="bid-frm">
		<div class="col-md-12">
			<form id="manage-bid">
				<input type="hidden" name="product_id" value="<?= $id ?>">
				<div class="form-group">
					<label for="" class="control-label">Bid Amount</label>
					<input type="number" class="form-control text-right" name="harga_lelang">
				</div>
				<div class="row justify-content-between">
					<button class="btn col-sm-5 btn-primary btn-block btn-sm mr-2">Submit</button>
					<button class="btn col-sm-5 btn-secondary mt-0 btn-block btn-sm" type="button" id="cancel_bid">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	var _updateBid = setInterval(function() {
		$.ajax({
			url: 'admin/ajax.php?action=get_latest_bid',
			method: 'POST',
			data: {
				product_id: '<?= $id ?>'
			},
			success: function(resp) {
				if (resp && resp > 0) {
					$('#hbid').text(parseFloat(resp).toLocaleString('en-US', {
						style: 'decimal',
						maximumFractionDigits: 2,
						minimumFractionDigits: 2
					}))
				}
			}
		})
	}, 1000)

	$('#manage-bid').submit(function(e) {
		e.preventDefault()
		start_load()
		var latest = $('#hbid').text()
		latest = latest.replace(/,/g, '')
		if (parseFloat(latest) > $('[name="harga_lelang"]').val()) {
			alert_toast("Harga tawaran harus lebih tinggi dari harga tertinggi saat ini.", 'danger')
			end_load()
			return false;
		}
		$.ajax({
			url: 'admin/ajax.php?action=save_bid',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Tawaran lelang berhasil disubmit", 'success')
					end_load()
				} else if (resp == 2) {
					alert_toast("Harga tertinggi saat ini masih milik anda.", 'danger')
					end_load()
				}
			}
		})
	})
	$('#bid').click(function() {
		if ('<?= isset($_SESSION['login_id']) ? 1 : '' ?>' != 1) {
			$('.modal').modal('hide')
			uni_modal("LOGIN", 'login.php')
			return false;
		}
		$(this).hide()
		$('#bid-frm').show()
	})
	$('#cancel_bid').click(function() {
		$('#bid').show()
		$('#bid-frm').hide()
	})
</script>