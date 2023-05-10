<?php
$deactivate_reasons = [
   'no_longer_needed' => [
      'title' => esc_html__('I no longer need the plugin', 'spacex-blocks'),
      'input' => '',
   ],
   'found_a_better' => [
      'title' => esc_html__('I found a better plugin', 'spacex-blocks'),
      'input' => esc_html__('Please share which plugin', 'spacex-blocks'),
   ],
   'couldnt_get_to_work' => [
      'title' => esc_html__('I couldn\'t get the plugin to work', 'spacex-blocks'),
      'input' => '',
   ],
   'temporary_deactivation' => [
      'title' => esc_html__('It\'s a temporary deactivation', 'spacex-blocks'),
      'input' => '',
   ],
   'has_pro' => [
      'title' => esc_html__('I have SpaceX Blocks Pro', 'spacex-blocks'),
      'input' => '',
      'alert' => esc_html__('Wait! Don\'t deactivate SpaceX Blocks. You have to activate both SpaceX Blocks and SpaceX Blocks Pro in order for the plugin to work.', 'spacex-blocks'),
   ],
   'other' => [
      'title' => esc_html__('Other', 'spacex-blocks'),
      'input' => esc_html__('Please share the reason', 'spacex-blocks'),
   ],
];

?> 
<div class="bfsb"> 
   <div class="bfsb-overlay bfsb-feedback-modal" style="display: none">
      <div class="bfsb-modal-content"> 
         <div class="bfsb-modal-header bfsb-gradient">
               <span class="bfsb-close">
                  <svg
                     width="25"
                     height="25"
                     viewBox="0 0 16 16"
                     fill="none" 
                  >
                     <path
                        d="M12.5 3.5L3.5 12.5"
                        stroke="#718096"
                        strokeLinecap="round"
                        strokeLinejoin="round"
                     />
                     <path
                        d="M12.5 12.5L3.5 3.5"
                        stroke="#718096"
                        strokeLinecap="round"
                        strokeLinejoin="round"
                     />
                  </svg>
               </span>
               <h2 class="bfsb-modal-title"><?php echo esc_html__('Quick Feedback', 'elementor'); ?></h2>
               <p><?php echo esc_html__('If you have a moment, please share why you are deactivating SpaceX Blocks', 'spacex-blocks'); ?></p>
         </div>

         <form>
            <div class="bfsb-content">
               <div class="bfsb-form-style-one"> 
                  <?php wp_nonce_field('_bfsb_deactivate_nonce'); ?>
                  <div class="row"> 
                     <?php foreach ($deactivate_reasons as $reason_key => $reason) : ?>
                        <div class="col-12">
                           <div class="bfsb-field-radio">
                              <input 
                                 type="radio" 
                                 id="bfsb-deactivate-<?php echo esc_attr($reason_key); ?>" 
                                 class="bfsb-deactivate-reason" 
                                 name="reason_key" 
                                 value="<?php echo esc_attr($reason_key); ?>" 
                              />
                              <label for="bfsb-deactivate-<?php echo esc_attr($reason_key); ?>"><?php echo esc_html($reason['title']); ?></label> 
                           </div>

                           <?php if (! empty($reason['input'])) : ?>
                              <div class="bfsb-feedback-text" style="display: none" >
                                 <input 
                                    type="text"  
                                    name="reason_<?php echo esc_attr($reason_key); ?>" 
                                    placeholder="<?php echo esc_attr($reason['input']); ?>" 
                                 />
                              </div>
                           <?php endif; ?>

                           <?php if (! empty($reason['alert'])) : ?>
                              <div class="bfsb-feedback-alert" style="display: none; color: #ff0000"><?php echo esc_html($reason['alert']); ?></div>
                           <?php endif; ?>
                        </div> 
                     <?php endforeach; ?> 

                     <div class="bfsb-data-alert" style="display: none; margin-top: 10px">
                        <div class="col-12">
                           <div class="bfsb-field-radio">
                              <input 
                                 type="checkbox" 
                                 id="bfsb-data-collect"
                                 name="data_collect"
                                 value='1'
                                 style="zoom: 1"
                                 checked
                              />
                              <label for="bfsb-data-collect" style="font-size: 11px">Share your Name and Email for communication purposes</label> 
                           </div>
                        </div>
                     </div>
                  </div> 
               </div>
            </div>

            <div class="bfsb-modal-footer bfsb-mt-25">
               <div class="row">
                  <div class="col">
                     <button class="bfsb-feedback-skip bfsb-btn bfsb-text-hover-blue"><?php _e('Skip & Deactivate', 'spacex-blocks'); ?></button>
                  </div>
                  <div class="col">
                     <button class="bfsb-feedback-submit bfsb-btn bfsb-bg-blue bfsb-bg-hover-blue bfsb-btn-big bfsb-float-right bfsb-color-white">
                        <?php _e('Submit & Deactivate', 'spacex-blocks'); ?>
                     </button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div> 
<?php 