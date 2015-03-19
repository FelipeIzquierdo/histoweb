<div class="form-group">
	{!! Form::label($name, $label, ['class' => 'col-md-3 control-label']) !!}
	<div class="col-md-8">
	  <div class="input-group">
	  		{!! $control !!}
	      	<span class="input-group-addon"><i class="fa fa-bars"></i></span>
	  </div>
	  @if ($error)<span class="help-block text-danger">{{ $error }}</span>@endif
	</div>
</div>