import { Component } from '@angular/core';
import {TutorsService} from "./tutors.service";
import {LocalDataSource} from "ng2-smart-table/index";

@Component({
    selector: 'tutors',
    templateUrl: './tutors.html',
    styleUrls: ['./tutors.scss'],
})
export class TutorsComponent {
    query: string = '';

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
            id: {
                title: 'ID',
                type: 'number'
            },
            firstName: {
                title: 'First Name',
                type: 'string'
            },
            lastName: {
                title: 'Last Name',
                type: 'string'
            },
            username: {
                title: 'Username',
                type: 'string'
            },
            email: {
                title: 'E-mail',
                type: 'string'
            },
            city: {
                title: 'City',
                type: 'string'
            },
            country: {
                title: 'Country',
                type: 'string'
            },
            is_active: {
                title: 'Active',
                type: 'string'
            },
            actions: //or something
            {
                title:'Detail',
                type:'html',
                valuePrepareFunction:(cell,row)=>{
                    return `<a title="Session Detail" href="/#/pages/session/${row.id}"> 
                            <i class="ion-ios-eye session-detail"></i></a>
                            |<a title="active/inactive" href="/#/pages/active/tutor/${row.id}"> 
                            <i class="ion-contrast session-detail"></i></a>
                            |<a title="delete" href="/#/pages/remove/tutor/${row.id}"> 
                            <i class="ion-close session-detail"></i></a>`
                },
                filter:false
            },
        }
    };

    public source: LocalDataSource = new LocalDataSource();

    constructor(protected service: TutorsService) {
        this.service.getData().subscribe((data) => {
            this.source.load(data);
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
