import { Component, OnInit } from '@angular/core';
import {ProfileService} from "./profile.service";
import {LocalDataSource} from "ng2-smart-table/index";
import { ActivatedRoute } from '@angular/router';
import {environment} from "../../../environments/environment";
import {FormGroup, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import {AuthenticationService} from "../../services/index";
import {EmailValidator, EqualPasswordsValidator} from '../../theme/validators';

@Component({
    selector: 'profile',
    templateUrl: './profile.html',
    styleUrls: ['./profile.scss']
})
export class ProfileComponent {
    query: string = '';
    userid: number;
    fullName: String;
    email: String;
    phone: String;
    public submitted:boolean = false;
    public form:FormGroup;
    public passwords:FormGroup;

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
            email: {
                title: 'Email',
                type: 'string'
            },
            phone: {
                title: 'Phone',
                type: 'string'
            }

        }
    };

    public source: LocalDataSource = new LocalDataSource();

    constructor(private route: ActivatedRoute,
                protected service:
                ProfileService,fb:FormBuilder,
                private authenticationService: AuthenticationService) {

        this.form = fb.group({
            'name': ['', Validators.compose([Validators.required, Validators.minLength(4)])],
            'email': ['', Validators.compose([Validators.required, EmailValidator.validate])],
            'phone': ['', Validators.compose([Validators.required])],
            'passwords': fb.group({
                'password': ['', Validators.compose([Validators.required, Validators.minLength(4)])],
                'repeatPassword': ['', Validators.compose([Validators.required, Validators.minLength(4)])]
            }, {validator: EqualPasswordsValidator.validate('password', 'repeatPassword')})
        });

        this.service.getData().subscribe((data) => {
            console.log(data[0]);
            this.userid = data[0].id;
            this.fullName = data[0].firstName+" "+data[0].lastName;
            this.email = data[0].email;
            this.phone = data[0].phone;
            this.source.load(data);
        });


        //window.location.href='http://localhost:4200/#/pages/students';
    }

    onDeleteConfirm(event): void {
        if (window.confirm('Are you sure you want to delete?')) {
            event.confirm.resolve();
        } else {
            event.confirm.reject();
        }
    }

    public onSubmit(values:Object):void {
        console.log(values)
        this.submitted = true;
        this.authenticationService.update(values)
            .subscribe(result => {
                if (result === true) {
                    alert('User updated Successfully');
                }
       });
        
    }
}
