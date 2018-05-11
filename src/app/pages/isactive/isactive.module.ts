import { NgModule }      from '@angular/core';
import { CommonModule }  from '@angular/common';
import { FormsModule } from '@angular/forms';

import {IsActiveComponent } from './isactive.component';
import { routing } from './isactive.routing';
import {NgaModule} from "../../theme/nga.module";
import {Ng2SmartTableModule} from "ng2-smart-table/ng2-smart-table.module";
import {IsActiveService} from "./isactive.service";

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        routing,
        Ng2SmartTableModule,
        NgaModule,
    ],
    declarations: [
        IsActiveComponent
    ],
    providers: [
        IsActiveService
    ]
})
export class IsActiveModule {}
