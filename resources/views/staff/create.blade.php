@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'staff.store']) !!}

        @include('staff.fields')

    {!! Form::close() !!}
</div>
@endsection
