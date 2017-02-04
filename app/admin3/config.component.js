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
var ConfigManager = (function () {
    function ConfigManager(http, roomsService, uploadService) {
        this.http = http;
        this.roomsService = roomsService;
        this.uploadService = uploadService;
        this.background_path = rooms_service_1.VOSettings.background_path;
        this.background_name = rooms_service_1.VOSettings.background_name;
        // selected: boolean = false;
        this.addDisadled = true;
    }
    ConfigManager.prototype.ngOnInit = function () { };
    ConfigManager.prototype.onItemClick = function (item) {
        // this.selected = true;
        // console.log('item', item);
    };
    // onDeleteItemClick(item:VOIcon){
    //     if(confirm('You want to delete background ?')){
    //         this.roomsService.deleteIcon(item).subscribe((res:VOResult)=>{
    //             item.iconPath = item.iconPath + "?" + Date.now();
    //             console.log(res);
    //         });
    //     }
    // }
    ConfigManager.prototype.onChange = function (evt, background_name) {
        var _this = this;
        var files = evt.target.files;
        if (files.length) {
            var form = new FormData();
            var file = files[0];
            form.append('file', file);
            if (files[0].size < 2000000) {
                this.uploadService.upload(form, background_name).done(function (res) {
                    _this.background_path = _this.background_path + "?" + Date.now();
                    console.log(res);
                });
            }
            else
                alert('File should be less then 2 Megabite');
        }
    };
    ConfigManager = __decorate([
        core_1.Component({
            selector: 'config-manager',
            template: "\n        <div class=\"container\">\n            <div class=\"row\">\n                <div class=\"col-xs-12 text-center\">\n                    <h1>Config Manager</h1>\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"tools\">\n                    <div class=\"col-xs-1\">\n                        <button class=\"btn btn-primary\" (click) = \"onAddClick()\" [disabled]=\"addDisadled\">Add</button>\n                    </div>\n                    <div class=\"col-xs-3 col-xs-offset-8 text-right\">\n                        <button class=\"btn btn-success\" routerLink=\"\" >Admin Panel</button>\n                        <button class=\"btn btn-success\" routerLink=\"../icons-manager\">Icons Manager</button>\n                    </div>\n                </div>\n            </div>\n            <br>\n            <div class=\"row\">\n                <div class=\"col-xs-12\">\n                    <div class=\"panel panel-default psh pb\">\n                        <div class=\"panel-body\">\n                            <table class=\"table table-condensed table-striped\">\n                                <thead>\n                                    <tr>\n                                        <th>background</th>\n                                        <th>NAME</th>\n                                        <th colspan=\"2\">CHANGE</th>\n                                    </tr>\n                                </thead>\n                                <tbody>\n                                    <tr style=\"height: 1.5px;\"></tr>\n                                    <tr (click)=\"onItemClick(item)\">\n                                        <td class=\"text-center img_128\">\n                                            <img src=\"{{background_path}}\">\n                                        </td>\n                                        <td class=\"text-center\">\n                                            <span><strong>background</strong></span>\n                                        </td>\n                                        <td class=\"text-center\">\n                                            <label class=\"btn btn-default btn-file fa fa-download\">\n                                                <input style=\"display: none;\" name='file' ngModel type='file' (change)=\"onChange($event,background_name)\"/>\n                                            </label>\n                                        </td>\n                                    </tr>\n                                </tbody>\n                            </table>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n",
            styles: ["\n       \n    "]
        }), 
        __metadata('design:paramtypes', [http_1.Http, rooms_service_1.RoomsService, upload_service_1.UploadService])
    ], ConfigManager);
    return ConfigManager;
}());
exports.ConfigManager = ConfigManager;
//# sourceMappingURL=config.component.js.map