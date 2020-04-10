@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $feed->description }}</div>
                    <div class="card-body">
                        @include('feeditems.paginated')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
