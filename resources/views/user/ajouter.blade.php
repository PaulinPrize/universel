@extends('adminlte::page')

<link rel="stylesheet" href="{{ asset('css/admin_costom.css') }}">

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
            <div class="panel-heading">Ajouter un utilisateur</div>
            <div class="panel-body">
                <div class="col-sm-12">
                    {!! Form::open(['route' => 'user.store']) !!}
                        <div class="row">
                            <div class="form-group col-md-6 {!! $errors->has('name') ? 'has-error' : '' !!}">
                                <label for="name" class="control-label">Nom *</label>
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
                                <label for="email" class="control-label">Email *</label>
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 {!! $errors->has('password') ? 'has-error' : '' !!}">
                                <label for="password" class="control-label">Mot de passe *</label>
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de passe']) !!}
                                {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirmation" class="control-label">Confirmer *</label>
                                {!! Form::password('confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmation mot de passe']) !!}
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="ajout" id="ajout" value="admin"/>
                        <input type="hidden" class="form-control" name="photo" id="photo"  value="images.png"/>
                        <div class="clearfix">
                            {!! Form::submit('Envoyer', ['class' => 'btn btn-primary  pull-right']) !!}
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