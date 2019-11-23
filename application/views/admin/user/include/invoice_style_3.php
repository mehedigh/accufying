<?php include'invoice_val.php'; ?>

<div class="card-body p-0 overhidden">
    <div class="row p-35 invtem_top_3" style="background: <?php echo html_escape($this->business->color) ?>">
        <div class="col-md-9 text-left">
            <h1 class="mb-1 text-uppercase text-white"><?php echo html_escape($title) ?></h1>
            <p class="text-white"><?php echo html_escape($summary) ?></p>
        </div>

        <div class="col-md-3 text-center text-white">
            <h5 class="mt-25 text-white mb-0">Amount Due</h5>
            <h2 class="text-white mt-0">
                <?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?><?php if ($status == 2){echo "0.00";}else{echo html_escape($grand_total);} ?>
            </h2>
        </div>
    </div>

    <div class="row bill_area">
        <div class="col-md-8">
            <h5 class="font-weight-bold">Bill to</h5>
            <?php if (empty($customer_id)): ?>
                <p class="mb-1">You have not added a customer.</p>
            <?php else: ?>
                <p class="mb-1">
                    <?php if (!empty(helper_get_customer($customer_id))): ?>
                        <p class="mb-0"><strong><?php echo helper_get_customer($customer_id)->name ?></strong></p>
                        <p class="mt-0 mb-0"><?php echo helper_get_customer($customer_id)->country ?></p>
                        <p class="mt-0 mb-0"><?php echo helper_get_customer($customer_id)->phone ?></p>
                        <p class="mt-0 mb-0"><?php echo helper_get_customer($customer_id)->address ?></p>
                    <?php endif ?>
                </p>
            <?php endif ?>
        </div>

        <div class="col-md-4 text-right">
            <table class="tables pull-right">
                <tr>
                    <td><b class="mr-10">Invoice number:</b></td>
                    <td class="text-left" colspan="1"># <?php echo html_escape($number) ?></td>
                </tr>
                <tr>
                    <td><b class="mr-10">Invoice date:</b></td>
                    <td class="text-left" colspan="1"><?php echo my_date_show($date) ?></td>
                </tr>
                <tr>
                    <td><b class="mr-10">Due date:</b></td>
                    <td class="text-left">
                        <?php echo my_date_show($payment_due) ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-left">
                        <?php if ($due_limit == 1): ?>
                            <p>On Receipt</p>
                        <?php else: ?>
                            <p>Within <?php echo html_escape($due_limit) ?> days</p>
                        <?php endif ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row p-0 table_area">
        <div class="col-md-12">
            <table class="table">
                <thead class="pre_head2">
                    <tr class="pre_head_tr2">
                        <th class="border-0">Items</th>
                        <th class="border-0">Price</th>
                        <th class="border-0">Quantity</th>
                        <th class="border-0">Amount</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (isset($page_title) && $page_title == 'Invoice Preview'): ?>
                        <?php if (!empty($this->session->userdata('item'))): ?>
                            <?php $total_items = count($this->session->userdata('item')); ?>
                        <?php else: ?>
                            <?php $total_items = 0; ?>
                        <?php endif ?>
                        
                        <?php if (empty($total_items)): ?>
                            <tr>
                                <td colspan="4" class="text-center">You have not added any items</td>
                            </tr>
                        <?php else: ?>
                            <?php for ($i=0; $i < $total_items; $i++) { ?>
                                <tr>
                                    <td width="50%">
                                    <?php $product_id = $this->session->userdata('item')[$i] ?>
                                    
                                    <?php if (is_numeric($product_id)) {
                                        echo helper_get_product($product_id)->name;
                                    } else {
                                        echo html_escape($product_id);
                                    } ?>
                                    </td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo $this->session->userdata('price')[$i] ?></td>
                                    <td><?php echo $this->session->userdata('quantity')[$i] ?></td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo $this->session->userdata('total_price')[$i] ?></td>
                                </tr>
                            <?php } ?>
                        <?php endif ?>

                    <?php else: ?>

                        <?php $items = helper_get_invoice_items($invoice->id) ?>
                        <?php if (empty($items)): ?>
                            <tr>
                                <td colspan="4" class="text-center">You have not added any items</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td width="50%"><?php echo html_escape($item->item_name) ?></td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo html_escape($item->price) ?></td>
                                    <td><?php echo html_escape($item->qty) ?></td>
                                    <td><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo html_escape($item->total) ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endif ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong>Sub Total</strong></td>
                        <td><span><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo html_escape($sub_total) ?></span></td>
                    </tr>
                    <?php if (!empty($tax)): ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong>Tax <?php echo html_escape($tax) ?>%</strong></td>
                            <td><span><?php echo number_format($sub_total * ($tax / 100), 2) ?></span></td>
                        </tr>
                    <?php endif ?>
                    <?php if (!empty($discount)): ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-right"><strong>Discount <?php echo html_escape($discount) ?>%</strong></td>
                            <td><span><?php echo number_format($sub_total * ($discount / 100), 2) ?></span></td>
                        </tr>
                    <?php endif ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong>Total</strong></td>
                        <td><span><?php if(!empty($currency_symbol)){echo html_escape($currency_symbol);} ?> <?php echo html_escape($grand_total) ?></span></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="p-30">
        <p class="text-center"><?php echo html_escape($footer_note) ?></p>
    </div>

    <hr class="my-5">

    <div class="row p-15">
        <div class="col-md-6 col-xs-4 text-right">
            <img width="100px" src="<?php echo base_url($logo) ?>" alt="">
        </div>
        <div class="col-md-6 col-xs-8 text-left mt-10">
            <p class="mb-0"><strong><?php echo html_escape($business_name) ?></strong></p>
            <p class="mb-0"><strong><?php echo html_escape($business_address) ?></strong></p>
            <p class=""><?php echo html_escape($country) ?></p>
        </div>
    </div>
</div>