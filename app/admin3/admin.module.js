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
var platform_browser_1 = require('@angular/platform-browser');
var forms_1 = require('@angular/forms');
var http_1 = require('@angular/http');
var admin_component_1 = require("./admin.component");
var rooms_service_1 = require("../rooms-service");
var common_1 = require("@angular/common");
var router_1 = require("@angular/router");
var icon_component_1 = require("./icon.component");
var panel_component_1 = require("./panel.component");
var upload_service_1 = require("./upload-service");
var config_component_1 = require("./config.component");
var routes = [
    {
        path: '',
        component: panel_component_1.AdminPanel
    },
    // {
    //     path: 'admin-panel',
    //     component:AppComponent
    // },
    {
        path: 'icons-manager',
        component: icon_component_1.IconsManager
    },
    {
        path: 'config-manager',
        component: config_component_1.ConfigManager
    }
];
var AdminModule = (function () {
    function AdminModule() {
    }
    AdminModule = __decorate([
        core_1.NgModule({
            imports: [
                platform_browser_1.BrowserModule,
                forms_1.FormsModule,
                http_1.HttpModule,
                http_1.JsonpModule,
                router_1.RouterModule.forRoot(routes) //, { useHash: true })
            ],
            declarations: [admin_component_1.AdminComponent, panel_component_1.AdminPanel, icon_component_1.IconsManager, config_component_1.ConfigManager],
            providers: [
                rooms_service_1.RoomsService,
                upload_service_1.UploadService,
                { provide: common_1.LocationStrategy, useClass: common_1.HashLocationStrategy }
            ],
            bootstrap: [admin_component_1.AdminComponent]
        }), 
        __metadata('design:paramtypes', [])
    ], AdminModule);
    return AdminModule;
}());
exports.AdminModule = AdminModule;
//# sourceMappingURL=admin.module.js.map