@if(auth()->user()->role == 'admin' || auth()->user()->role == 'developer')
    <div class="card">
        <div class="card-header bg-cyan">
            <h6>Comments</h6>
        </div>

        <div class="card-body">
            @if(count($order->comments) > 0)
                @forelse($order->comments as $comment)

                    @if($comment->user_id == auth()->user()->id || $comment->user_id == '1' || $comment->order_id == $order->id)
                        <div class="@if($comment->user_id == auth()->user()->id) text-right @endif">
                            <h6>{{ ucwords($comment->user->name) }}</h6>

                            <p>
                                {!! nl2br(chunk_split(e($comment->comment), 120, "\n")) !!}
                            </p>
                        </div>
                    @endif
                @empty
                @endforelse
            @endif
        </div>
    </div>
@endif
