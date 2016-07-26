<?php
######################################
#
# Widget for showing client info in portal
#
######################################

class Abills_stats_widget extends WP_Widget {

  public function __construct() {

    parent::__construct(
      'abills_stats_widget',
      __('ABillS Stats', 'abillstextdomain'),
      array(
        'classname' => 'Abills_stats_widget',
        'description' => __('Shows user info', 'abillstextdomain')
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

    $billing_url = $instance['billing_url'];

    $sid_cookie = '';
    if (isset($_COOKIE['sid'])) {
      $sid_cookie = $_COOKIE['sid'];
    }

    $content = '';

    $abills_stats = <<<ABILLS_STATS
<div class='abills-stats-wrapper'>
<center><i class='fa fa-spinner fa-spin fa-3x'></i></center>
</div>
ABILLS_STATS;

    if (!empty($sid_cookie)) {
      $content = $abills_stats;
      $visible_form = 'hidden';
      wp_enqueue_script('jquery-cookies', '/wp-content/plugins/abills/js/vendor/jquery.cookie.js');
      wp_enqueue_script('abills-language', '/wp-content/plugins/abills/js/abills_stats/language.js');
      wp_enqueue_script('abills-xml_explain', '/wp-content/plugins/abills/js/abills_stats/xml_explain.js');
      wp_enqueue_script('abills-stats-main', '/wp-content/plugins/abills/js/abills_stats/main.js');
    } else {
//      show login form
      $visible_form = '';
    }

    global $before_widget;
    global $after_widget;

    #echo $before_widget;


    ?>
    <div class="panel panel-default">
      <script>
        var abills_params = {
          uri: '<?php echo $billing_url ?>',
          sid: '<?php echo $sid_cookie ?>'
        };
      </script>
      <div class="panel-heading text-center">
        <!--       TODO: localize-->
        Личный кабинет
      </div>
      <div class="panel-body col-xs-10 col-xs-offset-1 col-md-10 col-md-offset-1">
        <form class='form form-horizontal <?php echo $visible_form ?>' action="<?php echo $billing_url ?>" method="post"
              id="abills_stats_login_form">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
              <input type="text" class="form-control" name="user"/>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
              <input type="password" class="form-control" name="passwd"/>
            </div>
          </div>
        </form>
      </div>
      <?php echo $content ?>
      <div class="panel-footer">
        <button type="submit" form="abills_stats_login_form" class="btn btn-success form-control">Войти</button>
      </div>


    </div>
    <?php
    #echo $after_widget;
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

    $instance['billing_url'] = $new_instance['billing_url'];


    return $instance;
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   * @return string|void
   */
  public function form($instance) {

    $billing_url = isset($instance['billing_url']) ? esc_attr($instance['billing_url']) : '';

    ?>

    <p>
      <label for="<?php echo $this->get_field_id('billing_url'); ?>"><?php _e('ABillS Client Portal URL'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('billing_url'); ?>"
             name="<?php echo $this->get_field_name('billing_url'); ?>" type="text"
             value="<?php echo $billing_url; ?>"/>
    </p>

    <?php
  }

}
