import { Component } from '@angular/core';
import { ApiService } from '../services/api.service';
import { ActivatedRoute } from '@angular/router';
import { Livre } from '../models/livre';

@Component({
  selector: 'app-livres-by-category',
  templateUrl: './livres-by-category.component.html',
  styleUrl: './livres-by-category.component.css'
})
export class LivresByCategoryComponent {
  loading = true;
  livres: Livre[] = [];

  constructor(private apiService: ApiService, private route: ActivatedRoute) {}

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      const nomCategorie = params['titre'];
      if (nomCategorie) {
        this.loadLivres(nomCategorie);
      }
    });

    const nomCategorie = this.route.snapshot.params['nomCategorie'];

    if (nomCategorie) {
      this.apiService.getLivresByCategory(nomCategorie).subscribe((data: Livre[]) => {
        this.livres = data;
        console.log(this.livres);
        
      });

      setTimeout(() => {
        this.loading = false;
  
      }, 800);
    }
  }

  loadLivres(nomCategorie: string): void {
    this.apiService.getLivresByCategory(nomCategorie).subscribe((data: Livre[]) => {
      this.livres = data;
      this.loading = false;
    });
  }
}
