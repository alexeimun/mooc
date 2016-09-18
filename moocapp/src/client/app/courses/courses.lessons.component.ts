import {Component, OnInit} from '@angular/core';
import {Course, Test, Lesson} from "../shared/models/index";
import {ActivatedRoute, Params} from "@angular/router";
import {UserService, CourseService} from "../shared/services/index";

@Component({
  moduleId : module.id,
  selector : 'app-course-lessons',
  templateUrl : 'courses.lesson.component.html',
  styleUrls : ['courses.lesson.component.css'],
})

export class CourseLessonComponent implements OnInit {

  courseName: string = '';
  lessonNumber: number = 0;
  lesson: Lesson;
  doTest: boolean = false;
  result: any = null;
  score: boolean = false;
  //Test
  ans: number = 0;
  test: Test;
  scoreMessage: string = '';
  literals: string[] = ['a', 'b', 'c', 'd', 'e', 'f'];

  ngOnInit()
  {
    this.route.params.forEach((params: Params) =>
    {
      this.lessonNumber = params['lesson'];
      this.courseName = params['course'];
      this.courseService.getLessonCourse(this.courseName, this.userService.getUser('EMAIL'), this.lessonNumber).subscribe(
        (data: any)=>
        {
          this.lesson = data.data.LESSON;
          this.result = data.data.TEST;
          this.courseService.getTest(this.lessonNumber).subscribe(
            (data: any)=>
            {
              this.test = data;
            });
        }
      );
    });
  }

  constructor(private courseService: CourseService, private route: ActivatedRoute, public userService: UserService)
  {
    this.test = new Test();
    this.lesson = new Lesson();
  }

  checkAnswears()
  {
    this.doTest = false;
    this.score = true;
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

    if(this.ans <= 5)
      this.scoreMessage = 'No has aprobado el examen para esta lección, pero puedes repasar más en la sesión material de apoyo';
    else if(this.ans <= 7)
      this.scoreMessage = '¡Felicidades! has aprobado esta lección, sin embargo, te recomendamos seguir estudiando el material de apoyo';
    else if(this.ans > 7)
      this.scoreMessage = '!Genial! has aprobado esta lección de forma exitosa.';

    this.courseService.getSaveTestScore(ans, this.courseName, this.userService.getUser('EMAIL'), this.lessonNumber).subscribe(()=>
    {
    });
  }

  changeDoTest(): void
  {
    this.doTest = true;
  }

  backLesson(): void
  {
    this.doTest = this.score = false;
  }
}
