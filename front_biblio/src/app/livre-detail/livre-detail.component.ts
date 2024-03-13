import { Component } from '@angular/core';
import { ApiService } from '../services/api.service';
import { ActivatedRoute } from '@angular/router';
import { Livre } from '../models/livre';

@Component({
  selector: 'app-livre-detail',
  templateUrl: './livre-detail.component.html',
  styleUrl: './livre-detail.component.css'
})
export class LivreDetailComponent {
  loading = true;
  livres: Livre[] = [];

  constructor(private apiService: ApiService, private route: ActivatedRoute) {}

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      const titre = params['titre'];
      if (titre) {
        this.loadLivres(titre);
      }
    });

    const titre = this.route.snapshot.params['titre'];

    if (titre) {
      this.apiService.getLivreByTitre(titre).subscribe((data: Livre[]) => {
        this.livres = data;
      });

      setTimeout(() => {
        this.loading = false;
  
      }, 800);
    }
  }

  loadLivres(titre: string): void {
    this.apiService.getLivreByTitre(titre).subscribe((data: Livre[]) => {
      this.livres = data;
      this.loading = false;
    });
  }
}
