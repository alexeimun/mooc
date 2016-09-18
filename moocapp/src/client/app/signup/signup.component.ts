import {Component} from '@angular/core';
import {Router} from '@angular/router';
import {UserService} from "../shared/services/index"

@Component({
  moduleId : module.id,
  selector : 'app-signup',
  templateUrl : 'signup.component.html',
  styleUrls : ['signup.component.css'],
})

export class SignupComponent {

  signup = {
    USERNAME : '',
    EMAIL : '',
    PASSWORD : '',
  };
  private rpassword: string = '';
  private valusername: boolean = false;
  private valemail: boolean = false;
  private reg_email: any = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  private validemail: boolean = true;

  validateEmail(email: any)
  {
    this.validemail = this.reg_email.test(email);
  }

  validateUser(field: any, type: string)
  {
    field = field.target.value;
    if(field) {
      this.userService.validateUser(field, type).subscribe(res=>
      {
        if(type == 'username')
          this.valusername = res.response;

        else if(type == 'email')
          this.valemail = res.response;
      });
    }
  }

  constructor(private router: Router, private userService: UserService)
  {
    if(userService.getUser())
      this.router.navigate(['/']);
  }

  onSubmit()
  {
    this.userService.postUser(this.signup).subscribe(response =>
      {
        this.userService.setUser(response.data);
        this.router.navigateByUrl('/');
      },
      error =>
      {
        console.log(error);
      });
  }
}
