     <div class="form-group">
        <div class="col-xs-12">
            {!! $control !!}
            @if ($error)
                <p class="error_message">{{ $error }}</p>
            @endif
            {{$template}}
        </div>
    </div>