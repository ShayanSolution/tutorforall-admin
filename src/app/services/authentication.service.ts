import { Injectable } from '@angular/core';
import { Http, Headers, Response,RequestOptions } from '@angular/http';
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
            role: 'admin',
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

    register(values): Observable<boolean> {
        var request = Object.assign({
            grant_type: 'password',
            client_id: environment.ApiClientID,
            client_secret: environment.apiSec,
            scope: '',
            role: 'admin',
        }, values);

        return this.http.post(environment.apiURL+'/register-tutor', request)
            .map((response: Response) => {
                //console.log(request);
                return true;
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

    update(values,userid): Observable<boolean> {
        var request = Object.assign({
            grant_type: 'password',
            client_id: environment.ApiClientID,
            client_secret: environment.apiSec,
            scope: '',
            role: 'admin',
            userid: userid,
        }, values);

        return this.http.post(environment.apiURL+'/update-user', request)
            .map((response: Response) => {
                console.log(response);
                return true;
        });
    }
}
