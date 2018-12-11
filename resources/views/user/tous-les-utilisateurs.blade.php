@extends('adminlte::page')

@section('content')
<!-- Afficher la liste des utilisateurs -->
<div>
    <!-- Sert à afficher un message éventuel provenant du contrôleur -->
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-sm-12">
        <br>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">Tous les utilisateurs</h3>
            </div>
            <div class="box-body  table-responsive">
                <table class="table table-striped table-hover" id="postTable" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Date de création</th>
                            <th>Date de modification</th>
                            <th>Etat</th>
                            <th colspan="3">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->updated_at)->diffForHumans() }}</td>
                                <td>
                                    @if($user->isOnline())
                                        <i class="fa fa-circle text-success"></i> En ligne
                                    @else
                                        <i class="fa fa-circle text-muted"></i> Déconnecté
                                    @endif
                                </td>
                                <td width="10px">
                                    @can('user.show')
                                        {!! link_to_route('user.show', 'Voir', [$user->id], ['class' => 'btn btn-md btn-success']) !!}
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('user.edit')
                                        {!! link_to_route('user.edit', 'Modifier', [$user->id], ['class' => 'btn btn-md btn-warning ']) !!}
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('user.destroy')
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy',   $user->id]]) !!}
                                            {!! Form::submit('Supprimer', ['class' => 'btn btn-md btn-danger', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>    
        @can('user.create')
            {!! link_to_route('user.create', 'Ajouter un utilisateur', [], ['class' => 'add-modal btn btn-xs btn-info pull-right']) !!}
        @endcan
        {!! $links !!}
    </div>
</div>
@endsection


@section('css')
    <link rel="stylesheet" href="/css/admin_costom.css">
@endsection
    