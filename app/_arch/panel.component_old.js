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
var AdminPanel = (function () {
    function AdminPanel(http, roomsService) {
        this.http = http;
        this.roomsService = roomsService;
        this.url = "server/room-data.php?";
        this.urlIpRoom = "server/room-data.php?ip_room=";
        this.urlRoom = "server/room-data.php?room=";
        this.urlIp = "server/room-data.php?ip=";
    }
    AdminPanel.prototype.ngOnInit = function () {
        var _this = this;
        if (!this.currentItem)
            this.toolsDisadled = true;
        this.getData();
        this.roomsService.selectedItem$.subscribe(function (item) {
            _this.currentItem = item;
            _this.toolsDisadled = item.selected ? false : true;
            // console.log('this.toolsDisadled ', this.toolsDisadled);
        });
    };
    AdminPanel.prototype.saveData = function () {
        var _this = this;
        this.rooms.forEach(function (item) {
            delete item.selected;
        });
        var out = new rooms_service_1.VOIp_Rooms({
            vers: this.vers++,
            rooms: this.rooms
        });
        console.log('out', out);
        this.roomsService.saveRooms(out).subscribe(function (res) {
            _this.toolsDisadled = true;
            console.log(res);
        });
    };
    AdminPanel.prototype.onSaveClick = function () {
        this.saveData();
    };
    AdminPanel.prototype.onAddClick = function () {
        this.rooms.push(new rooms_service_1.VOIpRoom({ IP: '', ID: '' }));
    };
    AdminPanel.prototype.onDeleteClick = function () {
        if (!this.currentItem)
            return;
        this.toolsDisadled = true;
        this.roomsService.deleteRoom(this.currentItem).subscribe(function (res) {
            console.log(res);
        });
        this.getData();
    };
    AdminPanel.prototype.getData = function () {
        var _this = this;
        this.roomsService.getRooms().subscribe(function (res) {
            _this.vers = res.vers;
            _this.rooms = res.rooms;
        });
    };
    AdminPanel.prototype.onManagerClick = function () {
    };
    AdminPanel.prototype.onIpRoomClick = function (item) {
        this.roomsService.selectItem(item);
        // console.log('item', item);
    };
    AdminPanel = __decorate([
        core_1.Component({
            selector: 'admin-panel',
            template: "\n        <div class=\"wrap\">\n            <h1>Admin panel</h1>\n            <div class=\"content\">\n            <div class=\"tools\">\n                <button class=\"btn btn-primary\" (click) = \"onSaveClick()\">Save</button>\n                <button class=\"btn btn-primary\" (click) = \"onAddClick()\">Add</button>\n                <button class=\"btn btn-primary\" (click) = \"onDeleteClick()\" [disabled]=\"toolsDisadled\">Delete</button>\n                <button class=\"btn btn-success fright\" routerLink=\"icons-manager\">Icons Manager</button>\n            </div>\n                <div class=\"panel\">\n                    <div class=\"ip-room-item\" *ngFor=\"let item of rooms\" (click)=\"onIpRoomClick(item)\" [class.selected]=\"item.selected\">\n                        <div class=\"form-group\">\n                            <label>IP</label>\n                            <!--<div contenteditable=\"true\">{{item.IP}}</div>-->\n                            <!--<div contenteditable=\"true\">{{item.ID}}</div>-->\n                            <input \n                                placeholder=\"0.0.0.0\" \n                                name=\"IP\" \n                                [(ngModel)] = \"item.IP\"\n                                minlength=\"7\"\n                                maxlength=\"15\"\n                                required\n                                />\n                        </div>\n                        <div class=\"form-group\">\n                            <label>ROOM</label>\n                            <input \n                                placeholder=\"ID ROOM\"\n                                [(ngModel)] = \"item.ID\"\n                                name=\"ID\"\n                                ngModel\n                                minlength=\"1\"\n                                pattern=\"[0-9]+\"\n                                required/>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n",
            styles: ["\n        .wrap{\n            position: relative;\n            height: 100%;\n            text-align: center;\n        }\n        .tools{\n            margin: 0 auto 10px;\n            max-width: 650px;\n            text-align: initial;\n        }\n        .panel{\n            max-width: 650px;\n            margin: 0 auto 20px;\n            border-radius: 8px;\n            border: 2px solid #337ab7;\n            box-shadow: grey 5px 5px 10px;\n            padding: 20px;\n        }\n\n        .form-group{\n            display: inline-block;\n            width: 45%;\n            margin: 0 5px;\n        }\n        .column{\n            display: inline-block;\n            width: 300px;\n        }\n        .item{\n            border: 2px solid #337ab7;\n        }\n        .ip-room-item{\n            border-radius: 8px;\n            border: 2px solid #337ab7;\n            box-shadow: grey 5px 5px 10px;\n            padding: 7px 0;\n            margin: 0 0 5px;\n        }\n        .selected{\n            border: 2px solid #ff7e00;\n        }\n        label{\n            margin-right: 5px;\n        }\n        input{\n            padding: 0 5px;\n        }\n        .fright{\n            float: right;\n        }\n    "]
        }), 
        __metadata('design:paramtypes', [http_1.Http, (typeof (_a = typeof rooms_service_1.RoomsService !== 'undefined' && rooms_service_1.RoomsService) === 'function' && _a) || Object])
    ], AdminPanel);
    return AdminPanel;
    var _a;
}());
exports.AdminPanel = AdminPanel;
//# sourceMappingURL=panel.component_old.js.map