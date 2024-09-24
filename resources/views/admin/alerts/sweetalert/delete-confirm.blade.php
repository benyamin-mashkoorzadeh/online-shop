<script>
    $(document).ready(function () {
        let className = '{{ $className }}'
        let element = $('.' + className)

        element.on('click', function (e) {
            e.preventDefault()

            const swalWithBootstrapButton = Swal.mixin({

                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },

                buttonsStyling: false
            })

            swalWithBootstrapButton.fire({
                title: 'آیا از حذف کردن داده مطمئن هستید؟',
                text: 'شما می توانید درخواست خود را لغو نمایید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله‌، داده حذف شود',
                cancelButtonText: 'خیر، درخواست لغو شد',
                reverseButtons: true
            }).then((result) => {
                if (result.value == true) {
                    $(this).parent().submit()
                }
                else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButton.fire({
                        title: 'لغو درخواست',
                        text: 'درخواست شما لغو شد',
                        icon: 'error',
                        confirmButtonText: 'باشه'
                    })
                }
            })
        })
    })
</script>
