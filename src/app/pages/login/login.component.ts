import {Component} from '@angular/core';
import {FormGroup, AbstractControl, FormBuilder, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import {AuthenticationService} from "../../services/index";

@Component({
  selector: 'login',
  templateUrl: './login.html',
  styleUrls: ['./login.scss']
})
export class Login {

  public form:FormGroup;
  public username:AbstractControl;
  public password:AbstractControl;
  public submitted:boolean = false;
  public error = {status: true, msg: ''};

  constructor(
      fb:FormBuilder,
      private router : Router,
      private authenticationService: AuthenticationService
  ) {
    this.form = fb.group({
      'username': ['', Validators.compose([Validators.required, Validators.minLength(4)])],
      'password': ['', Validators.compose([Validators.required, Validators.minLength(4)])]
    });

    this.username = this.form.controls['username'];
    this.password = this.form.controls['password'];
  }

  public onSubmit(values : Object) : void {
    this.submitted = true;
    if (this.form.valid) {

      this.authenticationService.login(values)
      .subscribe(result => {
        if (result === true) {
          this.router.navigateByUrl('pages');
        }else{
          this.error.status = true;
          this.error.msg = 'Username or password is incorrect';
        }
      });

    }
  }
}
