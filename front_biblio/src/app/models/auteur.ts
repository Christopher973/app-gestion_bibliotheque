import { Livre } from "./livre";

export class Auteur {
  constructor(
    public id: number,
    public nom: string,
    public prenom: string,
    public dateNaissance: Date,
    public dateDeces: Date,
    public nationalite: string,
    public photo: string,
    public description : string,
    public livres: Livre[]
  ){}
}
