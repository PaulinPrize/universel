@extends('adminlte::page')

@section('content')
<div>
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-md-offset-4 col-md-4 text-center" style="padding:5px;">
        <img src="{{asset('img/avatars/'.Auth::user()->photo.'')}}" style="width:150px;height:150px;margin-right:25px;border-radius: 50%"/>
        <div>
            <br/>
            <form enctype="multipart/form-data" action="profil" method="POST">
                <label>Modifier votre image de profil</label>
                <input type="file" name="photo" class="form-control">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <br/>
                <div class="row">
                    <div class="form-group col-md-12 {!! $errors->has('name') ? 'has-error' : '' !!}">
                        <input type="text" id="name" name="name" class="form-control" value="{{Auth::user()->name}}"/>
                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="email" id="email" name="email" class="form-control" value="{{Auth::user()->email}}" disabled/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 {!! $errors->has('telephone') ? 'has-error' : '' !!}">
                        <input type="number" id="telephone" name="telephone" class="form-control" value="{{Auth::user()->telephone}}"/>
                        {!! $errors->first('telephone', '<small class="help-block">:message</small>') !!}
                    </div>
                </div>
                <input type="submit" class="pull-right btn btn-sm btn-success" value="Enregistrer">
            </form>
        </div>
    </div>  
</div> 
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_costom.css">
@endsection



