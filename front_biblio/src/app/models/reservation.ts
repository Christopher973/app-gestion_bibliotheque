import { Adherent } from "./adherent";
import { Livre } from "./livre";

export class Reservation {
  constructor(
    public id: number,
    public dateReservation: Date,
    public livre: Livre,
    public adherent: Adherent
  ){}
}
