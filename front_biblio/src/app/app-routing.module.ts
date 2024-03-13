import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { AdherentsListComponent } from './adherents-list/adherents-list.component';
import { LivresListComponent } from './livres-list/livres-list.component';
import { EmpruntsListComponent } from './emprunts-list/emprunts-list.component';
import { CategoriesListComponent } from './categories-list/categories-list.component';
import { AuteursListComponent } from './auteurs-list/auteurs-list.component';
import { LivreDetailComponent } from './livre-detail/livre-detail.component';
import { LivresByCategoryComponent } from './livres-by-category/livres-by-category.component';
import { LoginComponent } from './login/login.component';
import { ProfileComponent } from './profile/profile.component';
import { EditAdherentComponent } from './edit-adherent/edit-adherent.component';

const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'login', component: LoginComponent },
  { path: 'profile', component: ProfileComponent },
  { path: 'profile/modification',  component: EditAdherentComponent },
  { path: 'livres',  component: LivresListComponent },
  { path: 'livres/:titre',  component: LivreDetailComponent },
  { path: 'livres/categorie/:nomCategorie',  component: LivresByCategoryComponent },

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
