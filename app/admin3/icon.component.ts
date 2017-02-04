import {Component, OnInit} from '@angular/core';

import './rxjs-operators';

import { Http, Response, Headers, RequestOptions } from '@angular/http';
import {VOIpRoom, RoomsService, VOIp_Rooms, VOResult, VOIcons, VOIcon} from "../rooms-service";
import {UploadService} from "./upload-service";

@Component({
    selector: 'icons-manager',
    template: `
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>Icons Manager</h1>
                </div>
            </div>
            <div class="row">
                <div class="tools">
                    <div class="col-xs-1">
                        <button class="btn btn-primary" (click) = "onAddClick()" [disabled]="addDisadled">Add</button>
                    </div>
                    <div class="col-xs-3 col-xs-offset-8 text-right">
                        <button class="btn btn-success" routerLink="" >Admin Panel</button>
                        <button class="btn btn-success" routerLink="../config-manager">Config Manager</button>
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
                                        <th>ICONS</th>
                                        <th>NAME</th>
                                        <th colspan="2">CHANGE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 1.5px;"></tr>
                                    <tr *ngFor="let item of icons" (click)="onIconClick(item)" [class.selected]="item.selected">
                                        <td class="text-center">
                                            <img src="{{item.iconPath}}">
                                        </td>
                                        <td class="text-left">
                                            <span>{{item.label_en}}</span>
                                        </td>
                                        <td class="text-center">
                                            <label *ngIf="item.selected" class="btn btn-default btn-file fa fa-download">
                                                <input style="display: none;" name='file' ngModel type='file' (change)="onChange($event,item)"/>
                                            </label>
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
       
    `]
})
export class IconsManager implements OnInit {
    toolsDisadled:boolean;
    addDisadled:boolean = true;

    icons: VOIcon[];
    currentIcon:VOIcon;

    response:any;

    constructor(
        private http:Http,
        private roomsService:RoomsService,
        private uploadService:UploadService
    ) { }

    ngOnInit(){
        if(!this.currentIcon) this.toolsDisadled = true;
        this.getIcons();

        this.roomsService.selectedIcon$.subscribe((item:VOIcon)=>{
            this.currentIcon = item;
            this.toolsDisadled = item.selected ? false : true;
        });
    }
    onDeleteItemClick(item:VOIcon){
        if(confirm('You want to delete icon "'+item.label_en+'"?')){
            this.roomsService.deleteIcon(item).subscribe((res:VOResult)=>{
                item.iconPath = item.iconPath + "?" + Date.now();
                console.log(res);
            });
        }
    }
    getIcons(){
        this.roomsService.getIcons().subscribe(res=>{
            this.icons = res.icons;
        });
    }

    onIconClick(item:VOIcon){
        this.roomsService.selectIcon(item);
    }

    onChange(evt: any, icon:VOIcon):void{
        let files:FileList = evt.target.files;
        if(files.length){
            let form:FormData = new FormData();
            let file:File = files[0];
            form.append('file',file);
            if(files[0].size<2000000){
                this.uploadService.upload(form,icon.filename).done((res:any)=>{
                    icon.iconPath = icon.iconPath + "?" + Date.now();
                    console.log(res);
                })
            }
            else alert('File should be less then 2 Megabite');
        }
    }

}