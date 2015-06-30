
@extends('dashboard.pages.layout')
    @section('title') 
        Vias De Entrada
    @endsection

    @section('dashboard_title')
        <h1>
            <i class="fa fa-user-md"></i>
            Vias de Entrada
            <a href="{{ route('admin.system.wayEntries.create') }}" class="btn btn-info" title="Nueva Via de entrada">
                <i class="fa fa-plus"></i>
            </a>
        </h1>
    @endsection
    
    @section('dashboard_body')
        <div class="block">
            @include('flash::message')
            <div class="block-title clearfix">
                <h2><span class="hidden-xs">Lista de</span>Vias de entrada</h2>
            </div>
            <div class="table-responsive">
                @if($wayEntries->isEmpty())
                    <div class="well text-center">Via de entrada no encontrada.</div>
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
                            @foreach($wayEntries as $wayEntry)
                                <tr>
                                    <td>{!! $wayEntry->name !!}</td>
                                    <td>{!! $wayEntry->description !!}</td>
                                    <td>{!! $wayEntry->code !!}</td>
                                    <td>
                                        <a href="{!! route('admin.system.wayEntries.edit', [$wayEntry->id]) !!}" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-warning" data-original-title="Editar via de entrada"><i class="fa fa-pencil"></i></a>
                                        <a href="{!! route('wayEntries.delete', [$wayEntry->id]) !!}" onclick="return confirm('Are you sure wants to delete this AnesthesiaTypes?')" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-sm btn-danger" data-original-title="Eliminar via de entrada"><i class="fa fa-times"></i></a>                                    
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