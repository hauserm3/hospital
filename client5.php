<?php
    include 'api/settings.php';
    if(isset($_GET['room_id'])) $get_room_path = $get_room_path.'?room_id='.$_GET['room_id'];
    elseif (isset($_GET['room_ip'])) $get_room_path = $get_room_path.'?room_ip='.$_GET['room_ip'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hospital Client</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="libs/bootstrap.min.css">
      <link rel="stylesheet" href="libs/font-awesome.css">
      <link rel="stylesheet" href="styles.css">
      <script src="libs/jquery-3.1.0.min.js"></script>
      <style>
          .panel{
              margin-bottom: 10px;
          }
          .panel-body{
              padding-top: 5px;
              padding-bottom: 7px;
          }
          .h4, .h5, .h6, h4, h5, h6 {
              margin-top: 5px;
              margin-bottom: 5px;
          }
      </style>
  </head>

  <body>
            <div id="content">
                  <div class="row">
                      <div class="col-md-8">
                          <div id="logo" class="row text-center transition-scale">
                              <img src="app/img/logo.png">
                          </div>
                          <div id="logoText" class="row text-center transition-scale">
                              <h3><strong>Personal Protective Equipment (PPE) available in</strong></h3>
                              <h3><strong>the cabinet outside the patient/client room.</strong></h3>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div id="RoutinePractices" class="panel panel-primary psh transition-scale">
                                      <div class="panel-heading text-center">ROUTINE PRACTICES</div>
                                      <div class="panel-body vcenter">
                                          <div class="row-fluid img_178">
                                              <div class="col-md-12 text-center">
                                                  <div class="segmenter"></div>
                                                  <img id="RP_image" src="">
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div id="CautionAttention" class="panel panel-info psh transition-scale">
                                      <div class="panel-heading text-center">CAUTION</div>
                                      <div class="panel-body">

                                          <div id="CAUTION_SINGLE" class="row-fluid img_178">
                                              <div class="col-md-12 text-center">
                                                  <img id="CA_image" src="">
                                              </div>
                                          </div>
                                          <div id="CAUTION_ARR" class="row-fluid img_158">
                                              <div class="col-md-6 text-center">
                                                  <img id="CA_image_0" src="">
                                              </div>
                                              <div class="col-md-6 text-center">
                                                  <img id="CA_image_1" src="">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div id="ContactPrecautions" class="panel panel-danger psh transition-scale">
                                      <div class="panel-heading text-center">CONTACT PRECAUTIONS</div>
                                      <div class="panel-body text-center">
                                          <h5><strong>In addition to routine practices apply the following PPE before entering the room.</strong></h5>
                                          <fieldset class="scheduler-border text-center">
                                              <legend class="scheduler-border danger"><strong>WARNING BEFORE YOU ENTER</strong></legend>
                                              <h5><strong>Visitors please consult nursing</strong></h5>
                                              <h5><strong>staff before entering.</strong></h5>
                                          </fieldset>
                                          <br>
                                          <div id="ContactPrecautions_4" class="row text-center img_158">
                                              <div class="col-md-6">
                                                  <img id="CP_image_0" src="">
                                              </div>
                                              <div class="col-md-6">
                                                  <img id="CP_image_1" src="">
                                              </div>
                                              <div class="col-md-6">
                                                  <img id="CP_image_2" src="">
                                              </div>
                                              <div class="col-md-6">
                                                  <img id="CP_image_3" src="">
                                              </div>
                                              <div class="col-md-6">
                                                  <img id="CP_image_4" src="">
                                              </div>
                                          </div>
                                          <div id="ContactPrecautions_5" class="row text-center img_100">
                                              <br>
                                              <div class="col-md-4">
                                                  <img id="CP_5_image_0" src="">
                                              </div>
                                              <div class="col-md-4">
                                                  <img id="CP_5_image_1" src="">
                                              </div>
                                              <div class="col-md-4">
                                                  <img id="CP_5_image_2" src="">
                                              </div>
                                              <div class="col-md-6 img_158">
                                                  <img id="CP_5_image_3" src="">
                                              </div>
                                              <div class="col-md-6 img_158">
                                                  <img id="CP_5_image_4" src="">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div id="ContactPrecautions_000" class="panel panel-default text-center psh transition-scale">
                                      <img id="CP_image_000" src="">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div id="HazardousMedications" class="panel panel-success psh transition-scale">
                              <div class="panel-heading text-center">HAZARDOUS PRECAUTIONS</div>
                              <div class="panel-body text-center">
                                  <h5><strong>Apply the following PPE only if you will handle Hazardous Medications or are at risk of handling body fluids.</strong></h5>

                                  <fieldset class="scheduler-border text-center">
                                      <legend class="scheduler-border success"><strong>WARNING BEFORE YOU ENTER</strong></legend>
                                      <h5><strong>If you are pregnant please speak</strong></h5>
                                      <h5><strong>with nursing staff before entering.</strong></h5>
                                  </fieldset>

                                  <div class="row text-center img_150">
                                      <div class="col-md-6">
                                          <img id="HM_image_0" src="">
                                      </div>
                                      <div class="col-md-6">
                                          <img id="HM_image_1" src="">
                                      </div>
                                      <div class="col-md-6">
                                          <img id="HM_image_2" src="">
                                      </div>
                                      <div class="col-md-6">
                                          <img id="HM_image_3" src="">
                                      </div>
                                      <div class="col-md-6">
                                          <img id="HM_image_4" src="">
                                      </div>
                                      <div class="col-md-6">
                                          <img id="HM_image_5" src="">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div id="HazardousMedications_000" class="panel panel-default text-center psh transition-scale">
                              <img id="HM_image_000" src="">
                          </div>
                      </div>
                  </div>
            </div>
          <footer>
              <strong id="textDate">Last updated:  </strong><strong id="Date"></strong>
          </footer>

      <script>


          //TODO take jquery view references in separate classes View.  MVC structure:  controller go trough model and calling view functions


          $(document).ready(function () {
              var $url = '<?php echo $get_room_path;?>';                // url = 'api/get-room-5.php';
              var $icons_folder = '<?php echo $icons_folder;?>' + '/';  // icons_folder = 'app/icons'
              var isOnline,
                  isStarted;
              var isRoutinePractices,
                  isCautionAttention,
                  isCautionAttention_Single,
                  isCautionAttention_Double,
                  isContactPrecautions,
                  isContactPrecautions_4,
                  isContactPrecautions_5,
                  isContactPrecautions_000,
                  isHazardousMedications,
                  isHazardousMedications_000,
                  dateModel;

              var show_redBorder = function () {
                  $('#content').addClass('network-offline');
                  $('footer').addClass('network-offline');
              };

              var hide_redBorder = function () {
                  $('#content').removeClass('network-offline');
                  $('footer').removeClass('network-offline');
              };

              var img_178_view = function () {
                  $('#CAUTION_ARR').removeClass( 'img_158' ).addClass( 'img_178' );
                  $('#ContactPrecautions_4').removeClass( 'img_158' ).addClass( 'img_178' );
                  $('#ContactPrecautions_5').removeClass( 'img_100' ).addClass( 'img_178' );
                  $('#HazardousMedications').removeClass( 'img_150' ).addClass( 'img_178' );
              };

              var RoutinePractices_view = function (model) {
                  if(isRoutinePractices) return;
                  isRoutinePractices = true;
                  console.log('RoutinePractices_view');
                  $('#RP_image').attr('src',$icons_folder+model.RoutinePractices);
                  $('#RoutinePractices').show();
              };

              var show_CautionAttention_view = function () {
                  if(isCautionAttention) return;
                  isCautionAttention = true;
                  console.log('show_CautionAttention_view');
                  $('#CautionAttention').show();
              };

              var hide_CautionAttention_view = function () {
                  if(!isCautionAttention) return;
                  isCautionAttention = false;
                  isCautionAttention_Single = false;
                  isCautionAttention_Double = false;
                  console.log('hide_CautionAttention_view');
                  $('#CautionAttention').hide();
              };

              var CautionAttention_Single_view = function (model) {
                  if(isCautionAttention_Single) return;
                  isCautionAttention_Single = true;
                  console.log('CautionAttention_Single_view');
                  $('#CAUTION_ARR').hide();
                  $('#CAUTION_SINGLE').show();
                  $('#CA_image').attr('src',$icons_folder+model.CautionAttention);
              };

              var CautionAttention_Double_view = function (model) {
                  if(isCautionAttention_Double) return;
                  isCautionAttention_Double = true;
                  console.log('CautionAttention_Double_view');
                  $('#CAUTION_SINGLE').hide();
                  $('#CAUTION_ARR').show();
                  model.CautionAttention.forEach(function (item,i) {
                      $('#CA_image_'+i).attr('src',$icons_folder+item);
                  });
              };

              var ContactPrecautions_view = function () {
                  if(isContactPrecautions) return;
                  isContactPrecautions = true;
                  isContactPrecautions_000 = false;
                  console.log('ContactPrecautions_view');
                  $('#ContactPrecautions_000').hide();
                  $('#ContactPrecautions').show();
              };
              var ContactPrecautions_000_view = function () {
                  if(isContactPrecautions_000) return;
                  isContactPrecautions_000 = true;
                  isContactPrecautions = false;
                  console.log('ContactPrecautions_000_view');
                  $('#ContactPrecautions').hide();
                  $('#ContactPrecautions_000').show();
                  $('#CP_image_000').attr('src',$icons_folder+'IC_000.png');
              };

              var ContactPrecautions_5_view = function (model) {
                  if(isContactPrecautions_5) return;
                  isContactPrecautions_5 = true;
                  isContactPrecautions_4 = false;
                  console.log('ContactPrecautions_5_view');
                  $("#ContactPrecautions_4").hide();
                  $('#ContactPrecautions_5').show();
                  model.ContactPrecautions.forEach(function (item,i) {
                      $('#CP_5_image_'+i).attr('src',$icons_folder+item);
                  });
              };

              var ContactPrecautions_4_view = function (model) {
                  if(isContactPrecautions_4) return;
                  isContactPrecautions_4 = true;
                  isContactPrecautions_5 = false;
                  console.log('ContactPrecautions_4_view');
                  $("#ContactPrecautions_5").hide();
                  $('#ContactPrecautions_4').show();
                  model.ContactPrecautions.forEach(function (item,i) {
                      $('#CP_image_'+i).attr('src',$icons_folder+item);
                  });
              };

              var HazardousMedications_view = function (model) {
                  if(isHazardousMedications) return;
                  isHazardousMedications = true;
                  isHazardousMedications_000 = false;
                  console.log('HazardousMedications_view');
                  $('#HazardousMedications_000').hide();
                  $('#HazardousMedications').show();
                  model.HazardousMedications.forEach(function (item,i) {
                      $('#HM_image_'+i).attr('src',$icons_folder+item);
                  });
              };

              var HazardousMedications_000_view = function (model) {
                  if(isHazardousMedications_000) return;
                  isHazardousMedications_000 = true;
                  isHazardousMedications = false;
                  console.log('HazardousMedications_000_view');
                  $('#HazardousMedications').hide();
                  $('#HazardousMedications_000').show();
                  $('#HM_image_000').attr('src',$icons_folder+'HM_000.png');
              };

              var showDate_view = function (model) {
                  if(dateModel !== model.Date){
                      dateModel = model.Date;
                      $('#Date').text(model.Date);
                  }
              };

              var putOffline = function () {
                  if(!isOnline) return;
                  isOnline = false;
                  show_redBorder();
                  console.log('isOffline');
              };

              var putOnline = function () {
                  if(isOnline) return;
                  isOnline = true;
                  hide_redBorder();
                  console.log('isOnline');
              };

              var reportError = function (error) {
                  $.post("api/error-report.php",error);
              };

              var showError = function (error) {
                  allert(error.screenMessage);
              };

              // controller
              if(window.matchMedia('(min-width: 1281px)').matches){
                  ///View
                  img_178_view();
              }

              // controller
              var transform = function (idBlock) {
                  setTimeout(function() {
                      // view
                      $(idBlock).addClass('transition-scale-activated');
                  }, 1000);
              };

              var startApp = function () {
                  if(isStarted) return;
                  isStarted = true;
                  transform('#logo');
                  transform('#logoText');
                  transform('#RoutinePractices');
                  if(isCautionAttention) transform('#CautionAttention');
                  if(isContactPrecautions) transform('#ContactPrecautions');
                  if(isContactPrecautions_000) transform('#ContactPrecautions_000');
                  if(isHazardousMedications) transform('#HazardousMedications');
                  if(isHazardousMedications_000) transform('#HazardousMedications_000');
              };

              var getData = function () {
                  $.getJSON($url).done(function (res) {
                      // controller
                      putOnline();

                      if(res.result){model = res.result} //TODO if no result property  send error to server
                      else{ //3
                          console.error('no result model!');
                          putOffline();
                          var error = {
                              id: 300,
                              message: "no property result",
                              screenMessage: "SOME MESSAGE",
                              body: JSON.stringify(res)
                          };
                          reportError(error);
                          showError(error);
                          return;
                      }
                      console.log('model', model);

                      showDate_view(model);
                      if(model.RoutinePractices) {
                          //view
                          RoutinePractices_view(model);
                      } else { //4
                          isRoutinePractices = false;
                          showError({
                              id:700,
                              screenMessage: "NO RoutinePractices"
                          })
                      }
                      // controller
                      if(model.CautionAttention) {
                          show_CautionAttention_view();
                          if(model.CautionAttention.length == 1){
                              ///view
                              CautionAttention_Single_view(model);
                          } else {
                              CautionAttention_Double_view(model);
                          }
                      } else {
                          hide_CautionAttention_view();
                      }
                      // controller
                      if(model.ContactPrecautions && model.ContactPrecautions[0] != 'IC_000.png') {
                          // view
                          ContactPrecautions_view();
                          // controller
                          if(model.ContactPrecautions.length == 5){
                              // view
                              ContactPrecautions_5_view(model);
                          } else {
                              ContactPrecautions_4_view(model);
                          }
                          //controller
                      } else {
                          //view
                          ContactPrecautions_000_view();
                      }
                      // controller
                      if(model.HazardousMedications && model.HazardousMedications[0] != 'HM_000.png'){
                          HazardousMedications_view(model);
                      } else {
                          HazardousMedications_000_view(model);
                      }
                      startApp();
                  }).fail(function (jqxhr, textStatus, error) { //2
                      console.error('error: ', error);
//                      console.log('jqxhr: ', jqxhr);
                      putOffline();
//                      window.location.reload();
                  })
              };

              getData();
              setInterval(function(){getData()},10000);
          });
      </script>
  </body>
</html>