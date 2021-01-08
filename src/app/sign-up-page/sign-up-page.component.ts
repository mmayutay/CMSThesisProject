import { Component, OnInit } from '@angular/core';
import { RequestsService } from '../../apiRequests/requests.service'

@Component({
  selector: 'app-sign-up-page',
  templateUrl: './sign-up-page.component.html',
  styleUrls: ['./sign-up-page.component.scss']
})
export class SignUpPageComponent implements OnInit {
  public userData = {
    Age: 0,
    Leader: '',
    Member_status: '',
    Email: '',
    Name: '',
    Password: ''  
  }

  constructor(
    private http: RequestsService
  ) { }

  ngOnInit(): void {
  }

  signUp() {
    this.http.signup(this.userData).subscribe(res => {
      console.log(res)
    })
  }

}
