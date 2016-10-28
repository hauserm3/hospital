import {Component, OnInit, NgZone} from '@angular/core';

import './rxjs-operators';

import { Http, Response, Headers, RequestOptions } from '@angular/http';
import {RoomsService, VORoom, VORoom3, VOIcon} from "../rooms-service";


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
                                            <div><strong>Hand Hygiene Required</strong></div>
                                            <div><strong>Hygiène des mains obligatoire</strong></div>
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
                                            <img src="app/icons/{{room.CautionAttention}}">
                                            <div><strong id="roomCAlabel_en">{{room.CA_label_en}}</strong></div>
                                            <div><strong>{{room.CA_label_fr}}</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" *ngIf="room.ContactPrecautions">
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
                                        <div class="col-md-2" *ngFor="let item of room.ContactPrecautions; let i=index" >
                                            <img src="app/icons/{{item}}">
                                            <!--<div><strong>{{room.CP_label_en[i]}}</strong></div>-->
                                            <!--<div><strong>{{room.CP_label_fr[i]}}</strong></div>-->
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-1"></div>
                                        <div class="col-md-2" *ngFor="let item of room.CP_label_en" >
                                            <div><strong>{{item}}</strong></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-1"></div>
                                        <div class="col-md-2" *ngFor="let item of room.CP_label_fr" >
                                            <div><strong>{{item}}</strong></div>
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
                    <div class="row" *ngIf="room.HazardousMedications">
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
    ContactPrecautionsArray:boolean;

    icons: VOIcon[];
    room: VORoom3 = new VORoom3({});

    response:any;

    private url:string = "server/get-my-room.php";
    private urlRoom:string = "server/get-my-room.php?room=";
    private urlIp:string = "server/get-my-room.php?ip=";

    constructor(
        private http:Http,
        private _ngZone: NgZone,
        private roomsService:RoomsService
    ) {
        this.room = JSON.parse($room_json);
        this.roomsService.getIcons3().subscribe(res=>{
            this.icons = res.icons;
            console.log('this.icons', this.icons);
            this.roomsService.setIconsLabel(this.room,this.icons);
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