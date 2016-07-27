<?php
######################################
#
# Widget for button with links
#
######################################
class Link_button_widget extends WP_Widget {

  public function __construct() {

    parent::__construct(
      'link_button_widget',
      __('Abills button widget', 'abillstextdomain'),
      array(
        'classname' => 'Abills_button_widget',
        'description' => __('Widget for user cabinet button', 'abillstextdomain')
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
    global $before_widget;
    global $after_widget;

    extract($args);

    $link = isset($instance['link']) ? esc_attr($instance['link']) : '';
    $icon = isset($instance['icon']) ? esc_attr($instance['icon']) : '';
    $color = isset($instance['color']) ? esc_attr($instance['color']) : '';
    $icon_text = '';
    $btn_tooltip = isset($instance['btn_name']) ? esc_attr($instance['btn_name']) : '';
//    if (!empty($btn_tooltip)) {
//      $btn_tooltip = "<div class=text-center>" . $btn_tooltip . "</div>";
//    }

    $col_md_size = '2';
    $col_xs_size = '3';

    if (!empty($icon)) {
      $icon_text = "<span class='$icon' aria-hidden='true'></span>";
    }

    if ($link) {
      echo "<div class='col-md-$col_md_size col-xs-$col_xs_size'>";
      echo $before_widget;

//      $before_button = "<div class='header-button '>";

//            $button = "<a href='$link' class='btn btn-$color btn-flat' target='_blank' data-toggle='popover' data-content='' data-html=true data-trigger='hover' data-placement='bottom'> </a>";
      $button = <<<BUTTON
<a href='$link' target="_blank" class="btn btn-$color btn-flat">
  <div class="header-button">
    <div class="header-button-title">
      <span class="$icon"></span>
    </div>
    <div class="header-button-text">
      <span>$btn_tooltip</span>
    </div>
  </div>
</a>
BUTTON;

//      $after_button = "</div>";

//      echo $before_button . $button . $after_button;
      echo $button;

      echo $after_widget;
      echo "</div>";
    }

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

    $instance['link'] = $new_instance['link'];
    $instance['btn_name'] = $new_instance['btn_name'];
    $instance['icon'] = $new_instance['icon'];
    $instance['color'] = $new_instance['color'];

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

    $link = isset($instance['link']) ? esc_attr($instance['link']) : '';
    $icon = isset($instance['icon']) ? esc_attr($instance['icon']) : '';
    $color = isset($instance['color']) ? esc_attr($instance['color']) : '';
    $text = isset($instance['btn_name']) ? esc_attr($instance['btn_name']) : '';


    ?>

    <p>
      <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('URL:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>"
             name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>"/>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Icon'); ?></label>
      <br/>
      <input class="widefat" id="<?php echo $this->get_field_id('icon'); ?>"
             name="<?php echo $this->get_field_name('icon'); ?>" type="text"
             value="<?php echo $icon; ?>"/>
    </p>


    <p>
      <label for="<?php echo $this->get_field_id('btn_name'); ?>"><?php _e('Text:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('btn_name'); ?>"
             name="<?php echo $this->get_field_name('btn_name'); ?>" type="text" value="<?php echo $text; ?>"/>
    </p>


    <p>
      <label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Color:'); ?></label>


      <select class='widefat' name="<?php echo $this->get_field_name('color'); ?>"
              id="<?php echo $this->get_field_id('color'); ?>">
        <option <?php echo ($color == 'default') ? 'selected' : ''; ?> value="default">default</option>
        <option <?php echo ($color == 'info') ? 'selected' : ''; ?> value="info">info</option>
        <option <?php echo ($color == 'success') ? 'selected' : ''; ?> value="success">success</option>
        <option <?php echo ($color == 'primary') ? 'selected' : ''; ?> value="primary">primary</option>
        <option <?php echo ($color == 'danger') ? 'selected' : ''; ?> value="danger">danger</option>
        <option <?php echo ($color == 'warning') ? 'selected' : ''; ?> value="warning">warning</option>
      </select>
    </p>

    <?php
  }

}
