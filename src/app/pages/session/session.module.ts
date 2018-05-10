import { NgModule }      from '@angular/core';
import { CommonModule }  from '@angular/common';
import { FormsModule } from '@angular/forms';

import { SessionComponent } from './session.component';
import { routing } from './session.routing';
import {NgaModule} from "../../theme/nga.module";
import {Ng2SmartTableModule} from "ng2-smart-table/ng2-smart-table.module";
import {SessionService} from "./session.service";

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        routing,
        Ng2SmartTableModule,
        NgaModule,
    ],
    declarations: [
        SessionComponent
    ],
    providers: [
        SessionService
    ]
})
export class SessionModule {}
