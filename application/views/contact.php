<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 text-center">
                <h2>Get in touch <span>with us</span></h2>
                <form method="post" action="<?php echo base_url('home/send_message'); ?>">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="input-wrp">
                                <input class="textfield textfield--grey" placeholder="Full name" name="name" type="text" />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="input-wrp">
                                <input class="textfield textfield--grey" placeholder="Email" name="email" type="text" inputmode="email" x-inputmode="email" required />
                            </div>
                        </div>
                    </div>

                    <label class="input-wrp">
                        <textarea class="textfield textfield--grey" placeholder="Write your Message" name="message" required></textarea>
                    </label>
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button class="custom-btn custom-btn--medium custom-btn--style-3" type="submit" role="button">Send</button>

                    <div class="form__note"></div>
                </form>
            </div>
            <div class="spacer py-4 d-lg-none"></div>
        </div>
    </div>
</section>