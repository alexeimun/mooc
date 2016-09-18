import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {SharedModule} from '../shared/shared.module';
import {CoursesComponent, CourseSummaryComponent, CourseLessonComponent} from './index';
import {CourseService} from "../shared/services/index";

@NgModule({
  imports : [CommonModule, SharedModule],
  declarations : [CoursesComponent, CourseSummaryComponent, CourseLessonComponent],
  exports : [CoursesComponent, CourseSummaryComponent, CourseLessonComponent],
  providers : [CourseService]
})
export class CoursesModule {
}
