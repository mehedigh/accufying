<ul class="nav nav-tabs admin">
  <li><a class="<?php if(isset($page_title) && $page_title == 'Personal Information'){echo "active";} ?>" href="<?php echo base_url('admin/profile') ?>"><i class="fa fa-cog"></i> General Settings</a></li>
  <li><a class="<?php if(isset($page_title) && $page_title == 'Change Password'){echo "active";} ?>" href="<?php echo base_url('admin/profile/change_password') ?>"><i class="fa fa-lock"></i> Change Password</a></li>
  <li><a class="<?php if(isset($page_title) && $page_title == 'Business' || $page == 'Business'){echo "active";} ?>" href="<?php echo base_url('admin/business') ?>"><i class="fa fa-briefcase"></i> Business</a></li>
  <li><a class="<?php if(isset($page_title) && $page_title == 'Invoice Customization'){echo "active";} ?>" href="<?php echo base_url('admin/business/invoice_customize') ?>"><i class="fa fa-file-text"></i> Invoice Customization</a></li>
</ul>