import { Component } from '@angular/core';
import { Auteur } from '../models/auteur';
import { ApiService } from '../services/api.service';

@Component({
  selector: 'app-auteurs-list',
  templateUrl: './auteurs-list.component.html',
  styleUrl: './auteurs-list.component.css'
})
export class AuteursListComponent {
  loading = true;
  auteurs: Auteur[] = [];
 
  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    this.apiService.getAuteurs().subscribe((data: Auteur[]) => {
      this.auteurs = data;
      console.log(this.auteurs);
    });
    setTimeout(() => {
      this.loading = false;

    }, 500);
  }
}
