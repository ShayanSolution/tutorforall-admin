import { Routes, RouterModule } from '@angular/router';

import { TutorsComponent } from './tutors.component';

const routes: Routes = [
    {
        path: '',
        component: TutorsComponent
    }
];

export const routing = RouterModule.forChild(routes);