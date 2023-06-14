<script src="{{ asset('dist/modules/jquery.min.js')}}"></script>
<script src="{{ asset('dist/modules/popper.js') }}"></script>
<script src="{{ asset('dist/modules/tooltip.js') }}"></script>
<script src="{{ asset('dist/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js') }}"></script>
<script src="{{ asset('dist/js/sa-functions.js') }}"></script>
<script src="{{ asset('dist/modules/chart.min.js') }}"></script>
<script src="{{ asset('dist/modules/summernote/summernote-lite.js') }}"></script>
<script src="{{ asset('dist/modules/toastr/build/toastr.min.js') }}"></script>
<script src="{{ asset('dist/js/scripts.js') }}"></script>
<script src="{{ asset('dist/js/custom.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>


<!-- DataTables -->
<script src="{{asset('dist/modules/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('dist/modules/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('dist/modules/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('dist/modules/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dist/modules/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('dist/modules/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('dist/modules/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('dist/modules/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('dist/modules/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('dist/modules/pdfmake/vfs_fonts.js')}}"></script>
<!-- table buttons -->
<script src="{{ asset('dist/modules/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('dist/modules/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('dist/modules/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('dist/modules/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('dist/modules/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
@if (session('message'))
    <script>
        Swal.fire({
            title: 'Success',
            text: '{{ session('message') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@if (session('error'))
    <script>
        Swal.fire({
            title: 'Error',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
@endif


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(function (form) {
            const deleteButton = form.querySelector('.delete-button');

            deleteButton.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the default button click behavior

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms the deletion, submit the respective form
                        form.submit();
                    }
                });
            });
        });
    });
</script>





<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["csv", "excel", "pdf", "print"],
        "pageLength": 10 // Show 10 rows per page
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true, // Allow changing the number of rows per page
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        // "displayStart": 5, // Display starting from the 5th row
        "pageLength": 10 // Show 10 rows per page
    });

    $('#example3').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        // "displayStart": 15, // Display starting from the 15th row
        "pageLength": 10 // Show 10 rows per page
    });
});
</script>

</body>
</html>