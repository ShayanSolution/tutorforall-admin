import { Routes, RouterModule } from '@angular/router';

import { SessionComponent } from './session.component';

const routes: Routes = [
    {
        path: '',
        component: SessionComponent
    }
];

export const routing = RouterModule.forChild(routes);
