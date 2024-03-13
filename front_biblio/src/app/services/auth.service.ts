import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable, map } from 'rxjs';

export class AuthUser {
  constructor(
    public email:string = "",
    public roles:string[] = []
  ) {}
  isAdmin() : boolean {
    return this.roles.includes("ROLE_ADMIN")
  }
  isLogged() : boolean {
    return this.email.length>0
  }
}

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrlLogin    = 'http://localhost:8000/api/login';
  private apiUrlUserInfo = 'http://localhost:8000/api/user/me';

  // code de l'entrée dans le localstorage
  private localStorageToken = 'currentToken';

  // Token
  private    currentTokenSubject: BehaviorSubject<string|null>;
  public     currentToken: Observable<string|null>;
  public get currentTokenValue() : string|null { return this.currentTokenSubject.value }

  // info AuthUser
  private currentAuthUserSubject: BehaviorSubject<AuthUser>;
  public  currentAuthUser: Observable<AuthUser>;
  public get currentAuthUserValue() : AuthUser { return this.currentAuthUserSubject.value }

  constructor(private http: HttpClient) {
    this.currentTokenSubject = new BehaviorSubject<string|null>( null );
    this.currentToken        = this.currentTokenSubject.asObservable();
    this.currentAuthUserSubject = new BehaviorSubject(new AuthUser());
    this.currentAuthUser        = this.currentAuthUserSubject.asObservable()

    const storedToken:string|null = localStorage.getItem(this.localStorageToken);
    this.updateUserInfo(storedToken)
  }

  private updateUserInfo(token:string|null) {
    // on supprime les infos utilisateur (par défaut)
    // si le token est null ou que la requete ne trouve pas d'utilisateur on en restera la.
    this.currentTokenSubject.next(null);
    this.currentAuthUserSubject.next(new AuthUser());

    if (token) {
      // On donne le token a tester + skip-token pour court-circuiter AuthInterceptor
      const headers = new HttpHeaders({'Authorization': `Bearer ${token}`, 'skip-token':'true' });
      this.http.get<AuthUser>(this.apiUrlUserInfo, { headers }).subscribe({
        next:data => {
          console.log("retour du check : ", data)
          if (data.email) {
            // L'utilisateur a été reconnu si on a un email en retour
            // Ceci est bien entendu un check "simplifié"
            this.currentTokenSubject.next(token);
            this.currentAuthUserSubject.next(new AuthUser(data.email, data.roles));
          }
        }
      })
    }
  }
  public login(email: string, password: string) : Observable<boolean> {
    return this.http.post<any>(this.apiUrlLogin, { email, password })
      .pipe(map(reponse => {
        if (reponse.token) {
          this.updateUserInfo(reponse.token)
          return true
        } else {
          return false
        }
      })
      )
  }

  public logout() {
    this.updateUserInfo(null)
  }
}
