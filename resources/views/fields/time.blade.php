<div class="form-group">
    {!! Form::label($name, $label, ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-8">
        <div class="input-group bootstrap-timepicker">
            {!! $control !!}
            <span class="input-group-btn">
                <a href="javascript:void(0)" class="btn btn-effect-ripple btn-primary"><i class="fa fa-clock-o"></i></a>
            </span>
        </div>
        @if ($error)<div class="help-block animation-pullUp" style="color: #de815c;">{{ $error }}</div>@endif
    </div>
</div>
