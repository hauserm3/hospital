import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule }    from '@angular/forms';
import { HttpModule, JsonpModule } from '@angular/http';

import {RoomsService} from "../rooms-service";
import {LocationStrategy, HashLocationStrategy} from "@angular/common";
import {Routes, RouterModule, Route} from "@angular/router";
import {ClientComponent} from "./client.component";
import {RoomComponent} from "./room.component";



const routes: Route[] = [
    {
        path: '',
        component:RoomComponent
    }
    // ,{
    //     path: 'room',
    //     component:RoomComponent
    // }
    // {
    //     path: 'admin-panel',
    //     component:AppComponent
    // },
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
  declarations: [ ClientComponent, RoomComponent ],
    providers:[
        RoomsService,
        { provide: LocationStrategy, useClass: HashLocationStrategy}
    ],
  bootstrap: [ ClientComponent ]
})
export class ClientModule { }
