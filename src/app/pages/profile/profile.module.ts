import { NgModule }      from '@angular/core';
import { CommonModule }  from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { routing } from './profile.routing';
import {NgaModule} from "../../theme/nga.module";
import {Ng2SmartTableModule} from "ng2-smart-table/ng2-smart-table.module";
import {ProfileService} from "./profile.service";
import { ProfileComponent } from './profile.component';


@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        routing,
        Ng2SmartTableModule,
        NgaModule,
        ReactiveFormsModule
    ],
    declarations: [
        ProfileComponent
    ],
    providers: [
        ProfileService
    ]
})
export class ProfileModule {}
