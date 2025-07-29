@extends('layouts.app')

@section('content_title', 'Data Users')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data Users</h3>
					<div class="d-flex justify-content-end mb-2">
						<x-user.form-user />
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body table-responsive">

					<table class="table table-sm table-hover text-nowrap" id="table1">
						<thead>
							<tr>
								<th>No.</th>
								<th>Name</th>
								<th>Email</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($model as $item)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ ucwords($item->name) }}</td>
								<td>{{ $item->email }}</td>
								<td>
									<div class="btn-group">
										<x-user.form-user :id="$item->id" />
										<a href="{{ route('users.destroy', $item->id) }}" data-confirm-delete='true'
											class="btn btn-danger btn-sm">
											<i class="fas fa-trash"></i>
										</a>
										<x-user.reset-password :id="$item->id" />
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
