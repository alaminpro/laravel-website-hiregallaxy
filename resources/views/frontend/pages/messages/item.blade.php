 <li id="conversation-{!! $conv->id !!}" data-id="{!! $conv->id !!}" class="conversation-item {!! ( Illuminate\Support\Facades\Route::is('message') && request()->id ==  $conv->id) || (!request()->id && $key == 0) ? ' active':''!!}" >
    <div class="media">
        @if(!isset($html_receive) && auth()->id() === $conv->sender_id)
            <img class="mr-2 border rounded-circle" src="{{ App\Helpers\ReturnPathHelper::getUserImage($conv->receive['id']) }}">
        @else
            <img class="mr-2 border rounded-circle" src="{{ App\Helpers\ReturnPathHelper::getUserImage($conv->sender['id']) }}">
        @endif
        <div class="media-body">
            @if(auth()->id() === $conv->sender_id)
                <strong>{!! $conv->receive['username'] !!}</strong>
            @else
                <strong>{!! $conv->sender['username'] !!}</strong>
            @endif
            <p class="mb-0">{!! isHTML($conv->last_message)?'<i class="far fa-image"></i> Image': \Str::words($conv->last_message, 3, $end = '...') !!}</p>
        </div>
    </div>
</li> 
