<div class="col-sm-3">
    <a href="{{ $url_widget }}" class="widget">
        <div class="widget-content themed-background-info text-light-op text-center">
            <div class="widget-icon">
                {!! Html::image($icon_widget, 'Icon', ['class' => 'img-circle img-thumbnail']) !!}
            </div>
        </div>
        <div class="widget-content text-dark text-center">
            <strong>{{ $title_widget }}</strong>
        </div>
    </a>
</div>