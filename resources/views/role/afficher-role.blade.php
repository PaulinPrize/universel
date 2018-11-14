@extends('adminlte::page')

@section('content')
<div>
	@if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <br>
            <div class="panel panel-warning">
                <div class="panel-heading">Fiche rôle</div>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <p>ID : {{ $role->id }}</p>
                        <p>Nom : {{ $role->name }}</p>
                        <p>Slug : {{ $role->slug }}</p>
                        <p>Description : {{ $role->description }}</p>
                        <p>Date de création : {{ $role->created_at }}</p>
                        <p>Dernière modification : {{ $role->updated_at }}</p>
                    </div>
                </div>
            </div>
            <table>
                <tr>
                    <td>
                        @can('role.index')
                            {!! link_to_route('role.index', 'Retourner à la liste', [$role->id], ['class' => 'btn btn-md btn-warning ']) !!}
                        @endcan
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_costom.css">
@endsection