import {Route} from '@angular/router';
import {CoursesComponent, CourseSummaryComponent,CourseLessonComponent} from "./index";
import {HomeComponent} from "../home/index";

export const CourseRoutes: Route[] = [
  {
    path : 'courses',
    component : CoursesComponent
  }, {
    path : 'courses/:course',
    component : CourseSummaryComponent
  },{
    path : 'courses/:course/:lesson',
    component : CourseLessonComponent
  },
  {
    path : '**',
    component : HomeComponent
  }
];
