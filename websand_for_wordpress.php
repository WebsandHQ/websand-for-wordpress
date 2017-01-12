<?php
  
  /**
  * Plugin Name: Websand for WordPress
  * Plugin URI: http://www.websandhq.com
  * Description: Websand for WordPress. Subscribe your WordPress site visitors in Websand with ease. 
  * Version: 0.1.0
  * Author: Websand
  * Author URI: http://www.websandhq.com
  */

  class websandhq_contact extends WP_Widget {
    
    // Set up the widget name and description.
    public function __construct() {
      $widget_options = array( 'classname' => 'websandhq_contact', 'description' => 'This plugin creates a widget that can be used to capture and send subscriber information to WebsandHQ' );
      parent::__construct( 'websandhq_contact', 'Websand Contact', $widget_options );
    }
    
    // Create the widget output.
    public function widget( $args, $instance ) {
      echo $args['before_widget'] . $args['before_title'] . $instance['title'] . $args['after_title']; ?>
      <form accept-charset="UTF-8" method="post" class="websand-for-wordpress-widget">
        <input type="hidden" id="wshq_subscribe_key" name="wshq_subscribe_key" value="<?php echo $instance['wshq_api_key'] ?>">
        <input type="hidden" id="wshq_source" name="wshq_source" value="<?php echo $instance['wshq_source'] ?>">
        <input type="hidden" id="wshq_domain" name="wshq_domain" value="<?php echo $instance['wshq_domain'] ?>">
        <input type="hidden" id="wshq_redirect" name="wshq_redirect" value="<?php echo $instance['wshq_redirect'] ?>">
        <div class="websand-form-group">
          <label for="subscriber_first">First name:</label>
          <input class="form-control" type="text" name="wshq_subscriber[first]" id="wshq_subscriber_first">
          <p>
            Your first name
          </p>
        </div>
        <div class="websand-form-group">
          <label for="subscriber_email">Your email address: </label>
          <input class="form-control" type="text" name="wshq_subscriber[email]" id="wshq_subscriber_email">
          <p>
            Your email address
          </p>
        </div>
        <div class="websand-form-group">
          <label><input type="checkbox" value="wshq_subscribe_confirmation">I agree to hand over my first born in return for recieving your lovely marketing messages</label>
        </div>
        <div class="websand-form-group">
          <input type="submit" name="wshq_subscribe_button" class="websand-submit button button-primary" value="Subscribe">
        </div>
      </form>
      <?php echo $args['after_widget'];

    }
    
    // Create the admin area widget settings form.
    public function form( $instance ) {
      $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
      $wshq_api_key = ! empty($instance['wshq_api_key']) ? $instance['wshq_api_key'] : '';
      $wshq_source = ! empty($instance['wshq_source']) ? $instance['wshq_source'] : '';
      $wshq_domain = ! empty($instance['wshq_domain']) ? $instance['wshq_domain'] : '';
      $wshq_redirect = ! empty($instance['wshq_redirect']) ? $instance['wshq_redirect'] : '';
      $wshq_terms = ! empty($instance['wshq_terms']) ? $instance['wshq_terms'] : '';

      ?>
      <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('wshq_api_key'); ?>">WebsandHQ API Token:</label>
        <input type="text" id="<?php echo $this->get_field_id('wshq_api_key'); ?>" name="<?php echo $this->get_field_name('wshq_api_key'); ?>" value="<?php echo esc_attr($wshq_api_key); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('wshq_source'); ?>">WebsandHQ source code:</label>
        <input type="text" id="<?php echo $this->get_field_id('wshq_source'); ?>" name="<?php echo $this->get_field_name('wshq_source'); ?>" value="<?php echo esc_attr($wshq_source); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('wshq_domain'); ?>">WebsandHQ account:</label>
        <input type="text" id="<?php echo $this->get_field_id('wshq_domain'); ?>" name="<?php echo $this->get_field_name('wshq_domain'); ?>" value="<?php echo esc_attr($wshq_domain); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('wshq_redirect'); ?>">Where should we redirect the user after a successful signup?</label>
        <input type="text" id="<?php echo $this->get_field_id('wshq_redirect'); ?>" name="<?php echo $this->get_field_name('wshq_redirect'); ?>" value="<?php echo esc_attr($wshq_redirect); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('wshq_terms'); ?>">Add the link to your Terms and Conditions page</label>
        <input type="text" id="<?php echo $this->get_field_id('wshq_terms'); ?>" name="<?php echo $this->get_field_name('wshq_terms'); ?>" value="<?php echo esc_attr($wshq_terms); ?>" />
      </p>
      <?php
    }
    
    // Apply settings to the widget instance.
    public function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      $instance[ 'wshq_api_key' ] = strip_tags( $new_instance[ 'wshq_api_key' ] );
      $instance[ 'wshq_source' ] = strip_tags( $new_instance[ 'wshq_source' ] );
      $instance[ 'wshq_domain' ] = strip_tags( $new_instance[ 'wshq_domain' ] );
      $instance[ 'wshq_redirect' ] = strip_tags( $new_instance[ 'wshq_redirect' ] );
      $instance[ 'wshq_terms' ] = strip_tags( $new_instance[ 'wshq_terms' ] );
      return $instance;
    }
  }
 
  // Pull in JS 
  function websandhq_register_scripts() {
    wp_enqueue_script(
      'websandhq_contact_js', 
      plugins_url( 'assets/js/websandhq_contact_js.js', __FILE__ ), 
      array('jquery'),
      '0.1.0',
      true
    ); 
  }
 
  add_action('wp_enqueue_scripts', 'websandhq_register_scripts');
  add_action('widgets_init', function(){ register_widget('websandhq_contact'); });

?>
