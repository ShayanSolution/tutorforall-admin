import { NgModule }      from '@angular/core';
import { CommonModule }  from '@angular/common';
import { FormsModule } from '@angular/forms';

import { TutorsComponent } from './tutors.component';
import { routing } from './tutors.routing';

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        routing
    ],
    declarations: [
        TutorsComponent
    ]
})
export class TutorsModule {}