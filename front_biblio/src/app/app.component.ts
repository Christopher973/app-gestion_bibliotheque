import { Component, HostListener } from '@angular/core';
import { ApiService } from './services/api.service';
import { Categorie } from './models/categorie';
import { Livre } from './models/livre';
import { Router } from '@angular/router';
import { AuthService } from './services/auth.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'front_biblio';
  categories: Categorie[] = [];
  livres: Livre[] = [];
  selectedLivres: string = '';
  
  constructor(private apiService: ApiService, public authService: AuthService, private router: Router) {}

  ngOnInit(): void {
    this.apiService.getCategories().subscribe((data: Categorie[]) => {
      this.categories = data;
    });
    
    this.apiService.getLivres().subscribe((data: Livre[]) => {
      this.livres = data;      
    });
    
  }

  @HostListener('document:keydown', ['$event'])
  handleKeyboardEvent(event: KeyboardEvent) {
    // Vérifie si la combinaison de touches est Ctrl + R
    if (event.ctrlKey && event.key === 'r') {
      // Empêche l'action par défaut de rechargement de la page
      event.preventDefault();
    }
  }

  logout() {
    this.authService.logout();
    this.router.navigateByUrl('/login');
  }

  onSearch(): void {
    if (this.selectedLivres.trim() !== '') {
      this.router.navigateByUrl('/livres/' + this.selectedLivres.trim());
    }
  }
}
