import {Component, OnInit} from '@angular/core';

import '../rxjs-operators';

import { Http, Response, Headers, RequestOptions } from '@angular/http';
import {VOIpRoom, RoomsService, VOIp_Rooms, VOResult} from "./rooms-service";

@Component({
    selector: 'my-app',
    template: `
        <div class="wrap">
            <h1>Admin panel</h1>
            <div class="content">
                <div class="panel" *ngFor="let item of rooms">
                    <!--<form (ngSubmit)="onSubmit(f.value)" #f="ngForm" autocomplete="off" novalidate>                -->
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
                        
                    <!--</form>-->
                </div>
                <!--<button class="btn btn-primary btn-lg btn-block"-->
                                <!--type="submit" value="Log In"-->
                                <!--[style.cursor]="cursorStyle"-->
                                <!--[disabled]="!f.valid?"><span>Save</span></button>-->
                <div class="panel">
                    <h4>Get Room by ID</h4>
                    <form (ngSubmit)="onSubmit2(f2.value)" #f2="ngForm" autocomplete="off" novalidate>                
                        <div class="form-group">
                            <label>ROOM</label>
                            <input 
                                placeholder="ID ROOM"
                                [(ngModel)] = "ID"
                                name="ID"
                                ngModel
                                minlength="1"
                                pattern="[0-9]+"
                                required/>
                        </div>                            
                        <button class="btn btn-primary btn-lg btn-block"
                                type="submit" value="Log In"
                                [style.cursor]="cursorStyle"
                                [disabled]="!f2.valid"><span>Get Room</span>
                        </button>
                    </form>
                    <div>
                        <p>{{response}}</p>
                    </div>
                        
                </div>
                <div class="panel">
                    <h4>Get Room by IP</h4>
                    <form (ngSubmit)="onSubmit3(f3.value)" #f3="ngForm" autocomplete="off" novalidate>                
                        <div class="form-group">
                            <label>IP</label>
                            <input 
                                placeholder="0.0.0.0" 
                                name="IP" 
                                [(ngModel)] = "IP"
                                minlength="7"
                                maxlength="15"
                                required
                                />
                        </div>                            
                        <button class="btn btn-primary btn-lg btn-block"
                                type="submit" value="Log In"
                                [style.cursor]="cursorStyle"
                                [disabled]="!f3.valid"><span>Get Room</span>
                        </button>
                    </form>
                    <div>
                        <p>{{response}}</p>
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
        .panel{
            max-width: 650px;
            margin: 0 auto 20px;
            border-radius: 8px;
            border: 2px solid #337ab7;
            box-shadow: grey 5px 5px 10px;
            padding: 20px;
        }
        form label {
            display: block;
        }
        form input {
            padding: 5px;
            width: 95%;
        }
        form button{
            display: block;
            width: 90%;
            margin: 15px auto 0;
           
        }
        form .form-group{
            display: inline-block;
            width: 43%;
            margin: 0 5px;
        }
        .column{
            display: inline-block;
            width: 300px;
        }
        .item{
            border: 2px solid #337ab7;
        }
    `]
})
export class AppComponent implements OnInit {
    IP: string;
    ID: number;

    vers: number;

    rooms: VOIpRoom[];

    response:any;

    private url:string = "server/room-data.php?";
    private urlIpRoom:string = "server/room-data.php?ip_room=";
    private urlRoom:string = "server/room-data.php?room=";
    private urlIp:string = "server/room-data.php?ip=";

    constructor(private http:Http, private roomsService:RoomsService) { }

    ngOnInit(){
        this.roomsService.getRooms().subscribe(res=>{
            this.vers = res.vers;
            this.rooms = res.rooms;
        })
    }

    saveData(){
        var out:VOIp_Rooms = new VOIp_Rooms({
            vers: this.vers++,
            rooms: this.rooms
        });

        this.roomsService.saveRooms(out).subscribe((res:VOResult)=>{
            console.log(res);
        });
    }

