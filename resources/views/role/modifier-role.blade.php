@extends('adminlte::page')

@section('content')
<div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-sm-12">
        <br>
        <div class="panel panel-warning">  
            <div class="panel-heading">Modifier un rôle</div>
            <div class="panel-body">
                <div class="col-sm-12">
                        {!! Form::model($role, ['route' => ['role.update', $role->id], 'method' => 'put']) !!}
                            <div class="row">
                                <div class="form-group col-md-6 {!! $errors->has('name') ? 'has-error' : '' !!}">
                                    <label for="nom" class="control-label">Nom </label>
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                                    {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-group col-md-6 {!! $errors->has('slug') ? 'has-error' : '' !!}">
                                    <label for="slug" class="control-label">Slug *</label>
                                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug']) !!}
                                    {!! $errors->first('slug', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 {!! $errors->has('description') ? 'has-error' : '' !!}">
                                    <label for="description" class="control-label">Description </label>
                                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                                    {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                            <hr>
                            <h3>Permissions spéciales</h3>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>{{ Form::radio('special', 'all-access') }} Tous les accès</label>
                                    <label>{{ Form::radio('special', 'no-access') }} Pas d'accès</label>
                                </div>
                            </div>
                            <hr>
                            <h3>Liste des permissions</h3>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <ul class="list-unstyled">
                                        @foreach($permissions as $permission)
                                            <li>
                                                <label>
                                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                                    {{ $permission->name }}
                                                    <em>({{ $permission->description ?: 'Sans description' }})</em>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>                               
                            <div class="clearfix">
                                {!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
                            </div> 
                        {!! Form::close() !!}
                    </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
    
@section('js')
    <script type="text/javascript"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_costom.css">
@endsection