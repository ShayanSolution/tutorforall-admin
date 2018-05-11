import { Routes, RouterModule } from '@angular/router';

import { IsActiveComponent } from './isactive.component';

const routes: Routes = [
    {
        path: '',
        component: IsActiveComponent
    }
];

export const routing = RouterModule.forChild(routes);
