<div class="start-content">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-6">
                <div class="d-md-block">
                    <div class="__site-name"><?php echo html_escape(settings()->site_name) ?></div>
                </div>
                <h3>
                   <?php echo html_escape(settings()->description) ?>
                </h3>

                <div class="spacer py-1 py-sm-2"></div>

                <div class="d-sm-table">
                    <div class="d-sm-table-cell  pb-5 pb-sm-0 pr-sm-8 pr-md-10">
                        <a class="custom-btn custom-btn--medium custom-btn--style-3" href="<?php echo base_url('register') ?>">Get Started <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-10 col-lg-6 xsmt-10">
                <img class="pull-right hero-imgi mt--40" src="<?php echo base_url() ?>assets/front/img/hside.png" alt="Hero Image" />
            </div>
        </div>
    </div>
</div>


<!-- start main -->
<main role="main">
    <!-- start section -->
    <section class="section section--light-blue-bg">
        <div class="container">
            <div class="section-heading section-heading--center">
                <h3 class="__title mb-0">Workflow</h3>
                <h4 class="mt-1"><span>Look at a glance how our app works</span></h4>
            </div>

            <div class="spacer py-6"></div>

            <div class="row">
                <div class="col-12">

                    <!-- start steps -->
                    <div class="steps steps--s1">
                        <div class="__inner">
                            <div class="row justify-content-center justify-content-xl-around">
                                <!-- start item -->
                                <div class="col-12 col-sm-9 col-md-4 col-xl-3">
                                    <div class="__item">
                                        <div class="mb-md-8">
                                            <span class="__num">
                                                <img class="pull-rights" src="<?php echo base_url() ?>assets/front/img/plan.svg" alt="demo" />
                                            </span>
                                        </div>
                                        <h4 class="__title">Choose Plan</h4>
                                        <p>
                                            Choose your confortable plan
                                        </p>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="col-12 col-sm-9 col-md-4 col-xl-3">
                                    <div class="__item">
                                        <div class="mb-md-8">
                                            <span class="__num">
                                                <img class="pull-rights" src="<?php echo base_url() ?>assets/front/img/payment.svg" alt="demo" />
                                            </span>
                                        </div>
                                        <h4 class="__title">Get Paid</h4>
                                        <p>
                                            Paid via paypal payment method
                                        </p>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="col-12 col-sm-9 col-md-4 col-xl-3">
                                    <div class="__item">
                                        <div class="mb-md-8">
                                            <span class="__num">
                                                <img class="pull-rights" src="<?php echo base_url() ?>assets/front/img/work.svg" alt="demo" />
                                            </span>
                                        </div>
                                        <h4 class="__title">Start Working</h4>
                                        <p>
                                            Start Using <?php echo html_escape(settings()->site_name) ?> and explore the featuers
                                        </p>
                                    </div>
                                </div>
                                <!-- end item -->
                            </div>
                        </div>
                    </div>
                    <!-- end steps -->

                </div>
            </div>
        </div>
    </section>
    <!-- end section -->

    
    <?php if (!empty($features)): ?>
        <section class="section">
            <div class="container">
                <div class="section-heading section-heading--center">
                    <h3 class="__title">The better way to make, move and manage your money</h3>
                </div>

                <?php $i=1; foreach ($features as $feature): ?>
                    <div class="row <?php if($i % 2 == 0){echo "flex-lg-row-reverse";} ?> align-items-md-center">
                        <div class="col-12 col-lg-6">
                            <div class="section-heading">
                                <h3 class="__title"><?php echo html_escape($feature->name); ?></h3>
                            </div>

                            <div class="spacer py-2"></div>

                            <div>
                                <p class="c-555">
                                    <?php echo strip_tags($feature->details); ?>
                                </p>
                            </div>
                        </div>

                        <div class="spacer py-4 d-lg-none"></div>

                        <div class="col-12 col-lg-6  text-center text-lg-<?php if($i % 2 == 0){echo "left";}else{echo "right";} ?>">
                            <img class="img-fluid" width="520" height="507" src="<?php echo base_url($feature->image) ?>" alt="demo" />
                        </div>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        </section>
    <?php endif ?>


    <!-- start testimonials section -->
    <?php if (!empty($testimonials)): ?>
        <section class="section section--light-blue-bg">
            <div class="container">
                <div class="section-heading text-center">
                    <h2 class="__title">Clients Say <span>About <?php echo html_escape(settings()->site_name) ?></span></h2>
                </div>

                <div class="spacer py-4"></div>

                <div class="row">
                    <div class="col-12">
                        <!-- start review -->
                        <div class="review review--s1 review--slider">
                            <div class="js-slick"
                                data-slick='{
                                    "autoplay": true,
                                    "infinite": false,
                                    "arrows": true,
                                    "dots": false,
                                    "speed": 1200
                                }'>
                                <?php foreach ($testimonials as $testimonial): ?>
                                    <div class="review__item">
                                        <figure class="review__item__author-image">
                                            <img width="100" height="100" src="<?php echo base_url($testimonial->thumb) ?>" alt="Image" />
                                        </figure>
                                        <div>
                                            <span class="review__item__author-name h4 mb-1"><?php echo html_escape($testimonial->name); ?></span>
                                            <p>
                                                <?php echo character_limiter($testimonial->feedback, 80); ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- end review -->
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>
    <!-- end section -->


    <!-- start blog section -->
    <?php if (!empty($posts)): ?>
        <section id="blog" class="section pb-50">
            <div class="container">
                <div class="section-heading section-heading--center">
                    <h3 class="__title">Learn more, Build skills & Empower yourself </h3>
                </div>

                <div class="row">
                    <div class="col-12">
                        <!-- start posts -->
                        <div class="posts posts--s2">
                            <div class="__inner">
                                <div class="row">
                                    <?php foreach ($posts as $post): ?>
                                    <div class="col-12 col-sm-6 col-lg-4 d-sm-flex">
                                        <div class="__item __item--preview">
                                            <div class="__header">
                                                <a href="<?php echo base_url('post/'.$post->slug) ?>">
                                                    <figure class="__image">
                                                        <img width="303" height="223" src="<?php echo base_url($post->image) ?>" alt="demo" />
                                                    </figure>
                                                </a>
                                            </div>

                                            <div class="__body">
                                                <div class="__content">
                                                    <a class="post_category" href="<?php echo base_url('category/'.$post->category_slug) ?>">
                                                        <?php echo html_escape($post->category) ?>
                                                    </a>

                                                    <h4 class="__title"><a href="<?php echo base_url('post/'.$post->slug) ?>"><?php echo html_escape($post->title) ?></a></h4>

                                                    <p>
                                                        <?php echo character_limiter($post->details, 100)?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                        <!-- end posts -->

                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>
    <!-- end section -->
   
</main>
<!-- end main -->