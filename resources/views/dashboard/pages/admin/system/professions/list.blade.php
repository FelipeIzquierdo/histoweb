@extends('dashboard.pages.layout')
    @section('title') 
        Profesiones
    @endsection

    @section('dashboard_title')
        <h1>
            <i class="fa fa-user-md"></i>
            Profesiones
            <a href="{{ route('admin.system.professions.create') }}" class="btn btn-info" title="Nueva Profesión">
                <i class="fa fa-plus"></i>
            </a>
        </h1>
    @endsection
    
    @section('dashboard_body')
        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Lista de</span> Profesiones</h2>
            </div>
            <div class="table-responsive">
                @if($professions->isEmpty())
                    <div class="well text-center">Profesión no encontrada.</div>
                @else
                    <table id="general-table" class="table table-vcenter table-striped table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th width="50px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($professions as $profession)
                                <tr>
                                    <td>{!! $profession->id !!}</td>
                                    <td>{!! $profession->name !!}</td>
                                    <td>{!! $profession->description !!}</td>
                                    <td>
                                        <a href="{!! route('admin.system.professions.edit', [$profession->id]) !!}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar Profesión"><i class="fa fa-pencil"></i></a>
                                        <a href="{!! route('professions.delete', [$profession->id]) !!}" onclick="return confirm('Are you sure wants to delete this AnesthesiaTypes?')" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-danger" data-original-title="Eliminar Profesión"><i class="fa fa-times"></i></a>                                    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12">
                   {!! $professions->render() !!}
                </div>
            </div>
        </div>
    @endsection