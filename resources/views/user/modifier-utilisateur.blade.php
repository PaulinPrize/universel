@extends('adminlte::page')

@section('content')
<div>
	@if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
    	<div class="col-sm-9">
    		<br>
    		<div class="panel panel-warning">
                <div class="panel-heading">Editer le profil</div>
    			<div class="panel-body">
    				<div class="col-sm-12">
    					{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put']) !!}
                            <div class="row">
                                <div class="form-group col-md-6 {!! $errors->has('name') ? 'has-error' : '' !!}">
                                    <label for="name" class="control-label">Nom </label>
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                                    {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-group col-md-6 {!! $errors->has('telephone') ? 'has-error' : '' !!}">
                                    <label for="telephone" class="control-label">Téléphone</label>
                                    {!! Form::number('telephone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone']) !!}
                                    {!! $errors->first('telephone', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 {!! $errors->has('email') ? 'has-error' : '' !!}">
                                    <label for="email" class="control-label">Email </label>
                                    {!! Form::email('email', null, ['class' => 'form-control','disabled', 'placeholder' => 'Email']) !!}
                                    {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 {!! $errors->has('password') ? 'has-error' : '' !!}">
                                    <label for="password" class="control-label">Nouveau mot de passe *</label>
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Nouveau mot de passe']) !!}
                                    {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirmer" class="control-label">Confirmer *</label>
                                    {!! Form::password('confirmer', ['class' => 'form-control', 'placeholder' => 'Confirmation mot de passe']) !!}
                                </div>
                            </div>  
                            <hr>
                            <h3>Liste des rôles</h3>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <ul class="list-unstyled">
                                        @foreach($roles as $role)
                                            <li>
                                                <label>
                                                    {{ Form::checkbox('roles[]', $role->id, null) }}
                                                    {{ $role->name }}
                                                    <em>({{ $role->description ?: 'Sans description' }})</em>
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
    	<div class="col-sm-3">
    		<br>
    		<div class="panel panel-warning">
                <div class="panel-heading text-center">Photo</div>
    			<div class="panel-body">
    				<div class="thumbnail">
        				<img src="{{asset('img/'.Auth::user()->photo.'')}}" class="img-square" style="height:225px;width:225px;">
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_costom.css">
@endsection