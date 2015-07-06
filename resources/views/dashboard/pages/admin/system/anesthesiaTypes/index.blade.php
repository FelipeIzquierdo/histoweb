@extends('dashboard.pages.layout')
    @section('title') 
        Tipos de Anestesia
    @endsection

    @section('dashboard_title')
        <h1>
            <i class="fa fa-user-md"></i>
            Tipos de Anestesia
            <a href="{{ route('admin.system.anesthesiaTypes.create') }}" class="btn btn-info" title="Nueva Tipo de Anestesia">
                <i class="fa fa-plus"></i>
            </a>
        </h1>
    @endsection
    
    @section('dashboard_body')
        <div class="block">
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Lista de</span> Tipos de Anestesia</h2>
            </div>
            <div class="table-responsive">
                @if($anesthesiaTypes->isEmpty())
                    <div class="well text-center">Tipos de Anestesia no encontrada.</div>
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
                            @foreach($anesthesiaTypes as $anesthesiaTypes)
                                <tr>
                                    <td>{!! $anesthesiaTypes->name !!}</td>
                                    <td>{!! $anesthesiaTypes->description !!}</td>
                                    <td>{!! $anesthesiaTypes->code !!}</td>
                                    <td>
                                        <a href="{!! route('admin.system.anesthesiaTypes.edit', [$anesthesiaTypes->id]) !!}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar tipos anestesias"><i class="fa fa-pencil"></i></a>
                                        <a href="{!! route('anesthesiaTypes.delete', [$anesthesiaTypes->id]) !!}" onclick="return confirm('Are you sure wants to delete this AnesthesiaTypes?')" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-danger" data-original-title="Eliminar tipos anestesias"><i class="fa fa-times"></i></a>                                    
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