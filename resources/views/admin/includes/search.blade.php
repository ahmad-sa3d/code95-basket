@section( 'breadcrumbs' )
	@include( 'admin.includes.breadcrumbs.' . $for, [ 'is_index'=>false ])
	
	@if( !empty( $search_key ) )
		<li>
			<a href="{{ route('admin.' . $for . '.search') }}" class="breadcrumb-item">
				<span class="glyphicon glyphicon-search"></span>
				بحث
			</a>
		</li>
		<li>
			<span class="breadcrumb-item">
				{{ $search_key }}
			</span>
		</li>
	@else
		<li>
			<span class="breadcrumb-item">
				<span class="glyphicon glyphicon-search"></span>
				بحث
			</span>
		</li>

	@endif
@endsection


@section( 'content' )
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					<form action="" class="">
						<div class="form-group">
							<div class="input-group">
								<input type="text" name="key" class="form-control" value="{{ $search_key }}">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default">
										<span class="fa fa-search"></span>
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>{{-- End Row --}}

			<h4>النتائج <small class="">( {{ $result->isEmpty() ? 0 : $result->total() }} )</small></h4>
		</div>
		
		@if( !$result->isEmpty() )
			@include( 'admin.' . $for . '.includes.'. $for . '_table' )
		@endif
		
	</div>
@endsection