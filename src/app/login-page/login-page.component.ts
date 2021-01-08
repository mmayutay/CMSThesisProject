import { Component, OnInit } from '@angular/core';
import { RequestsService } from '../../../src/apiRequests/requests.service';
import { Router } from '@angular/router'

@Component({
  selector: 'app-login-page',
  templateUrl: './login-page.component.html',
  styleUrls: ['./login-page.component.scss']
})
export class LoginPageComponent implements OnInit {
  public partialData;
  public userLogin = {
    email: '',
    password: ''
  }

  constructor(
    private http: RequestsService,
    private route: Router
  ) { }

  ngOnInit(): void {
  }

  submit() {
    this.http.login(this.userLogin).subscribe(res => {
      this.partialData = res
      if(this.partialData.length != 0){
        localStorage.setItem('current-user', this.userLogin.email)
        this.route.navigate(['dashboard'])
      }else {
        alert('An error has occured!')
      }
    })
  }

}
