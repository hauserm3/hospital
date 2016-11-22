import {Component, OnInit} from '@angular/core';

import './rxjs-operators';

import { Http, Response, Headers, RequestOptions } from '@angular/http';
import {VOIpRoom, RoomsService, VOIp_Rooms, VOResult, VOIcons, VOIcon, VOSettings} from "../rooms-service";
import {UploadService} from "./upload-service";

@Component({
    selector: 'config-manager',
    template: `
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>Config Manager</h1>
                </div>
            </div>
            <div class="row">
                <div class="tools">
                    <div class="col-xs-1">
                        <button class="btn btn-primary" (click) = "onAddClick()" [disabled]="addDisadled">Add</button>
                    </div>
                    <div class="col-xs-3 col-xs-offset-8 text-right">
                        <button class="btn btn-success" routerLink="" >Admin Panel</button>
                        <button class="btn btn-success" routerLink="../icons-manager">Icons Manager</button>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default psh pb">
                        <div class="panel-body">
                            <table class="table table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th>background</th>
                                        <th>NAME</th>
                                        <th colspan="2">CHANGE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 1.5px;"></tr>
                                    <!--<tr (click)="onItemClick(item)" [class.selected]="selected">-->
                                    <tr (click)="onItemClick(item)">
                                        <td class="text-center img_128">
                                            <img src="{{background_path}}">
                                        </td>
                                        <td class="text-center">
                                            <span><strong>background</strong></span>
                                        </td>
                                        <td class="text-center">
                                            <!--<label *ngIf="selected" class="btn btn-default btn-file fa fa-download">-->
                                            <label class="btn btn-default btn-file fa fa-download">
                                                <input style="display: none;" name='file' ngModel type='file' (change)="onChange($event,background_name)"/>
                                            </label>
                                        </td>
                                        <!--<td class="text-center">-->
                                            <!--<a *ngIf="selected" class="btn fa fa-times-circle" (click) = "onDeleteItemClick(item)"></a>-->
                                        <!--</td>-->
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
       
    `]
})
export class ConfigManager implements OnInit {
    background_path: string =  VOSettings.background_path;
    background_name: string =  VOSettings.background_name;
    // selected: boolean = false;
    addDisadled:boolean = true;

    currentIcon:VOIcon;

    response:any;

    constructor(
        private http:Http,
        private roomsService:RoomsService,
        private uploadService:UploadService
    ) { }

    ngOnInit(){ }

    onItemClick(item:VOIcon){
        // this.selected = true;
        // console.log('item', item);
    }

    // onDeleteItemClick(item:VOIcon){
    //     if(confirm('You want to delete background ?')){
    //         this.roomsService.deleteIcon(item).subscribe((res:VOResult)=>{
    //             // this.getIcons();
    //             item.iconPath = item.iconPath + "?" + Date.now();
    //             console.log(res);
    //         });
    //     }
    // }

    onChange(evt: any, background_name:string):void{
        var files:FileList = evt.target.files;
        console.log('files',files);
        // console.log('filename', filename);
        if(files.length){
            var form:FormData = new FormData();
            var file:File = files[0];
            form.append('file',file);
            if(files[0].size<2000000){
                this.uploadService.upload(form,background_name).done((res:any)=>{
                    // this.getIcons();
                    this.background_path = this.background_path + "?" + Date.now();
                    console.log(res);
                })
            }
            else alert('File should be less then 2 Megabite');
        }
    }

}