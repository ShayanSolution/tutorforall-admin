import { NgModule }      from '@angular/core';
import { CommonModule }  from '@angular/common';
import { FormsModule } from '@angular/forms';

import { TutorsComponent } from './tutors.component';
import { routing } from './tutors.routing';
import {NgaModule} from "../../theme/nga.module";
import {Ng2SmartTableModule} from "ng2-smart-table/ng2-smart-table.module";
import {TutorsService} from "./tutors.service";

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        routing,
        Ng2SmartTableModule,
        NgaModule,
    ],
    declarations: [
        TutorsComponent
    ],
    providers: [
        TutorsService
    ]
})
export class TutorsModule {}