import {Component} from '@angular/core';

import {GlobalState} from '../../../global.state';

@Component({
  selector: 'ba-content-top',
  styleUrls: ['./baContentTop.scss'],
  templateUrl: './baContentTop.html',
})
export class BaContentTop {
  public isValid:boolean = false;
  public activePageTitle:string = '';

  constructor(private _state:GlobalState) {
    this._state.subscribe('menu.activeLink', (activeLink) => {
      if (activeLink) {
        this.activePageTitle = activeLink.title;
      }
      var url = window.location.href;
      var result= url.split('/');
      var Param = result[result.length-2];

      if(this.activePageTitle == 'general.menu.tutors' && Param !='session'){
        this.isValid = true;
      }else{
        this.isValid = false;
      }
    });
  }
}
