import {Component, OnInit} from '@angular/core';

import '../rxjs-operators';

import { Http, Response, Headers, RequestOptions } from '@angular/http';
import {VOIpRoom, RoomsService, VOIp_Rooms, VOResult, VOIcons, VOIcon} from "./rooms-service";
import {UploadService} from "./upload-service";

@Component({
    selector: 'icons-manager',
    template: `
        <div class="wrap">
            <h1>Icons Manager</h1>
            <div class="content">
            <div class="tools">
                <button class="btn btn-primary" (click) = "onAddClick()">Add</button>
                <button class="btn btn-primary" (click) = "onDeleteClick()" [disabled]="toolsDisadled">Delete</button>
                <button class="btn btn-success fright" routerLink="" >Admin Panel</button>
            </div>
                <div class="panel" *ngIf="uploadPanel">
                    <h4>Upload Files</h4>               
                        <div class="form-group">
                            <input name='files' ngModel type='file' multiple (change)="onChange($event)"/>
                        </div>                            
                    <div>
                        <p>{{response}}</p>
                    </div>  
                </div>
                <div class="panel">
                
                    <table id="tableone" class="table table-condensed table-striped">
                        <thead>
                        <tr>
                            <th>ICONS</th>
                            <th>NAME</th>
                            <th>CHANGE</th>
                        </tr>
                        </thead>
                        <tbody id="tablebody">
                            <tr *ngFor="let item of icons" (click)="onIconClick(item)" [class.selected]="item.selected">
                                <td class="myicon">
                                    <img class="icons" src="app/icons/{{item.path}}">
                                </td>
                                <td>
                                    <span>{{item.name}}</span>
                                </td>
                                <td class="myinput">
                                    <input name='file' ngModel type='file' (change)="onChange($event)"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                
                </div>
            </div>
            
        </div>
`
    ,styles:[`
        .panel{
            border-radius: 8px;
            border: 2px solid #337ab7;
            box-shadow: grey 5px 5px 10px;
            padding: 20px;
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
        img{
            max-height: 128px;
        }
        
        #tableone td{
            vertical-align: middle;
        }
        #tableone thead>tr>th{
            text-align: center;
        }
        td > img{
            max-height: 64px;
        }
    `]
})
export class IconsManager implements OnInit {
    toolsDisadled:boolean;
    uploadPanel:boolean;

    icons: VOIcon[];
    currentIcon:VOIcon;

    response:any;

    constructor(
        private http:Http,
        private roomsService:RoomsService,
        private uploadService:UploadService
    ) { }

    ngOnInit(){
        this.uploadPanel = false;
        if(!this.currentIcon) this.toolsDisadled = true;
        this.getIcons();

        this.roomsService.selectedIcon$.subscribe((item:VOIcon)=>{
            this.currentIcon = item;
            this.toolsDisadled = item.selected ? false : true;
            // console.log('this.toolsDisadled ', this.toolsDisadled);
        });
    }

    saveIcons(){

        var arrIcons:VOIcon[]=[];

        this.icons.forEach(function (item) {
            if(item.path != item.name) arrIcons.push(item);
        });

        if(!arrIcons.length) return;

        this.icons.forEach(function (item) {
            delete item.selected;
        });
        // console.log('save',arrIcons);

        var out:VOIcons = new VOIcons(
            arrIcons
        );

        // console.log('out', out);

        this.roomsService.saveIcons(out).subscribe((res:VOResult)=>{
            this.toolsDisadled = true;
            this.getIcons();
            console.log(res);
        });
    }

    onSaveClick(){
        this.saveIcons();
    }
    onAddClick(){
        this.uploadPanel = true;
    }
    onDeleteClick(){
        if(!this.currentIcon) return;
        this.toolsDisadled = true;
        this.roomsService.deleteIcon(this.currentIcon).subscribe((res:VOResult)=>{
            console.log(res);
        });
        this.getIcons();
    }
    getIcons(){
        this.roomsService.getIcons().subscribe(res=>{
            this.icons = res.icons;
        });
    }

    onAdminPanelClick(){

    }

    onIconClick(item:VOIcon){
        this.roomsService.selectIcon(item);
        // console.log('item', item);
    }

    onSubmit(value:any){
        console.log('value', value);
        let headers = new Headers({ 'Content-Type': 'multipart/form-data' }); //application/json  'application/x-www-form-urlencoded'
        let options = new RequestOptions({ headers: headers });

        // return this.http.get(this.urlIpRoom+JSON.stringify(value))
        return this.http.post('server/files_upload.php',value,options)
            .subscribe((res)=>{

            }, (err)=>{
                console.log('onSubmit error ', err);
                // this.handleError(err); // = <any>err;
            });
    }


    onChange(evt: any):void{
        var files:FileList = evt.target.files;
        console.log('files',files);
        if(files.length){
        var form:FormData = new FormData();
        var file:File = files[0];
        form.append('file',file);
        if(files[0].size<2000000){
        this.uploadService.upload(form,'fileName').done((res:any)=>{
            console.log(res);
        })
    }
    else alert('File should be less then 2 Megabite');
    }
    }
    // {
    //     let files = [].slice.call(event.target.files);
    //     console.log(event);
    //     console.log(files.map((f:any) => f.name).join(', '));
    //
    //     // console.log('value', value);
    //     let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' }); //application/json  'application/x-www-form-urlencoded'
    //     let options = new RequestOptions({ headers: headers });
    //
    //     // return this.http.get(this.urlIpRoom+JSON.stringify(value))
    //     return this.http.post('server/files_upload.php',files)
    //         .subscribe((res)=>{
    //
    //         }, (err)=>{
    //             console.log('onSubmit error ', err);
    //             // this.handleError(err); // = <any>err;
    //         });
    //
    // }


}