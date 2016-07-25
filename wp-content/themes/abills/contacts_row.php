<div id="abills-contacts_row" style="display: none">
  <div class="col-md-3" style="display: <?php echo abills_get_custom_option('abills_has_coa') ? 'block' : 'none' ?>">
    <div class="panel panel-info">
      <div class="panel-heading panel-info-card">
        <div class="row">
          <div class="col-xs-12">
            <!--                    TODO : localize-->
            <div class="col-xs-12">
              <div class="pull-left"><i class="fa fa-calendar fa-4x"></i></div>
              <div class="pull-right">График работы ЦОА</div>
            </div>
          </div>
          <div class="col-xs-12 text-right">
            <div class="row summary">
              <div class='col-md-6 col-xs-6'><?php echo abills_get_custom_option(ABILLS_COA_WORK_DAYS) ?></div>
              <div class='col-md-6 col-xs-6'><?php echo abills_get_custom_option(ABILLS_COA_WORK_HOURS) ?></div>
            </div>
            <div class="row summary">
              <div class='col-md-6 col-xs-6'><?php echo abills_get_custom_option(ABILLS_COA_HOLIDAY_DAYS) ?></div>
              <div class='col-md-6 col-xs-6'><?php echo abills_get_custom_option(ABILLS_COA_HOLIDAY_HOURS) ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3" style="display: <?php echo abills_get_custom_option('abills_has_coa') ? 'block' : 'none' ?>">
    <div class="panel panel-info">
      <div class="panel-heading panel-info-card">
        <!--                    TODO : localize-->
        <div class="col-xs-12">
          <div class="pull-left"><i class="fa fa-map fa-4x"></i></div>
          <div class="pull-right">Адрес ЦОА</div>
        </div>
        <div class="col-xs-12 text-right">
          <div class="summary">
            <?php echo abills_get_custom_option(ABILLS_COA_ADDRESS) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6" style="display: <?php echo abills_get_custom_option('abills_has_coa') ? 'none' : 'block' ?>"></div>
  <div class="col-md-3">
    <div class="panel panel-success">
      <div class="panel-heading panel-info-card">
        <div class="row">
          <div class="col-xs-12">
            <i class="glyphicon glyphicon-envelope fa-4x"></i>
          </div>
          <div class="col-xs-12 text-right">
            <div class="summary">
              <a href='mailto:<?php echo abills_get_custom_option('abills_provider_mail') ?>'><?php echo abills_get_custom_option('abills_provider_mail') ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="panel panel-info">
      <div class="panel-heading panel-info-card">
        <div class="row" id="request_call_wrapper">
          <form class='form form-horizontal' id='request_call_form'>
            <input type='hidden' name='billing_url' value='<?php echo abills_get_custom_option('abills_billing_url') ?>'>
            <div class="form-group">
              <div class="col-md-10 col-md-offset-1 col-xs-8 col-xs-offset-2">
                <div class="input-group">
                  <span class="input-group-addon">+38</span>
                  <input class="form-control" type="number" required="required" min="0100000000" max="0999999999"
                         name="phone" id="phone">
                </div>
              </div>
            </div>
            <div class="row text-center">
              <input class="btn btn-flat btn-success" type="submit" id="request_call_btn" value="Заказать звонок">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>