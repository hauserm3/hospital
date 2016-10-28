"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
require('./rxjs-operators');
var http_1 = require('@angular/http');
var rooms_service_1 = require("../rooms-service");
var RoomComponent = (function () {
    function RoomComponent(http, _ngZone, roomsService) {
        var _this = this;
        this.http = http;
        this._ngZone = _ngZone;
        this.roomsService = roomsService;
        this.room = new rooms_service_1.VORoom3({});
        this.url = "server/get-my-room.php";
        this.urlRoom = "server/get-my-room.php?room=";
        this.urlIp = "server/get-my-room.php?ip=";
        this.room = JSON.parse($room_json);
        this.roomsService.getIcons3().subscribe(function (res) {
            _this.icons = res.icons;
            console.log('this.icons', _this.icons);
            _this.roomsService.setIconsLabel(_this.room, _this.icons);
        });
        // this.roomsService.setIconsLabel(this.room,this.icons).subscribe(res=>{
        //     this.room = res.room;
        //     console.log('room', this.icons);
        // });
        // this.roomsService.setIconsLabel(this.room,this.icons);
        console.log('this.room', this.room);
        // console.log('$room_json ', $room_json);
        //zone -> $room_json
    }
    RoomComponent.prototype.ngOnInit = function () {
        // this._ngZone.runOutsideAngular(() => {
        //     this._ngZone.run(() => { this.room = JSON.parse($room_json); console.log('room_json', this.room); });
        // });
        // this.roomsService.getRoom().subscribe(res=>{
        //    this.room = res;
        // });
    };
    RoomComponent = __decorate([
        core_1.Component({
            selector: 'room',
            template: "\n        <div class=\"container-fluid\">\n            <div class=\"panel panel-default\">\n                <div class=\"panel-heading text-right p-head\">Welcome / Bienvenue</div>\n                <div class=\"panel-body\">\n                    <div class=\"row\">\n                        <div class=\"col-md-7\">\n                            <div class=\"panel panel-primary psh\">\n                                <div class=\"panel-heading text-center\">Routine Practices / Pratiques de base</div>\n                                <div class=\"panel-body\">\n                                    <div class=\"row-fluid img_64\">\n                                        <div class=\"col-md-6 text-center\">\n                                            <!-- <img src=\"{{room.FallRisk_i}}\"> -->\n                                            <img src=\"app/icons/R_001.png\">\n                                            <div><strong>Hand Hygiene Required</strong></div>\n                                            <div><strong>Hygi\u00E8ne des mains obligatoire</strong></div>\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                        <div class=\"col-md-5\">\n                            <div class=\"panel panel-primary psh\">\n                                <div class=\"panel-heading text-center\">Caution / Attention</div>\n                                <div class=\"panel-body\">\n                                    <div class=\"row-fluid img_64\" *ngIf=\"room.CautionAttention\">\n                                        <div class=\"col-md-4 text-center\">\n                                            <img src=\"app/icons/{{room.CautionAttention}}\">\n                                            <div><strong id=\"roomCAlabel_en\">{{room.CA_label_en}}</strong></div>\n                                            <div><strong>{{room.CA_label_fr}}</strong></div>\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                    <div class=\"row\" *ngIf=\"room.ContactPrecautions\">\n                        <div class=\"col-md-12\">\n                            <div class=\"panel panel-danger psh\">\n                                <div class=\"panel-heading text-center\">Contact Precautions / Pr\u00E9cautions de Contact</div>\n                                <div class=\"panel-body text-center\">\n                                    <div class=\"row img_64\">\n                                        <div class=\"col-md-1\">\n                                            <img src=\"app/img/warning-r.png\">\n                                        </div>\n                                        <div class=\"col-md-10 \">\n                                            <h4><strong>Visitors please consult nursing desk before entering</strong></h4>\n                                            <h4><strong>Les visiteurs consultent bureau s'il vous pla\u00EEt de soins infirmiers avant d'entrer</strong></h4>\n                                        </div>\n                                        <div class=\"col-md-1\">\n                                            <img src=\"app/img/warning-r.png\">\n                                        </div>\n                                    </div>\n                                    <div class=\"row\"> \n                                        <div class=\"col-md-12 \">\n                                        <h4>IN ADDITION TO ROUTINE PRACTICES PLEASE USE:/EN PLUS DES PRATIQUES DE ROUTINE UTILISEZ S'IL VOUS PLA\u00CET:</h4>\n                                        </div>\n                                    </div>\n                                    <div class=\"row img_64\">\n                                    <div class=\"col-md-1\"></div>\n                                        <div class=\"col-md-2\" *ngFor=\"let item of room.ContactPrecautions; let i=index\" >\n                                            <img src=\"app/icons/{{item}}\">\n                                            <!--<div><strong>{{room.CP_label_en[i]}}</strong></div>-->\n                                            <!--<div><strong>{{room.CP_label_fr[i]}}</strong></div>-->\n                                        </div>\n                                    </div>\n                                    <div class=\"row\">\n                                    <div class=\"col-md-1\"></div>\n                                        <div class=\"col-md-2\" *ngFor=\"let item of room.CP_label_en\" >\n                                            <div><strong>{{item}}</strong></div>\n                                        </div>\n                                    </div>\n                                    <div class=\"row\">\n                                    <div class=\"col-md-1\"></div>\n                                        <div class=\"col-md-2\" *ngFor=\"let item of room.CP_label_fr\" >\n                                            <div><strong>{{item}}</strong></div>\n                                        </div>\n                                    </div>\n                                    <!--<div class=\"row img_64\" *ngIf=\"!ContactPrecautionsArray\">-->\n                                        <!--<div class=\"col-md-4 col-md-offset-4\">-->\n                                            <!--<img src=\"app/icons/{{room.ContactPrecautions.Image}}\">-->\n                                            <!--<div><strong>Hand Hygiene Required</strong></div>-->\n                                            <!--<div><strong>Hand Hygiene Required</strong></div>-->\n                                        <!--</div>-->\n                                    <!--</div>-->\n                                    <div class=\"row\">\n                                        <h5><strong class=\"text-danger\">Personal Protective Equipement available in the cabinet outside patient/client room.</strong></h5>\n                                        <h5><strong class=\"text-danger\">Protection individuelle Equipement disponible dans l'armoire \u00E0 l'ext\u00E9rieur la chambre du patient / client.</strong></h5>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                    <div class=\"row\" *ngIf=\"room.HazardousMedications\">\n                        <div class=\"col-md-12\">\n                            <div class=\"panel panel-warning text-center psh\">\n                                <div class=\"panel-heading\">Hazardous Medications / M\u00E9dicaments Dangereux</div>\n                                <div class=\"panel-body\">\n                                    <div class=\"row img_64\">\n                                        <div class=\"col-md-1\">\n                                            <img src=\"app/img/warning-y.png\">\n                                        </div>\n                                        <div class=\"col-md-10 \">\n                                            <h4><strong>Visitors please consult nursing desk before entering</strong></h4>\n                                            <h4><strong>Les visiteurs consultent bureau s'il vous pla\u00EEt de soins infirmiers avant d'entrer</strong></h4>\n                                        </div>\n                                        <div class=\"col-md-1\">\n                                            <img src=\"app/img/warning-y.png\">\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n",
            styles: ["\n        .container-fluid{\n            margin-top: 15px;\n        }\n    "]
        }), 
        __metadata('design:paramtypes', [http_1.Http, core_1.NgZone, rooms_service_1.RoomsService])
    ], RoomComponent);
    return RoomComponent;
}());
exports.RoomComponent = RoomComponent;
//# sourceMappingURL=room.component.js.map