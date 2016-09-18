import {Component, OnInit} from '@angular/core';
import {CourseService} from "../shared/services/courses.service";
import {Course} from "../shared/models/Course";
import {ActivatedRoute, Params} from "@angular/router";

/**
 * This class represents the lazy loaded HomeComponent.
 */
@Component({
  moduleId : module.id,
  selector : 'app-course',
  templateUrl : 'courses.component.html',
  styleUrls : ['courses.component.css'],
})

export class CoursesComponent implements OnInit {

  courses: Course[];
  errorMessage: string;

  ngOnInit()
  {
    this.getCourses();
  }

  constructor(private courseService: CourseService, private route: ActivatedRoute)
  {
  }

  getCourses()
  {
    this.courseService.getCourses().subscribe(
      (courses: any) =>
      {
        this.courses = courses;
      },
      error => this.errorMessage = <any>error
    );
  }
}
