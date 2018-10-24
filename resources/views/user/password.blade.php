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
    		<div class="panel-heading">Modifier votre mot de passe</div>
    		<div class="panel-body">
    			<div class="col-sm-12">
    				<form> 
    					<div class="row">
    						<div class="form-group col-md-6 {!! $errors->has('password') ? 'has-error' : '' !!}">
                                <label for="password" class="control-label">Ancien mot de passe *</label>
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ancien mot de passe']) !!}
                                {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
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
    				</form> 
    			</div>
    		</div>
    	</div>
    </div>	
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_costom.css">
@endsection