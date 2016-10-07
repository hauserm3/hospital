import {Component, OnInit} from '@angular/core';

import './rxjs-operators';

import { Http, Response, Headers, RequestOptions } from '@angular/http';
import {VOIpRoom, RoomsService, VOIp_Rooms, VOResult} from "./rooms-service";

@Component({
    selector: 'my-app',
    template: `
        <router-outlet></router-outlet>
`
})
export class AppComponent { }