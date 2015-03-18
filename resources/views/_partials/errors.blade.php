@foreach ($errors->all() as $error)    
    <div class="alert alert-danger alert-dismissable site-block">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p> {{$error}} </p>
    </div>
@endforeach