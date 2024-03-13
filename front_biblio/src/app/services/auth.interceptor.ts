import { Injectable } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Observable } from 'rxjs';

import { AuthService } from './auth.service';

@Injectable()
export class AuthInterceptor implements HttpInterceptor {
  constructor(private authService: AuthService) {}

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>>
  {
    if (!request.headers.has('skip-token')) {
      let currentToken = this.authService.currentTokenValue;
      if (currentToken) {
        request = request.clone({
          setHeaders: {
            Authorization: `Bearer ${currentToken}`
          }
        });
      }
    } else {
      request = request.clone({
        headers: request.headers.delete('skip-token')
      });
    }

    return next.handle(request);
  }
}
