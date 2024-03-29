<section class="section">
    <div class="container">

        <?php if (empty($faqs)): ?>
            <div class="text-center">
                <h3 class="pt-300"><span>No data found!</span></h3>
            </div>
        <?php else: ?>

        <div class="section-heading section-heading--center">
            <h2 class="__title">Frequently <span>Asked Questions</span></h2>
        </div>

        <div class="spacer py-2"></div>

        <div class="row">
            <div class="col-12">

                <div class="content-container">
                    <!-- start FAQ -->
                    <div class="faq">
                        <div class="accordion-container">
                            
                            <!-- start item -->
                            <?php $i=1; foreach ($faqs as $row): ?>
                                <div class="accordion-item">
                                    <div class="accordion-toggler">
                                        <h4 class="accordion-title"><?php echo html_escape($row->title); ?></h4>
                                        <i class="circled"></i>
                                    </div>

                                    <article class="accordion-content">
                                        <div class="accordion-content__inner">
                                            <p>
                                                <?php echo strip_tags($row->details); ?>
                                            </p>
                                        </div>
                                    </article>
                                </div>
                            <?php $i++; endforeach; ?>
                            <!-- end item -->
                           
                        </div>
                    </div>
                    <!-- end FAQ -->
                </div>

            </div>
        </div>
        <?php endif; ?>
    </div>
</section>