    onSubmit(value:VOIpRoom){
        console.log('value', value);
        let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' }); //application/json'application/x-www-form-urlencoded'
        let options = new RequestOptions({ headers: headers });

        // return this.http.get(this.urlIpRoom+JSON.stringify(value))
        return this.http.post(this.url,value)
        // .map(this.parseOne)
        // .catch(this.handleError)
            .subscribe((res)=>{
                console.log('onSubmit res: ', res);
                // this.router.navigate(["./dashboard/content-manager",'view',0]);
                // localStorage.removeItem("myuser");
                // window.location.href = "/login";
            }, (err)=>{
                console.log('onSubmit error ', err);
                // this.handleError(err); // = <any>err;
            });
        // return this.http.get(this.url+value.ID)
        //     // .map(this.parseOne)
        //     // .catch(this.handleError)
        //     .subscribe((res)=>{
        //         console.log('onSubmit res: ', res);
        //         // this.router.navigate(["./dashboard/content-manager",'view',0]);
        //         // localStorage.removeItem("myuser");
        //         // window.location.href = "/login";
        //     }, (err)=>{
        //         console.log('onSubmit error ', err);
        //         // this.handleError(err); // = <any>err;
        //     });
    }

    onSubmit2(value:VOIpRoom){
        console.log('value', value);
        let headers = new Headers({ 'Content-Type': 'application/json' }); //'application/x-www-form-urlencoded'
        let options = new RequestOptions({ headers: headers });

        return this.http.get(this.urlRoom+value.ID)
        // return this.http.get(this.url+'ip='+value.IP+'&'+'room='+value.ID)
        // .map(this.parseOne)
        // .catch(this.handleError)
            .subscribe((res:Response)=>{
                console.log('onSubmit res: ', res);
                this.response = res.json();
                // this.router.navigate(["./dashboard/content-manager",'view',0]);
                // localStorage.removeItem("myuser");
                // window.location.href = "/login";
            }, (err)=>{
                console.log('onSubmit error ', err);
                // this.handleError(err); // = <any>err;
            });
        // return this.http.get(this.url+value.ID)
        //     // .map(this.parseOne)
        //     // .catch(this.handleError)
        //     .subscribe((res)=>{
        //         console.log('onSubmit res: ', res);
        //         // this.router.navigate(["./dashboard/content-manager",'view',0]);
        //         // localStorage.removeItem("myuser");
        //         // window.location.href = "/login";
        //     }, (err)=>{
        //         console.log('onSubmit error ', err);
        //         // this.handleError(err); // = <any>err;
        //     });
    }

    onSubmit3(value:VOIpRoom){
        console.log('value', value);
        let headers = new Headers({ 'Content-Type': 'application/json' }); //'application/x-www-form-urlencoded'
        let options = new RequestOptions({ headers: headers });

        return this.http.get(this.urlIp+value.IP)
        // return this.http.get(this.url+'ip='+value.IP+'&'+'room='+value.ID)
        // .map(this.parseOne)
        // .catch(this.handleError)
            .subscribe((res:Response)=>{
                console.log('onSubmit res: ', res);
                this.response = res;
                // this.router.navigate(["./dashboard/content-manager",'view',0]);
                // localStorage.removeItem("myuser");
                // window.location.href = "/login";
            }, (err)=>{
                console.log('onSubmit error ', err);
                // this.handleError(err); // = <any>err;
            });
        // return this.http.get(this.url+value.ID)
        //     // .map(this.parseOne)
        //     // .catch(this.handleError)
        //     .subscribe((res)=>{
        //         console.log('onSubmit res: ', res);
        //         // this.router.navigate(["./dashboard/content-manager",'view',0]);
        //         // localStorage.removeItem("myuser");
        //         // window.location.href = "/login";
        //     }, (err)=>{
        //         console.log('onSubmit error ', err);
        //         // this.handleError(err); // = <any>err;
        //     });
    }

}