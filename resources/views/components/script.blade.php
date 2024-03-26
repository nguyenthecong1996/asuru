<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
{{-- Yara DataTables --}}
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- apps -->
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<script src="{{ asset('dist/js/app.init.js') }}"></script>
<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('dist/js/custom.js') }}"></script>
</script>
<script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/forms/select2/select2.init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/fullcalendar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale-all.min.js"></script>
<script src="{{ asset('js/function.js') }}"></script>
<script>
    $('body').on('submit', '.base-form', function() {
        $(this).find('button[type="submit"]').attr('disabled', 'disabled');
    })
</script>
<script src="{{ asset('assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
<script>
    var trans = <?php echo json_encode(trans('common')); ?>;
    var locale = <?php echo json_encode(Illuminate\Support\Facades\App::currentLocale());?>;
</script>
<script type="text/javascript">
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    
    var page = 2;
    $('.show-all-notification').on('click', function (event) {
        event.stopPropagation();
        $(this).html('<div class="spinner-grow" role="status"><span class="sr-only">Loading...</span></div>')
        $.ajax({
            url:"{{route('customers.index')}}",
            data: {page:page},
            dataType: 'json',
            success: function(response){
                $(".scroll-notifications").append(response);
                $('.show-all-notification').text('Show More')
                page += 1;
            }
        });
    })

    $( document.body ).on( 'click', '.icon-country', function( event ) {
        var $target = $( event.currentTarget );
        var country = $target.data('icon');
        var icon = country;
        if(country == 'en') {
            icon = 'us'
        }
        var html = `<i class="flag-icon flag-icon-${icon} change-icon"></i>`
        $('#navbarDropdown2').html(html)
        $.ajax({
            url:"{{route('customers.index')}}",
            method: 'post',
            data: {
                icon : icon
            },
            dataType: 'json',
            success: function(response){
                location.reload();
            }
        });
    });
</script>
<script>
    @if (Session::has('message'))
        toastr.success('{{ session('message') }}');
    @endif

    @if (Session::has('error'))
        toastr.error('{{ session('error') }}');
    @endif
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
   
</script>
@yield('script')
