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
require('./rxjs-operators');
var http_1 = require('@angular/http');
var rooms_service_1 = require("../rooms-service");
var upload_service_1 = require("./upload-service");
var IconsManager = (function () {
    function IconsManager(http, roomsService, uploadService) {
        this.http = http;
        this.roomsService = roomsService;
        this.uploadService = uploadService;
        this.addDisadled = true;
    }
    IconsManager.prototype.ngOnInit = function () {
        var _this = this;
        if (!this.currentIcon)
            this.toolsDisadled = true;
        this.getIcons();
        this.roomsService.selectedIcon$.subscribe(function (item) {
            _this.currentIcon = item;
            _this.toolsDisadled = item.selected ? false : true;
        });
    };
    IconsManager.prototype.onDeleteItemClick = function (item) {
        if (confirm('You want to delete icon "' + item.label_en + '"?')) {
            this.roomsService.deleteIcon(item).subscribe(function (res) {
                item.iconPath = item.iconPath + "?" + Date.now();
                console.log(res);
            });
        }
    };
    IconsManager.prototype.getIcons = function () {
        var _this = this;
        this.roomsService.getIcons().subscribe(function (res) {
            _this.icons = res.icons;
        });
    };
    IconsManager.prototype.onIconClick = function (item) {
        this.roomsService.selectIcon(item);
    };
    IconsManager.prototype.onChange = function (evt, icon) {
        var files = evt.target.files;
        if (files.length) {
            var form = new FormData();
            var file = files[0];
            form.append('file', file);
            if (files[0].size < 2000000) {
                this.uploadService.upload(form, icon.filename).done(function (res) {
                    icon.iconPath = icon.iconPath + "?" + Date.now();
                    console.log(res);
                });
            }
            else
                alert('File should be less then 2 Megabite');
        }
    };
    IconsManager = __decorate([
        core_1.Component({
            selector: 'icons-manager',
            template: "\n        <div class=\"container\">\n            <div class=\"row\">\n                <div class=\"col-xs-12 text-center\">\n                    <h1>Icons Manager</h1>\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"tools\">\n                    <div class=\"col-xs-1\">\n                        <button class=\"btn btn-primary\" (click) = \"onAddClick()\" [disabled]=\"addDisadled\">Add</button>\n                    </div>\n                    <div class=\"col-xs-3 col-xs-offset-8 text-right\">\n                        <button class=\"btn btn-success\" routerLink=\"\" >Admin Panel</button>\n                        <button class=\"btn btn-success\" routerLink=\"../config-manager\">Config Manager</button>\n                    </div>\n                </div>\n            </div>\n            <br>\n            <div class=\"row\">\n                <div class=\"col-xs-12\">\n                    <div class=\"panel panel-default psh pb\">\n                        <div class=\"panel-body\">\n                            <table class=\"table table-condensed table-striped\">\n                                <thead>\n                                    <tr>\n                                        <th>ICONS</th>\n                                        <th>NAME</th>\n                                        <th colspan=\"2\">CHANGE</th>\n                                    </tr>\n                                </thead>\n                                <tbody>\n                                    <tr style=\"height: 1.5px;\"></tr>\n                                    <tr *ngFor=\"let item of icons\" (click)=\"onIconClick(item)\" [class.selected]=\"item.selected\">\n                                        <td class=\"text-center\">\n                                            <img src=\"{{item.iconPath}}\">\n                                        </td>\n                                        <td class=\"text-left\">\n                                            <span>{{item.label_en}}</span>\n                                        </td>\n                                        <td class=\"text-center\">\n                                            <label *ngIf=\"item.selected\" class=\"btn btn-default btn-file fa fa-download\">\n                                                <input style=\"display: none;\" name='file' ngModel type='file' (change)=\"onChange($event,item)\"/>\n                                            </label>\n                                        </td>\n                                        <td class=\"text-center\">\n                                            <a *ngIf=\"item.selected\" class=\"btn fa fa-times-circle\" (click) = \"onDeleteItemClick(item)\"></a>\n                                        </td>\n                                    </tr>\n                                </tbody>\n                            </table>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n",
            styles: ["\n       \n    "]
        }), 
        __metadata('design:paramtypes', [http_1.Http, rooms_service_1.RoomsService, upload_service_1.UploadService])
    ], IconsManager);
    return IconsManager;
}());
exports.IconsManager = IconsManager;
//# sourceMappingURL=icon.component.js.map