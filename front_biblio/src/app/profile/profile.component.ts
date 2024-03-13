import { Component } from '@angular/core';
import { ApiService } from '../services/api.service';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { Adherent } from '../models/adherent';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.css'
})
export class ProfileComponent {
  adherents: Adherent[] = [];
  adherent: Adherent | undefined;

  constructor(
    private apiService: ApiService,
    private authService: AuthService,
    private router: Router
  ) {}

  ngOnInit(): void {
    if (!this.authService.currentAuthUserValue.isLogged()) {
      this.router.navigate(['/login']);
      return;
    }

    this.apiService.getAdherents().subscribe((data: Adherent[]) => {
      this.adherents = data;
      this.adherents.forEach(adherent => {
        if(adherent.email === this.authService.currentAuthUserValue.email) {
          this.adherent = adherent;
        }
      });
    });
  }
}
