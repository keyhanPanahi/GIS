<script>
    $(document).ready(function(){

        //All Confirm
        $('.delete-confirm,#active,#deactive').on('click', function () {
            Swal.fire({
                title: `آیا از ${$(this).data('word')} موارد انتخابی مطمئن هستید؟`,
                text: "شما میتوانید درخواست خود را لغو نمایید",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله انجام شود.',
                cancelButtonText: 'خیر درخواست لغو شود.',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.value == true) {
                    let ids = [];
                    $('.form-check-input.checkbox:checked').each(function(){
                        ids.push($(this).val());
                    });

                    $.ajax({
                        type: "POST",
                        url: $(this).data('route'),
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: ids,
                            status: $(this).attr('id') === 'active' ? 1 : 0,
                        },
                        success: function (response) {
                            if(response.success){
                                toastr['success'](response.success, 'عملیات با موفقیت انجام شد!', {
                                    closeButton: true,
                                    progressBar: true,
                                    showMethod: 'fadeIn',
                                    hideMethod: 'fadeOut',
                                    tapToDismiss: false,
                                    rtl: isRtl
                                });

                                $('#checkAll').prop('checked',false);
                                $('table').DataTable().columns(0).search('').draw();
                            }
                            else{
                                toastr['error'](response.error,  'خطا!', {
                                    closeButton: true,
                                    progressBar: true,
                                    showMethod: 'fadeIn',
                                    hideMethod: 'fadeOut',
                                    tapToDismiss: false,
                                    rtl: isRtl
                                });
                            }
                        }
                    });
                }
                else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'لغو درخواست',
                        text: "درخواست شما لغو شد.",
                        icon: 'error',
                        confirmButtonText: 'تایید.',
                        customClass: {
                            confirmButton: 'btn btn-success',
                        }
                    });
                }
            });
        });

        //Check All
        $('#checkAll').click(function(event) {
            if(this.checked) {
                $('.checkbox').each(function() {
                    this.checked = true;
                });
            }
            else{
                $('.checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    });
</script>
