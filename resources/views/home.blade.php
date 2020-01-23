@extends('layouts.app')

@section('content')
    <participant-component
        :lang="{{session()->get('lang')}}"
    ></participant-component>
@endsection
