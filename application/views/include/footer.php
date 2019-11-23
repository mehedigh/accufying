    </main>
    <!-- end main -->

    <!-- start footer -->
    <?php if (isset($page_title) && $page_title != 'Register'): ?>
        <footer class="footer footer--s3 footer--color-dark">
            <div class="footer__line footer__line--first">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-5">
                            <div class="footer__item">
                                <a class="footer__logo site-logo" href="<?php echo base_url() ?>">
                                    <img src="<?php echo base_url(settings()->logo) ?>" width="159" alt="demo" />
                                </a>
                            </div>

                            <div class="footer__item">
                                <?php echo html_escape(settings()->footer_about) ?>
                            </div>
                        </div>

                        <div class="col-12 col-md-5 col-lg-3">
                            <div class="footer__item">
                                <nav id="footer__navigation" class="footer__navigation">
                                    <ul>
                                        <li><a href="<?php echo base_url('features') ?>">Features</a></li>
                                        <li><a href="<?php echo base_url('pricing') ?>">Pricing</a></li>
                                        <li><a href="<?php echo base_url('blog') ?>">Blogs</a></li>
                                        <li><a href="<?php echo base_url('faqs') ?>">FAQs</a></li>
                                        <li><a href="<?php echo base_url('contact') ?>">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 col-lg-4">
                            <div class="footer__item">
                                <nav id="footer__navigation" class="footer__navigation">
                                    <ul>
                                        <?php foreach (get_pages() as $page): ?>
                                            <li><a href="<?php echo base_url('page/'.$page->slug) ?>"><?php echo html_escape($page->title) ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                
                    </div>

                    <div class="spacer py-4 py-sm-2"></div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <span class="__copys"><?php echo html_escape(settings()->copyright) ?></span>
                        </div>
                    </div>
                </div>
            </div>


        </footer>
    <?php endif; ?>
    <!-- end footer -->
   
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <?php $success = $this->session->flashdata('msg'); ?>
    <?php get_update_currencies(); ?>
    <?php $error = $this->session->flashdata('error'); ?>
    <input type="hidden" id="success" value="<?php echo html_escape($success); ?>">
    <input type="hidden" id="error" value="<?php echo html_escape($error);?>">

    </div>

    <div id="btn-to-top-wrap">
        <a id="btn-to-top" class="circled" href="javascript:void(0);" data-visible-offset="800"></a>
    </div>


    <script src="<?php echo base_url() ?>assets/front/js/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/bootstrap.min.js"></script>

    <!-- gdpr compliance code -->
    <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/jquery.cookieMessage.min.js"></script>
    <script type="text/javascript">
        $.cookieMessage({
            'mainMessage': 'This website uses cookies. By using this website you consent to our use of these cookies. ',
            'acceptButton': 'Accept',
            'fontSize': '16px',
            'backgroundColor': '#222',
        });
    </script>
    <!-- gdpr compliance code -->

    <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/main.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/custom.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/toast.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/sweet-alert.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/validation.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.multiple_select').select2();
        $('.single_select').select2();
    });
    </script>

    <script type="text/javascript">
      <?php if (isset($success)): ?>
          $(document).ready(function() {
            var msg = $('#success').val();
            $.toast({
              heading: 'Success',
              text: msg,
              position: 'top-right',
              loaderBg:'#fff',
              icon: 'success',
              hideAfter: 3500
            });
          });
      <?php endif; ?>

      <?php if (isset($error)): ?>
          $(document).ready(function() {
            var msg = $('#error').val();
            $.toast({
              heading: 'Error',
              text: msg,
              position: 'top-right',
              loaderBg:'#fff',
              icon: 'error',
              hideAfter: 3500
            });
          });
      <?php endif; ?>
    </script>

</body>
</html>