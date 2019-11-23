<div class="content-wrapper">
    <section class="content">
        <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h2>
                    Reports
                    <span class="pull-right"></span>
                  </h2>
                  <form method="GET" class="sort_report_form" action="<?php echo base_url('admin/reports/generate') ?>">
                      <div class="row reprt-box p-0">
                          
                          <div class="col-md-3 col-xs-12 mt-5 pl-0">
                              <div class="input-group">
                                  <input type="text" class="inv-dpick form-control datepicker" placeholder="From" name="start_date" value="<?php if(isset($_GET['start_date'])){echo $_GET['start_date'];} ?>" autocomplete="off">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              </div>
                          </div>

                          <div class="col-md-3 col-xs-12 mt-5 pl-0">
                              <div class="input-group">
                                  <input type="text" class="inv-dpick form-control datepicker" placeholder="To" name="end_date" value="<?php if(isset($_GET['end_date'])){echo $_GET['end_date'];} ?>" autocomplete="off">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              </div>
                          </div>

                          <div class="col-md-4 col-xs-12 mt-5 pl-0">
                              <select class="form-control single_select" name="customer">
                                  <option value="0">All Customers</option>
                                  <?php foreach ($customers as $customer): ?>
                                    <option value="<?php echo html_escape($customer->id) ?>" <?php echo(isset($_GET['customer']) && $_GET['customer'] == $customer->id) ? 'selected' : ''; ?>
                                    ><?php echo html_escape($customer->name) ?></option>
                                  <?php endforeach ?>
                              </select>
                          </div>
                      
                          <div class="col-md-2 col-xs-12 mt-5 pl-0">
                              <button type="submit" class="btn btn-info btn-report">Show Report</button>
                          </div>
                      </div>
                  </form>
              </div>

              <?php if (isset($page_title) && $page_title == 'Generate Reports'): ?>
                <div class="col-md-12 mt-50">
                    <div class="table-responsive">
                        <table class="table table-bordered <?php if(count($reports) > 10){echo "datatable";} ?>">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $total=0; $r=1; foreach ($reports as $report): ?>
                                <tr id="row_<?php echo html_escape($report->id); ?>">
                                    <td><?php echo $r; ?></td>
                                    <td><?php echo html_escape($report->invoice_id); ?></td>
                                    <td>
                                      <?php if (!empty(helper_get_customer($report->customer_id))): ?>
                                          <?php echo helper_get_customer($report->customer_id)->name ?>
                                      <?php endif ?>
                                    </td>
                                    <td><?php echo html_escape($this->business->currency_symbol.''.$report->amount); ?></td>
                                    <td><span class="label label-default"> <?php echo my_date_show($report->payment_date); ?> </span></td>
                                    <?php $total += $report->amount; ?>
                                </tr>
                              <?php $r++; endforeach; ?>

                              <h3>Total: <?php echo html_escape($this->business->currency_symbol.''.$total); ?></h3>
                            </tbody>
                        </table>
                    </div>
                </div>
              <?php endif ?>

          </div>
        </div>
    </section>
</div>