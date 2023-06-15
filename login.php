<?php session_start() ?>
<div class="container-fluid">
	<form action="" id="login-frm">
		<div class="form-group">
			<label for="" class="control-label" style="font-size: 13px;">Username</label>
			<input type="text" name="username" required="" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label" style="font-size: 13px;">Password</label>
			<input type="password" name="password" required="" class="form-control">
			<a href="javascript:void(0)" id="new_account" style="font-size: 13px;">Create New Account</a>
		</div>
		<button class="button btn btn-primary btn-lg">Login</button>
		<button class="button btn btn-secondary btn-lg" type="button" data-dismiss="modal">Cancel</button>
	</form>
</div>

<style>
	#uni_modal .modal-footer {
		display: none;
	}
</style>

<script>
	$('#new_account').click(function() {
		uni_modal("Create an Account", 'signup.php?redirect=index.php?page=checkout')
	})
	$('#login-frm').submit(function(e) {
		e.preventDefault()
		start_load()
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'admin/ajax.php?action=login2',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				end_load()

			},
			success: function(resp) {
				if (resp == 1) {
					location.href = '<?= isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
				} else {
					$('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
					end_load()
				}
			}
		})
	})
</script>