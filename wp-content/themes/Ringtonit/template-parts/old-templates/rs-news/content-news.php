<!--<div class="col-xs-6 col-sm-6 col-md-3 news-block">-->
<!--	<div class="news-item" data-nekoanim="fadeInUp" data-nekodelay="400">-->
<!--		<a class="news-image b-lazy" href="--><?php //the_permalink() ?><!--"-->
<!--           data-src="--><?//=get_the_post_thumbnail_url(); ?><!--"></a>-->
<!--		<div class="news-title">-->
<!--			<h3>-->
<!--				<a href="--><?php //the_permalink() ?><!--">--><?php //the_title() ?><!--</a>-->
<!--			</h3>-->
<!--		</div>-->
<!--			<div class="news-date">-->
<!--				--><?php //echo get_the_date("j F Y");  ?>
<!--			</div>-->
<!--			--><?php //if(get_the_content()) { ?>
<!--			<div class="news-content">-->
<!--				--><?php //if (get_the_content()) {?>
<!--					--><?php //echo kama_excerpt(array('maxchar' => 80)); ?>
<!--				--><?php //} ?>
<!--			</div>--><?// }
//		?>
<!--		<div class="news-more">-->
<!--			<a href="--><?php //the_permalink() ?><!--" class="btn btn-outline">Подробнее</a>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->

<article class="news-card">
    <div class="news-image">
        <img src="<?=get_the_post_thumbnail_url(); ?>"

             srcset="<?=get_the_post_thumbnail_url(); ?>">
    </div>

    <div class="news-content">
        <h3 class="news-title"><?php the_title() ?></h3>
        <?php if(get_the_content()) { ?>
        <p class="news-text"><?php if (get_the_content()) {?>
                <?php echo kama_excerpt(array('maxchar' => 80)); ?>
            <?php } ?></p>
        <? }
        ?>
    </div>

    <div class="news-action">
        <a href="<?php the_permalink() ?>" class="news-link">Подробнее</a>
    </div>
</article>
<?php
	unset($photo);
	unset($params);
	unset($image);
?>