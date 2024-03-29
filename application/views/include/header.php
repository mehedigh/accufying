<!DOCTYPE html>
<html class="no-js" lang="en">
    <?php $settings = get_settings(); ?>
    <head>
        <meta charset="utf-8">
        <title><?php echo html_escape($settings->site_name) ?> - <?php echo html_escape($settings->site_title) ?></title>
        <meta charset="utf-8">
        <meta name="author" content="<?php echo html_escape($settings->site_name) ?>">
        <meta name="description" content="<?php echo html_escape($settings->description) ?>">
        <meta name="keywords" content="<?php echo html_escape($settings->keywords) ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="theme-color" content="#056EB9" />
        <meta name="msapplication-navbutton-color" content="#056EB9" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#056EB9" />

        <!-- Favicons
        ================================================== -->
        <link rel="icon" href="<?php echo base_url($settings->favicon) ?>">
        <link rel="apple-touch-icon" href="img/apple-touch-icon.html">
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.html">
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.html">

        <!-- styles
        ================================================== -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/cristal.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/style.min.css" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/font-awesome.min.css">
        <link href="<?php echo base_url() ?>assets/admin/css/toast.css" rel="stylesheet" />
        <link href="<?php echo base_url() ?>assets/admin/css/sweet-alert.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/simple-line-icons.css">
        <link href="<?php echo base_url() ?>assets/front/css/select2.min.css" rel="stylesheet" />

        <!-- Load google font
        ================================================== -->
        <script type="text/javascript">
            WebFontConfig = {
                google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
            };
            (function() {
                var wf = document.createElement('script');
                wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
                wf.type = 'text/javascript';
                wf.async = 'true';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(wf, s);
            })();
        </script>

        <script type="text/javascript">
           var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
           var token_name = '<?php echo $this->security->get_csrf_token_name();?>'
        </script>

        <!-- Load scripts
        ================================================== -->
        <script type="text/javascript">
            var _html = document.documentElement,
                isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

            _html.className = _html.className.replace("no-js","js");
            _html.classList.add( isTouch ? "touch" : "no-touch");
        </script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/device.min.js"></script>

        
        <?php if (!empty($settings->google_analytics)): ?>
            <!-- google analytics -->
            <?php echo base64_decode($settings->google_analytics) ?>
        <?php endif ?>

    </head>

    <body>
        <div id="app">
           
            <!-- start header -->
            <?php if (isset($page_title) && $page_title != 'Register'): ?>
                <header id="top-bar" class="top-bar top-bar--dark" data-nav-anchor="true">
                    <div class="top-bar__inner">
                        <div class="container-fluid">
                            <div class="row align-items-center no-gutters">

                                <a class="top-bar__logo site-logo" href="<?php echo base_url() ?>">
                                    <img class="img-fluid" src="<?php echo base_url($settings->logo) ?>" width="159" height="45" alt="demo" />
                                </a>

                                <a id="top-bar__navigation-toggler" class="top-bar__navigation-toggler" href="javascript:void(0);">
                                    <span></span>
                                </a>

                                <div class="top-bar__collapse">
                                    <nav id="top-bar__navigation" class="top-bar__navigation" role="navigation">
                                        <ul>
                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Home'){echo "active";} ?>" href="<?php echo base_url() ?>">Home</a>
                                            </li>

                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Features'){echo "active";} ?>" href="<?php echo base_url('features') ?>">Features</a>
                                            </li>

                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Pricing'){echo "active";} ?>" href="<?php echo base_url('pricing') ?>">Pricing</a>
                                            </li>
                                           
                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Blog Posts'){echo "active";} ?>" href="<?php echo base_url('blog') ?>">Blogs</a>
                                            </li>

                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Faqs'){echo "active";} ?>" href="<?php echo base_url('faqs') ?>">FAQs</a>
                                            </li>

                                            <li>
                                                <a class="nav-link <?php if(isset($page_title) && $page_title == 'Contact'){echo "active";} ?>" href="<?php echo base_url('contact') ?>">Contact </a>
                                            </li>

                                            <?php if (!empty(get_pages())): ?>
                                                <li class="has-submenu">
                                                    <a class="nav-link" href="javascript:void(0);">More</a>

                                                    <ul class="submenu">
                                                        <?php foreach (get_pages() as $page): ?>
                                                            <li><a href="<?php echo base_url('page/'.$page->slug) ?>"><?php echo html_escape($page->title) ?></a></li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </li>
                                            <?php endif ?>

                                        </ul>
                                    </nav>

                                    <div id="top-bar__action" class="top-bar__action">
                                        <div class="d-xl-flex flex-xl-row flex-xl-wrap align-items-xl-center">
                                            <div class="top-bar__auth-btns">
                                                <?php if (is_admin()): ?>
                                                    <a class="custom-btn custom-btn--medium custom-btn--style-3" href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                                                <?php elseif(is_user()): ?>
                                                     <a class="custom-btn custom-btn--medium custom-btn--style-3" href="<?php echo base_url('admin/dashboard/business') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                                                <?php else: ?>
                                                    <a href="<?php echo base_url('login') ?>">Sign In</a>
                                                    <a class="custom-btn custom-btn--medium custom-btn--style-2" href="<?php echo base_url('register') ?>">Create Account</a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </header>
            <?php endif ?>
            <!-- end header -->
            <div class="spacer py-8"></div>
            <!-- start main -->
            <main role="main">