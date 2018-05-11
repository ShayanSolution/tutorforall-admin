import { NgModule }      from '@angular/core';
import { CommonModule }  from '@angular/common';
import { FormsModule } from '@angular/forms';

import {RemoveComponent } from './remove.component';
import { routing } from './remove.routing';
import {NgaModule} from "../../theme/nga.module";
import {Ng2SmartTableModule} from "ng2-smart-table/ng2-smart-table.module";
import {RemoveService} from "./remove.service";

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        routing,
        Ng2SmartTableModule,
        NgaModule,
    ],
    declarations: [
        RemoveComponent
    ],
    providers: [
        RemoveService
    ]
})
export class RemoveModule {}
