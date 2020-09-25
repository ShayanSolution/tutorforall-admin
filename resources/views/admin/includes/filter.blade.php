<script>
    $('input[name="dates"]').daterangepicker({
        autoUpdateInput: false,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    $(document).ready(function()
    {
        $('body').on('change','.classes',function()
        {
            var value = $(this).val();
            if(value !== 'all')
            {
                var fd = new FormData();
                fd.append('class',value);
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url : "{{URL::to('/admin/tutors/fetchSubjects')}}",
                    type : 'POST',
                    data : fd,
                    dataType: 'html',
                    contentType: false,
                    processData: false,
                    success:function (response) {
                        $('.subjects').html(response);
                    }
                });
            }
            else {
                $('.subjects').html('<option value="all">Select Subjects</option>');
            }
        });
        $('#classes').select2({
        });
        $('#subjects').select2({
        });
    });
</script>
<script>
    $(document).ready(function()
    {
        $('body').on('change','.countries',function()
        {
            var value = $(this).val();
            if(value !== 'all')
            {
                var fd = new FormData();
                fd.append('country',value);
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url : "{{URL::to('/admin/tutors/fetchProvince')}}",
                    type : 'POST',
                    data : fd,
                    dataType: 'html',
                    contentType: false,
                    processData: false,
                    success:function (response) {
                        $('.provinces').html(response);
                    }
                });
            }
            else {
                $('.provinces').html('<option value="all">Select Province</option>');
                $('.cities').html('<option value="all">Select City</option>');
                $('.areas').html('<option value="all">Select Area List</option>');
            }
        });
        $('body').on('change','.provinces',function()
        {
            var value = $(this).val();
            if(value !== 'all')
            {
                var fd = new FormData();
                fd.append('province',value);
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url : "{{URL::to('/admin/tutors/fetchCity')}}",
                    type : 'POST',
                    data : fd,
                    dataType: 'html',
                    contentType: false,
                    processData: false,
                    success:function (response) {
                        $('.cities').html(response);
                    }
                });
            }
            else {
                $('.cities').html('<option value="all">Select City</option>');
                $('.areas').html('<option value="all">Select Area List</option>');
            }
        });
        $('body').on('change','.cities',function()
        {
            var value = $(this).val();
            if(value !== 'all')
            {
                var fd = new FormData();
                fd.append('city',value);
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url : "{{URL::to('/admin/tutors/fetchArea')}}",
                    type : 'POST',
                    data : fd,
                    dataType: 'html',
                    contentType: false,
                    processData: false,
                    success:function (response) {
                        $('.areas').html(response);
                    }
                });
            }
            else {
                $('.areas').html('<option value="all">Select Area List</option>');
            }
        });
    });
</script>
