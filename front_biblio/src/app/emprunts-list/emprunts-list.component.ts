import { Component } from '@angular/core';
import { Emprunt } from '../models/emprunt';
import { ApiService } from '../services/api.service';

@Component({
  selector: 'app-emprunts-list',
  templateUrl: './emprunts-list.component.html',
  styleUrl: './emprunts-list.component.css'
})
export class EmpruntsListComponent {
  emprunts: Emprunt[] = [];
 
  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    this.apiService.getEmprunt().subscribe((data: Emprunt[]) => {
      this.emprunts = data;
    });
  }
}
