import {Component, OnInit, NgZone} from '@angular/core';

import './rxjs-operators';

import { Http, Response, Headers, RequestOptions } from '@angular/http';
import {RoomsService, VORoom} from "../rooms-service";


@Component({
    selector: 'room',
    template: `
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body row">
                    <div class="col-xs-12 text-center img_64">
                        <div>
                            <label>Room ID: </label>
                            <span>{{room.ID}}</span>
                        </div>
                        <div>
                            <label>Bed Name: </label>
                            <span>{{room.BedName}}</span>
                        </div>
                        <div>
                            <label>Patientname: </label>
                            <span>{{room.Patientname}}</span>
                        </div>
                        <div>
                            <label>FallRisk: </label>
                            <img src="{{room.FallRisk_i}}">
                        </div>
                        <div>
                            <label>AllergyMed: </label>
                            <img src="{{room.AllergyMed_i}}">
                        </div>
                        <div>
                            <label>AllergyLatex: </label>
                            <img src="{{room.AllergyLatex_i}}">
                        </div>
                        <div>
                            <label>AllergyFood: </label>
                            <img src="{{room.AllergyFood_i}}">
                        </div>
                        <div>
                            <label>AllergySubstance: </label>
                            <img src="{{room.AllergySubstance_i}}">
                        </div>
                        <div>
                            <label>HazardousMed: </label>
                            <img src="{{room.HazardousMed_i}}">
                        </div>
                        <div>
                            <label>InfectionControl: </label>
                            <img src="{{room.InfectionControl_i}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
`
    ,styles:[`
        .container{
            margin-top: 40px;
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