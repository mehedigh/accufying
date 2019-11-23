

(function($) {
  "use strict";


  var loading_html = '<div class="container text-center" style="padding: 200px"><div class="spinner-md"></div></div>';
  var loader_md = '<div class="container text-center" style="padding: 100px"><div class="spinner-md"></div></div>';
  var loader_btn = '<div class="spinner-sm"></div>';
  var base_url = $('#base_url').val();

  $('[data-toggle="tooltip"]').tooltip(); 


  $('.print_invoice').on("click", function () {
    $('.print_area').printThis({
      base: "https://jasonday.github.io/printThis/"
    });
  });


  jQuery(document).ready(function(){
    jQuery().invoice({
      addRow : "#addRow",
      delete : ".delete",
      parentClass : ".item-row",

      price : ".price",
      qty : ".qty",
      total : ".total",
      totalQty: "#totalQty",

      subtotal : "#subtotal",
      discount: "#discount",
      shipping : "#shipping",
      grandTotal : "#grandTotal"
    });
  });


  $('.fab-button').on('click', function() {
    $('.floating-menus').toggle('fadeToggle');
    $('.fab-button i').toggleClass('ti-close ti-plus');
  });

  var needToConfirm=false;
  var form_original_data = $(".leave_con").serialize();

  $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
  });


  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#img-upload').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }


  $("#imgInp").on('change', function() {
    readURL(this);
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


  $(document).on('click', ".package_btn", function() {
    var billType = $('.billing_type').val();
    var url = $(this).attr('href')+'/'+billType;
    window.location.href=url;
    return false;
  });


  $(document).on('click', ".monthly_btn", function() {
    $('.yearly_btn').removeClass('active');
    $(this).addClass('active');
    $('.monthly_area').fadeIn();
    $('.yearly_area').hide();
    return false;
  });

  $(document).on('click', ".yearly_btn", function() {
    $('.monthly_btn').removeClass('active');
    $(this).addClass('active');
    $('.yearly_area').fadeIn();
    $('.monthly_area').hide();
    return false;
  });



    //avatar upload
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#imagePreview').css('background-image', 'url('+e.target.result +')');
          $('#imagePreview').hide();
          $('.upload-text').hide();
          $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#imageUpload").change(function() {
      readURL(this);
    });


    $(".checkcolor").on('click', function() {
      var $box = $(this);
      if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
      } else {
        $box.prop("checked", false);
      }
    });


    $(".check_all").on('click', function() {

      $('input:checkbox').not(this).prop('checked', this.checked);

      if ($(".check_all").is(":checked")) {
        $(".multiple_delete_btn").show();
      } else {
        $(".multiple_delete_btn").hide();
      }
    });


    $(".switch_business").on('click', function() {
      new WOW().init();
      $(".business_switch_panel").show();
    });

    $(".business_close").on('click', function() {
      $(".business_switch_panel").hide();
    });


    $(".checkItem").on('click', function() {
      if ($(".checkItem").is(":checked")) {
        $(".multiple_delete_btn").show();
      } else {
        $(".multiple_delete_btn").hide();
      }
    });


    $(".income_check").on('click', function() {
      if ($(".income_check").is(":checked")) {
        $(".income_list").show();
      } else {
        $(".income_list").hide();
      }
    });


    $(".expense_check").on('click', function() {
      if ($(".expense_check").is(":checked")) {
        $(".expense_list").show()
      } else {
        $(".expense_list").hide();
      }
    });


    $(".add_item_btn").on('click', function(e) {
      $("#products_list_inv").fadeToggle();
      e.preventDefault();
    });

    $(".cancel-inv").on('click', function(e) {
      $("#products_list_inv").fadeOut();
      e.preventDefault();
    });


    $(document).on('keyup', ".search_product", function() {
      var svalue = $(this).val();
      if (!svalue) {var value = 'empty';}else{var value = svalue;}
      $(".loaderp").html(loader_btn);
      var url = base_url+'admin/invoice/search_product/'+value;
      $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
        if(json.st == 1){
          $(".loaderp").html('');
          $("#load_product").html(json.loaded);
        }else{
          $(".loaderp").html('Product not found!');
          $("#load_product").html('');
        }
      }, 'json' );
      return false;
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


    $(document).on('change', "#country", function() {
      var Id = $(this).val();
      if(Id != ''){
        var url = base_url+'admin/customer/load_currency/'+Id;
        $.post(url,{ data: 'value', 'csrf_test_name': csrf_token },function(data){
          $('#currency').html(data);
          $('#currency').prop('disabled', false);
        }
        );
      }  
    });


    $(document).on('change', "#customer", function() {
      var Id = $(this).val();
      if(Id != ''){
        var url = base_url+'admin/customer/load_customer_info/'+Id;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
          if(json.st == 1){
            $('#load_info').html(json.value);
            $('.currency_wrapper').html(json.currency);
            $('.currency_name').html(json.currency_name);
            $('.currency_code').val(json.code);
          }
        }, 'json' );
      }else{
        $('.currency_wrapper').html('');
        $('#load_info').html('Select a customer');
      }
    });


    $(document).on('click', ".set_layout", function() {
      var designId = $(this).val();
      var url = base_url+'admin/profile/change_layout/'+designId;
      $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
       if(json.st == 1){

        swal({
          title: "Success",
          text: 'Layout changes successfully',
          type: "success",
          showConfirmButton: true
        }, function(){
          window.location.reload();
        });

      }
    }, 'json' );
      return false;
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


    $(document).on('submit', "#recurring_form", function() {
      $.post($('#recurring_form').attr('action'), $('#recurring_form').serialize(), function(json){

        if (json.st == 1) {
          swal({
            title: "Success",
            text: "Invoice setup successfully",
            type: "success",
            showConfirmButton: true
          }, function(){
            window.location.reload();
          });
        }else {
          swal({
            title: "Error!",
            text: "Something wrong",
            type: "error",
            showConfirmButton: true
          });
        }
      },'json');
      return false;
    });


    $(document).on('click', ".convert_to_invoice", function() {
      var actionUrl = $(this).attr('href');
      swal({
        title: "Are you sure",
        text: "Convert this estimate to a draft invoice?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        confirmButtonText: "Convert",
        closeOnConfirm: false
      },
      function(){ 
        $.post(actionUrl, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
          if(json.st == 1){     
            swal({
              title: "Success",
              text: "Converted successfully",
              type: "success",
              showCancelButton: false
            },
            function(){ 
              window.location.href = base_url+'admin/invoice';
            });
          }
        },'json');
      });
      return false;
    });


    $(".preview_invoice_btn").on('click', function() {
      $('.add_val').attr('value', '');  
      $('.add_val').val("1");
      $(this).hide();
      $('.edit_invoice_btn').show();
      $('.invoice_area').hide();
      $('#load_data').show();
    });

    $(".edit_invoice_btn").on('click', function() {
      $('.edit_invoice_btn').hide();
      $('.preview_invoice_btn').show();
      $('#load_data').hide();
      $('.invoice_area').show();
    });

    $(".save_invoice_btn").on('click', function() {
      $('.add_val').attr('value', '');  
      $('.add_val').val("2");
    });


    $(document).on('change', ".single_select", function() {
      $("span.select2-selection").removeClass("error-line");
      $('.error_area').hide();
    });

    //Invoice form
    $('#invoice_form').on('submit',(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      var checkData = $('.add_val').val();
      form_original_data = $(".leave_con").serialize();   

      if (checkData == 1) {
        var actionUrl = base_url+'admin/invoice/preview';
      } else if(checkData == 2) {
        var actionUrl = base_url+'admin/invoice/add';
      }

      $("#load_data").html(loading_html);

      $.ajax({
        type:'POST',
        url: actionUrl,
        data:formData,
        dataType: 'json',
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){

          if (data.status == 1) {
            $('.error_area').hide();
            $('#load_data').html(data.load_data);
          }else if(data.status == 2){
            window.location.href = base_url+"admin/invoice/details/"+data.invoice_id;
          }else if(data.status == 3){
            $("span.select2-selection").addClass("error-line");
            $('.invoice_area').show();
            $('.preview_invoice_btn').show();
            $('.edit_invoice_btn').hide();
            $('#load_data').hide();
            $('.error_area').show();
            $('#load_error').html(data.error);
          }else if(data.status == 4){
            $('#load_data').hide();
            swal({
              title: "Error!",
              text: "Data limit has been over",
              type: "error",
              showConfirmButton: true
            });
          }
          console.log("success");
        },
        error: function(data){
          console.log("error");
        }
      });
    }));



    //Estimate form
    $('#estimate_form').on('submit',(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      form_original_data = $(".leave_con").serialize();  

      $('.invoice_area').hide();
      $("#load_data").html(loading_html);

      $.ajax({
        type:'POST',
        url: base_url+'admin/estimate/add',
        data:formData,
        dataType: 'json',
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
          if(data.status == 1){
            window.location.href = base_url+"admin/estimate/details/"+data.invoice_id;
          }else if(data.status == 2){
            $('.invoice_area').show();
            $("span.select2-selection").addClass("error-line");
            $('html, body').animate({ scrollTop: 25 }, 'slow');
            $("#load_data").html('');
            $('.error_area').show();
            $('#load_error').html(data.error);
          }else if(data.status == 3){
            $('.invoice_area').show();
            $("#load_data").html('');
            swal({
              title: "Error!",
              text: "Data limit has been over",
              type: "error",
              showConfirmButton: true
            });
          }
          console.log("success");
        },
        error: function(data){
          console.log("error");
        }
      });
    }));




    $(document).on('submit', "#product-form", function() {
      $.post($('#product-form').attr('action'), $('#product-form').serialize(), function(json){

        $("#load_product").html(loading_html);

        if (json.st == 1) {
          $('#productModal').modal('hide');
          $("#load_product").html(json.load_product);
          $.toast({
            heading: 'Success',
            text: 'Product added Successfully',
            position: 'top-right',
            loaderBg:'#fff',
            icon: 'success',
            hideAfter: 3500
          });
        }else {
          swal({
            title: "Error!",
            text: "There are something missing",
            type: "error",
            showConfirmButton: true
          });
        }
      },'json');
      return false;
    });


    //send estimate form
    var eId = $("input[name=send_estimate_id]").val();
    var eId = $("form#send-estimate-form input[name=send_estimate_id]").val();

    $('.send-estimate-form').on('submit',(function(e) {

      var eId = $(this).find('input[name=send_estimate_id]').val();
      e.preventDefault();
      var formData = new FormData(this);

      $('.modal-body').html(loader_md);
      $('.submit_btn').prop('disabled', true);

      $.ajax({
        type:'POST',
        url: base_url+'admin/estimate/send/'+eId,
        data:formData,
        dataType: 'json',
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
          if(data.status == 1){
            $('.estimate_modal').modal('hide');

            swal({
              title: "Success",
              text: "Estimate sent successfully",
              type: "success",
              showCancelButton: false
            },
            function(){ 
              window.location.reload();
            });

          }else{
            $('#submit_btn_'+eId).prop('disabled', false);
            $.toast({
              heading: 'Error',
              text: 'Estimate sending failed',
              position: 'top-right',
              loaderBg:'#fff',
              icon: 'error',
              hideAfter: 3500
            });
          }
          console.log("success");
        },
        error: function(data){
          console.log("error");
        }
      });
    }));


    //send invoice form
    var fId = $("input[name=send_invoice_id]").val();
    var fId = $("form#send-invoice-form input[name=send_invoice_id]").val();

    $('.send-invoice-form').on('submit',(function(e) {

      var fId = $(this).find('input[name=send_invoice_id]').val();
      e.preventDefault();
      var formData = new FormData(this);

      $('.modal-body').html(loader_md);
      $('.submit_btn').prop('disabled', true);

      $.ajax({
        type:'POST',
        url: base_url+'admin/invoice/send/'+fId,
        data:formData,
        dataType: 'json',
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
          if(data.status == 1){
            $('#sendInvoiceModal_'+fId).modal('hide');
            swal({
              title: "Success",
              text: "Invoice sent successfully",
              type: "success",
              showCancelButton: false
            },
            function(){ 
              window.location.reload();
            });
          }else{
            $('.submit_btn').prop('disabled', false);
            $.toast({
              heading: 'Error',
              text: 'Invoice not sent',
              position: 'top-right',
              loaderBg:'#fff',
              icon: 'error',
              hideAfter: 3500
            });
          }
          console.log("success");
        },
        error: function(data){
          console.log("error");
        }
      });
    }));


    $(document).on('click', ".approve_invoice", function() {
      var invoiceId = $(this).attr('data-id');
      $(this).html(loader_btn);

      var url = base_url+'admin/invoice/approve_invoice/'+invoiceId;
      $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
       if(json.st == 1){
        $.toast({
          heading: 'Success',
          text: 'Invoice approved Successfully',
          position: 'top-right',
          loaderBg:'#fff',
          icon: 'success',
          hideAfter: 3500
        });
        window.location.reload();
      }
    }, 'json' );
      return false;
    });



    $(document).on('click', ".approve_img", function() {
      var imgId = $(this).attr('data-id');

      var url = base_url+'admin/photos/approve_img/0/'+imgId;
      $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
       if(json.st == 1){
        swal({
          title: "Success",
          text: "Image has been approved.",
          type: "success",
          showCancelButton: false
        }),
        $('#img_'+imgId).slideUp();
      }
    }, 'json' );
      return false;
    });


    $(document).on('click', ".add_featured", function() {
      var imgId = $(this).attr('data-id');

      var url = base_url+'admin/photos/approve_img/1/'+imgId;

      $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
       if(json.st == 1){
        swal({
          title: "Success",
          text: "Image has been approved and selected featured.",
          type: "success",
          showCancelButton: false
        }),
        $('#img_'+imgId).slideUp();
      }
    }, 'json' );
      return false;
    });


    $(document).on('click', ".reject_img", function() {
      var imgId = $(this).attr('data-id');

      var url = base_url+'admin/photos/reject_img/'+imgId;

      $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
       if(json.st == 1){
        swal({
          title: "Success",
          text: "Image has been rejected.",
          type: "success",
          showCancelButton: false
        }),
        $('#img_'+imgId).slideUp();
      }
    }, 'json' );
      return false;
    });


    $(document).on('change', ".sort", function() {
      $('.sort_invoice_form').submit();
    });

    $(document).on('click', ".custom_search", function() {
      $('.sort_invoice_form').submit();
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


    $(document).on('click', ".scheduled_post", function() {
      $('.date_area').slideToggle();
      $('this').checked();
      return false;
    });


    $(document).on('change', "#category", function() {
      var catId = $(this).val();
      if(catId != ''){
        var url = base_url+'admin/post/load_subcategory/'+catId;
        $.post(url,{ data: 'value', 'csrf_test_name': csrf_token },function(data){
          $('#sub_category').html(data);
          $('#sub_category').prop('disabled', false);
        }
        );
      }  
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


    $(document).on('click', ".approve_item", function() {

      var action_url = $(this).attr('href');
      var itemId = $(this).attr('data-id');

      swal({
        title: "Are you sure?",
        text: "Approve this invoice",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Approve",
        closeOnConfirm: false
      },
      function(){ 

        $.post(action_url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
          if(json.st == 1){     
            swal({
              title: "Success",
              text: "Invoice approved",
              type: "success",
              showCancelButton: false
            }),                
            window.location.reload();
          }
        },'json');

      });

      return false;

    });


    $(document).on('click', ".primary_item", function() {

      var action_url = $(this).attr('href');
      var itemId = $(this).attr('data-id');
      var itemName = $(this).attr('data-val');

      swal({
        title: "Are you sure?",
        text: "Want to set " +itemName+ " as your default business?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Make it",
        closeOnConfirm: false
      },
      function(){ 

        $.post(action_url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
          if(json.st == 1){     
            swal({
              title: "Success",
              text: itemName+" set as your primary business",
              type: "success",
              showCancelButton: false
            },   
            function(){              
             window.location.reload();
           });
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