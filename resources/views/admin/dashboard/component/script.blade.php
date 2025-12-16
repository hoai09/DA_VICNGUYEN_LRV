
<!-- Mainly scripts -->
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('js/inspinia.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

@if(isset($config['js']) && is_array($config['js']) )
@foreach ($config['js'] as $val)
    {!! '<script src="'.$val.'"></script>' !!}
@endforeach
@endif
