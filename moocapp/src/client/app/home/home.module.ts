import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {SharedModule} from '../shared/shared.module';
import {HomeComponent} from './home.component';
import {MobileComponent, SliderComponent} from '../shared/components/home/index';

@NgModule({
  imports : [CommonModule, SharedModule],
  declarations : [HomeComponent, MobileComponent, SliderComponent],
  exports : [HomeComponent, MobileComponent, SliderComponent],
})
export class HomeModule {
}
