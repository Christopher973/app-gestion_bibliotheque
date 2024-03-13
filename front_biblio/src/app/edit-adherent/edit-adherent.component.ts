import { Component } from '@angular/core';
import { ApiService } from '../services/api.service';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';
import { Adherent } from '../models/adherent';

@Component({
  selector: 'app-edit-adherent',
  templateUrl: './edit-adherent.component.html',
  styleUrl: './edit-adherent.component.css'
})
export class EditAdherentComponent {
  adherents: Adherent[] = [];
  adherent: Adherent | undefined;
  model: any = {};

  constructor(
    private apiService: ApiService,
    private authService: AuthService,
    private router: Router
  ) {}


  ngOnInit(): void {
    if (!this.authService.currentAuthUserValue.isLogged()) {
      // Si l'utilisateur n'est pas connecté :
      // redirigez vers la page de connexion
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

  onSubmit(): void {
    console.log(this.model);
    this.apiService.editAdherent().subscribe((data: Adherent) => {
      this.adherent = this.model;
      this.adherents.forEach(adherent => {
        if(adherent.email === this.authService.currentAuthUserValue.email) {
          this.adherent = adherent;
        }
      });
    });
  }
}
