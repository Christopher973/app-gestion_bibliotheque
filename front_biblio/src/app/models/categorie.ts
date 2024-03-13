import { Livre } from "./livre";

export class Categorie {
  constructor(
    public id: number,
    public nom: string,
    public description: string,
    public livres: Livre[]
  ){}
}
