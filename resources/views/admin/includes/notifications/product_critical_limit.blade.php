<li>
    <a href="{{ route( 'admin.products.show', $notification->data['id'] ) }}">
        <i class="fa fa-cubes text-info"></i>
        <span class="text">Product {{ $notification->data['name'] }} Quantity reached to <span class="badge badge-warning no-margin">{{ $notification->data['instock_quantity'] }}</span></span>
    	<span class="timestamp">
    		<span class="fa fa-clock-o"></span>
    		{{ \Carbon\Carbon::parse( $notification->data['updated_at'] )->diffForHumans() }}
    	</span>
    </a>
</li>