<?php
/**
 * Single Post template
 **/

get_header();
?>
<div class="content">
	<?php while (have_posts()){ the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('tpl-single'); ?>>

		<?php if ( has_post_thumbnail() ) : ?>

			<div class="module single-block">
				<div class="under-payment-form">
					<?php the_post_thumbnail() ?>
					<h2><?php the_title();?></h2>
					<?php the_excerpt();?>
					<?php
						$campaign = get_post();
						if( !$campaign || $campaign->post_type != Leyka_Campaign_Management::$post_type ) { 
						// Wrong campaign data
							echo '';
						}
						echo "<div id='".esc_attr('leyka_scale_standalone-'.uniqid())."'>".leyka_get_scale($campaign, $a)."</div>";?>
				</div>


				<h2>Пожертвование</h2>
				<?php if( !defined('WPINC') ) die;

					/**

					 * Leyka Template: Neo

					 * Description: Styled after recent te-st.ru works, more modern variant of Toggles form template

					 **/



					$active_pm = apply_filters('leyka_form_pm_order', leyka_get_pm_list(true));

					$supported_curr = leyka_get_active_currencies();

					$mode = leyka_options()->opt('donation_sum_field_type'); // fixed/flexible/mixed



					global $leyka_current_pm; /** @todo Make it a Leyka_Payment_Form class singleton */



					leyka_pf_submission_errors();?>



					<div id="leyka-payment-form" class="leyka-tpl-neo" data-template="neo">

						<!-- <?php echo __("This donation form is created by Leyka WordPress plugin, created by Teplitsa of Social Technologies. If you are interested in some way, don't hesitate to write to us: support@te-st.ru", 'leyka');?> -->



						<?php $counter = 0;



						foreach($active_pm as $i => $pm) {



							leyka_setup_current_pm($pm);

							$counter++;?>


							<div class="leyka-payment-option toggle <?php if($counter == 1) echo 'toggled';?> <?php echo esc_attr($pm->full_id);?>">

								<div class="leyka-toggle-trigger <?php echo count($active_pm) > 1 ? '' : 'toggle-inactive';?>">

									<p class="payment-method">Банковская карта</p>
									<?php //echo leyka_pf_get_pm_label();?>

								</div>

								<div class="leyka-toggle-area">

									<form class="leyka-pm-form" id="<?php echo leyka_pf_get_form_id();?>" action="<?php echo leyka_pf_get_form_action();?>" method="post">


										<div class="leyka-pm-fields">



											<?php if($leyka_current_pm->is_field_supported('amount') ) {



												$current_curr = $leyka_current_pm->get_current_currency();



												if(empty($supported_curr[$current_curr])) {

													return; // Current currency isn't supported

												}?>



												<p>Сумма пожертвования, руб.</p>
												<div class="leyka-field amount-selector amount mixed">



													<div class="currency-selector-row" >

														<div class="currency-variants">

															<?php foreach($supported_curr as $currency => $data) {



																if($mode == 'fixed' || $mode == 'mixed') {

																	$variants = explode(',', $data['amount_settings']['fixed']);

																} else {

																	$variants = array();

																}?>

																<div class="<?php echo $currency;?> amount-variants-container" <?php echo $currency == $current_curr ? '' : 'style="display:none;"';?>>

																	<div class="amount-variants-row">

																		<?php foreach($variants as $i => $amount) {?>

																			<label class="figure rdc-radio" title="<?php _e('Please, specify your donation amount', 'leyka');?>">

																				<input type="radio" value="<?php echo (int)$amount;?>" name="leyka_donation_amount" class="rdc-radio__button" <?php checked($i, 0);?> <?php echo $currency == $current_curr ? '' : 'disabled="disabled"';?> >

																				<span class="rdc-radio__label"><?php echo (int)$amount;?></span>

																			</label>

																		<?php }?>



																		<label class="figure-flex">

																			<?php if($mode == 'mixed' && $variants) {?>

																				<span class="figure-sep"><?php _e('or', 'leyka');?></span>

																			<?php }



																			if($mode != 'fixed') {?>

																				<input type="text" title="<?php _e('Specify the amount of your donation', 'leyka');?>" name="leyka_donation_amount" class="donate_amount_flex" value="<?php echo esc_attr($supported_curr[$current_curr]['amount_settings']['flexible']);?>" maxlength="6" <?php echo $currency == $current_curr ? '' : 'disabled="disabled"';?>>

																			<?php }?>

																		</label>

																	</div>

																</div>

															<?php }?>

														</div>

														<div class="currency"><span class="currency-frame"><?php echo $leyka_current_pm->get_currency_field();?></span></div>

													</div>



													<div class="leyka_donation_amount-error field-error"></div>



												</div>



											<?php }



											echo leyka_pf_get_hidden_fields(empty($campaign) ? false : $campaign->id);?>



											<input name="leyka_payment_method" value="<?php echo esc_attr($pm->full_id);?>" type="hidden">

											<input name="leyka_ga_payment_method" value="<?php echo esc_attr($pm->label);?>" type="hidden">



											<!-- name -->

											<?php if($leyka_current_pm->is_field_supported('name') ) { ?>

												<div class="rdc-textfield leyka-field name">

													<input type="text" class="required rdc-textfield__input" name="leyka_donor_name" id="leyka_donor_name" value="" placeholder="<?php _e('Your name', 'leyka');?>">

													<label for="leyka_donor_name" class="leyka-screen-reader-text rdc-textfield__label"><?php _e('Your name', 'leyka');?></label>

													<span id="leyka_donor_name-error" class="leyka_donor_name-error field-error rdc-textfield__error"></span>

												</div>



											<?php }?>



											<!-- email -->

											<?php if($leyka_current_pm->is_field_supported('email') ) { ?>

												<div class="rdc-textfield leyka-field email">

													<input type="text" value="" id="leyka_donor_email" name="leyka_donor_email" class="required email rdc-textfield__input" placeholder="<?php _e('Your email', 'leyka');?>">

													<label class="leyka-screen-reader-text rdc-textfield__label" for="leyka_donor_email"><?php _e('Your email', 'leyka');?></label>

													<span class="leyka_donor_email-error field-error rdc-textfield__error" id="leyka_donor_email-error"></span>

												</div>



											<?php }



											echo leyka_pf_get_pm_fields();



											echo leyka_pf_get_agree_field();?>



											<!-- submit -->

											<div class="leyka-field submit">

												<?php if($leyka_current_pm->is_field_supported('submit') ) { ?>

													<input type="submit" class="rdc-submit-button" id="leyka_donation_submit" name="leyka_donation_submit" value="Отправить" />

												<?php }?>

											</div>



										</div> <!-- .leyka-pm-fields -->


									</form>

								</div>

							</div>

						<?php }?>

					</div><!-- #leyka-payment-form -->
				
			</div>

		<?php endif; ?>

		<div class="module2x">
			<div class="container">
				<?php the_content(); ?>
			</div>
			<div class="likely-holder">
			<!-- likely -->
				<div class="likely">
					<div class="facebook">Поделиться</div>
					<div class="vkontakte">Поделиться</div>
					<div class="twitter">Твитнуть</div>
					<div class="telegram">Отправить</div>
				</div>
			</div>
		</div><!-- /content-inner -->

	</article>
	<?php	} //endwhile ?>

	<?php do_action('grt_content_bottom');?>

</div> <!-- /content -->

<?php get_footer(); ?>