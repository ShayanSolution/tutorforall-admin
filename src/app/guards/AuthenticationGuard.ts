import { Injectable } from '@angular/core';
import { CanActivate } from '@angular/router';
import {AuthenticationService} from "../services/index";

@Injectable()
export class AuthenticationGuard implements CanActivate {

    constructor(private authService: AuthenticationService) {}

    canActivate() {
        return this.authService.isLoggedIn();
    }
}