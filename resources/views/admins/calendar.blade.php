@extends('layouts.layout', ['title' => 'Календарь'])

@section('content')
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
@endsection
