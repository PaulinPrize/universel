@extends('adminlte::page')

@section('content')
<div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-md-offset-4 col-md-4 text-center" style="padding:5px;">
    	<img src="{{asset('img/'.Auth::user()->photo.'')}}" class="img-circle img-responsive center-block" alt="User Image" style="cursor:pointer;height:225px;width:225px;" id="mon_image" >
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
    <div id="medicaments" height="200px;"> 
        <form method="POST" name="form_cover" style="visibility: hidden;" enctype="multipart/form-data">
            <input type="file"  name="fichier"/>
            <input type="hidden" name="token" value="{{Auth::user()->id}}">                 
        </form>
    </div>
</div> 
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_costom.css">
@endsection

@section('js')
    <script>
        $(function(){
            var token = $('[name="token"]').val();
            $('#mon_image').click(function(){
                $('[name="fichier"]').trigger('click');
                $('[name="fichier"]').change(function(){
                    updateCouverture();
                });
            });
        });
       function updateCouverture()
       {
            var oData = new FormData(document.forms.namedItem("form_cover"));
            oData.append("CustomField", "This is some extra data");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                url: "updateImage",
                type: "POST",
                data: oData,
                processData: false,  
                contentType: false,   
                success:function(data){
                    if(data.nom)
                    {
                        var couverture  = document.getElementById('mon_image');
                        couverture.src = "{{asset('/')}}img/"+data.nom;
                    }
                    if(data.errors.fichier){
                        setTimeout(function () {
                            toastr.error(data.errors.fichier, 'Image Alert', {timeOut: 5000});
                        }, 500);
                    }
                },
            });
        }      
    </script>
@endsection


