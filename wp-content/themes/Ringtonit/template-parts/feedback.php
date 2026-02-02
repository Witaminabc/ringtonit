<section class="feedback" id="feedback">
    <div class="container feedback__container">
        <h2 class="feedback__title"><?php echo esc_html(carbon_get_theme_option('crb_contacts_title')); ?></h2>

        <div class="feedback__content-grid">
            <div class="feedback__content-grid-column">
                <div class="feedback__content-flex-row">
                    <div class="feedback__content-flex-column">
                        <h3>Contact Information</h3>
                        <ul class="contact-info">
                            <li><strong>Address:</strong> <?php echo esc_html(carbon_get_theme_option('crb_contacts_address')); ?></li>
                            <li><strong>Phone:</strong>
                                <a href="tel:<?php echo esc_attr(carbon_get_theme_option('crb_contacts_phone')); ?>">
                                    <?php echo esc_html(carbon_get_theme_option('crb_contacts_phone')); ?>
                                </a>
                            </li>
                            <li><strong>Email:</strong>
                                <a href="mailto:<?php echo esc_attr(carbon_get_theme_option('crb_contacts_email')); ?>">
                                    <?php echo esc_html(carbon_get_theme_option('crb_contacts_email')); ?>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="feedback__content-flex-column">
                        <h3>Follow Us</h3>
                        <ul class="social-links">
                            <?php
                            $socials = carbon_get_theme_option('crb_contacts_socials');
                            if ($socials) :
                                foreach ($socials as $social) :
                            ?>
                                    <li>
                                        <a href="<?php echo esc_url($social['url']); ?>" target="_blank">
                                            <?php if (!empty($social['icon'])) : ?>
                                                <img src="<?php echo esc_url($social['icon']); ?>" alt="<?php echo esc_attr($social['name']); ?>">
                                            <?php endif; ?>
                                            <?php echo esc_html($social['name']); ?>
                                        </a>
                                    </li>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>

                <p class="feedback__subtitle"><?php echo esc_html(carbon_get_theme_option('contacts_subtitle')); ?></p>
                <div class="feedback__text">
                    <?php echo wp_kses_post(carbon_get_theme_option('crb_contacts_text')); ?>
                </div>
                <p class="feedback__note"><?php echo esc_html(carbon_get_theme_option('crb_contacts_note')); ?></p>
            </div>

            <div class="feedback__content-grid-column">
                <form class="feedback__form" id="feedbackForm" data-ajax data-action="send_feedback_form" novalidate>
                    <?php if (carbon_get_theme_option('crb_show_field_name')) : ?>
                        <div class="form-group">
                            <input type="text" id="name" name="name" class="form-input" required>
                            <label for="name" class="form-label">Your Name</label>
                            <span class="form-error"></span>
                        </div>
                    <?php endif; ?>

                    <?php if (carbon_get_theme_option('crb_show_field_phone')) : ?>
                        <div class="form-group">
                            <input type="tel" id="phone" name="phone" class="form-input" required>
                            <label for="phone" class="form-label">Phone Number</label>
                            <span class="form-error"></span>
                        </div>
                    <?php endif; ?>

                    <?php if (carbon_get_theme_option('crb_show_field_message')) : ?>
                        <div class="form-group">
                            <textarea id="message" name="message" class="form-textarea" rows="3"></textarea>
                            <label for="message" class="form-label">Message (optional)</label>
                        </div>
                    <?php endif; ?>

                    <?php if (carbon_get_theme_option('crb_show_field_service')) : ?>
                        <div class="form-group">
                            <select id="services" name="services" class="form-select" required>
                                <option value="" disabled selected>Select a Service</option>
                                <?php
                                $services = carbon_get_theme_option('crb_contacts_services');
                                if ($services) :
                                    foreach ($services as $service) :
                                ?>
                                        <option value="<?php echo esc_attr($service['service_name']); ?>">
                                            <?php echo esc_html($service['service_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <label for="services" class="form-label">Choose a Service</label>
                            <span class="form-error"></span>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="feedback__submit">
                        <span>Submit</span>
                        <svg class="submit-icon" viewBox="0 0 24 24">
                            <path d="M4 12l16 0m-7-7l7 7-7 7"></path>
                        </svg>
                    </button>

                    <?php if (carbon_get_theme_option('crb_show_field_agreement')) : ?>
                        <div class="form-agreement">
                            <input type="checkbox" id="agreement" name="agreement" class="form-checkbox" required checked>
                            <label for="agreement">
                                I agree with the <a href="  <?php echo wp_kses_post(carbon_get_theme_option('contacts_privacy_policy')); ?>">privacy policy</a>
                            </label>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="feedback__decoration">
            <div class="decoration-circle"></div>
            <div class="decoration-dots"></div>
        </div>
    </div>
</section>