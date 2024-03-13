import { Component } from '@angular/core';
import { Adherent } from '../models/adherent';
import { ApiService } from '../services/api.service';

@Component({
  selector: 'app-adherents-list',
  templateUrl: './adherents-list.component.html',
  styleUrl: './adherents-list.component.css'
})
export class AdherentsListComponent {
  loading = true;
  adherents: Adherent[] = [];
 
  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    this.apiService.getAdherents().subscribe((data: Adherent[]) => {
      this.adherents = data;
      // console.log(this.adherents);
    });

    setTimeout(() => {
      this.loading = false;

    }, 500);
  }
}
