@extends('adminlte::page')

@section('content')
<div>
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-sm-12">
        <br>
        <img src="img/uploads/avatars/{{ $user->photo }}" style="height:150px;width:150px;float:left;border-radius:50%;margin-right:25px">
        <form enctype="multipart/form-data" action="profil" method="post">
            <label>Modifier votre image de profil</label>
            <input type="file" name="photo">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="submit" class="pull-right btn btn-sm btn-primary">
        </form>
    </div>
    <div class="col-md-offset-4 col-md-4 text-center" style="padding:5px;">
    	<div>
    		<br/>
            {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put']) !!}
                <div class="row">
                    <div class="form-group col-md-12 {!! $errors->has('name') ? 'has-error' : '' !!}">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 {!! $errors->has('email') ? 'has-error' : '' !!}">
                        {!! Form::email('email', null, ['class' => 'form-control','disabled', 'placeholder' => 'Email']) !!}
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 {!! $errors->has('telephone') ? 'has-error' : '' !!}">
                        {!! Form::number('telephone', null, ['class' => 'form-control', 'placeholder' => 'Téléphone']) !!}
                        {!! $errors->first('telephone', '<small class="help-block">:message</small>') !!}
                    </div>
                </div>
                <div class="clearfix ">
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-success pull-center']) !!}
                </div>
            {!! Form::close() !!}
    	</div>
	</div>  
</div> 
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_costom.css">
@endsection



