@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Staff</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('staff.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($staff->isEmpty())
                <div class="well text-center">No Staff found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Name</th>
			<th>Description</th>
			<th>Code</th>
                    <th width="50px">Action</th>
                    </thead>
                    <tbody>
                     
                    @foreach($staff as $staff)
                        <tr>
                            <td>{!! $staff->name !!}</td>
					<td>{!! $staff->description !!}</td>
					<td>{!! $staff->code !!}</td>
                            <td>
                                <a href="{!! route('staff.edit', [$staff->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('staff.delete', [$staff->id]) !!}" onclick="return confirm('Are you sure wants to delete this Staff?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection