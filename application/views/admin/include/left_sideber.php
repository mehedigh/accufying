 <aside class="main-sidebar">
    <section class="sidebar mt-10">
      
      <ul class="sidebar-menu" data-widget="tree">
  
        <?php if (is_admin()): ?>
          <li class="<?php if(isset($page_title) && $page_title == "Dashboard"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/dashboard') ?>">
              <i class="flaticon-home-2"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Settings"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/settings') ?>">
              <i class="flaticon-settings-1"></i> <span>Settings</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Users"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/users') ?>">
              <i class="flaticon-group"></i> <span>Users</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Features"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/package') ?>">
              <i class="flaticon-box-1"></i> <span>Pricing Package</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Feature"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/feature') ?>">
              <i class="flaticon-feature"></i> <span>Features</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Pages"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/pages') ?>">
              <i class="flaticon-document"></i> <span>Pages</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Faqs"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/faq') ?>">
              <i class="flaticon-info"></i> <span>Faqs</span>
            </a>
          </li>

          <li class="<?php if(isset($page_title) && $page_title == "Testimonial"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/testimonial') ?>">
              <i class="flaticon-rating"></i> <span>Testimonials</span>
            </a>
          </li>

          <li class="treeview <?php if(isset($page_title) && $page_title == "Blog " || isset($page) && $page == "Blog"){echo "active";} ?>">
            <a href="#"><i class="flaticon-blogging-1"></i>
              <span>Blog</span>
              <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url('admin/blog_category') ?>"><i class="flaticon-right-arrow"></i>Add Category </a></li>
              <li><a href="<?php echo base_url('admin/blog') ?>"><i class="flaticon-right-arrow"></i>Blog Posts</a></li>
            </ul>
          </li> 
          
        <?php else: ?>
        
        <li class="<?php if(isset($page_title) && $page_title == "User Dashboard"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/dashboard/business') ?>">
            <i class="flaticon-home-1"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php if (check_payment_status() == TRUE || settings()->enable_paypal == 0): ?>
        
        <li class="<?php if(isset($page_title) && $page_title == "Profile"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/profile') ?>">
            <i class="flaticon-settings-1"></i> <span>Settings</span>
          </a>
        </li>
       
        <li class="<?php if(isset($page_title) && $page_title == "Customers"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/customer') ?>">
            <i class="flaticon-target-1"></i> <span>Customers</span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Category"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/category') ?>">
            <i class="flaticon-folder-1"></i> <span>Categories</span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Tax"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/tax') ?>">
            <i class="flaticon-tax"></i> <span>Tax</span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Products"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/product') ?>">
            <i class="flaticon-box-1"></i> <span>Products</span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Estimate"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/estimate') ?>">
            <i class="flaticon-contract"></i> <span>Estimates</span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Invoices"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/invoice/type/1') ?>">
            <i class="flaticon-approve-invoice"></i> <span>Invoices</span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Create Invoice"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/invoice/create/1') ?>">
            <i class="flaticon-iterative"></i> <span>Recurring Invoice</span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Vendor"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/vendor') ?>">
            <i class="flaticon-group"></i> <span>Vendors</span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Expense"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/expense') ?>">
            <i class="flaticon-bill"></i> <span>Expenses</span>
          </a>
        </li>

        <?php endif ?>

        <li class="<?php if(isset($page_title) && $page_title == "Subscription"){echo "active";} ?>">
          <a href="<?php echo base_url('admin/subscription') ?>">
            <i class="flaticon-time-is-money"></i> <span>Subscription</span>
          </a>
        </li>

        <li class="<?php if(isset($page_title) && $page_title == "Reports"){echo "active";} ?>">
            <a href="<?php echo base_url('admin/reports') ?>">
              <i class="flaticon-analytics"></i> <span>Reports</span>
            </a>
        </li>

        <?php endif; ?>

        <li class="<?php if(isset($page_title) && $page_title == "Change Password"){echo "active";} ?>">
          <a href="<?php echo base_url('change_password') ?>">
            <i class="flaticon-lock-1"></i> <span>Change Password</span>
          </a>
        </li>

        <li class="">
          <a href="<?php echo base_url('auth/logout') ?>">
            <i class="flaticon-exit"></i> <span>logout</span>
          </a>
        </li>
      </ul>

      <?php if (!is_admin()): ?>
          <a href="<?php echo base_url('admin/subscription') ?>" class="btn btn-info upgrade_btn">
            <i class="fa fa-rocket"></i> <span>Upgrade</span>
          </a>
      <?php endif; ?>
    </section>
  </aside>