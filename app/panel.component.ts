import {Component, OnInit} from '@angular/core';

import './rxjs-operators';

import { Http, Response, Headers, RequestOptions } from '@angular/http';
import {VOIpRoom, RoomsService, VOIp_Rooms, VOResult} from "./rooms-service";

@Component({
    selector: 'admin-panel',
    template: `
        <div class="container">
            <div class="container navbar navbar-fixed-top">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Admin panel</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="tools">
                        <div class="col-xs-12">
                            <button class="btn btn-primary" (click) = "onSaveClick()">Save</button>
                            <button class="btn btn-primary" (click) = "onAddClick()">Add</button>
                            <button class="btn btn-primary" (click) = "onDeleteClick()" [disabled]="toolsDisadled">Delete</button>
                            <button class="btn btn-success pull-right" routerLink="icons-manager">Icons Manager</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-top">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th>IP</th>
                                        <th>ROOM</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="tablebody">
                                    <tr style="height: 1.5px;"></tr>
                                    <tr class="ip-room-item" *ngFor="let item of rooms" (click)="onIpRoomClick(item)" [class.selected]="item.selected">
                                        <td class="text-center">
                                            <input 
                                                placeholder="0.0.0.0" 
                                                name="IP" 
                                                [(ngModel)] = "item.IP"
                                                minlength="7"
                                                maxlength="15"
                                                required
                                                />
                                        </td>
                                        <td class="text-center">
                                            <input 
                                                placeholder="ID ROOM"
                                                [(ngModel)] = "item.ID"
                                                name="ID"
                                                ngModel
                                                minlength="1"
                                                pattern="[0-9]+"
                                                required/>
                                        </td>
                                        <td class="text-center">
                                            <a *ngIf="item.selected" class="btn fa fa-times-circle" (click) = "onDeleteItemClick(item)"></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
`
    ,styles:[`

         .m-top{
            margin-top: 120px;
         }

        .form-group{
            display: inline-block;
            margin: 0 5px;
        }
        
        /*#tablebody{*/
            /*border-radius: 8px;*/
            /*border: 2px solid #337ab7;*/
            /*box-shadow: grey 5px 5px 10px;*/
            /*padding: 7px 0;*/
            /*margin: 0 0 5px;*/
        /*}*/
        .selected{
            border: 2px solid #ff7e00;
        }
        input{
            padding: 0 5px;
            text-align: center;
        }
        .fright{
            float: right;
        }
        #tableone td{
            vertical-align: middle;
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
            this.getData();
            console.log(res);
        });
    }
    onDeleteItemClick(item:VOIpRoom){
        this.toolsDisadled = true;
        this.roomsService.deleteRoom(item).subscribe((res:VOResult)=>{
            this.getData();
            console.log(res);
        });
    }
    getData(){
        this.roomsService.getRooms().subscribe(res=>{
            this.vers = res.vers;
            this.rooms = res.rooms;
        });
    }

    onIpRoomClick(item:VOIpRoom){
        this.roomsService.selectItem(item);
        // console.log('item', item);
    }

}