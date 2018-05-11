import {Injectable} from '@angular/core';
import {environment} from "../../../environments/environment";
import { Http, Headers, Response, RequestOptions } from '@angular/http';

@Injectable()
export class IsActiveService {

    constructor(private http: Http) { }

    getData(id: number) {
        let user = JSON.parse(localStorage.getItem('currentUser'));
        let headers = new Headers({ 'Authorization': 'Bearer ' + user.token });
        let options = new RequestOptions({ headers: headers });
        var user_id = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
        //console.log(user_id);
        return this.http.get(environment.apiURL+'/user/active/'+user_id, options)
            .map((response: Response) => response.json());
        
    }
}
