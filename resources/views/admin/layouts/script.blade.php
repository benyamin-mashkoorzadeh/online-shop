<script src="{{ asset('admin-assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/grid.js') }}"></script>
<script src="{{ asset('admin-assets/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('admin-assets/sweetalert/sweetalert2.min.js') }}"></script>

<script>
    let notificationDropdown = document.getElementById('header-notification-toggle')
    notificationDropdown.addEventListener('click', function () {
        $.ajax({
            type: "POST",
            url: '/admin/notification/read-all',
            data: {_token: "{{ csrf_token() }}" },
            success: function () {
                console.log('نوتیفیکیشن ها دیده شد.')
            }
        })
    })
</script>
