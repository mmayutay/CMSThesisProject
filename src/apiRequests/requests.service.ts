import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http'

@Injectable({
  providedIn: 'root'
})
export class RequestsService {
  public url = "http://localhost:8000/api/"

  constructor(
    private httpClient: HttpClient
  ) { }
  
  login(userdata) {
    return this.httpClient.post(this.url+'login', userdata)
  }
  signup(userdata) {
    return this.httpClient.post(this.url+'sign-up', userdata)
  }
  getUserInfo(userEmail) {
    return this.httpClient.post(this.url+'userProfile', userEmail)
  }

}
