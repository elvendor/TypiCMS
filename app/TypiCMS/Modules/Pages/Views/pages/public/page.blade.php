@section('css')
    @if($model->css)
    <style type="text/css">
        {{ $model->css }}
    </style>
    @endif
@stop

@section('js')
    @if($model->js)
    <script>
        {{ $model->js }}
    </script>
    @endif
@stop

@section('main')

    <div class="row">

        @if($sideMenu)
        <div class="col-sm-4">
            {{ $sideMenu }}
        </div>
        @endif

        <div class="col-sm-8">
            {{ $model->body }}
        </div>

    </div>

@stop
