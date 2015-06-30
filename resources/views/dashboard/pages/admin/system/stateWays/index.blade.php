@extends('dashboard.pages.layout')
    @section('title') 
        Estado de Vias
    @endsection

    @section('dashboard_title')
        <h1>
            <i class="fa fa-user-md"></i>
            Estado de Vias
            <a href="{{ route('admin.system.stateWays.create') }}" class="btn btn-info" title="Nueva Tipo de Anestesia">
                <i class="fa fa-plus"></i>
            </a>
        </h1>
    @endsection
    
    @section('dashboard_body')
        <div class="block">
            @include('flash::message')
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Lista de</span> Estado de Vias</h2>
            </div>
            <div class="table-responsive">
                @if($stateWays->isEmpty())
                    <div class="well text-center">Estado de via no encontrada.</div>
                @else
                    <table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Código</th>
                                <th width="50px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stateWays as $stateWay)
                                <tr>
                                    <td>{!! $stateWay->name !!}</td>
                                    <td>{!! $stateWay->description !!}</td>
                                    <td>{!! $stateWay->code !!}</td>
                                    <td>
                                        <a href="{!! route('admin.system.stateWays.edit', [$stateWay->id]) !!}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar estado de via"><i class="fa fa-pencil"></i></a>
                                        <a href="{!! route('stateWays.delete', [$stateWay->id]) !!}" onclick="return confirm('Are you sure wants to delete this AnesthesiaTypes?')" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-danger" data-original-title="Eliminar estado de via"><i class="fa fa-times"></i></a>                                    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12">
                   
                </div>
            </div>
        </div>
    @endsection