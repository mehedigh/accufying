

(function($) {
"use strict";


  var loading_html = '<div class="container text-center" style="padding: 200px"><div class="spinner-md"></div></div>';
  var loader_md = '<div class="container text-center" style="padding: 100px"><div class="spinner-md"></div></div>';
  var loader_btn = '<div class="spinners"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
  var base_url = $('#base_url').val();

  var needToConfirm=false;
  var form_original_data = $(".leave_con").serialize();

  $('[data-toggle="tooltip"]').tooltip(); 
	

    $(".checkItem").on('click', function() {
        if ($(".checkItem").is(":checked")) {
            $(".multiple_delete_btn").show()
        } else {
            $(".multiple_delete_btn").hide()
        }
    });

    $(".agree_btn").on('click', function() {
        if ($(".agree_btn").is(":checked")) {
            $('.submit_btn').prop('disabled', false);
        } else {
            $('.submit_btn').prop('disabled', true);
        }
    });


    $(".switch_price").on('click', function() {
        var priceVal = $(this).val();
        if (priceVal == 'monthly') {
            $('.price_year').hide();
            $('.price_month').show();
            $('.monthly_row').show();
            $('.yearly_row').hide();
            $('.bill_type').html('per month');
            $('.billing_type').val('monthly');
        } else {
            $('.price_month').hide();
            $('.price_year').show();
            $('.yearly_row').show();
            $('.monthly_row').hide();
            $('.bill_type').html('per year');
            $('.billing_type').val('yearly');
        }
    });




    $(document).on('click', ".inv-item", function() {
        var Id = $(this).attr('data-id');
        var customerData = $('#customer').val();
        if (customerData == '') {var customerId = 0;}else{var customerId = customerData;}

        var url = base_url+'admin/invoice/add_product/'+Id+'/'+customerId;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
          if(json.st == 1){
              $("#add_item").append(json.loaded);
              $('.currency_wrapper').html(json.currency);
          }
        }, 'json' );
        return false;
    });


    $(document).on('click', ".package_btn", function() {
        form_original_data = $(".leave_con").serialize();  
        var billType = $('.billing_type').val();
        var url = $(this).attr('href')+'/'+billType;

        $('.pricing_area').hide();
        $(".loader").html(loading_html);
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
          if(json.st == 1){  
              window.location.href = json.url;
          }else{
            $('.pricing_area').show();
          }
        }, 'json' );
        return false;
    });


    $(function(){
        $(document).on('submit', "#register_form", function() {
            form_original_data = $(".leave_con").serialize();
            
            $(".loader_btn").html(loader_btn);
            $.post($('#register_form').attr('action'), $('#register_form').serialize(), function(json){
                if (json.st == 1) {   
                    $('#register_form')[0].reset();
                    $('.account_area').hide();
                    $('.step_2').addClass('active');
                    $('.business_area').show();
                }else if (json.st == 2) {
                    $(".loader_btn").html('Get Started');
                    swal({
                      title: "Opps !",
                      text: "This email already exist, try another one",
                      type: "error",
                      showConfirmButton: true
                    });
                }else if (json.st == 3) {
                    $(".loader_btn").html('Get Started');
                    swal({
                      title: "Opps !",
                      text: "Recaptcha is required !",
                      type: "error",
                      showConfirmButton: true
                    });
                }else {
                    $(".loader_btn").html('Get Started');
                    $('#register_form')[0].reset();
                    swal({
                      title: "Error!",
                      text: json.st,
                      type: "error",
                      showConfirmButton: true
                    });
                }
            },'json');
            return false;
        });
    });


    $(function(){
        $(document).on('submit', "#business_form", function() {
            form_original_data = $(".leave_con").serialize(); 
            
            $.post($('#business_form').attr('action'), $('#business_form').serialize(), function(json){
                if (json.st == 1) {  
                    $('#business_form')[0].reset();
                    $('.account_area').hide();
                    $('.business_area').hide();
                    $('.step_3').addClass('active');
                    $('.pricing_area').show();
                }else {
                    $('#register_form')[0].reset();
                    swal({
                      title: "Error!",
                      text: json.st,
                      type: "error",
                      showConfirmButton: true
                    });
                }
            },'json');
            return false;
        });
    });



    $(function(){
        $(document).on('submit', "#cahage_pass_form", function() {
            $.post($('#cahage_pass_form').attr('action'), $('#cahage_pass_form').serialize(), function(json){
                if (json.st == 1) {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                          title: "Congratulations!",
                          text: "Your Password has been changed Successfully",
                          type: "success",
                          showConfirmButton: true
                    });
                }else if (json.st == 2) {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                      title: "Opps !",
                      text: "Your Confirm Password doesn't Match",
                      type: "error",
                      showConfirmButton: true
                    });
                }else {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                      title: "Error!",
                      text: "Your Old Password doesn't Match",
                      type: "error",
                      showConfirmButton: true
                    });
                }
            },'json');
            return false;
        });
    });



    $(document).on('change', ".sort", function() {
        $('.sort_form').submit();
    });

    
    $(document).on('click', ".add_btn", function() {
        $('.add_area').show();
        $('.list_area').hide();
        return false;
    });

    $(document).on('click', ".cancel_btn", function() {
        $('.add_area').hide();
        $('.list_area').show();
        return false;
    });


    $(document).on('click', ".delete_item", function() {

        var del_url = $(this).attr('href');
        var itemId = $(this).attr('data-id');


            swal({
              title: "Are you sure?",
              text: "You will not be able to recover this file",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(){ 

                $.post(del_url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                    if(json.st == 1){     
                        swal({
                          title: "Success",
                          text: "Deleted successfully",
                          type: "success",
                          showCancelButton: false
                        }),                
                        $("#row_"+itemId).slideUp();
                    }
                },'json');

            });

        return false;

    });



    $(document).on('click', ".change_pass", function() {
        $('.change_password_area').slideDown();
        $('.edit_account_area').hide();
        $("html, body").animate({ scrollTop: 200 }, "slow");
        return false;
    });

    $(document).on('click', ".cancel_pass", function() {
        $('.change_password_area').hide();
        $('.edit_account_area').slideDown();
        return false;
    });


    $(window).on('bind', "beforeunload", function(e) {
        if ($(".leave_con").serialize() != form_original_data) {
            var needToConfirm = true;
        }
        if(needToConfirm)
            return "You have made some changes and it's not saved?";
        else 
        e=null; // i.e; if form state change show warning box, else don't show it.
    });


})(jQuery);