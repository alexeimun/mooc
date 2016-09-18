import {Injectable} from "@angular/core";
import {Http, Response, Headers} from '@angular/http'
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/catch';
import {urlBunch} from '../classes/index';
import {} from '../models/Course'
import {Course} from "../models/Course";

@Injectable()
export class CourseService {

  private headers = new Headers({'Content-Type' : 'application/json', 'Accept' : 'application/json'});

  constructor(private http: Http)
  {
  }

  getCourses(): Observable<Course[]>
  {
    return this.http.get(urlBunch.urls.course.courses).map((res: Response) => res.json()).catch(this.handleError);
  }

  getPrevTest(): Observable<any>
  {
    return this.http.get(urlBunch.urls.test.prevtest).map((res: Response) => res.json()).catch(this.handleError);
  }

  getTest(lesson: number): Observable<any>
  {
    return this.http.get(`${urlBunch.urls.test.test}${lesson}.json`).map((res: Response) => res.json()).catch(this.handleError);
  }

  getCheckCourse(course_url, user_email): Observable<any>
  {
    return this.http.get(`${urlBunch.urls.course.checkcourse}?course_url=${course_url}&user_email=${user_email}`).map((res: Response) => res.json()).catch(this.handleError);
  }

  getLessonCourse(course_url, user_email, lesson): Observable<any>
  {
    return this.http.get(`${urlBunch.urls.course.checkcourse}?course_url=${course_url}&lesson=${lesson}&user_email=${user_email}`).map((res: Response) => res.json()).catch(this.handleError);
  }

  getSaveScore(score, course_url, user_email): Observable<any>
  {
    return this.http.get(`${urlBunch.urls.test.postprevtest}?score=${score}&course_url=${course_url}&user_email=${user_email}`).map((res: Response) => res.json()).catch(this.handleError);
  }

  getSaveTestScore(score, course_url, user_email, lesson): Observable<any>
  {
    return this.http.get(`${urlBunch.urls.test.posttest}?score=${score}&course_url=${course_url}&user_email=${user_email}&lesson=${lesson}`).map((res: Response) => res.json()).catch(this.handleError);
  }

  getResgisterAttempt(course_url, user_email): Observable<any>
  {
    return this.http.get(`${urlBunch.urls.test.registerattempt}?course_url=${course_url}&user_email=${user_email}`).map((res: Response) => res.json()).catch(this.handleError);
  }
  getAttempt(course_url, user_email): Observable<any>
  {
    return this.http.get(`${urlBunch.urls.test.attempt}?course_url=${course_url}&user_email=${user_email}`).map((res: Response) => res.json()).catch(this.handleError);
  }
  private handleError(error: any)
  {
    // In a real world app, we might use a remote logging infrastructure
    // We'd also dig deeper into the error to get a better message
    let errMsg = (error.message) ? error.message :
      error.status ? `${error.status} - ${error.statusText}` :'Server error';
    console.error(errMsg); // log to console instead
    return Observable.throw(errMsg);
  }
}
