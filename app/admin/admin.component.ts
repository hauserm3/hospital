import {Component} from '@angular/core';

import '../rxjs-operators';

@Component({
    selector: 'my-admin',
    template: `
        <router-outlet></router-outlet>
`
})
export class AdminComponent { }