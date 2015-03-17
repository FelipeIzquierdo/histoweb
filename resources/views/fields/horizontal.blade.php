     <div class="form-group">
        <div class="col-xs-12">
            {!! Form::label($name, $label) !!}
            {!! $control !!}
            @if ($error)
                <p class="error_message">{{ $error }}</p>
            @endif
        </div>
    </div>