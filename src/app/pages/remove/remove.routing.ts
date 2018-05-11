import { Routes, RouterModule } from '@angular/router';

import { RemoveComponent } from './remove.component';

const routes: Routes = [
    {
        path: '',
        component: RemoveComponent
    }
];

export const routing = RouterModule.forChild(routes);
