import { Routes, RouterModule } from '@angular/router';

import { DeserveComponent } from './deserve.component';

const routes: Routes = [
    {
        path: '',
        component: DeserveComponent
    }
];

export const routing = RouterModule.forChild(routes);
