import { NgModule }      from '@angular/core';
import { CommonModule }  from '@angular/common';
import { FormsModule } from '@angular/forms';

import { DeserveComponent } from './deserve.component';
import { routing } from './deserve.routing';
import {NgaModule} from "../../theme/nga.module";
import {Ng2SmartTableModule} from "ng2-smart-table/ng2-smart-table.module";
import {DeserveService} from "./deserve.service";

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        routing,
        Ng2SmartTableModule,
        NgaModule,
    ],
    declarations: [
        DeserveComponent
    ],
    providers: [
        DeserveService
    ]
})
export class DeserveModule {}
