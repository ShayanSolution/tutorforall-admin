import { Component } from '@angular/core';
import { StudentsService } from "./students.service";
import { LocalDataSource } from 'ng2-smart-table';
import {environment} from "../../../environments/environment";

@Component({
    selector: 'students',
    templateUrl: './students.html',
    styleUrls: ['./students.scss']

})
export class StudentsComponent {
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
            is_deserving: {
                title: 'Deserving',
                type: 'string'
            },
            is_active: {
                title: 'Active',
                type: 'string'
            },
            actions: //or something
            {
                title:'Actions',
                type:'html',
                valuePrepareFunction:(cell,row)=>{
                    return `<a title="deserving" href="/#/pages/deserve/${row.id}"> 
                            <i class="ion-settings student-detail"></i></a>
                            |<a title="active/inactive" href="/#/pages/active/${row.id}"> 
                            <i class="ion-contrast student-detail"></i></a>
                            |<a title="delete" href="/#/pages/remove/${row.id}"> 
                            <i class="ion-close student-detail"></i></a>`
                },
                filter:true
            },
        }
    };

    public source: LocalDataSource = new LocalDataSource();

    constructor(protected service: StudentsService) {
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

    doSomething() {
        alert();
    }
}
