import {Injectable} from "@angular/core";
import {Http, Response, Headers} from '@angular/http'
import {Router} from '@angular/router';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/catch';
import {urlBunch} from '../classes/index';
import {User} from '../models/index';
import 'rxjs/Rx';

@Injectable()
export class UserService extends User {

  private headers = new Headers({'Content-Type' : 'application/json', 'Accept' : 'application/json'});
  users:any;


  signOut = () =>
  {

    this.removeUser();
    setTimeout(()=>
    {
      this.router.navigateByUrl('/login');
    }, 200);
  };

  constructor(private http: Http, private router: Router)
  {
    super();
  }

  postUser(data: any): Observable<any>
  {
    return this.http.post(urlBunch.urls.user.user, JSON.stringify(data), {'headers' : this.headers}).map((res: Response) => res.json() || {}).catch(this.handleError);
  }

  validateUser(field: string, type: string): Observable<any>
  {
    return this.http.get(`${urlBunch.urls.user.valuser}?field=${field}&type=${type}`).map((res: Response) => res.json() || {}).catch(this.handleError);
  }

  userLogin(data: any): Observable<any>
  {
    return this.http.post(urlBunch.urls.user.userlogin, JSON.stringify(data), {'headers' : this.headers}).map((res: Response) => res.json() || {}).catch(this.handleError);
  }

  public getUser(key = null): User
  {
    if(key)
      return JSON.parse(localStorage.getItem('user'))[key];
    else
      return JSON.parse(localStorage.getItem('user'));
  }

  setUser(userdata: any): void
  {
    localStorage.setItem('user', JSON.stringify(userdata));
  }


  public removeUser(): void
  {
    localStorage.removeItem('user');
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
