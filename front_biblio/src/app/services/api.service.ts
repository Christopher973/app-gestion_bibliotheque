import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Livre } from '../models/livre';
import { Observable } from 'rxjs';
import { Adherent } from '../models/adherent';
import { Auteur } from '../models/auteur';
import { Categorie } from '../models/categorie';
import { Emprunt } from '../models/emprunt';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private apiUrl = 'http://localhost:8000/api'; // URL de notre API
   
  constructor(
    private http: HttpClient
  ) {}

  // Lister les adherents
  getAdherents(): Observable<Adherent[]> {
    return this.http.get<Adherent[]>(`${this.apiUrl}/adherents`);
  }

  getAdherent(email: string): Observable<Adherent> {
    return this.http.get<Adherent>(`${this.apiUrl}/adherent/${email}`);
    // return this.http.get<Adherent>(`${this.apiUrl}/adherent/:id`);
  }

  editAdherent(): Observable<Adherent> {
    return this.http.get<Adherent>(`${this.apiUrl}/adherent/edit`);
  }

  // Ajouter un adherent
  addAdherent(adherent: Adherent): Observable<Adherent> {
    return this.http.post<Adherent>(`${this.apiUrl}/adherents`, adherent);
  }

  // Lister les auteurs
  getAuteurs(): Observable<Auteur[]> {
    return this.http.get<Auteur[]>(`${this.apiUrl}/auteurs`);
  }

  // Ajouter un livre
  addAuteur(auteur: Auteur): Observable<Auteur> {
    return this.http.post<Auteur>(`${this.apiUrl}/auteurs`, auteur);
  }

  // Lister les categories
  getCategories(): Observable<Categorie[]> {
    return this.http.get<Categorie[]>(`${this.apiUrl}/categories`);
  }

  // Ajouter une catégorie
  addCategorie(categorie: Categorie): Observable<Categorie> {
    return this.http.post<Categorie>(`${this.apiUrl}/categories`, categorie);
  }

  // Lister les emprunts
  getEmprunt(): Observable<Emprunt[]> {
    return this.http.get<Emprunt[]>(`${this.apiUrl}/emprunts`);
  }
  
  // Ajouter un emprunt
  addEmprunt(emprunt: Emprunt): Observable<Emprunt> {
    return this.http.post<Emprunt>(`${this.apiUrl}/emprunts`, emprunt);
  }

  // Lister les livres
  getLivres(): Observable<Livre[]> {
    return this.http.get<Livre[]>(`${this.apiUrl}/livres`);
  }

  // Lister un livre selon son id
  getLivreByTitre(titre: string): Observable<Livre[]> {
    return this.http.get<Livre[]>(`${this.apiUrl}/livres/${titre}`);
  }

  // Lister un livre selon son id
  getLivresByCategory(nomCategorie: string): Observable<Livre[]> {
    return this.http.get<Livre[]>(`${this.apiUrl}/livres/categorie/${nomCategorie}`);
  }
  
  // Ajouter un emprunt
  addLivre(livre: Livre): Observable<Livre> {
    return this.http.post<Livre>(`${this.apiUrl}/livres`, livre);
  }
  
}
