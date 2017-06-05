<?php
/**
 * General template
 *
 **/

global $wp_query;

get_header(); ?>
    <div class="content">
        <?php
        //Start the loop
        $i=0;
        while ( have_posts() ) : the_post();?>
        <div class="module home-block emerge">
                <a href="<?php the_permalink();?>">
                    <div>
                        <?php the_post_thumbnail() ?>
                    </div>
				<h2><?php the_title();?></h2></a>
				<?php the_excerpt();?>
				<?php
					$campaign = get_post();
					if( !$campaign || $campaign->post_type != Leyka_Campaign_Management::$post_type ) { 
					// Wrong campaign data
						echo '';
					}
					echo "<div id='".esc_attr('leyka_scale_standalone-'.uniqid())."'>".leyka_get_scale($campaign, $a)."</div>";

				?>
				<div class="leyka-scale-button">

                <a href='<?php echo trailingslashit(get_permalink($campaign->ID)).'#leyka-payment-form';?>' <?php echo $campaign->ID == $current_post->ID ? 'class="leyka-scroll"' : '';?><?php echo $args['embed_mode'] === 1 ? ' target="_blank"' : '';?>>
                    ПОМОЧЬ
                </a>
				</div>
		</div>
        <?php $i++; ?>
        <?php if($i==2) {?>
                <!-- Миссия -->
                <div class="module home-block center-pt20 emerge">
                    <p class="birka">Миссия «Редфонда»</p>
                    <h6>Сохранить<br>жизни пациентов <nobr>с редкими</nobr> заболеваниями, обеспечив доступность лечения и улучшив диагностику</h6>
                    <p><a href="#">Подробнее о фонде</a></p>
                </div>

                <!-- Цифры -->
                <div class="module home-block center-pt20 greyback emerge">
                    <p class="birka">Цифры</p>
                    <p class="digits">7000</p>
                    <p class="under-digits">редких заболеваний известно в мире</p>
                    <p class="digits">300</p>
                    <p class="under-digits">имеют лекарственную терапию</p>
                    <p class="digits">10%</p>
                    <p class="under-digits">населения страдают той или иной формой редкого заболевания</p>

                </div>
        <?php    }
            if($i==5) {?>
                <!-- Миссия -->
                <div class="module home-block center-pt20 emerge">
                    <p class="birka">Безопасность</p>
                    <h6>Сбор денег организован совместно <nobr>с Теплицей</nobr> социальных технологий <nobr>и Cloud Payments</nobr></h6>
                    <p><a href="#">Теплица социальных технологий</a></p>
                    <p><a href="#">Cloud Payments</a></p>
                </div>
        <?php    };



            ?>

    <?php
    // End the loop.
    endwhile; ?>
    </div> <!-- /content -->

    <div class="likely-holder">
        <!-- likely -->
        <div class="likely">
            <div class="facebook">Поделиться</div>
            <div class="vkontakte">Поделиться</div>
            <div class="twitter">Твитнуть</div>
            <div class="telegram">Отправить</div>
        </div>
    </div>


<?php get_footer(); ?>