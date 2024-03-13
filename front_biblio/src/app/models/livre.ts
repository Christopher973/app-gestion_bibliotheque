import { Categorie } from "./categorie";
import { Auteur } from "./auteur";
import { Emprunt } from "./emprunt";
import { Reservation } from "./reservation";


export class Livre {
  constructor(
    public id: number,
    public titre: string,
    public dateSortie: Date,
    public langue: string,
    public photoCouverture: string,
    public categories: Categorie[],
    public auteur: Auteur[],
    public emprunts: Emprunt[],
    public reservations: Reservation[]
  ){}
}
