import {Component} from '@angular/core';

import {PieChartService} from './pieChart.service';

import 'easy-pie-chart/dist/jquery.easypiechart.js';
import {BaThemeConfigProvider, colorHelper} from '../../../theme';

@Component({
  selector: 'pie-chart',
  templateUrl: './pieChart.html',
  styleUrls: ['./pieChart.scss']
})
// TODO: move easypiechart to component
export class PieChart {

  public charts: Array<Object>;
  private _init = false;

  constructor(private _pieChartService: PieChartService, private _baConfig:BaThemeConfigProvider) {
    //this.charts = this._pieChartService.getData();
    let pieColor = this._baConfig.get().colors.custom.dashboardPieChart;
    this._pieChartService.getTotals().subscribe(data => {
      this.charts = [
        {
          color: pieColor,
          description: 'dashboard.no_of_students',
          stats: data.students,
          icon: 'person',
        }, {
          color: pieColor,
          description: 'dashboard.no_of_tutors',
          stats: data.tutors,
          icon: 'face',
        }, {
          color: pieColor,
          description: 'dashboard.no_of_sessions',
          stats: data.sessions,
          icon: 'person',
        }, {
          color: pieColor,
          description: 'dashboard.total_earning',
          stats: data.earning,
          icon: 'money',
        }
      ];
    });
  }

  ngAfterViewInit() {
    if (!this._init) {
      this._loadPieCharts();
      this._updatePieCharts();
      this._init = true;
    }
  }

  private _loadPieCharts() {

    jQuery('.chart').each(function () {
      let chart = jQuery(this);
      chart.easyPieChart({
        easing: 'easeOutBounce',
        onStep: function (from, to, percent) {
          jQuery(this.el).find('.percent').text(Math.round(percent));
        },
        barColor: jQuery(this).attr('data-rel'),
        trackColor: 'rgba(0,0,0,0)',
        size: 84,
        scaleLength: 0,
        animation: 2000,
        lineWidth: 9,
        lineCap: 'round',
      });
    });
  }

  private _updatePieCharts() {
    let getRandomArbitrary = (min, max) => { return Math.random() * (max - min) + min; };

    jQuery('.pie-charts .chart').each(function(index, chart) {
      jQuery(chart).data('easyPieChart').update(getRandomArbitrary(55, 90));
    });
  }
}
