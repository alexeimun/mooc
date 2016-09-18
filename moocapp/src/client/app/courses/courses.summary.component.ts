import {Component, OnInit} from '@angular/core';
import {Course, Test} from "../shared/models/index";
import {ActivatedRoute, Params} from "@angular/router";
import {UserService, CourseService} from "../shared/services/index";

@Component({
  moduleId : module.id,
  selector : 'app-course-summary',
  templateUrl : 'courses.summary.component.html',
  styleUrls : ['courses.summary.component.css'],
})

export class CourseSummaryComponent implements OnInit {

  course: Course = null;
  exists: boolean = true;
  prevtest: boolean = false;
  courseName: string = '';
  //Prev test
  test: Test;
  literals: string[] = ['a', 'b', 'c', 'd', 'e', 'f'];
  ans: number = 0;
  scoreMessage: string = '';
  score: boolean = false;
  attempt: number = 0;

  checkAnswears()
  {
    var ans = 0;
    this.test.body.forEach(function (e)
    {
      if(e.hasOwnProperty('submit')) {
        if(e.answear == e.submit) {
          ans++;
        }
      }
    });
    this.ans = ans;
    this.score = true;
    this.prevtest = false;
    var score = (ans / this.test.body.length) * 100;
    console.log(score);
    if(score < 60)
      this.scoreMessage = 'No has aprobado el examen para esta lección, pero puedes repasar más en la sesión material de apoyo';
    else if(score <= 70)
      this.scoreMessage = '¡Felicidades! has aprobado esta lección, sin embargo, te recomendamos seguir estudiando el material de apoyo';
    else if(score > 70)
      this.scoreMessage = '!Genial! has aprobado esta lección de forma exitosa.';
    if(score >= 60)
      this.courseService.getSaveScore(ans, this.courseName, this.userService.getUser('EMAIL')).subscribe(() =>
      {
      });

    this.courseService.getResgisterAttempt(this.courseName, this.userService.getUser('EMAIL')).subscribe(() =>
    {
    });
  }

  ngOnInit()
  {
    this.route.params.forEach((params: Params) =>
    {
      this.courseName = params['course'];
      this.courseService.getCheckCourse(this.courseName, this.userService.getUser('EMAIL')).subscribe(
        (data: any)=>
        {
          this.exists = data.status;
          this.course = data.data;
          this.prevtest = data.data.PREV_TEST;
          if(this.prevtest) {
            this.courseService.getAttempt(this.courseName, this.userService.getUser('EMAIL')).subscribe((data: any) =>
            {
              this.attempt = data.data;
              if(this.attempt == 3) {
                this.prevtest = false
              }
            });
            this.courseService.getPrevTest().subscribe(
              (data: any)=>
              {
                this.test = data;
              });
          }
        }
      );
    });
  }

  constructor(private courseService: CourseService, private route: ActivatedRoute, public userService: UserService)
  {
    this.test = new Test();
    this.course = new Course();
  }

  backLesson(): void
  {
    this.score = false;
    this.prevtest = true;
    this.attempt++;
  }

  goLessons(): void
  {
    this.score = this.prevtest = false;
  }
}
