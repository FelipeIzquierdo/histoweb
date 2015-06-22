@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($staff, ['route' => ['staff.update', $staff->id], 'method' => 'patch']) !!}

        @include('staff.fields')

    {!! Form::close() !!}
</div>
@endsection
