<?php
/**
 * Template for displaying single post (read full post page).
 *
 * @package bootstrap-basic
 */

get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?>

<div class="col-md-6 col-md-offset-3 content-area text-center" id="main-column">
  <main id="main" class="site-main" role="main">

    <?php

     $street = $_POST['STREET'];
     $build  = $_POST['BUILD'];
     $date   = $_POST['DATE'];
     $time   = $_POST['TIME'];

     print "$street, $build, $date $time";
    ?>

    <div class='panel panel-primary form-horizontal'>
      <div class='panel-heading'>Зявка на регистрацию</div>
      <div class='panel-body'>
        <div class='form-group'>
          <label class='col-md-3 control-label'>ФИО</label>
          <div class='col-md-9'>
            <input type='text' name='FIO' class='form-control'>
          </div>
        </div>
        <div class='form-group'>
          <label class='col-md-3 control-label'>Телефон</label>
          <div class='col-md-9'>
            <input type='text' name='PHONE' class='form-control'>
          </div>
        </div>
        <div class='form-group'>
          <label class='col-md-3 control-label'>Адрес</label>
          <div class='col-md-9'>
            <input type='text' name='ADDRESS' value='<?php  print "$street, $build" ?>' class='form-control'>
          </div>
        </div>
        <div class='form-group'>
          <label class='col-md-3 control-label'>Ожидаемая дата и время</label>
          <div class='col-md-9'>
            <input type='text' name='DATE' value='<?php  print "$date $time" ?>' class='form-control'>
          </div>
        </div>
      </div>
      <div class='panel-footer'>

      </div>
    </div>
  </main>
</div>

<?php get_footer(); ?>
