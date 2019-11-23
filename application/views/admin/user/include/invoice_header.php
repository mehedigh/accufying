<div class="row mb-10">
    <div class="col-md-12">
        <h2 class="pull-left"><?php if(isset($page_title) && $page_title == 'Edit Invoice'){echo "Edit";}else{echo "Create new";} ?> invoice</h2>
        <div class="inv-top-btn mb-10">
			
			<?php if (isset($page_title) && $page_title == 'Edit Invoice'): ?>
                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-default btn-rounded pull-right ml-10"><i class="fa fa-long-arrow-left"></i> Back</a>
            <?php endif ?>

          <button type="submit" class="btn btn-info btn-rounded save_invoice_btn pull-right ml-5"><?php if(isset($page_title) && $page_title == 'Edit Invoice'){echo "Update";}else{echo "Save and continue";} ?></button>
            
          <button id="edit_invoice" type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info pull-right mr-10 edit_invoice_btn" style="display: none;">Edit</button>
            <button type="submit" class="btn waves-effect waves-light btn-outline-info btn-rounded pull-right mr-10 preview_invoice_btn">Preview</button>
        </div>
        <input type="hidden" class="set_value" name="check_value">
    </div>
</div>