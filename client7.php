<?php
//$url = 'server/get-room-4.php';
//$room_json = isset($_GET['room_id']) ? file_get_contents($url.'?room_id='.$_GET['room_id']) :
//             isset($_GET['room_ip']) ? file_get_contents($url.'?room_ip='.$_GET['room_ip']) :
//             file_get_contents($url);
//$url = 'server/get-room-5.php';
//if(isset($_GET['room_id'])) $url = $url.'?room_id='.$_GET['room_id'];
//elseif (isset($_GET['room_ip'])) $url = $url.'?room_ip='.$_GET['room_ip'];
include 'api/settings.php';
if(isset($_GET['room_id'])) $get_room_path = $get_room_path.'?room_id='.$_GET['room_id'];
elseif (isset($_GET['room_ip'])) $get_room_path = $get_room_path.'?room_ip='.$_GET['room_ip'];
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

<!--  <body background="app/img/background.png">-->
  <body class="transition-opacity">
<!--      <div class="panel panel-default">-->
<!--          <div class="panel-heading">  </div>-->
<!--          <div class="panel-body">-->
<!--              <div class="container-fluid">-->
            <div id="content">
                  <div class="row">
                      <div class="col-md-8">
                          <div id="logo" class="row text-center">
                              <img src="app/img/logo.png">
                          </div>
                          <div id="logoText" class="row text-center">
                              <h3><strong>Personal Protective Equipment (PPE) available in</strong></h3>
                              <h3><strong>the cabinet outside the patient/client room.</strong></h3>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                                  <div id="RoutinePractices" class="panel panel-primary psh ">
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

                                  <div id="CautionAttention" class="panel panel-info psh ">
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
                                  <div id="ContactPrecautions" class="panel panel-danger psh  ">
                                      <div class="panel-heading text-center">CONTACT PRECAUTIONS</div>
                                      <div class="panel-body text-center">
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
                                  <div id="ContactPrecautions_000" class="panel panel-default text-center psh  ">
                                      <img id="CP_image_000" src="">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div id="HazardousMedications" class="panel panel-success psh  ">
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
                          <div id="HazardousMedications_000" class="panel panel-default text-center psh  ">
                              <img id="HM_image_000" src="">
                          </div>
                      </div>
                  </div>
            </div>
<!--                  <div class="row text-right"><strong class="text-danger">Last updated:</strong><strong id="Date"></strong></div>-->
<!--              </div>-->
<!--          </div>-->
<!--          <div class="panel-footer text-right"></div>-->
            <footer>
                <strong id="textDate">Last updated:  </strong><strong id="Date"></strong>
            </footer>
