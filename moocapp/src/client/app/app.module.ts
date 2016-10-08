import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';
import {APP_BASE_HREF} from '@angular/common';
import {RouterModule} from '@angular/router';
import {HttpModule} from '@angular/http';
import {AppComponent} from './app.component';
import {routes} from './app.routes';

import {AboutModule} from './about/about.module';
import {HomeModule} from './home/home.module';
import {LoginModule} from './login/login.module';
import {SharedModule} from './shared/shared.module';
import {SignupModule} from './signup/signup.module';
import {CoursesModule} from "./courses/courses.module";


@NgModule({
  imports : [BrowserModule, HttpModule, RouterModule.forRoot(routes),
    AboutModule, HomeModule, LoginModule, SignupModule, CoursesModule,
    SharedModule.forRoot()],
  declarations : [AppComponent],
  providers : [{
    provide : APP_BASE_HREF,
    useValue : '<%= APP_BASE %>'
  }
  ],
  bootstrap : [AppComponent]

})

export class AppModule {
}
