<footer class="main-footer">
  <div class="pull-right d-none d-sm-inline-block">
    
    <?php if (!is_admin()): ?>
      <div id="floating-container">
        <div class="floating-menus" style="display:none;">
          <div>
            <a href="<?php echo base_url('admin/invoice/create') ?>"> Create new Invoice
            <i class="fa fa-file-text-o"></i></a>
          </div>
          <div>
            <a href="<?php echo base_url('admin/estimate/create') ?>"> Create new Estimate
            <i class="fa fa-file-text"></i></a>
          </div>
          <div>
            <a href="<?php echo base_url('admin/expense') ?>">Create new Bill
            <i class="fa fa-file-text-o"></i></a>
          </div>
          <div>
            <a href="<?php echo base_url('admin/customer') ?>">Add Customer 
            <i class="fa fa-user-o"></i></a>
          </div>
          <div>
            <a href="<?php echo base_url('admin/product') ?>">Add Product
            <i class="fa fa-bars"></i></a>
          </div>
          <div>
            <a href="<?php echo base_url('admin/vendor') ?>">Add Vendor
            <i class="fa ti-user"></i></a>
          </div>
        </div>
        <div class="fab-button">
          <i class="ti-plus" aria-hidden="true"></i>
        </div>
      </div>
    <?php endif ?>

  </div>
  
</footer>


<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<?php $success = $this->session->flashdata('msg'); ?>
<?php $error = $this->session->flashdata('error'); ?>
<input type="hidden" id="success" value="<?php echo html_escape($success); ?>">
<input type="hidden" id="error" value="<?php echo html_escape($error);?>">
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/admin/js/jquery3.min.js"></script>
<!-- popper -->
<script src="<?php echo base_url() ?>assets/admin/js/popper.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>
<!-- Custom js -->
<script src="<?php echo base_url() ?>assets/admin/js/admin.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/toast.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/sweet-alert.min.js"></script>
<!-- Datatables-->
<script src="<?php echo base_url() ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/validation.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/admin/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/admin/js/fastclick.js"></script>
<!-- MinimalPro Admin App -->
<script src="<?php echo base_url() ?>assets/admin/js/template.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<!-- MinimalPro Admin for demo purposes -->
<script src="<?php echo base_url() ?>assets/admin/js/demo.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/jquery.invoice.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/wow.min.js"></script>

<!-- high charts js-->
<script src="https://code.highcharts.com/highcharts.js"></script>


<script>


  <?php if (isset($page_title) && $page_title == 'User Dashboard'): ?>
    
  
  var incomeData = <?php echo $income_data; ?>;
  var expenseData = <?php echo $expense_data; ?>;
  var incomeAxis = <?php echo $income_axis; ?>;

  Highcharts.chart('incomeChart', {
      chart: {
          type: 'column'
      },
      credits: {
          enabled: false
      },
      title: {
          text: ''
      },
      xAxis: {
          categories: incomeAxis
      },
      yAxis: {
          title: {
              text: ''
          }

      },
      legend: {
          enabled: true
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '<?php echo html_escape($currency) ?> {point.y}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span> <b><?php echo html_escape($currency) ?> {point.y}</b><br/>'
      },

      series: [
          {
              name: "Income",
              data: incomeData,
              color: '#2568ef'
          },
          {
              name: "Expense",
              data: expenseData,
              color: '#67757c'
          }
      ]
  });

  <?php endif ?>

  <?php if (isset($page_title) && $page_title == 'Dashboard'): ?>
    
  var incomeData = <?php echo $income_data; ?>;
  var incomeAxis = <?php echo $income_axis; ?>;

  Highcharts.chart('adminIncomeChart', {
      chart: {
          type: 'column'
      },
      credits: {
          enabled: false
      },
      title: {
          text: ''
      },
      xAxis: {
          categories: incomeAxis
      },
      yAxis: {
          title: {
              text: ''
          }

      },
      legend: {
          enabled: true
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '<?php echo html_escape($currency) ?>{point.y}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span> <b><?php echo html_escape($currency) ?>{point.y}</b><br/>'
      },

      series: [
          {
              name: "Income",
              data: incomeData,
              color: '#2568ef'
          }
      ]
  });


  //users packages share pie chart

  Highcharts.chart('packagePie', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  credits: {
      enabled: false
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: 'Users',
    colorByPoint: true,
    
    data: [
        <?php 
          foreach ($upackages as $upackage) {
            echo '{
                  name: "'.$upackage->name.'",
                  y: '.$upackage->total.'
                },';
          }
        ?>
      ]
  }]
});

<?php endif ?>

</script>



<script src="<?php echo base_url() ?>assets/admin/js/printThis.js"></script>
<!-- Color Picker Plugin JavaScript -->
<script src="<?php echo base_url() ?>assets/admin/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>


<!-- bt-switch -->
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
$(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
var radioswitch = function() {
    var bt = function() {
        $(".radio-switch").on("switch-change", function() {
            $(".radio-switch").bootstrapSwitch("toggleRadioState")
        }), $(".radio-switch").on("switch-change", function() {
            $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
        }), $(".radio-switch").on("switch-change", function() {
            $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
        })
    };
    return {
        init: function() {
            bt()
        }
    }
}();
$(document).ready(function() {
    radioswitch.init()
});
</script>

    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>assets/admin/js/jQuery.style.switcher.js"></script>

    <script type="text/javascript">
      <?php if (isset($success)): ?>
      $(document).ready(function() {
        var msg = $('#success').val();
        $.toast({
          heading: 'Success',
          text: msg,
          position: 'top-right',
          loaderBg:'#fff',
          icon: 'success',
          hideAfter: 3500
        });

      });
      <?php endif; ?>


      <?php if (isset($error)): ?>
      $(document).ready(function() {
        var msg = $('#error').val();
        $.toast({
          heading: 'Error',
          text: msg,
          position: 'top-right',
          loaderBg:'#fff',
          icon: 'error',
          hideAfter: 3500
        });

      });
      <?php endif; ?>
    </script>

    <script>
        ! function(window, document, $) {
            "use strict";
          $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }(window, document, jQuery);

        $(document).ready(function() {
            $('.datatable').dataTable();
            $('.multiple_select').select2();
            $('.single_select').select2();
        });
    </script>

    <script type="text/javascript">
      jQuery('.datepicker').datepicker({
          format: 'yyyy-mm-dd'
      });

      //colorpicker start
      $('.colorpicker-default').colorpicker({
          format: 'hex'
      });
      $('.colorpicker-rgba').colorpicker();

    </script>

    <script>
        CKEDITOR.replace('ckEditor', {
            language: 'en',
            filebrowserImageUploadUrl: "<?php echo base_url(); ?>admin/post/upload_ckimage_post?key=kgh764hdj990sghsg46r"
        });
    </script>

    <?php if (isset($page_sub) && $page_sub == 'Edit'): ?>
      <script type="text/javascript">
        $(document).ready(function() {
            var Id = $('#customer').val();
            var base_url = $('#base_url').val();
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
      </script>
    <?php endif ?>


    <?php if (isset($page) && $page == 'Invoice' || isset($page) && $page == 'Create'): ?>
      <script type="text/javascript">
        $(document).on("click",function(){
            var base_url = $('#base_url').val();
            var total = $('.grandtotal').val();
            var code = $('.currency_code').val();

            var url = base_url+'admin/invoice/convert_currency/'+total+'/'+code;
            $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
               if(json.st == 1){
                  $('.conversion_currency').html(json.result);
                  $('.convert_total').val(json.convert_total);
                }
            }, 'json' );
        });
      </script>
    <?php endif ?>

</body>
</html>
