@extends('dashboard.layout.dashboard_app')
@section('title','Home')

@section('content')

<div class="container">
	<div class="row">
		
		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body btn-light">
					<h3 class="count-card-title"></h3>
					<h3 class="count-card-text">Total Visitor</h3>
				</div>
			</div>
		</div>


			<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body btn-secondary">
					<h3 class="count-card-title"></h3>
					<h3 class="count-card-text">Total Service</h3>
				</div>
			</div>
		</div>

			<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body btn-primary">
					<h3 class="count-card-title"></h3>
					<h3 class="count-card-text">Total Project</h3>
				</div>
			</div>
		</div>

			<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body bg-success">
					<h3 class="count-card-title"></h3>
					<h3 class="count-card-text">Total Contact</h3>
				</div>
			</div>
		</div>


	</div>
</div>

@endsection