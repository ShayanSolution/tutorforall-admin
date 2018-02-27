import { NgModule }      from '@angular/core';
import { CommonModule }  from '@angular/common';
import { FormsModule } from '@angular/forms';

import { StudentsComponent } from './students.component';
import { routing } from './students.routing';
import { StudentsService } from "./students.service";
import { Ng2SmartTableModule } from "ng2-smart-table";
import {NgaModule} from "../../theme/nga.module";

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        routing,
        Ng2SmartTableModule,
        NgaModule,
    ],
    declarations: [
        StudentsComponent
    ],
    providers: [
        StudentsService
    ]
})
export class StudentsModule {}