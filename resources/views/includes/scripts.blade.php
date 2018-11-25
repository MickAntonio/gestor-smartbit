
<!-- Mainly scripts -->
{!! Html::script('js/jquery-3.1.1.min.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}
{!! Html::script('js/plugins/metisMenu/jquery.metisMenu.js') !!}
<!-- {!! Html::script('js/plugins/slimscroll/jquery.slimscroll.min.js') !!} -->

 <!-- Custom and plugin javascript -->
{!! Html::script('js/inspinia.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/datapicker/bootstrap-datepicker.js') !!}  

<script>

    $('#data_5 .input-daterange').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy-mm-dd"
    });

     $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
        format: "yyyy-mm-dd"
            });

</script>

@yield('scripts')

