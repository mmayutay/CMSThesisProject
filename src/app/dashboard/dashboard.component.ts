import { Component, OnInit } from '@angular/core';
import { RequestsService } from '../../apiRequests/requests.service';
import { Router} from '@angular/router';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {
  public userProfile;

  constructor(
    private http: RequestsService,
    private router: Router
  ) { }

  ngOnInit(): void {
  }

  getAllProfileData() {
    this.http.getUserInfo({Email: localStorage.getItem('current-user')}).subscribe((data) => {
      console.log(data)
      this.userProfile = data
    })
  }
  logout() {
    localStorage.clear()
    this.router.navigate(['login'])
  }

}
