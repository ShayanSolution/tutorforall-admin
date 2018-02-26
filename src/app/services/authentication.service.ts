import { Injectable } from '@angular/core';
import { Http, Headers, Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map'
import { environment } from '../../environments/environment';


@Injectable()
export class AuthenticationService {
    public token: string;

    constructor(private http: Http) {
        var currentUser = JSON.parse(localStorage.getItem('currentUser'));
        this.token = currentUser && currentUser.token;
    }

    login(values): Observable<boolean> {
        var request = Object.assign({
            grant_type: 'password',
            client_id: environment.ApiClientID,
            client_secret: environment.apiSec,
            scope: '',
        }, values);
        return this.http.post(environment.apiURL+'/login', request)
            .map((response: Response) => {
                let token = response.json() && response.json().access_token;
                if (token) {
                    this.token = token;
                    localStorage.setItem('currentUser', JSON.stringify({ username: request.username, token: token }));
                    return true;
                } else {
                    return false;
                }
            });
    }

    logout(): void {
        this.token = null;
        localStorage.removeItem('currentUser');
    }

    isLoggedIn(): boolean {
        let user = JSON.parse(localStorage.getItem('currentUser'));
        if(user && user.token){
            return true;
        }else {
            return false;
        }
    }
}