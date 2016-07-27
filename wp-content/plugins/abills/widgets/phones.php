<?php
######################################
#
# Widget for provider phones
#
######################################

class Phones_Widget extends WP_Widget {

  public function __construct() {

    parent::__construct(
      'phones_widget',
      __('Phones Widget', 'abillstextdomain'),
      array(
        'classname' => 'phones_widget',
        'description' => __('Widget for input provider\'s phones', 'abillstextdomain')
      )
    );

    load_plugin_textdomain('abillstextdomain', false, basename(dirname(__FILE__)) . '/languages');

  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget($args, $instance) {

    extract($args);

    $phone_one = $instance['phone_one'];
    $phone_two = $instance['phone_two'];

    $before_widget;
    $after_widget;

    echo "<div class='col-md-4 col-xs-12 phones_widget_wrapper'>" . $before_widget . "<div class='header-phones'><a href='#' class='btn btn-info btn-flat'>";
    if ($phone_one) {
      echo "<h5><span class='glyphicon glyphicon-earphone'></span>" . $phone_one . "</h5>";
    }

    if ($phone_two) {
      echo "<h5><span class='glyphicon glyphicon-earphone'></span>" . $phone_two . "</h5>";
    }

    echo "</a></div>" . $after_widget . "</div>";

  }


  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update($new_instance, $old_instance) {

    $instance = $old_instance;

    $instance['phone_one'] = $new_instance['phone_one'];
    $instance['phone_two'] = $new_instance['phone_two'];

    return $instance;

  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form($instance) {

    $phone_one = isset($instance['phone_one']) ? esc_attr($instance['phone_one']) : '';
    $phone_two = isset($instance['phone_two']) ? esc_attr($instance['phone_two']) : '';

    ?>

    <p>
      <label for="<?php echo $this->get_field_id('phone_one'); ?>"><?php _e('Телефон:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('phone_one'); ?>"
             name="<?php echo $this->get_field_name('phone_one'); ?>" type="text"
             value="<?php echo $phone_one; ?>"/>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('phone_two'); ?>"><?php _e('Телефон:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('phone_two'); ?>"
             name="<?php echo $this->get_field_name('phone_two'); ?>" type="text"
             value="<?php echo $phone_two; ?>"/>
    </p>


    <?php
  }

}
