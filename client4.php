<?php
//$url = 'server/get-room-4.php';
//$room_json = isset($_GET['room_id']) ? file_get_contents($url.'?room_id='.$_GET['room_id']) :
//             isset($_GET['room_ip']) ? file_get_contents($url.'?room_ip='.$_GET['room_ip']) :
//             file_get_contents($url);
$url = 'server/get-room-4.php';
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

  <body>
      <div class="container-fluid">
          <div class="panel panel-default">
              <div class="panel-heading text-right p-head">Welcome / Bienvenue</div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-7">
                          <div class="panel panel-primary psh">
                              <div class="panel-heading text-center">Routine Practices / Pratiques de base</div>
                              <div class="panel-body">
                                  <div class="row-fluid img_64">
                                      <div class="col-md-6 text-center">
                                          <!-- <img src="{{room.FallRisk_i}}"> -->
                                          <img id="RP_image" src="">
                                          <div><strong id="RP_label_en"></strong></div>
                                          <div><strong id="RP_label_fr"></strong></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-5">
                          <div class="panel panel-primary psh">
                              <div class="panel-heading text-center">Caution / Attention</div>
                              <div class="panel-body">
                                  <div class="row-fluid img_64" *ngIf="room.CautionAttention">
                                      <div class="col-md-4 text-center">
                                          <img id="CA_image" src="">
                                          <div><strong id="CA_label_en"></strong></div>
                                          <div><strong id="CA_label_fr"></strong></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row" id="ContactPrecautions" style="display:none">
                      <div class="col-md-12">
                          <div class="panel panel-danger psh">
                              <div class="panel-heading text-center">Contact Precautions / Précautions de Contact</div>
                              <div class="panel-body text-center">
                                  <div class="row img_64">
                                      <div class="col-md-1">
                                          <img src="app/img/warning-r.png">
                                      </div>
                                      <div class="col-md-10 ">
                                          <h4><strong>Visitors please consult nursing desk before entering</strong></h4>
                                          <h4><strong>Les visiteurs consultent bureau s'il vous plaît de soins infirmiers avant d'entrer</strong></h4>
                                      </div>
                                      <div class="col-md-1">
                                          <img src="app/img/warning-r.png">
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12 ">
                                          <h4>IN ADDITION TO ROUTINE PRACTICES PLEASE USE:/EN PLUS DES PRATIQUES DE ROUTINE UTILISEZ S'IL VOUS PLAÎT:</h4>
                                      </div>
                                  </div>
                                  <div class="row img_64">
                                      <div class="col-md-1"></div>
                                      <div class="col-md-2">
                                          <img id="CP_image_0" src="">
                                      </div>
                                      <div class="col-md-2">
                                          <img id="CP_image_1" src="">
                                      </div>
                                      <div class="col-md-2">
                                          <img id="CP_image_2" src="">
                                      </div>
                                      <div class="col-md-2">
                                          <img id="CP_image_3" src="">
                                      </div>
                                      <div class="col-md-2">
                                          <img id="CP_image_4" src="">
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-1"></div>
                                      <div class="col-md-2" >
                                          <div><strong id="CP_label_en_0"></strong></div>
                                      </div>
                                      <div class="col-md-2" >
                                          <div><strong id="CP_label_en_1"></strong></div>
                                      </div>
                                      <div class="col-md-2" >
                                          <div><strong id="CP_label_en_2"></strong></div>
                                      </div>
                                      <div class="col-md-2" >
                                          <div><strong id="CP_label_en_3"></strong></div>
                                      </div>
                                      <div class="col-md-2" >
                                          <div><strong id="CP_label_en_4"></strong></div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-1"></div>
                                      <div class="col-md-2" >
                                          <div><strong id="CP_label_fr_0"></strong></div>
                                      </div>
                                      <div class="col-md-2" >
                                          <div><strong id="CP_label_fr_1"></strong></div>
                                      </div>
                                      <div class="col-md-2" >
                                          <div><strong id="CP_label_fr_2"></strong></div>
                                      </div>
                                      <div class="col-md-2" >
                                          <div><strong id="CP_label_fr_3"></strong></div>
                                      </div>
                                      <div class="col-md-2" >
                                          <div><strong id="CP_label_fr_4"></strong></div>
                                      </div>
                                  </div>
                                  <!--<div class="row img_64" *ngIf="!ContactPrecautionsArray">-->
                                  <!--<div class="col-md-4 col-md-offset-4">-->
                                  <!--<img src="app/icons/{{room.ContactPrecautions.Image}}">-->
                                  <!--<div><strong>Hand Hygiene Required</strong></div>-->
                                  <!--<div><strong>Hand Hygiene Required</strong></div>-->
                                  <!--</div>-->
                                  <!--</div>-->
                                  <div class="row">
                                      <h5><strong class="text-danger">Personal Protective Equipement available in the cabinet outside patient/client room.</strong></h5>
                                      <h5><strong class="text-danger">Protection individuelle Equipement disponible dans l'armoire à l'extérieur la chambre du patient / client.</strong></h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row" id="HazardousMedications" style="display:none">
                      <div class="col-md-12">
                          <div class="panel panel-warning text-center psh">
                              <div class="panel-heading">Hazardous Medications / Médicaments Dangereux</div>
                              <div class="panel-body">
                                  <div class="row img_64">
                                      <div class="col-md-1">
                                          <img src="app/img/warning-y.png">
                                      </div>
                                      <div class="col-md-10 ">
                                          <h4><strong>Visitors please consult nursing desk before entering</strong></h4>
                                          <h4><strong>Les visiteurs consultent bureau s'il vous plaît de soins infirmiers avant d'entrer</strong></h4>
                                      </div>
                                      <div class="col-md-1">
                                          <img src="app/img/warning-y.png">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>


      <script>
          $(document).ready(function () {
//              url = 'server/get-room-4.php';
              var $url = '<?php echo $url;?>';
              console.log('$url', '<?php echo $url;?>');
              var currentModel;

//              if(model.CA_label_en == currentModel.CA_label_en) $('#CA_label_en').text(model.CA_label_en);

              var getData = function () {
                  $.getJSON($url).done(function (model) {
                      console.log('model', model);
//                      console.log('currentModel', currentModel);
                      if(model.RoutinePractices) {
                          $('#RP_image').attr('src','app/icons/'+model.RoutinePractices);
                          $('#RP_label_en').text(model.RP_label_en);
                          $('#RP_label_fr').text(model.RP_label_fr);
                      }
                      if(model.CautionAttention) {
                          $('#CA_image').attr('src','app/icons/'+model.CautionAttention);
                          $('#CA_label_en').text(model.CA_label_en);
                          $('#CA_label_fr').text(model.CA_label_fr);
                      }
                      if(model.ContactPrecautions) {
                          $('#ContactPrecautions').show();
                          model.ContactPrecautions.forEach(function (item,i) {
                              $('#CP_image_'+i).attr('src','app/icons/'+item);
                              $('#CP_label_en_'+i).text(model.CP_label_en[i]);
                              $('#CP_label_fr_'+i).text(model.CP_label_fr[i]);
                          });
//                          for (var i = 0; i<length){
//
//                          }
                      }
                      if(model.HazardousMedications){
                          $('#HazardousMedications').show();
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