
(function($){
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /**
         * All Global JavaScript Code start from here
         */

        // Delete Modal Open and set URL & id in form for delete data
        $(document).on('click' , '.deletes_btn' , function(e){
            e.preventDefault();
            const deletemodal = $('#deleteModal');
            deletemodal.find('form').attr('action' , $(this).data('url'))
            deletemodal.find('input[name="id"]').val($(this).data('id'))
            deletemodal.modal('show');
        });

        // Restore
        $(document).on('click' , '.restore_btn', function(e){
            e.preventDefault();
            $('.resore_form input[name="id"]').val($(this).data('id'))
            $('.resore_form').submit();
        })


        /**
         * Delivery Man JavaScript Code Start from here
         */
         $('.Deliverymen_edit').click(function(e){
            e.preventDefault();
            const modal =  $('#DeliverymenModal');
            modal.find('form').attr('action', $(this).data('url'));
            let id = $(this).data('id');
            $.ajax({
                url: 'delivery_man/' + id,
                success: function(output){
                    modal.find('input[name="name"]').val(output.name)
                    modal.find('input[name="phone"]').val(output.phone)
                    modal.find('input[name="address"]').val(output.address)
                    modal.find('input[name="id"]').val(output.id)
                    modal.modal('show');

                }
            })
        });

        /**
         * Delivery Method JavaScript Code start here
         */

         $('.deliverymethod_edit').click(function(e){
            e.preventDefault();
            const modal =  $('#deliveryMethodModal');
            modal.find('form').attr('action', $(this).data('url'));
            let id = $(this).data('id');
            $.ajax({
                url: 'delivery_method/' + id,
                success: function(output){
                    modal.find('input[name="name"]').val(output.name)
                    modal.find('input[name="id"]').val(output.id)
                    modal.modal('show');

                }
            })
        });


        // Create Order Js Code
        $('.OrderCreateForm input[name="price"]').keyup(function(e){
            e.preventDefault();
            if($('.OrderCreateForm input[name="price"]').val() === ''){
                $('.OrderCreateForm input[name="subtotal"]').val('')
                $('.OrderCreateForm input[name="grand_total"]').val('')
                $('.OrderCreateForm input[name="shipping"]').val('')
                $('.OrderCreateForm input[name="discount"]').val('')
                $('.OrderCreateForm input[name="total"]').val('')

            }
            $('.OrderCreateForm input[name="subtotal"]').val('')
            $('.OrderCreateForm input[name="subtotal"]').val($(this).val())
            $('.OrderCreateForm input[name="grand_total"]').val($(this).val())
            $('.OrderCreateForm input[name="total"]').val($(this).val())



        });

        $('.OrderCreateForm input[name="discount"]').keyup(function(e){
            e.preventDefault();
            let dis = Number($(this).val());
            let subs = Number($('.OrderCreateForm input[name="subtotal"]').val())
            let grand = subs - dis
            $('.OrderCreateForm input[name="grand_total"]').val(grand)
            let sub = Number($('.OrderCreateForm input[name="grand_total"]').val())
            let ship = Number($('.OrderCreateForm input[name="shipping"]').val())
            let grand_total = sub + ship;
            $('.OrderCreateForm input[name="total"]').val(grand_total)

        });




        $('.OrderCreateForm .charge').change(function(e){
            e.preventDefault();
            if($(this).is(":checked")){
                $('.OrderCreateForm input[name="shipping"]').attr('disabled' , true)
                $('.OrderCreateForm input[name="shipping"]').val('')
                $('.OrderCreateForm input[name="total"]').val($('.OrderCreateForm input[name="grand_total"]').val())

            }else{
                $('.OrderCreateForm input[name="shipping"]').attr('disabled' , false)
            }


        });

        $('.OrderCreateForm input[name="shipping"]').keyup(function(e){
            e.preventDefault();
            let sub = Number($('.OrderCreateForm input[name="grand_total"]').val())
            let ship = Number($('.OrderCreateForm input[name="shipping"]').val())
            let grand_total = sub + ship;
            $('.OrderCreateForm input[name="total"]').val(grand_total)


        });

        $('#prints').on('click', function() {
            let CSRF_TOKEN = $('meta[name="csrf-token"').attr('content');
            let id = $(this).data('id');
            $.ajaxSetup({
              url: '/print/' + id,
              type: 'POST',
              data: {
                _token: CSRF_TOKEN,
              },
              beforeSend: function() {
                console.log('printing ...');
              },
              complete: function() {
                console.log('printed!');
              }
            });

            $.ajax({
              success: function(viewContent) {
                $.print(viewContent); // This is where the script calls the printer to print the viwe's content.
              }
            });
          });

        //   Status Order UPdate
        $(document).on('change' , '.status-update' , function(e){
            e.preventDefault();
            let val = $(this).val();
            let id = $(this).data('id');
            $.ajax({
                url : '/admin/order/status/'+id+'/'+val,
                method: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success : function (output){
                    if(output){
                        iziToast['success']({
                            message: 'Order Invoice Status Updated Successfully',
                            position: "topRight"
                        });
                    }else{
                        iziToast['error']({
                            message: 'Something Went Wrong! Try again Later',
                            position: "topRight"
                        });
                    }
                }

            })
        })

        $('.customer_phone').blur(function(e){
            e.preventDefault();
            let val = $(this).val();
            $.ajax({
                url : '/admin/order/phone/serach/'+val,
                method: "GET",
                success : function (output){
                   $('.customer_address').val(output.address)
                   $('.customer_name').val(output.name)
                }

            })
        })
    });
})(jQuery)

