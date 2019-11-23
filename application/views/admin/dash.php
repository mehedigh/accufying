<div class="content-wrapper">

  <section class="content"> 

    <div class="row">

      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Income & Expenses - <strong class="text-right">Last 12 months</strong></h3>
          </div>
          <div class="box-body">
            <div id="incomeChart"></div>
          </div>
        </div>

        <div class="box mt-10">
          <div class="box-header with-border">
            <h3 class="box-title">Net Income</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Fiscal year <i class="fa fa-info-circle" data-toggle="tooltip" data-title="Fiscal year start is January 01"></i></th>
                    <?php foreach ($net_income as $netincome): ?>
                      <th><?php echo show_year($netincome->payment_date) ?></th>
                    <?php endforeach ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Income</td>
                    <?php foreach ($net_income as $netincome): ?>
                      <td><?php echo html_escape($this->business->currency_symbol) ?><?php echo html_escape($netincome->total) ?></td>
                    <?php endforeach ?>
                  </tr>
                  <tr>
                    <td>Expense</td> 
                    <?php foreach ($net_income as $netincome): ?>
                      <td><?php echo html_escape($this->business->currency_symbol) ?><?php echo get_expense_by_year(show_year($netincome->payment_date)) ?></td>
                    <?php endforeach ?>
                  </tr>
                  <tr>
                    <td>Net Income </td>
                    <?php foreach ($net_income as $netincome): ?>
                      <td><strong><?php echo html_escape($this->business->currency_symbol) ?><?php echo ($netincome->total - get_expense_by_year(show_year($netincome->payment_date))) ?></strong></td>
                    <?php endforeach ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Overdue Invoices</h3>
          </div>

          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Customer</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($overdues)): ?>
                    <p>No data founds</p>
                    <?php else: ?>
                      <?php foreach ($overdues as $due): ?>
                        <tr>
                          <td><?php echo html_escape($due->customer_name) ?></td>
                          <td><?php echo html_escape($this->business->currency_symbol.''.$due->grand_total) ?></td>
                        </tr>
                      <?php endforeach ?>
                    <?php endif ?>
                  </tbody>
                </table>
              </div>
            </div>

            <?php if (!empty($overdues)): ?>
              <div class="text-center bt-1 border-light p-10">
                <a class="d-block font-size-14" href="<?php echo base_url('admin/invoice/type/1') ?>">See all overdue invoices  <i class="fa fa-long-arrow-right"></i></a>
              </div>
            <?php endif ?>
          </div>

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Paid Invoices</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Customer</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($paids)): ?>
                      <p>No data founds</p>
                      <?php else: ?>
                        <?php foreach ($paids as $paid): ?>
                          <tr>
                            <td><?php echo html_escape($paid->customer_name) ?></td>
                            <td><?php echo html_escape($this->business->currency_symbol.''.$paid->grand_total) ?></td>
                          </tr>
                        <?php endforeach ?>
                      <?php endif ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <?php if (!empty($paids)): ?>
                <div class="text-center bt-1 border-light p-10">
                  <a class="d-block font-size-14" href="<?php echo base_url('admin/invoice/type/3') ?>">See all paid invoices  <i class="fa fa-long-arrow-right"></i></a>
                </div>
              <?php endif ?>

            </div>

          </div>
        </div>

      </section>

    </div>