
<?php $settings = get_settings(); ?>
<?php
    $paypal_url = ($settings->paypal_mode == 'sandbox')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
    $paypal_id= html_escape($settings->paypal_email);
?>

<section class="section p-100">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                
                <div class="pay-box">

                    <div class="text-center mt-100">
                        <?php if (isset($success_msg) && $success_msg=='Success'): ?>
                            <h1 class="text-success"><i class="icon-check"></i> <br>Done</h1>
                            <h5 class="text-successs">Your payment has be completed successfully !</h5><br>
                            <?php if ($settings->enable_email_verify == 1): ?>
                                <a href="<?php echo base_url('verify') ?>" class="custom-btn custom-btn--medium custom-btn--style-2">Continue <i class="fa fa-long-arrow-right"></i></a>
                            <?php else: ?>
                                <a href="<?php echo base_url('admin/dashboard/business') ?>" class="custom-btn custom-btn--medium custom-btn--style-2">Continue <i class="fa fa-long-arrow-right"></i></a>
                            <?php endif ?>

                        <?php elseif (isset($error_msg) && $error_msg=='Error'): ?>
                            <h3 class="success"><i class="icon-check"></i> Oops !</h3>
                            <h5 class="error">Payment has be failed</h5><br>
                            <a href="<?php echo base_url() ?>" class="btn btn-md btn-danger">Back Home</a>
                        <?php else: ?>
                    </div>

                        <h4>Please complete your payment by clicking the PAY NOW button</h4><br>

                        <!-- PRICE ITEM -->
                        <form action="<?php echo html_escape($paypal_url); ?>" method="post" name="frmPayPal1">
                            <div class="panel price panel-red">
                                <input type="hidden" name="business" value="<?php echo html_escape($paypal_id); ?>" readonly>
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="item_name" value="<?php echo html_escape($package->name);?>">
                                <input type="hidden" name="item_number" value="1">
                                <input type="hidden" name="amount" value="<?php if($payment->billing_type == 'monthly'){echo round($package->monthly_price);}else{echo round($package->price);}?>" readonly>
                                <input type="hidden" name="no_shipping" value="1">
                                <input type="hidden" name="currency_code" value="<?php echo html_escape($settings->currency);?>">
                                <input type="hidden" name="cancel_return" value="<?php echo base_url('payment-cancel/'.html_escape($payment_id)) ?>">
                                <input type="hidden" name="return" value="<?php echo base_url('payment-success/'.html_escape($payment_id)) ?>">  
                                    
                                <div class="panel-heading  text-center">
                                <h3>Package Plan: <?php echo html_escape($package->name);?></h3>
                                </div>
                                <div class="panel-body text-center">
                                    <p class="lead fs-40"><strong><?php echo currency_to_symbol(settings()->currency); ?> <?php if($payment->billing_type == 'monthly'){echo round($package->monthly_price).' per month';}else{echo round($package->price).' per year';}?></strong></p>
                                </div>
                                <div class="panel-footer mt-10">
                                    <button class="custom-btn custom-btn--medium custom-btn--style-2" href="#">PAY NOW - <?php echo currency_to_symbol(settings()->currency); ?><?php if($payment->billing_type == 'monthly'){echo round($package->monthly_price);}else{echo round($package->price);}?></button>
                                </div>
                            </div>
                        </form>
                        <!-- /PRICE ITEM -->
                        <div class="spacer py-6"></div>
                    <?php endif ?>

                </div>

            </div>
        </div>
    </div>
</section>
