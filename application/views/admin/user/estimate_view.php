<!DOCTYPE html>
<html lang="en">
<head>

<link rel="icon" href="<?php echo base_url($settings->favicon) ?>">
<title><?php echo html_escape($settings->site_name); ?> - <?php if(isset($page_title)){echo html_escape($page_title);}else{echo "Dashboard";} ?></title>
<!-- Bootstrap 4.0-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">
<!-- Bootstrap 4.0-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap-extend.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/master_style.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/skins/_all-skins.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/font-awesome.min.css">
</head>

<body>

    <?php $currency_symbol = helper_get_customer($invoice->customer)->currency_symbol ?>
    <div class="content-wrappers">
        <section class="content p-0">
            <?php if (isset($mode) && $mode == 'preview'): ?>
                <div class="preview-mood-top p-20 text-center readonly-title">
                    <a href="#" class="btn btn-default btn-rounded mr-5 disabled"><i class="fa fa-eye"></i> Preview mode </a>

                    <?php if (isset($link) && $link != ''): ?>
                        <a href="<?php echo $link ?>" class="btn btn-default btn-rounded mr-5"><i class="fa fa-long-arrow-left"></i> Back </a>
                    <?php endif ?>
                    <p class="mt-10 c-1038"><i class="fa fa-info-circle"></i> You are previewing how your customer will see the web version of your estimate.</p>
                </div>
            <?php endif ?>

            <div class="container">
                <div class="col-md-10" style="margin: 20px auto">

                    <?php if (isset($page_title) && $page_title == 'Readonly Estimate'): ?>
                    <div class="row mb-10">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-default btn-rounded mr-5 print_invoice"><i class="fa fa-print"></i> Print </a>

                            <a href="<?php echo base_url('readonly/export_pdf/'.md5($invoice->id)) ?>" class="btn btn-default btn-rounded mr-5"><i class="fa fa-download"></i> Download Pdf </a>
                        </div>
                    </div>
                    <?php endif ?>

                    <div id="invoice_save_area mt-0" class="card inv save_area print_area">
                        <?php include"include/invoice_style_".$this->business->template_style.".php"; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <footer></footer>
<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/admin/js/jquery3.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/printThis.js"></script>
<script>
    $('.print_invoice').on("click", function () {
      $('.print_area').printThis({
        base: "https://jasonday.github.io/printThis/"
      });
    });
</script>
</body>
</html>