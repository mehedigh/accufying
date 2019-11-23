<div class="row mb-20 mt-250">
    <div class="col-md-12 text-center">
		<div class="alert alert-danger">
		   <div class="lh-34">
		   	<h1 class="text-danger"><i class="icon-info"></i></h1>
		   	<h4 class="mb-0">You have reached your limit</h4>
		    <p>You already created <strong><?php echo html_escape($total.' '.$limit_for) ?></strong>. Please upgrade your package to unlock the features. </p>
		  </div><br>
		    <div class="clearfix"></div>
		</div>
		<a href="<?php echo base_url('admin/subscription') ?>" class="btn btn-info rounded">Upgrade your plan</a>
	</div>
</div>