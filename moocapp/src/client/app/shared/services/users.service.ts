import {Injectable} from "@angular/core";
import {Http, Response, Headers} from '@angular/http'
import {Router} from '@angular/router';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/catch';
import {urlBunch} from '../classes/index';
import {User} from '../models/index';
import {AngularFire, AuthProviders, AuthMethods, FirebaseListObservable} from "angularfire2/angularfire2";

@Injectable()
export class UserService extends User {

  private headers = new Headers({'Content-Type' : 'application/json', 'Accept' : 'application/json'});
  users: FirebaseListObservable<any[]>;

  login()
  {
    this.af.auth.login({
      provider : AuthProviders.Google,
      method : AuthMethods.Popup,
    })
  }

  logout()
  {
    this.af.auth.logout();
  }

  signOut = () =>
  {

    if(this.googleUser()) {
      this.logout();
    }
    this.removeUser();
    setTimeout(()=>
    {
      this.router.navigateByUrl('/login');
    }, 200);
  };

  onSignIn()
  {
    //this.users = this.af.database.list('users');
    //this.users.subscribe(data => console.log())
    this.af.auth.subscribe(auth =>
    {
      if(auth) {
        let gl = {
          TOKEN_ID : auth.auth.refreshToken,
          NAME : auth.auth.displayName,
          EMAIL : auth.auth.email,
          IMAGE_URL : auth.auth.photoURL,
          TYPE_USER : 1
        };
        this.postUser(gl).subscribe(res =>
          {
            if(res.status == true) {
              this.setUser(res.data);
              this.router.navigateByUrl('/');
            }
            else {
              console.log('there was an error!');
            }
          },
          error =>
          {
            console.log(error);
          });
      }
      else console.log('youre out');
    });
  }

  constructor(private http: Http, private router: Router, public af: AngularFire)
  {
    super();
  }

  pushUser(data: any)
  {
    this.users = this.af.database.list('users');
    //this.users.set(data);

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

  googleUser(): boolean
  {
    return this.getUser().hasOwnProperty('TYPE_USER');
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
