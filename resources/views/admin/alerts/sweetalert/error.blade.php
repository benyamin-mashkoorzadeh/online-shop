@if(session('swal-error'))
    <script>
        $(document).ready(function () {
            swal.fire({
                icon: 'error',
                title: 'خطا',
                text: '{{ session('swal-error') }}',
                confirmButtonText: 'باشه'
            })
        })
    </script>
@endif
