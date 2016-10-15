<li>
    <a href="{{ route( 'invoice', $notification->data['id'] ) }}">
        <i class="fa fa-money green-font"></i>
        <span class="text">New invoice with total of <span class="badge badge-info no-margin">{{ $notification->data['net'] }} L.E.</span></span>
		<span class="timestamp">
    		<span class="fa fa-clock-o"></span>
    		{{ \Carbon\Carbon::parse( $notification->data['created_at'] )->diffForHumans() }}
    	</span>
    </a>
</li>