@extends('layouts.master')

@section('page_title')
Admin Login
@endsection

@section('content')
<div class="row justify-content-sm-center">
	<div class="col col-sm-5 mt-5">
		<login-card :action="{{ json_encode(route('ajax_login')) }}"></login-card>
	</div>
</div>
@endsection
@section('scripts')

@endsection