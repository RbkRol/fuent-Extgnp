import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import {GastosMedicos} from '../captura-datos/gastosMedicos';

const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};

@Injectable()
export class GastosMedicosService {

  constructor(private http: HttpClient) { }

  public enviarInforme(gasto: GastosMedicos): Observable<any> {
    return this.http.post('https://backend-dot-gnp-fuentes-ext-proveedores.appspot.com',
      JSON.stringify(gasto),
      httpOptions).pipe();
  }


}
