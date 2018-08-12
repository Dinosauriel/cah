@extends('layouts.master')

@section('page_title')
Admin Login
@endsection

@section('content')
<div class="row justify-content-sm-center">
	<div class="col col-sm-5 mt-5">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Admin Login</h5>
				<p class="card-text">Log In to start creating games</p>
				<form action="{{ route('login') }}" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="admin_password">Password</label>
						<input type="password" class="form-control" id="admin_password" name="admin_password">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')

@endsection