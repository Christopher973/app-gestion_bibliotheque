import { Adherent } from "./adherent";
import { Livre } from "./livre";

export class Emprunt {
  constructor(
    public id: number,
    public dateEmprunt: Date,
    public dateRetour: Date,
    public livre: Livre,
    public adherent: Adherent
  ){}
}
