import {Routes} from '@angular/router';

import {AboutRoutes} from './about/index';
import {LoginRoutes} from './login/index';
import {SignupRoutes} from './signup/index';
import {HomeRoutes} from './home/index';
import {CourseRoutes} from "./courses/index";

export const routes: Routes = [
  ...HomeRoutes,
  ...AboutRoutes,
  ...LoginRoutes,
  ...SignupRoutes,
  ...CourseRoutes,
]
