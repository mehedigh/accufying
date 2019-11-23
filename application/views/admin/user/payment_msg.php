
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <div class="pay-box pt-200">
                    <?php if (isset($success_msg) && $success_msg=='Success'): ?>
                        <h1 class="success"><i class="icon-check"></i><br> Done</h1>
                        <h5 class="success">Your payment has be completed successfully !</h5><br>
                        <a href="<?php echo base_url('admin/dashboard/business') ?>" class="btn btn-md btn-info">Continue</a>
                    <?php endif; ?>
                    <?php if (isset($error_msg) && $error_msg=='Error'): ?>
                        <h1 class="text-danger"><i class="icon-close"></i><br> Failed!</h1>
                        <h5 class="text-danger">Your payment has be failed ! Please try again</h5><br>
                        <a href="<?php echo base_url('admin/subscription') ?>" class="btn btn-md btn-default">Try again</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
  </section>
</div>