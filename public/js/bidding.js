async function placeBid(url, e,id) {
            $(`#spinner-${ id }`).removeClass('d-none');
            const bid = await $(`#bid_input-${id}`).val()
            const user_id = $('#user_id').val()
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    bid_amount: bid,
                    user_id: user_id,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    $(`#spinner-${ id }`).addClass('d-none');
                    toastr.success(response.message);
                    $(`#current_bid-${response.item_id}`).text(response.amount);
                    Swal.fire({
                        title: `Bid of Rs ${response.amount} Placed!`,
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr) {
                    $(`#spinner-${ id }`).addClass('d-none');
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                toastr.error(errors[key][0]);
                            }
                        }
                    } else {
                        toastr.error("An unexpected error occurred.");
                    }
                }
            });
        }
