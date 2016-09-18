import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {SharedModule} from '../shared/shared.module';
import {SignupComponent} from './signup.component';
import {UserService} from "../shared/services/index";
import {FormsModule} from "@angular/forms";
import {BrowserModule} from "@angular/platform-browser";

@NgModule({
  imports : [CommonModule, SharedModule, BrowserModule, FormsModule],
  declarations : [SignupComponent],
  exports : [SignupComponent],
  providers : [UserService]
})

export class SignupModule {

}
