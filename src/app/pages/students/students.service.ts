import {Injectable} from '@angular/core';
import {environment} from "../../../environments/environment";
import { Http, Headers, Response, RequestOptions } from '@angular/http';

@Injectable()
export class StudentsService {

    constructor(private http: Http) { }

    getData() {
        let user = JSON.parse(localStorage.getItem('currentUser'));
        let headers = new Headers({ 'Authorization': 'Bearer ' + user.token });
        let options = new RequestOptions({ headers: headers });

        return this.http.get(environment.apiURL+'/get-students', options)
            .map((response: Response) => response.json());
    }
}
