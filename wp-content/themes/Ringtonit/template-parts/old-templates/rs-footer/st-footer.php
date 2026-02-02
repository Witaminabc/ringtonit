<!--<footer class="rs-17">-->
<!--	<div class="rs-footer">-->
<!--		<div class="container">-->
<!--			<div class="row">-->
<!--				<div class="col-xs-12 col-sm-6 col-md-4 footer-block">-->
<!--					--><?php //if (is_active_sidebar( 'footer-left' )) dynamic_sidebar( 'footer-left'); ?>
<!--				</div>-->
<!--				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-lg-offset-1 footer-block">-->
<!--					--><?php //if (is_active_sidebar( 'footer-left-center' )) dynamic_sidebar( 'footer-left-center'); ?>
<!--				</div>-->
<!--				<div class="col-xs-12 col-sm-6 col-md-2 footer-block">-->
<!--					--><?php //if (is_active_sidebar( 'footer-right-center' )) dynamic_sidebar( 'footer-right-center'); ?>
<!--				</div>-->
<!--				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-2 footer-block">-->
<!--					--><?php //if (is_active_sidebar( 'footer-right' )) dynamic_sidebar( 'footer-right'); ?>
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!---->
<!--		<div class="footer-bottom">-->
<!--			<div class="container">-->
<!--				<div class="row">-->
<!--					<div class="col-xs-12">-->
<!--						--><?php //if (is_active_sidebar( 'bottom' )) dynamic_sidebar( 'bottom'); ?>
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</footer>-->
<footer class="site-footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                <!-- Контакты и магазин -->
                <div class="footer-column">
                    <h3 class="footer-title">Магазин</h3>
                    <div class="footer-link">
                        <a href="https://stophimiy.ru/personalnyyrazdel/" class="footer-link-item">Личный кабинет</a>
                    </div>
                    <?php if (is_active_sidebar( 'footer-left' )) dynamic_sidebar( 'footer-left'); ?>
                </div>

                <!-- Каталог -->
                <div class="footer-column">
                    <h3 class="footer-title">Каталог</h3>
                    <?php if (is_active_sidebar( 'footer-left-center' )) dynamic_sidebar( 'footer-left-center'); ?>

                </div>

                <!-- Новости -->
                <div class="footer-column">
                    <h3 class="footer-title">Новости</h3>
                    <?php if (is_active_sidebar( 'footer-right-center' )) dynamic_sidebar( 'footer-right-center'); ?>
                </div>

                <!-- О нас -->
                <div class="footer-column">
                    <h3 class="footer-title">О нас</h3>
                    <?php if (is_active_sidebar( 'footer-right' )) dynamic_sidebar( 'footer-right'); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Нижняя часть футера -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <?php if (is_active_sidebar( 'bottom' )) dynamic_sidebar( 'bottom'); ?>
            </div>
        </div>
    </div>
</footer>



<!-- /.rs-footer -->