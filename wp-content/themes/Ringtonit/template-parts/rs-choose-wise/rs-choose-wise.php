
<?php


function rs_choose_wise_functions()
{

    $query = new WP_Query(array(
        'post_type' => 'custom_block',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'block_id',
                'value' => 9, // id блока
                'compare' => '='
            )
        )
    ));
    $query->the_post();
//    $rs_about_title = get_field('rs_about_title');
//    $rsadvantagesfull = get_field('rsaboutfull');
//    $rsaboutnumber = get_field('rsaboutnumber');
    ?>
<!--    --><?php //echo $rs_about_title; ?>
<!--    --><?php //foreach ($rsadvantagesfull as $rsadvantagesfull_k => $rsadvantagesfull_v){ ?>
<!--    --><?php //echo $rsadvantagesfull_v['title']; ?>

<?php //} ?>


    <section class="choose-wise">
        <div class="container">
            <div class="choose-wise__row">
                <div class="choose-wise__column column--first">
                    <h2 class="choose-wise__title" data-parallax>Why Choose Wise Swans SEO Company?</h2>
                    <p class="choose-wise__subtitle" data-parallax>We provide top-notch SEO services to boost your
                        online presence.</p>
                </div>
                <div class="choose-wise__column column--second">
                    <div class="choose-wise__accordion accordion">
                        <div class="accordion__item">
                            <button class="accordion__header">
                                <span class="accordion__title">Our Wisdom and Experience</span>
                                <span class="accordion__icon">+</span>
                            </button>
                            <div class="accordion__content">
                                <p class="accordion__text">Our wisdom is based not only on our experience. Wisdom is
                                    in creating a perfect and comfortable world between You and Us. In the ability
                                    to listen and convert your experience and knowledge into a brilliant SEO or
                                    Internet Marketing solution.</p>
                            </div>
                        </div>

                        <div class="accordion__item">
                            <button class="accordion__header">
                                <span class="accordion__title">Research and Strategy</span>
                                <span class="accordion__icon">+</span>
                            </button>
                            <div class="accordion__content">
                                <p class="accordion__text">If you are new to your business and don’t know what
                                    exactly you need, our marketers can do research for you and advise a strategy on
                                    where to move and what to do.</p>
                            </div>
                        </div>

                        <div class="accordion__item">
                            <button class="accordion__header">
                                <span class="accordion__title">Highly Qualified Team</span>
                                <span class="accordion__icon">+</span>
                            </button>
                            <div class="accordion__content">
                                <p class="accordion__text">At WiseSwans SEO Company United States, we have very
                                    high-qualified employees, and we all are truly in love with what we do. We are
                                    able to deal with any complicated task.</p>
                            </div>
                        </div>

                        <div class="accordion__item">
                            <button class="accordion__header">
                                <span class="accordion__title">Custom SEO Solutions</span>
                                <span class="accordion__icon">+</span>
                            </button>
                            <div class="accordion__content">
                                <p class="accordion__text">We create tailored SEO strategies that align with your
                                    business goals, ensuring maximum visibility and growth for your brand.</p>
                            </div>
                        </div>


                        <div class="accordion__item">
                            <button class="accordion__header">
                                <span class="accordion__title">Data-Driven Marketing</span>
                                <span class="accordion__icon">+</span>
                            </button>
                            <div class="accordion__content">
                                <p class="accordion__text">Our approach is backed by data analytics, ensuring that
                                    every decision we make is optimized for your success.</p>
                            </div>
                        </div>

                        <div class="accordion__item">
                            <button class="accordion__header">
                                <span class="accordion__title">Continuous Support</span>
                                <span class="accordion__icon">+</span>
                            </button>
                            <div class="accordion__content">
                                <p class="accordion__text">We provide ongoing support and optimization to ensure
                                    your SEO strategy evolves with the changing digital landscape.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>


    <?php

    wp_reset_query();

}


