import { Emprunt } from "./emprunt";
import { Reservation } from "./reservation";

export class Adherent {
  constructor(
    public id: number,
    public dateAdhesion: Date,
    public nom : string,
    public prenom: string,
    public dateNaiss: Date,
    public email: string,
    public adressePostale: string,
    public numTel: string,
    public photo: string,
    public emprunts: Emprunt[],
    public reservations: Reservation[]

  ){}
}
