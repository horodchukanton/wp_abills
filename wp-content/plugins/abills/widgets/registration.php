<?php
######################################
#
# Widget for button with links
#
######################################
class Abills_registration_widget extends WP_Widget
{
  public function __construct()
    {

        parent::__construct(
            'abills_registration_widget',
            __('Abills registration widget', 'abillstextdomain'),
            array(
                'classname' => 'Abills_registration_widget',
                'description' => __('Widget for registration', 'abillstextdomain')
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
    public function widget($args, $instance)
    {
      global $before_widget;
      global $after_widget;

      extract($args);
      echo $before_widget;
      echo "<form method='POST' action='/registration'>
      <div class='panel panel-info'>
            <div class='panel-heading text-center'>Заявка на подключение</div>
            <div class='panel-body'>
              <div class='form-group'>
                <label class='col-md-12 '>Улица</label>
                <input type='text' class='form-control' name='STREET' placeholder='Пушкина' required>
              </div>
              <div class='form-group'>
                <label class='col-md-12 '>Дом/квартира</label>
                <input type='text' class='form-control' name='BUILD' placeholder='18/2' required>
              </div>
              <div class='form-group'>
                <label class='col-md-12' data-toggle='popover' data-content='Удобная Вам дата для проведения работ' data-trigger='hover' data-placement='top'>Дата</label>
                <input type='date' class='form-control' name='DATE' required>
              </div>
              <div class='form-group'>
                <label class='col-md-12' data-toggle='popover' data-content='Удобное Вам время для проведения работ' data-trigger='hover' data-placement='top'>Время</label>
                <input type='time' class='form-control' name='TIME' required>
              </div>
            </div>
            <div class='panel-footer '>
            <input type='submit' class='btn btn-primary form-control' value='Создать заявку'>
            </div>
            </div>
            </form>
      ";
      echo $after_widget;
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
    public function update($new_instance, $old_instance)
    {
      $instance = $old_instance;

      return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {

    }

}

?>