import { Component } from '@angular/core';
import { Categorie } from '../models/categorie';
import { ApiService } from '../services/api.service';

@Component({
  selector: 'app-categories-list',
  templateUrl: './categories-list.component.html',
  styleUrl: './categories-list.component.css'
})
export class CategoriesListComponent {
  categories: Categorie[] = [];
 
  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    this.apiService.getCategories().subscribe((data: Categorie[]) => {
      this.categories = data;
    });
  }
}
