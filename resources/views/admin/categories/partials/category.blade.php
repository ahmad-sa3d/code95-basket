<li class="list-group-item">
	<div class="row">
		<div class="col-sm-9">
			<h5 class="list-group-item-heading">{{ $category->title }}</h5>
		</div>
		<div class="col-sm-3 pull-right text-right">
			<a href="{{ route( 'admin.categories.show', $category->id ) }}" class="no-underline" data-toggle="tooltip" title="show">
				<i class="fa fa-sitemap"></i>
			</a>
			<a href="{{ route( 'admin.categories.edit', $category->id ) }}" class="margin-0-5 no-underline" data-toggle="tooltip" title="edit">
				<i class="glyphicon glyphicon-edit"></i>
			</a>
			<a href="{{ route( 'admin.categories.delete', $category->id ) }}" class="no-underline text-danger" data-toggle="tooltip" title="delete">
				<i class="glyphicon glyphicon-trash"></i>
			</a>
		</div>
	</div>
</li>

@if( !$category->childs->isEmpty() )
	<ul class="level" level-for="{{ $category->id }}" title="Childs of {{ $category->title }}">
		@each( 'admin.categories.partials.category', $category->childs, 'category' )
	</ul>
@endif