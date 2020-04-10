<div class="card">
    <ul class="list-group list-group-flush">
        @foreach($pager->getCollection() as $item)
            <li class="list-group-item {{ $item->testMarkRead() ? 'read' : 'unread' }}">
                <div class="card-title">
                    <a class="text-body" target="_blank"
                       href="{{$item->content['link'] }}">{{ $item->content['title'] }}</a>
                </div>
                <div class="text-black-50">
                    {{ $item->published_at->format('j F Y')}} |
                    {{ $item->feed->description }}
                </div>
            </li>
        @endforeach
    </ul>
</div>
@if ($pager->hasMorePages())
    <div class="mt-3">
        {{ $pager }}
    </div>
@endif
