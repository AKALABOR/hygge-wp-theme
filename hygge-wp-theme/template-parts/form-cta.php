<?php
/**
 * Global Contact Form (CTA) Template Part
 */
?>
<section class="cta" id="contacts">
    <div class="container cta-wrapper">
        <div class="cta-text">
            <h2><?php echo esc_html( get_theme_mod( 'cta_title', 'Запросити консультацію щодо переходу' ) ); ?></h2>
            <p><?php echo esc_html( get_theme_mod( 'cta_subtitle', 'Залиште заявку — ми зв\'яжемося з вами протягом одного робочого дня та відповімо на всі питання.' ) ); ?></p>
            
            <?php if ( isset($_GET['contact_success']) && $_GET['contact_success'] == '1' ) : ?>
                <div style="background: rgba(40, 167, 69, 0.1); color: #28a745; padding: 15px; border-radius: 8px; margin-top: 20px; font-weight: 500;">
                    <?php echo esc_html( get_theme_mod( 'cta_success_msg', '✓ Дякуємо! Ваша заявка успішно відправлена. Ми зв\'яжемося з вами найближчим часом.' ) ); ?>
                </div>
            <?php endif; ?>
        </div>

        <form class="cta-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST" id="hygge-global-contact-form">
            <fieldset style="border:none; padding:0; margin:0;">
                <legend class="sr-only">Форма заявки на консультацію</legend>
                
                <input type="hidden" name="action" value="hygge_contact_form">
                <?php wp_nonce_field( 'hygge_contact_action', 'hygge_contact_nonce' ); ?>
                <input type="hidden" name="return_url" value="<?php echo esc_attr( get_permalink() ); ?>">
                <input type="hidden" name="form_timestamp" value="<?php echo time(); ?>">

                <!-- Honeypot Field (Hidden from users, bots will fill it) -->
                <div class="form-group" style="display:none !important;" aria-hidden="true">
                    <label for="cta-website">Ваш вебсайт</label>
                    <input type="text" id="cta-website" name="website_url" tabindex="-1" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="cta-name">Ваше ім'я</label>
                    <input type="text" id="cta-name" name="name" placeholder="Олександр" required>
                </div>
                <div class="form-group">
                    <label for="cta-contact">Телефон або Email</label>
                    <input type="text" id="cta-contact" name="contact" placeholder="+380... або email" required>
                </div>
                <button type="submit" class="btn-primary btn-submit"><?php echo esc_html( get_theme_mod( 'cta_btn_text', 'Записатись на консультацію' ) ); ?></button>
                <p class="form-note"><small>Натискаючи кнопку, ви погоджуєтеся з політикою конфіденційності.</small></p>
            </fieldset>
        </form>
    </div>
</section>
