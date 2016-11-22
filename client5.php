<?php
//$url = 'server/get-room-4.php';
//$room_json = isset($_GET['room_id']) ? file_get_contents($url.'?room_id='.$_GET['room_id']) :
//             isset($_GET['room_ip']) ? file_get_contents($url.'?room_ip='.$_GET['room_ip']) :
//             file_get_contents($url);
$url = 'server/get-room-5.php';
if(isset($_GET['room_id'])) $url = $url.'?room_id='.$_GET['room_id'];
elseif (isset($_GET['room_ip'])) $url = $url.'?room_ip='.$_GET['room_ip'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hospital Client</title>
<!--      <base href="/room/">-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="libs/bootstrap.min.css">
      <link rel="stylesheet" href="libs/font-awesome.css">
      <link rel="stylesheet" href="styles.css">

    <!-- Polyfill(s) for older browsers -->
      <script src="libs/jquery-3.1.0.min.js"></script>
    <script src="node_modules/core-js/client/shim.min.js"></script>

    <script src="node_modules/zone.js/dist/zone.js"></script>
    <script src="node_modules/reflect-metadata/Reflect.js"></script>
    <script src="node_modules/systemjs/dist/system.src.js"></script>

    <script src="systemjs.config3.js"></script>
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

  <body background="app/img/background.png">
<!--      <div class="panel panel-default">-->
<!--          <div class="panel-heading">  </div>-->
<!--          <div class="panel-body">-->
<!--              <div class="container-fluid">-->
                  <div class="row">
                      <div class="col-md-8">
                          <div class="row">
                              <br>
                              <br>
                              <br>
                                <!-- LOGO-->
                          </div>
                          <div class="row text-center">
<!--                              <h4>Personal Protective Equipment (PPE) available in</h4>-->
<!--                              <h4>the cabinet outside the patient/client room.</h4>-->
                              <br><br><br><br>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div id="RoutinePractices" class="panel panel-primary psh">
                                      <div class="panel-heading text-center">ROUTINE PRACTICES</div>
                                      <div class="panel-body">
                                          <br>
                                          <div class="row-fluid img_178">
                                              <div class="col-md-12 text-center">
                                                  <img id="RP_image" src="">
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div id="CautionAttention" class="panel panel-info psh">
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
                                  <div id="ContactPrecautions" class="panel panel-danger psh">
                                      <div class="panel-heading text-center">CONTACT PRECAUTIONS</div>
                                      <div class="panel-body">
        <!--                                  <div class="row">-->
                                            <h5><strong>In addition to routine practices apply the following PPE before entering the room.</strong></h5>
        <!--                                  </div>-->
        <!--                                  <div class="row">-->
                                          <fieldset class="scheduler-border text-center">
                                              <legend class="scheduler-border danger"><strong>WARNING BEFORE YOU ENTER</strong></legend>
                                              <h5><strong>Visitors please consult nursing</strong></h5>
                                              <h5><strong>staff before entering.</strong></h5>
                                          </fieldset>

        <!--                                  </div>-->

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
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div id="HazardousMedications" class="panel panel-success">
                              <div class="panel-heading text-center">HAZARDOUS PRECAUTIONS</div>
                              <div class="panel-body">
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
                      </div>
                  </div>
<!--                  <div class="row text-right"><strong class="text-danger">Last updated:</strong><strong id="Date"></strong></div>-->
<!--              </div>-->
<!--          </div>-->
<!--          <div class="panel-footer text-right"></div>-->
          <footer>
              <strong class="text-danger">Last updated: </strong><strong id="Date"></strong>
          </footer>
<!--      </div>-->


      <script>
          $(document).ready(function () {
//              url = 'server/get-room-5.php';
              var $url = '<?php echo $url;?>';
              console.log('$url', '<?php echo $url;?>');
              var currentModel;

//              if(model.CA_label_en == currentModel.CA_label_en) $('#CA_label_en').text(model.CA_label_en);

              var getData = function () {
                  $.getJSON($url).done(function (model) {
                      console.log('model', model);
//                      console.log('currentModel', currentModel);
                      $('#Date').text(model.Date);
                      if(model.RoutinePractices) {
                          $('#RP_image').attr('src','app/icons/'+model.RoutinePractices);
                          $('#RP_label_en').text(model.RP_label_en);
                          $('#RP_label_fr').text(model.RP_label_fr);
                      }
                      if(model.CautionAttention) {
//                          $('#CA_image').attr('src','app/icons/'+model.CautionAttention);
                          if(model.CautionAttention.length == 1){
                              console.log('CAUTION_SINGLE', model.CautionAttention.length);
//                              console.log('CAUTION_SINGLE', model.CautionAttention instanceof Array);
                              $('#CAUTION_ARR').hide();
                              $('#CAUTION_SINGLE').show();
                              $('#CA_image').attr('src','app/icons/'+model.CautionAttention);
                          } else {
                              $('#CAUTION_SINGLE').hide();
                              $('#CAUTION_ARR').show();
                              model.CautionAttention.forEach(function (item,i) {
                                  console.log('CautionAttention', item);
                                  $('#CA_image_'+i).attr('src','app/icons/'+item);
                              });
                          }
                      }
                      if(model.ContactPrecautions) {
                          console.log('ContactPrecautions', model.ContactPrecautions.length);
                          if(model.ContactPrecautions.length == 5){
                              $("#ContactPrecautions_4").hide();
                              $('#ContactPrecautions_5').show();
                              model.ContactPrecautions.forEach(function (item,i) {
                                  $('#CP_5_image_'+i).attr('src','app/icons/'+item);
                              });
                          } else {
                              $("#ContactPrecautions_5").hide();
                              $('#ContactPrecautions_4').show();
                              model.ContactPrecautions.forEach(function (item,i) {
                                  $('#CP_image_'+i).attr('src','app/icons/'+item);
                              });
                          }
                      }
                      if(model.HazardousMedications){
                          $('#HazardousMedications').show();
                          model.HazardousMedications.forEach(function (item,i) {
                              $('#HM_image_'+i).attr('src','app/icons/'+item);
                          });
                      }

                      currentModel = model;
//                      console.log('currentModel', currentModel);
                  }).fail(function (err) {
                      console.error('error', err);
                  })
              };

//              var getData = function () {
//                  $.getJSON(url).done(function (model) {
//                      if(model.CA_label_en == currentModel.CA_label_en) $('#CA_label_en').text(model.CA_label_en);
//                      currentModel = model;
//                  }).fail(function (err) {
//                      console.error('error', err);
//                  })
//              };
              getData();
//              setInterval(getData(),10000);
          });
      </script>
  </body>
</html>