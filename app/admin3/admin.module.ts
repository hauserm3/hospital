import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule }    from '@angular/forms';
import { HttpModule, JsonpModule } from '@angular/http';

import {AdminComponent} from "./admin.component";
import {RoomsService} from "../rooms-service";
import {LocationStrategy, HashLocationStrategy} from "@angular/common";
import {Routes, RouterModule, Route} from "@angular/router";
import {IconsManager} from "./icon.component";
import {AdminPanel} from "./panel.component";
import {UploadService} from "./upload-service";
import {ConfigManager} from "./config.component";



const routes: Route[] = [
    {
        path: '',
        component:AdminPanel
    },
    // {
    //     path: 'admin-panel',
    //     component:AppComponent
    // },
    {
        path: 'icons-manager',
        component:IconsManager
    },
    {
        path: 'config-manager',
        component:ConfigManager
    }
    // ,{
    //     path: '**',
    //     component: IconsManager
    // }
];


@NgModule({
  imports: [
      BrowserModule,
      FormsModule,
      HttpModule,
      JsonpModule,
      RouterModule.forRoot(routes)//, { useHash: true })
  ],
  declarations: [ AdminComponent, AdminPanel, IconsManager, ConfigManager],
    providers:[
        RoomsService,
        UploadService,
        { provide: LocationStrategy, useClass: HashLocationStrategy}
    ],
  bootstrap: [ AdminComponent ]
})
export class AdminModule { }
