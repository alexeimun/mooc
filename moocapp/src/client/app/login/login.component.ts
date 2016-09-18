import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {UserService} from "../shared/services/index"
import {Subject} from "rxjs/Rx";

declare var jQuery: any;
//declare var gapi: any;

@Component({
  moduleId : module.id,
  selector : 'app-login',
  templateUrl : 'login.component.html',
  styleUrls : ['login.component.css'],
})

export class LoginComponent implements OnInit {

  login = {
    USER_AUTH : '',
    PASSWORD : '',
  };

  ngOnInit()
  {
    //console.log(this.routeSegment.getParam('id'));
  }

  constructor(private router: Router, public userService: UserService)
  {
    if(userService.getUser())
      this.router.navigate(['/']);
    this.userService.onSignIn();
  }

  onSubmit()
  {
    this.userService.userLogin(this.login).subscribe(response =>
      {
        if(response.status == true) {
          this.userService.setUser(response.data);
          this.router.navigateByUrl('/');
        }
        else {
          jQuery('#badlogin').show(500);
          setTimeout(() => jQuery('#badlogin').hide(800), 3000);
        }
      },
      () =>
      {
        jQuery('#badlogin').show(500);
        setTimeout(() => jQuery('#badlogin').hide(800), 3000);
      });
  }
}
