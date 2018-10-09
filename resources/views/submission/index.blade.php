@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="lead text-center">
                Welcome to {{ config('app.name') }}
            </div>

            <p class='text-center'>
                On this site you can view the Honk Kong Dollar exchange rate for your last birthday!
                <br/>
                <a href="{{ route('submissionCreate') }}">Click here to give it a go!</a>
            </p>

            @if(! $submissions->isEmpty())

                <ul class="list-group">
                    @foreach($submissions as $s)

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4">
                                    {{ Carbon\Carbon::parse($s->birthday)->format('jS F Y') }}
                                </div>
                                <div class="col-md-4">
                                    {{ $s->exchangeRate->formatted_hong_kong_dollar }}
                                </div>
                                <div class="col-md-4">
                                    Times submitted: {{ $s->occurrences }}
                                </div>
                            </div>
                        </li>

                    @endforeach
                </ul>
                <br/>
                {{ $submissions->links() }}

            @else
                <small>
                    No submissions have been made.
                </small>
            @endif
        </div>
    </div>

@stop
