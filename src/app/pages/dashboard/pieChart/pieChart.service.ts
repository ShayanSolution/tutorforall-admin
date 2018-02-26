import {Injectable} from '@angular/core';
import {BaThemeConfigProvider, colorHelper} from '../../../theme';
import { Http, Headers, Response, RequestOptions } from '@angular/http';
import {environment} from "../../../../environments/environment";

@Injectable()
export class PieChartService {

  constructor(private _baConfig:BaThemeConfigProvider, private http: Http) { }

  getData() {
    let pieColor = this._baConfig.get().colors.custom.dashboardPieChart;
    return [
      {
        color: pieColor,
        description: 'dashboard.no_of_students',
        stats: '12',
        percent: 20,
        icon: 'person',
      }, {
        color: pieColor,
        description: 'dashboard.no_of_tutors',
        stats: '178,391',
        percent: 30,
        icon: 'face',
      }
    ];
  }

  getTotals() {
    let user = JSON.parse(localStorage.getItem('currentUser'));
    let headers = new Headers({ 'Authorization': 'Bearer ' + user.token });
    let options = new RequestOptions({ headers: headers });

    return this.http.get(environment.apiURL+'/dashboard-pie-chart-totals', options)
        .map((response: Response) => response.json());
  }

}
