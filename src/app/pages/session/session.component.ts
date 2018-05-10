import { Component, OnInit } from '@angular/core';
import {SessionService} from "./session.service";
import {LocalDataSource} from "ng2-smart-table/index";
import { ActivatedRoute } from '@angular/router';

@Component({
    selector: 'session',
    templateUrl: './session.html',
    styleUrls: ['./session.scss']
})
export class SessionComponent {
    query: string = '';
    userid: number;

    public settings = {
        actions: true,
        add: {
            addButtonContent: '<i class="ion-ios-plus-outline"></i>',
            createButtonContent: '<i class="ion-checkmark"></i>',
            cancelButtonContent: '<i class="ion-close"></i>',
        },
        edit: {
            editButtonContent: '<i class="ion-edit"></i>',
            saveButtonContent: '<i class="ion-checkmark"></i>',
            cancelButtonContent: '<i class="ion-close"></i>',
        },
        delete: {
            deleteButtonContent: '<i class="ion-trash-a"></i>',
            confirmDelete: true
        },
        columns: {
            firstName: {
                title: 'Student First Name',
                type: 'string'
            },
            lastName: {
                title: 'Student Last Name',
                type: 'string'
            },
            p_name: {
                title: 'Programme',
                type: 'string'
            },
            s_name: {
                title: 'Subject',
                type: 'string'
            },
            session_status: {
                title: 'Status',
                type: 'string'
            },

        }
    };

    public source: LocalDataSource = new LocalDataSource();

    constructor(private route: ActivatedRoute, protected service: SessionService) {        
        this.service.getData(this.userid).subscribe((data) => {
            this.source.load(data);
        });
    }

    ngOnInit() {
        this.route.params.subscribe(params => {
            this.userid = +params['id']; // (+) converts string 'id' to a number
            //console.log(this.userid);
            // In a real app: dispatch action to load the details here.
        });
    }

    onDeleteConfirm(event): void {
        if (window.confirm('Are you sure you want to delete?')) {
            event.confirm.resolve();
        } else {
            event.confirm.reject();
        }
    }
}
