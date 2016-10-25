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
        this.http = http;
        this._ngZone = _ngZone;
        this.roomsService = roomsService;
        this.room = new rooms_service_1.VORoom2({});
        this.url = "server/get-my-room.php";
        this.urlRoom = "server/get-my-room.php?room=";
        this.urlIp = "server/get-my-room.php?ip=";
        this.room = JSON.parse($room_json);
        console.log('room', this.room);
        this.InfectionControlArray = Array.isArray(this.room.InfectionControl.Precautions);
        console.log('arr', Array.isArray(this.room.InfectionControl.Precautions));
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
            template: "\n        <div class=\"container-fluid\">\n            <div class=\"panel panel-default\">\n                <div class=\"panel-heading text-right p-head\">Welcome / Bienvenue</div>\n                <div class=\"panel-body\">\n                    <div class=\"row\">\n                        <div class=\"col-md-7\">\n                            <div class=\"panel panel-primary psh\">\n                                <div class=\"panel-heading text-center\">Routine Practices / Pratiques de base</div>\n                                <div class=\"panel-body\">\n                                    <div class=\"row-fluid img_64\">\n                                        <div class=\"col-md-4 text-center\">\n                                            <!-- <img src=\"{{room.FallRisk_i}}\"> -->\n                                            <img src=\"app/icons/R_001.png\">\n                                            <label>Hand Hygiene Required Hygiene des mains obligatoire</label>\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                        <div class=\"col-md-5\">\n                            <div class=\"panel panel-primary psh\">\n                                <div class=\"panel-heading text-center\">Caution / Attention</div>\n                                <div class=\"panel-body\">\n                                    <div class=\"row-fluid img_64\" *ngIf=\"room.FallRisk != 'FALSE'\">\n                                        <div class=\"col-md-4 text-center\">\n                                            <img src=\"app/icons/{{room.FallRisk}}\">\n                                            <label>Fall Risk chutes du risque</label>\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                    <div class=\"row\" *ngIf=\"room.InfectionControl != 'FALSE'\">\n                        <div class=\"col-md-12\">\n                            <div class=\"panel panel-danger psh\">\n                                <div class=\"panel-heading text-center\">Contact Precautions / Precautions de Contact</div>\n                                <div class=\"panel-body text-center\">\n                                    <div class=\"row img_64\">\n                                        <div class=\"col-md-1\">\n                                            <img src=\"app/img/warning-r.png\">\n                                        </div>\n                                        <div class=\"col-md-10 \">\n                                            <h4><strong>Visitors please consult nursing desk before entering</strong></h4>\n                                            <h4><strong>Les visiteurs consultent bureau s'il vous plait de soins infirmiers avant d'entrer</strong></h4>\n                                        </div>\n                                        <div class=\"col-md-1\">\n                                            <img src=\"app/img/warning-r.png\">\n                                        </div>\n                                    </div>\n                                    <div class=\"row\"> \n                                        <div class=\"col-md-12 \">\n                                        <h4>IN ADDITION TO ROUTINE PRACTICES PLEASE USE:/EN PLUS DES PRATIQUES DE ROUTINE UTILISEZ S'IL VOUS PLAIT:</h4>\n                                        </div>\n                                    </div>\n                                    <div class=\"row img_64\" *ngIf=\"InfectionControlArray\">\n                                        <div class=\"col-md-1\" *ngFor=\"let item of room.InfectionControl.Precautions\">\n                                            <img src=\"app/icons/{{item}}\">\n                                        </div>\n                                    </div>\n                                    <div class=\"row img_64\" *ngIf=\"!InfectionControlArray\">\n                                        <div class=\"col-md-1\">\n                                            <img src=\"app/icons/{{room.InfectionControl.Precautions}}\">\n                                        </div>\n                                    </div>\n                                    <div class=\"row\">\n                                        <h5><strong class=\"text-danger\">Personal Protective Equipement available in the cabinet outside patient/client room.</strong></h5>\n                                        <h5><strong class=\"text-danger\">Protection individuelle Equipement disponible dans l'armoire a l'exterieur la chambre du patient / client.</strong></h5>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                    <div class=\"row\" *ngIf=\"room.HazardousMed != 'FALSE'\">\n                        <div class=\"col-md-12\">\n                            <div class=\"panel panel-warning text-center psh\">\n                                <div class=\"panel-heading\">Hazardous Medications / Medicaments Dangereux</div>\n                                <div class=\"panel-body\">\n                                    <div class=\"row img_64\">\n                                        <div class=\"col-md-1\">\n                                            <img src=\"app/img/warning-y.png\">\n                                        </div>\n                                        <div class=\"col-md-10 \">\n                                            <h4><strong>Visitors please consult nursing desk before entering</strong></h4>\n                                            <h4><strong>Les visiteurs consultent bureau s'il vous plait de soins infirmiers avant d'entrer</strong></h4>\n                                        </div>\n                                        <div class=\"col-md-1\">\n                                            <img src=\"app/img/warning-y.png\">\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n",
            styles: ["\n        .container-fluid{\n            margin-top: 15px;\n        }\n    "]
        }), 
        __metadata('design:paramtypes', [http_1.Http, core_1.NgZone, rooms_service_1.RoomsService])
    ], RoomComponent);
    return RoomComponent;
}());
exports.RoomComponent = RoomComponent;
//# sourceMappingURL=room.component.js.map