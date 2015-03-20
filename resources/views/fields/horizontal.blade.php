<div class="form-group">
	{!! Form::label($name, $label, ['class' => 'col-md-3 control-label']) !!}
	<div class="col-md-8">
	  <div class="input-group">
	  		{!! $control !!}
	      	<span class="input-group-addon"><i class="fa fa-bars"></i></span>
	  </div>
	  @if ($error)<div class="help-block animation-pullUp" style="color: #de815c;">{{ $error }}</div>@endif
	</div>
</div>