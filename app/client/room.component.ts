import {Component, OnInit, NgZone} from '@angular/core';

import './rxjs-operators';

import { Http, Response, Headers, RequestOptions } from '@angular/http';
import {RoomsService, VORoom} from "../rooms-service";


@Component({
    selector: 'room',
    template: `
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
                                        <div class="col-md-4 text-center">
                                            <!-- <img src="{{room.FallRisk_i}}"> -->
                                            <img src="app/icons/R_001.png">
                                            <label>Hand Hygiene Required Hygiene des mains obligatoire</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="panel panel-primary psh">
                                <div class="panel-heading text-center">Caution / Attention</div>
                                <div class="panel-body">
                                    <div class="row-fluid img_64">
                                        <div class="col-md-4 text-center">
                                            <img src="{{room.FallRisk_i}}">
                                            <label>Fall Risk chutes du risque</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-danger psh">
                                <div class="panel-heading text-center">Contact Precautions / Precautions de Contact</div>
                                <div class="panel-body text-center">
                                    <div class="row img_64">
                                        <div class="col-md-1">
                                            <img src="app/img/warning-r.png">
                                        </div>
                                        <div class="col-md-10 ">
                                            <h4><strong>Visitors please consult nursing desk before entering</strong></h4>
                                            <h4><strong>Les visiteurs consultent bureau s'il vous plait de soins infirmiers avant d'entrer</strong></h4>
                                        </div>
                                        <div class="col-md-1">
                                            <img src="app/img/warning-r.png">
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-md-12 ">
                                        <h4>IN ADDITION TO ROUTINE PRACTICES PLEASE USE:/EN PLUS DES PRATIQUES DE ROUTINE UTILISEZ S'IL VOUS PLAIT:</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                    </div>
                                    <div class="row">
                                        <h5><strong class="text-danger">Personal Protective Equipement available in the cabinet outside patient/client room.</strong></h5>
                                        <h5><strong class="text-danger">Protection individuelle Equipement disponible dans l'armoire a l'exterieur la chambre du patient / client.</strong></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-warning text-center psh">
                                <div class="panel-heading">Hazardous Medications / Medicaments Dangereux</div>
                                <div class="panel-body">
                                    <div class="row img_64">
                                        <div class="col-md-1">
                                            <img src="app/img/warning-y.png">
                                        </div>
                                        <div class="col-md-10 ">
                                            <h4><strong>Visitors please consult nursing desk before entering</strong></h4>
                                            <h4><strong>Les visiteurs consultent bureau s'il vous plait de soins infirmiers avant d'entrer</strong></h4>
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
`
    ,styles:[`
        .container-fluid{
            margin-top: 15px;
        }
    `]
})
export class RoomComponent implements OnInit {
    IP: string;
    ID: number;

    room: VORoom = new VORoom({});

    response:any;

    private url:string = "server/get-my-room.php";
    private urlRoom:string = "server/get-my-room.php?room=";
    private urlIp:string = "server/get-my-room.php?ip=";

    constructor(
        private http:Http,
        private _ngZone: NgZone,
        private roomsService:RoomsService
    ) {
        this.room = JSON.parse($room_json); console.log('room_json', this.room);
        // console.log('$room_json ', $room_json);
        //zone -> $room_json
    }

    ngOnInit(){

        // this._ngZone.runOutsideAngular(() => {
        //     this._ngZone.run(() => { this.room = JSON.parse($room_json); console.log('room_json', this.room); });
        // });

        // this.roomsService.getRoom().subscribe(res=>{
        //    this.room = res;
        // });
    }
}

declare var $room_json:string;