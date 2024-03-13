import { Component } from '@angular/core';
import { Livre } from '../models/livre';
import { ApiService } from '../services/api.service';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-livres-list',
  templateUrl: './livres-list.component.html',
  styleUrl: './livres-list.component.css'
})
export class LivresListComponent {
  loading = true;
  livres: Livre[] = [];
  logged: boolean = false;
 
  constructor(private apiService: ApiService, private authService: AuthService) {}

  ngOnInit(): void {
    if (this.authService.currentAuthUserValue.isLogged()) {
      this.logged = true;
    }

    this.apiService.getLivres().subscribe((data: Livre[]) => {
      this.livres = data;
    });

    setTimeout(() => {
      this.loading = false;

    }, 500);
  }
}
