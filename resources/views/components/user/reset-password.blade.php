<div>
	<button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#formResetPassword{{ $id }}">
		<i class="fas fa-lock-open"></i>
	</button>

	<div class="modal fade" id="formResetPassword{{ $id }}" aria-hidden="true" tabindex="-1"
		aria-labelledby="formResetPasswordLabel">
		<form action="{{ route('users.reset-password') }}" method="POST">
			@csrf
			<input type="hidden" name="id" value="{{ $id }}">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Reset Password</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Ketika Password User direset, maka Password User akan menjadi default yaitu
							<strong>"12345678"</strong>
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-sm btn-danger">Reset Password</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
