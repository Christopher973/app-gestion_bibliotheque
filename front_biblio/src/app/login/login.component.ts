import { Component } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';
                    
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  model: any = {};

  constructor(
    private authService: AuthService,
    private router: Router
  ) {}
  onSubmit() {
    this.authService.login(this.model.email, this.model.password)
      .subscribe({
        next: data => {
          this.router.navigate(['/']);
        },
        error: err => {
          console.error('Erreur lors de la connexion', err);
        }
  });
  }
}
