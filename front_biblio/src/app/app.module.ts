import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HTTP_INTERCEPTORS, HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { HomeComponent } from './home/home.component';
import { AdherentsListComponent } from './adherents-list/adherents-list.component';
import { AuteursListComponent } from './auteurs-list/auteurs-list.component';
import { CategoriesListComponent } from './categories-list/categories-list.component';
import { EmpruntsListComponent } from './emprunts-list/emprunts-list.component';
import { LivresListComponent } from './livres-list/livres-list.component';
import { LivreDetailComponent } from './livre-detail/livre-detail.component';
import { LivresByCategoryComponent } from './livres-by-category/livres-by-category.component';
import { AuthInterceptor } from './services/auth.interceptor';
import { LoginComponent } from './login/login.component';
import { ProfileComponent } from './profile/profile.component';
import { EditAdherentComponent } from './edit-adherent/edit-adherent.component';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    AdherentsListComponent,
    AuteursListComponent,
    CategoriesListComponent,
    EmpruntsListComponent,
    LivresListComponent,
    LivreDetailComponent,
    LivresByCategoryComponent,
    LoginComponent,
    ProfileComponent,
    EditAdherentComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AuthInterceptor,
      multi: true
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
