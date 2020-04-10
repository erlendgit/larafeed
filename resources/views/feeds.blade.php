@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __("Next is the list of feeds!") }}</div>

                    @if (count($feeds))
                            <ul class="list-group list-group-flush">
                                @foreach ($feeds as $feed)
                                    <li class="list-group-item"><a href="{{ $feed->route() }}">{{ $feed->description }}</a></li>
                                @endforeach
                            </ul>
                    @else
                        No feeds found yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
