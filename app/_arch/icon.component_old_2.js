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
var upload_service_1 = require("./upload-service");
var IconsManager = (function () {
    function IconsManager(http, roomsService, uploadService) {
        this.http = http;
        this.roomsService = roomsService;
        this.uploadService = uploadService;
    }
    IconsManager.prototype.ngOnInit = function () {
        var _this = this;
        this.uploadPanel = false;
        if (!this.currentIcon)
            this.toolsDisadled = true;
        this.getIcons();
        this.roomsService.selectedIcon$.subscribe(function (item) {
            _this.currentIcon = item;
            _this.toolsDisadled = item.selected ? false : true;
            // console.log('this.toolsDisadled ', this.toolsDisadled);
        });
    };
    IconsManager.prototype.saveIcons = function () {
        var _this = this;
        var arrIcons = [];
        this.icons.forEach(function (item) {
            if (item.path != item.name)
                arrIcons.push(item);
        });
        if (!arrIcons.length)
            return;
        this.icons.forEach(function (item) {
            delete item.selected;
        });
        // console.log('save',arrIcons);
        var out = new rooms_service_1.VOIcons(arrIcons);
        // console.log('out', out);
        this.roomsService.saveIcons(out).subscribe(function (res) {
            _this.toolsDisadled = true;
            _this.getIcons();
            console.log(res);
        });
    };
    IconsManager.prototype.onSaveClick = function () {
        this.saveIcons();
    };
    IconsManager.prototype.onAddClick = function () {
        this.uploadPanel = true;
    };
    IconsManager.prototype.onDeleteClick = function () {
        if (!this.currentIcon)
            return;
        this.toolsDisadled = true;
        this.roomsService.deleteIcon(this.currentIcon).subscribe(function (res) {
            console.log(res);
        });
        this.getIcons();
    };
    IconsManager.prototype.getIcons = function () {
        var _this = this;
        this.roomsService.getIcons().subscribe(function (res) {
            _this.icons = res.icons;
        });
    };
    IconsManager.prototype.onAdminPanelClick = function () {
    };
    IconsManager.prototype.onIconClick = function (item) {
        this.roomsService.selectIcon(item);
        // console.log('item', item);
    };
    IconsManager.prototype.onSubmit = function (value) {
        console.log('value', value);
        var headers = new http_1.Headers({ 'Content-Type': 'multipart/form-data' }); //application/json  'application/x-www-form-urlencoded'
        var options = new http_1.RequestOptions({ headers: headers });
        // return this.http.get(this.urlIpRoom+JSON.stringify(value))
        return this.http.post('server/files_upload.php', value, options)
            .subscribe(function (res) {
        }, function (err) {
            console.log('onSubmit error ', err);
            // this.handleError(err); // = <any>err;
        });
    };
    IconsManager.prototype.onChange = function (evt) {
        var files = evt.target.files;
        console.log('files', files);
        if (files.length) {
            var form = new FormData();
            var file = files[0];
            form.append('file', file);
            if (files[0].size < 2000000) {
                this.uploadService.upload(form, 'fileName').done(function (res) {
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
            template: "\n        <div class=\"wrap\">\n            <h1>Icons Manager</h1>\n            <div class=\"content\">\n            <div class=\"tools\">\n                <button class=\"btn btn-primary\" (click) = \"onAddClick()\">Add</button>\n                <button class=\"btn btn-primary\" (click) = \"onDeleteClick()\" [disabled]=\"toolsDisadled\">Delete</button>\n                <button class=\"btn btn-success fright\" routerLink=\"\" >Admin Panel</button>\n            </div>\n                <div class=\"panel\" *ngIf=\"uploadPanel\">\n                    <h4>Upload Files</h4>               \n                        <div class=\"form-group\">\n                            <input name='files' ngModel type='file' multiple (change)=\"onChange($event)\"/>\n                        </div>                            \n                    <div>\n                        <p>{{response}}</p>\n                    </div>  \n                </div>\n                <div class=\"panel\">\n                \n                    <table id=\"tableone\" class=\"table table-condensed table-striped\">\n                        <thead>\n                        <tr>\n                            <th>ICONS</th>\n                            <th>NAME</th>\n                            <th>CHANGE</th>\n                        </tr>\n                        </thead>\n                        <tbody id=\"tablebody\">\n                            <tr *ngFor=\"let item of icons\" (click)=\"onIconClick(item)\" [class.selected]=\"item.selected\">\n                                <td class=\"myicon\">\n                                    <img class=\"icons\" src=\"app/icons/{{item.path}}\">\n                                </td>\n                                <td>\n                                    <span>{{item.name}}</span>\n                                </td>\n                                <td class=\"myinput\">\n                                    <input name='file' ngModel type='file' (change)=\"onChange($event)\"/>\n                                </td>\n                            </tr>\n                        </tbody>\n                    </table>\n                \n                </div>\n            </div>\n            \n        </div>\n",
            styles: ["\n        .panel{\n            border-radius: 8px;\n            border: 2px solid #337ab7;\n            box-shadow: grey 5px 5px 10px;\n            padding: 20px;\n        }\n\n        .selected{\n            border: 2px solid #ff7e00;\n        }\n        label{\n            margin-right: 5px;\n        }\n        input{\n            padding: 0 5px;\n        }\n        .fright{\n            float: right;\n        }\n        img{\n            max-height: 128px;\n        }\n        \n        #tableone td{\n            vertical-align: middle;\n        }\n        #tableone thead>tr>th{\n            text-align: center;\n        }\n        td > img{\n            max-height: 64px;\n        }\n    "]
        }), 
        __metadata('design:paramtypes', [http_1.Http, (typeof (_a = typeof rooms_service_1.RoomsService !== 'undefined' && rooms_service_1.RoomsService) === 'function' && _a) || Object, (typeof (_b = typeof upload_service_1.UploadService !== 'undefined' && upload_service_1.UploadService) === 'function' && _b) || Object])
    ], IconsManager);
    return IconsManager;
    var _a, _b;
}());
exports.IconsManager = IconsManager;
//# sourceMappingURL=icon.component_old_2.js.map