@extends('adminlte::page')

@section('content')
<!-- Afficher la liste des roles -->
<div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-sm-12">
        <br>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">Tous les rôles</h3>
            </div>
            <div class="box-body  table-responsive">
                <table class="table table-striped table-hover" id="postTable" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Date de création</th>
                            <th colspan="3">&nbsp;</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->slug}}</td>
                                <td>{{$role->description}}</td>
                                <td>{{$role->created_at}}</td>
                                <td width="10px">
                                    @can('role.show')
                                        {!! link_to_route('role.show', 'Voir', [$role->id], ['class' => 'btn btn-md btn-success']) !!}
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('role.edit')
                                        {!! link_to_route('role.edit', 'Modifier', [$role->id], ['class' => 'btn btn-md btn-warning ']) !!}
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('role.destroy')
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['role.destroy',   $role->id]]) !!}
                                            {!! Form::submit('Supprimer', ['class' => 'btn btn-md btn-danger', 'onclick' => 'return confirm(\'Vraiment supprimer ce role ?\')']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>    
        @can('role.create')
            {!! link_to_route('role.create', 'Ajouter un rôle', [], ['class' => 'add-modal btn btn-xs btn-info pull-right']) !!}
        @endcan
        {!! $links !!}
    </div>
</div>



@endsection


@section('css')
    <link rel="stylesheet" href="/css/admin_costom.css">
@endsection
    