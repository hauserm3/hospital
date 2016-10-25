"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
require('../rxjs-operators');
var http_1 = require('@angular/http');
var rooms_service_1 = require("./rooms-service");
var AppComponent = (function () {
    function AppComponent(http, roomsService) {
        this.http = http;
        this.roomsService = roomsService;
        this.url = "server/room-data.php?";
        this.urlIpRoom = "server/room-data.php?ip_room=";
        this.urlRoom = "server/room-data.php?room=";
        this.urlIp = "server/room-data.php?ip=";
    }
    AppComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.roomsService.getRooms().subscribe(function (res) {
            _this.vers = res.vers;
            _this.rooms = res.rooms;
        });
    };
    AppComponent.prototype.saveData = function () {
        var out = new rooms_service_1.VOIp_Rooms({
            vers: this.vers++,
            rooms: this.rooms
        });
        this.roomsService.saveRooms(out).subscribe(function (res) {
            console.log(res);
        });
    };
    AppComponent.prototype.onSubmit = function (value) {
        console.log('value', value);
        var headers = new http_1.Headers({ 'Content-Type': 'application/x-www-form-urlencoded' }); //application/json'application/x-www-form-urlencoded'
        var options = new http_1.RequestOptions({ headers: headers });
        // return this.http.get(this.urlIpRoom+JSON.stringify(value))
        return this.http.post(this.url, value)
            .subscribe(function (res) {
            console.log('onSubmit res: ', res);
            // this.router.navigate(["./dashboard/content-manager",'view',0]);
            // localStorage.removeItem("myuser");
            // window.location.href = "/login";
        }, function (err) {
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
    };
    AppComponent.prototype.onSubmit2 = function (value) {
        var _this = this;
        console.log('value', value);
        var headers = new http_1.Headers({ 'Content-Type': 'application/json' }); //'application/x-www-form-urlencoded'
        var options = new http_1.RequestOptions({ headers: headers });
        return this.http.get(this.urlRoom + value.ID)
            .subscribe(function (res) {
            console.log('onSubmit res: ', res);
            _this.response = res.json();
            // this.router.navigate(["./dashboard/content-manager",'view',0]);
            // localStorage.removeItem("myuser");
            // window.location.href = "/login";
        }, function (err) {
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
    };
    AppComponent.prototype.onSubmit3 = function (value) {
        var _this = this;
        console.log('value', value);
        var headers = new http_1.Headers({ 'Content-Type': 'application/json' }); //'application/x-www-form-urlencoded'
        var options = new http_1.RequestOptions({ headers: headers });
        return this.http.get(this.urlIp + value.IP)
            .subscribe(function (res) {
            console.log('onSubmit res: ', res);
            _this.response = res;
            // this.router.navigate(["./dashboard/content-manager",'view',0]);
            // localStorage.removeItem("myuser");
            // window.location.href = "/login";
        }, function (err) {
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
    };
    AppComponent = __decorate([
        core_1.Component({
            selector: 'my-app',
            template: "\n        <div class=\"wrap\">\n            <h1>Admin panel</h1>\n            <div class=\"content\">\n                <div class=\"panel\" *ngFor=\"let item of rooms\">\n                    <!--<form (ngSubmit)=\"onSubmit(f.value)\" #f=\"ngForm\" autocomplete=\"off\" novalidate>                -->\n                        <div class=\"form-group\">\n                            <label>IP</label>\n                            <!--<div contenteditable=\"true\">{{item.IP}}</div>-->\n                            <!--<div contenteditable=\"true\">{{item.ID}}</div>-->\n                            <input \n                                placeholder=\"0.0.0.0\" \n                                name=\"IP\" \n                                [(ngModel)] = \"item.IP\"\n                                minlength=\"7\"\n                                maxlength=\"15\"\n                                required\n                                />\n                        </div>\n                        <div class=\"form-group\">\n                            <label>ROOM</label>\n                            <input \n                                placeholder=\"ID ROOM\"\n                                [(ngModel)] = \"item.ID\"\n                                name=\"ID\"\n                                ngModel\n                                minlength=\"1\"\n                                pattern=\"[0-9]+\"\n                                required/>\n                        </div>                            \n                        \n                    <!--</form>-->\n                </div>\n                <!--<button class=\"btn btn-primary btn-lg btn-block\"-->\n                                <!--type=\"submit\" value=\"Log In\"-->\n                                <!--[style.cursor]=\"cursorStyle\"-->\n                                <!--[disabled]=\"!f.valid?\"><span>Save</span></button>-->\n                <div class=\"panel\">\n                    <h4>Get Room by ID</h4>\n                    <form (ngSubmit)=\"onSubmit2(f2.value)\" #f2=\"ngForm\" autocomplete=\"off\" novalidate>                \n                        <div class=\"form-group\">\n                            <label>ROOM</label>\n                            <input \n                                placeholder=\"ID ROOM\"\n                                [(ngModel)] = \"ID\"\n                                name=\"ID\"\n                                ngModel\n                                minlength=\"1\"\n                                pattern=\"[0-9]+\"\n                                required/>\n                        </div>                            \n                        <button class=\"btn btn-primary btn-lg btn-block\"\n                                type=\"submit\" value=\"Log In\"\n                                [style.cursor]=\"cursorStyle\"\n                                [disabled]=\"!f2.valid\"><span>Get Room</span>\n                        </button>\n                    </form>\n                    <div>\n                        <p>{{response}}</p>\n                    </div>\n                        \n                </div>\n                <div class=\"panel\">\n                    <h4>Get Room by IP</h4>\n                    <form (ngSubmit)=\"onSubmit3(f3.value)\" #f3=\"ngForm\" autocomplete=\"off\" novalidate>                \n                        <div class=\"form-group\">\n                            <label>IP</label>\n                            <input \n                                placeholder=\"0.0.0.0\" \n                                name=\"IP\" \n                                [(ngModel)] = \"IP\"\n                                minlength=\"7\"\n                                maxlength=\"15\"\n                                required\n                                />\n                        </div>                            \n                        <button class=\"btn btn-primary btn-lg btn-block\"\n                                type=\"submit\" value=\"Log In\"\n                                [style.cursor]=\"cursorStyle\"\n                                [disabled]=\"!f3.valid\"><span>Get Room</span>\n                        </button>\n                    </form>\n                    <div>\n                        <p>{{response}}</p>\n                    </div>\n                        \n                </div>\n            </div>\n        </div>\n",
            styles: ["\n        .wrap{\n            position: relative;\n            height: 100%;\n            text-align: center;\n        }\n        .panel{\n            max-width: 650px;\n            margin: 0 auto 20px;\n            border-radius: 8px;\n            border: 2px solid #337ab7;\n            box-shadow: grey 5px 5px 10px;\n            padding: 20px;\n        }\n        form label {\n            display: block;\n        }\n        form input {\n            padding: 5px;\n            width: 95%;\n        }\n        form button{\n            display: block;\n            width: 90%;\n            margin: 15px auto 0;\n           \n        }\n        form .form-group{\n            display: inline-block;\n            width: 43%;\n            margin: 0 5px;\n        }\n        .column{\n            display: inline-block;\n            width: 300px;\n        }\n        .item{\n            border: 2px solid #337ab7;\n        }\n    "]
        }), 
        __metadata('design:paramtypes', [http_1.Http, (typeof (_a = typeof rooms_service_1.RoomsService !== 'undefined' && rooms_service_1.RoomsService) === 'function' && _a) || Object])
    ], AppComponent);
    return AppComponent;
    var _a;
}());
exports.AppComponent = AppComponent;
//# sourceMappingURL=app.component_orig.js.map