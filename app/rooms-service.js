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
/**
 * Created by админ on 23.09.2016.
 */
var core_1 = require("@angular/core");
var http_1 = require("@angular/http");
var Rx_1 = require("rxjs/Rx");
var RoomsService = (function () {
    function RoomsService(http) {
        this.http = http;
        this.selectedItemSubject = new Rx_1.Subject();
        this.selectedItem$ = this.selectedItemSubject.asObservable();
        this.selectedIconSubject = new Rx_1.Subject();
        this.selectedIcon$ = this.selectedIconSubject.asObservable();
    }
    RoomsService.prototype.getRooms = function () {
        return this.http.get(VOSettings.save_rooms_path).map(function (res) {
            // console.log('res', res);
            return new VOIp_Rooms(res.json());
        });
    };
    RoomsService.prototype.getIcons = function () {
        return this.http.get(VOSettings.get_icons_path).map(function (res) {
            return new VOIcons(res.json());
        });
    };
    RoomsService.prototype.saveRooms = function (data) {
        return this.http.post(VOSettings.save_rooms_path, data).map(function (res) {
            return new VOResult(res.json());
        });
    };
    RoomsService.prototype.saveIcons = function (icons) {
        return this.http.post(VOSettings.save_icons_path, icons).map(function (res) {
            return new VOResult(res.json());
        });
    };
    RoomsService.prototype.deleteRoom = function (data) {
        delete data.selected;
        return this.http.post(VOSettings.delete_room_path, data).map(function (res) {
            return new VOResult(res.json());
        });
    };
    RoomsService.prototype.deleteIcon = function (icon) {
        delete icon.selected;
        return this.http.post(VOSettings.delete_icon_path, icon).map(function (res) {
            return new VOResult(res.json());
        });
    };
    RoomsService.prototype.selectItem = function (item) {
        if (this.selectedItem)
            this.selectedItem.selected = false;
        this.selectedItem = item;
        this.selectedItem.selected = true;
        this.selectedItemSubject.next(item);
    };
    RoomsService.prototype.selectIcon = function (item) {
        if (this.selectedICon)
            this.selectedICon.selected = false;
        this.selectedICon = item;
        this.selectedICon.selected = true;
        this.selectedIconSubject.next(item);
    };
    RoomsService = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [http_1.Http])
    ], RoomsService);
    return RoomsService;
}());
exports.RoomsService = RoomsService;
var VOIpRoom = (function () {
    function VOIpRoom(obj) {
        for (var str in obj)
            this[str] = obj[str];
    }
    return VOIpRoom;
}());
exports.VOIpRoom = VOIpRoom;
var VOIp_Rooms = (function () {
    function VOIp_Rooms(obj) {
        for (var str in obj)
            this[str] = obj[str];
        if (this.rooms)
            this.rooms = this.rooms.map(function (item) {
                return new VOIpRoom(item);
            });
    }
    return VOIp_Rooms;
}());
exports.VOIp_Rooms = VOIp_Rooms;
var VOIcon = (function () {
    function VOIcon(obj) {
        for (var str in obj)
            this[str] = obj[str];
        this.iconPath = this.iconPath + "?" + Date.now(); //getTime();
    }
    return VOIcon;
}());
exports.VOIcon = VOIcon;
var VOIcons = (function () {
    function VOIcons(obj) {
        for (var str in obj)
            this[str] = obj[str];
        if (this.icons)
            this.icons = this.icons.map(function (item) {
                return new VOIcon(item);
            });
    }
    return VOIcons;
}());
exports.VOIcons = VOIcons;
var VORoom3 = (function () {
    function VORoom3(obj) {
        for (var str in obj)
            this[str] = obj[str];
    }
    return VORoom3;
}());
exports.VORoom3 = VORoom3;
var VOSettings = (function () {
    function VOSettings() {
    }
    VOSettings.background_path = 'app/img/background.png';
    VOSettings.background_name = 'background.png';
    VOSettings.save_rooms_path = 'api/save_rooms.php';
    VOSettings.save_icons_path = 'api/save_icons.php'; // deprecated ???
    VOSettings.delete_room_path = 'api/delete_room.php';
    VOSettings.delete_icon_path = 'api/delete_icon.php';
    VOSettings.get_icons_path = 'api/get_icons.php';
    return VOSettings;
}());
exports.VOSettings = VOSettings;
var VOResult = (function () {
    function VOResult(obj) {
        for (var str in obj)
            this[str] = obj[str];
    }
    return VOResult;
}());
exports.VOResult = VOResult;
//# sourceMappingURL=rooms-service.js.map