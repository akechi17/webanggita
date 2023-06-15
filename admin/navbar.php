<style>
	.collapse a {
		text-indent: 10px;
	}
</style>

<nav id="sidebar" class='mx-lt-5' style="background-color: #ffffffc4;">

	<div class="sidebar-list">
		<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
		<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-list"></i></span> Kategori</a>
		<a href="index.php?page=products" class="nav-item nav-products"><span class='icon-field'><i class="fa fa-th-list"></i></span> Produk</a>
		<a href="index.php?page=bids" class="nav-item nav-bids"><span class='icon-field'><i class="fa fa-money-bill-alt"></i></span> Lelang</a>
		<?php if ($_SESSION['login_type'] == 1) : ?>
			<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
		<?php endif; ?>
	</div>

</nav>
<script>
	$('.nav_collapse').click(function() {
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?= isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>