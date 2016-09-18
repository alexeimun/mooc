import {NgModule, ModuleWithProviders} from '@angular/core';
import {CommonModule} from '@angular/common';
import {FormsModule} from '@angular/forms';
import {RouterModule} from '@angular/router';

import {NavbarComponent, FooterComponent,} from './components/index';
import {UserService} from './services/index'

/**
 * Do not specify providers for modules that might be imported by a lazy loaded module.
 */

@NgModule({
  imports : [CommonModule, RouterModule],
  declarations : [NavbarComponent, FooterComponent],
  exports : [NavbarComponent, FooterComponent, CommonModule, FormsModule, RouterModule]
})
export class SharedModule {
  static forRoot(): ModuleWithProviders
  {
    return {
      ngModule : SharedModule,
      providers : [UserService]
    };
  }
}
