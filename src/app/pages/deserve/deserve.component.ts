import { Component, OnInit } from '@angular/core';
import {DeserveService} from "./deserve.service";
import {LocalDataSource} from "ng2-smart-table/index";
import { ActivatedRoute } from '@angular/router';
import {environment} from "../../../environments/environment";
@Component({
    selector: 'deserve',
    templateUrl: './deserve.html',
    styleUrls: ['./deserve.scss']
})
export class DeserveComponent {
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
            actions: //or something
            {
                title:'Actions',
                type:'html',
                valuePrepareFunction:(cell,row)=>{
                    return `<a title="deserving" href="/#/pages/deserve/${row.id}"> 
                            <i class="ion-settings student-detail"></i></a>`
                },
                filter:false
            },
        }
    };

    public source: LocalDataSource = new LocalDataSource();

    constructor(private route: ActivatedRoute, protected service: DeserveService) {        
        this.service.getData(this.userid).subscribe((data) => {
            this.source.load(data);
        });
        window.location.href='http://tutor4all-admin.shayansolutions.com/#/pages/students';
    }

    ngOnInit() {
        this.route.params.subscribe(params => {
            this.userid = +params['id']; // (+) converts string 'id' to a number
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
