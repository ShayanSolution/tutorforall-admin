import { Component } from '@angular/core';
import {StudentsService} from "./students.service";
import {LocalDataSource} from "ng2-smart-table/index";

@Component({
    selector: 'students',
    templateUrl: './students.html',
    styleUrls: ['./students.scss']
})
export class StudentsComponent {
    query: string = '';

    settings = {
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
            email: {
                title: 'E-mail',
                type: 'string'
            },
            age: {
                title: 'Age',
                type: 'number'
            }
        }
    };

    source: LocalDataSource = new LocalDataSource();

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
}