</main>
<footer class="footer">
    <div class="footer__container container">
        <div class="footer__top">
            <nav class="footer__menu footer-menu">
                <h4 class="footer-menu__title"><?php _e('Main Links', 'rightonit'); ?></h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_menu',
                    'menu_class' => 'footer-menu__list',
                    'container' => false,
                    'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                    'add_li_class' => 'footer-menu__item',
                    'link_class' => 'footer-menu__link'
                ));
                ?>
            </nav>
        
            <nav class="footer__menu footer-menu">
                <h4 class="footer-menu__title"><?php _e('Our Services', 'rightonit'); ?></h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'services_menu',
                    'menu_class' => 'footer-menu__list',
                    'container' => false,
                    'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                    'add_li_class' => 'footer-menu__item',
                    'link_class' => 'footer-menu__link'
                ));
                ?>
            </nav>
        
            <nav class="footer__menu footer-menu">
                <h4 class="footer-menu__title"><?php _e('Projects', 'rightonit'); ?></h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'projects_menu',
                    'menu_class' => 'footer-menu__list',
                    'container' => false,
                    'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                    'add_li_class' => 'footer-menu__item',
                    'link_class' => 'footer-menu__link'
                ));
                ?>
            </nav>
            
            <nav class="footer__menu footer-menu">
                <h4 class="footer-menu__title"><?php _e('Legal', 'rightonit'); ?></h4>
                <ul class="footer-menu__list">
                    <li class="footer-menu__item">
                        <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="footer-menu__link"><?php _e('Privacy Policy', 'rightonit'); ?></a>
                    </li>
                    <li class="footer-menu__item">
                        <a href="<?php echo esc_url(home_url('/terms-of-service')); ?>" class="footer-menu__link"><?php _e('Terms of Service', 'rightonit'); ?></a>
                    </li>
                    <li class="footer-menu__item">
                        <a href="<?php echo esc_url(home_url('/sitemap')); ?>" class="footer-menu__link"><?php _e('Sitemap', 'rightonit'); ?></a>
                    </li>
                </ul>
            </nav>
        </div>
        
        <div class="footer__middle">
            <div class="footer__row">
                <div class="footer__col">
                    <div class="footer__contact footer__contact--dark-bg">
                        <h4 class="footer__title" role="heading" aria-level="5"><?php _e('CHAT WITH US', 'rightonit'); ?></h4>
                        <a href="tel:<?php echo esc_attr(get_theme_mod('phone_number', '213.894.9933')); ?>" class="footer__link footer__link--white">
                            <span><?php echo esc_html(get_theme_mod('phone_number', '213.894.9933')); ?></span>
                        </a><br>
                        <a href="mailto:<?php echo esc_attr(get_theme_mod('email_address', 'hello@rightonit.com')); ?>" class="footer__link footer__link--white">
                            <span><?php echo esc_html(get_theme_mod('email_address', 'hello@rightonit.com')); ?></span>
                        </a>
                    </div>
                </div>
                <div class="footer__col">
                    <div class="footer__location">
                        <h4 class="footer__subtitle" role="presentation" aria-level="3"><?php _e('FIND US', 'rightonit'); ?></h4>
                        <h4 class="footer__address" role="heading" aria-level="2">
                            <a href="<?php echo esc_url(get_theme_mod('map_link', 'https://www.google.com/maps')); ?>" rel="noopener" target="_blank">
                                <?php echo nl2br(esc_html(get_theme_mod('company_address', "911 W. Washington Blvd.\nLos Angeles, California 90015"))); ?>
                            </a>
                        </h4>
                    </div>
                </div>
                <div class="footer__col">
                    <div class="footer__social">
                        <h4 class="footer__title"><?php _e('Follow us on', 'rightonit'); ?></h4>
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
            </div>
        </div>
        <div class="footer__bottom">
                   <?php 
$footer_logo = carbon_get_theme_option('crb_footer_logo');
if ($footer_logo) : ?>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__logo-link">
        <img src="<?php echo esc_url($footer_logo); ?>" alt="<?php bloginfo('name'); ?>" class="footer__logo">
    </a>
<?php endif; ?>
            <div class="footer__copyrite">
                <span>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All Rights Reserved', 'rightonit'); ?></span>
                <span class="footer__links">
                    | <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="footer__link"><?php _e('Privacy Policy', 'rightonit'); ?></a>
                    | <a href="<?php echo esc_url(home_url('/contact')); ?>" class="footer__link"><?php _e('Contact Us', 'rightonit'); ?></a>
                </span>
            </div>
        </div>
    </div>
</footer>

<?php get_template_part('template-parts/modal'); ?>

<div class="overlay"></div>

<?php wp_footer(); ?>
</body>
</html>