<!--      </div>-->


      <script>
          $(document).ready(function () {
              var $data_parse = '<?php echo $room_data;?>';             // data_parse = 'api/room-data-5.php';
              var $url = '<?php echo $get_room_path;?>';                // url = 'api/get-room-5.php';
              var $icons_folder = '<?php echo $icons_folder;?>' + '/';  // icons_folder = 'app/icons'
//              console.log('$url', '<?php //echo $get_room_path;?>//');
//              console.log('$icons_folder', '<?php //echo $icons_folder;?>//');
              var currentModel;
//              if(model.CA_label_en == currentModel.CA_label_en) $('#CA_label_en').text(model.CA_label_en);

              if(window.matchMedia('(min-width: 1281px)').matches)
              {
                  $('#CAUTION_ARR').removeClass( 'img_158' ).addClass( 'img_178' );
                  $('#ContactPrecautions_4').removeClass( 'img_158' ).addClass( 'img_178' );
                  $('#ContactPrecautions_5').removeClass( 'img_100' ).addClass( 'img_178' );
                  $('#HazardousMedications').removeClass( 'img_150' ).addClass( 'img_178' );
//                  $('#CAUTION_ARR').addClass( 'img_178' );
                  // do functionality on screens smaller than 768px
              }

              var transform = function (idBlock) {
                  setTimeout(function() { $(idBlock).addClass('transition-scale-activated'); }, 1000);
//                  $(idBlock).addClass('transition-scale-activated');
              };

              var getData = function () {
                  $.getJSON($url).done(function (res) {
                      $('#content').removeClass('network-offline');
                      if(res.result){model = res.result}
                      console.log('model', model);
//                      console.log('currentModel', currentModel);
                      $('#Date').text(model.Date);
                      if(model.RoutinePractices) {
                          $('#RP_image').attr('src',$icons_folder+model.RoutinePractices);
                          $('#RP_label_en').text(model.RP_label_en);
                          $('#RP_label_fr').text(model.RP_label_fr);
//                          setTimeout(function() { transform('#RoutinePractices') }, 1000);
                          $('#RoutinePractices').show();
                      }
                      if(model.CautionAttention) {
//                          $('#CA_image').attr('src','app/icons/'+model.CautionAttention);
                          if(model.CautionAttention.length == 1){
                              console.log('CAUTION_SINGLE', model.CautionAttention.length);
//                              console.log('CAUTION_SINGLE', model.CautionAttention instanceof Array);
                              $('#CAUTION_ARR').hide();
                              $('#CAUTION_SINGLE').show();
                              $('#CA_image').attr('src',$icons_folder+model.CautionAttention);
                          } else {
                              $('#CAUTION_SINGLE').hide();
                              $('#CAUTION_ARR').show();
                              model.CautionAttention.forEach(function (item,i) {
                                  console.log('CautionAttention', item);
                                  $('#CA_image_'+i).attr('src',$icons_folder+item);
                              });
                          }
                          $('#CautionAttention').show();
                      } else {
                          $('#CautionAttention').hide();
                      }
                      if(model.ContactPrecautions) {
                          $('#ContactPrecautions_000').hide();
                          $('#ContactPrecautions').show();
                          console.log('ContactPrecautions', model.ContactPrecautions.length);
                          if(model.ContactPrecautions.length == 5){
                              $("#ContactPrecautions_4").hide();
                              $('#ContactPrecautions_5').show();
                              model.ContactPrecautions.forEach(function (item,i) {
                                  $('#CP_5_image_'+i).attr('src',$icons_folder+item);
                              });
                          } else {
                              $("#ContactPrecautions_5").hide();
                              $('#ContactPrecautions_4').show();
                              model.ContactPrecautions.forEach(function (item,i) {
                                  $('#CP_image_'+i).attr('src',$icons_folder+item);
                              });
                          }
                      } else {
                          $('#ContactPrecautions').hide();
                          $('#ContactPrecautions_000').show();
                          $('#CP_image_000').attr('src',$icons_folder+'IC_000.png');
                      }
                      if(model.HazardousMedications){
                          $('#HazardousMedications_000').hide();
                          $('#HazardousMedications').show();
                          model.HazardousMedications.forEach(function (item,i) {
                              $('#HM_image_'+i).attr('src',$icons_folder+item);
                          });
                      } else {
                          $('#HazardousMedications').hide();
                          $('#HazardousMedications_000').show();
                          $('#HM_image_000').attr('src',$icons_folder+'HM_000.png');
                      }
//                      setTimeout(function() { $('#content').addClass('transition-scale-activated'); }, 1000);
                      setTimeout(function() { $('body').addClass('transition-opacity-activated'); }, 1000);
                      currentModel = model;
//                      console.log('currentModel', currentModel);
                      console.log('DATA', currentModel);
                  }).fail(function (err) {
                      console.error('error: ', err);
                      $('#content').addClass('network-offline');
                  })
              };

//              var parseData = function () {
//                  $.get($data_parse)
//              };

//              var checkChanges = function() {
//                  $.get("api/check_changes.php").done(function (data) {
//                      if(data.changes) {
//                          console.log('checkChanges: ', data);
//                          getData();
//                      } else {
//                          console.log('checkChangesFALSE: ', data);
//                      }
//                  });
////                  $.get("server/room-data-5.php");
//                  return false;
//              };

              getData();
//              setInterval(function(){checkChanges()},5000);
              setInterval(function(){getData()},10000);
          });
      </script>
  </body>
</html>