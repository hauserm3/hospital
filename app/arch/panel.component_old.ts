import {Component, OnInit} from '@angular/core';

import '../rxjs-operators';

import { Http, Response, Headers, RequestOptions } from '@angular/http';
import {VOIpRoom, RoomsService, VOIp_Rooms, VOResult} from "./rooms-service";

@Component({
    selector: 'admin-panel',
    template: `
        <div class="wrap">
            <h1>Admin panel</h1>
            <div class="content">
            <div class="tools">
                <button class="btn btn-primary" (click) = "onSaveClick()">Save</button>
                <button class="btn btn-primary" (click) = "onAddClick()">Add</button>
                <button class="btn btn-primary" (click) = "onDeleteClick()" [disabled]="toolsDisadled">Delete</button>
                <button class="btn btn-success fright" routerLink="icons-manager">Icons Manager</button>
            </div>
                <div class="panel">
                    <div class="ip-room-item" *ngFor="let item of rooms" (click)="onIpRoomClick(item)" [class.selected]="item.selected">
                        <div class="form-group">
                            <label>IP</label>
                            <!--<div contenteditable="true">{{item.IP}}</div>-->
                            <!--<div contenteditable="true">{{item.ID}}</div>-->
                            <input 
                                placeholder="0.0.0.0" 
                                name="IP" 
                                [(ngModel)] = "item.IP"
                                minlength="7"
                                maxlength="15"
                                required
                                />
                        </div>
                        <div class="form-group">
                            <label>ROOM</label>
                            <input 
                                placeholder="ID ROOM"
                                [(ngModel)] = "item.ID"
                                name="ID"
                                ngModel
                                minlength="1"
                                pattern="[0-9]+"
                                required/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
`
    ,styles:[`
        .wrap{
            position: relative;
            height: 100%;
            text-align: center;
        }
        .tools{
            margin: 0 auto 10px;
            max-width: 650px;
            text-align: initial;
        }
        .panel{
            max-width: 650px;
            margin: 0 auto 20px;
            border-radius: 8px;
            border: 2px solid #337ab7;
            box-shadow: grey 5px 5px 10px;
            padding: 20px;
        }

        .form-group{
            display: inline-block;
            width: 45%;
            margin: 0 5px;
        }
        .column{
            display: inline-block;
            width: 300px;
        }
        .item{
            border: 2px solid #337ab7;
        }
        .ip-room-item{
            border-radius: 8px;
            border: 2px solid #337ab7;
            box-shadow: grey 5px 5px 10px;
            padding: 7px 0;
            margin: 0 0 5px;
        }
        .selected{
            border: 2px solid #ff7e00;
        }
        label{
            margin-right: 5px;
        }
        input{
            padding: 0 5px;
        }
        .fright{
            float: right;
        }
    `]
})
export class AdminPanel implements OnInit {
    IP: string;
    ID: number;
    vers: number;

    rooms: VOIpRoom[];

    toolsDisadled:boolean;
    currentItem:VOIpRoom;

    response:any;

    private url:string = "server/room-data.php?";
    private urlIpRoom:string = "server/room-data.php?ip_room=";
    private urlRoom:string = "server/room-data.php?room=";
    private urlIp:string = "server/room-data.php?ip=";

    constructor(private http:Http, private roomsService:RoomsService) { }

    ngOnInit(){
        if(!this.currentItem) this.toolsDisadled = true;
        this.getData();

        this.roomsService.selectedItem$.subscribe((item:VOIpRoom)=>{
            this.currentItem = item;
            this.toolsDisadled = item.selected ? false : true;
            // console.log('this.toolsDisadled ', this.toolsDisadled);
        });
    }

    saveData(){

        this.rooms.forEach(function (item) {
            delete item.selected;
        });

        var out:VOIp_Rooms = new VOIp_Rooms({
            vers: this.vers++,
            rooms: this.rooms
        });

        console.log('out', out);

        this.roomsService.saveRooms(out).subscribe((res:VOResult)=>{
            this.toolsDisadled = true;
            console.log(res);
        });
    }

    onSaveClick(){
        this.saveData();
    }
    onAddClick(){
        this.rooms.push(new VOIpRoom({IP:'',ID:''}));
    }
    onDeleteClick(){
        if(!this.currentItem) return;
        this.toolsDisadled = true;
        this.roomsService.deleteRoom(this.currentItem).subscribe((res:VOResult)=>{
            console.log(res);
        });
        this.getData();
    }
    getData(){
        this.roomsService.getRooms().subscribe(res=>{
            this.vers = res.vers;
            this.rooms = res.rooms;
        });
    }

    onManagerClick(){

    }

    onIpRoomClick(item:VOIpRoom){
        this.roomsService.selectItem(item);
        // console.log('item', item);
    }

}