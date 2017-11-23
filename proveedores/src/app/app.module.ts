import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';
import { InicioSesionComponent } from './inicio-sesion/inicio-sesion.component';
import { RecuperarPassComponent } from './recuperar-pass/recuperar-pass.component';
import { CapturaDatosComponent } from './captura-datos/captura-datos.component';
import {HttpClientModule} from '@angular/common/http';
import {GastosMedicosService} from "./servicios/gastos-medicos.service";
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { HttpModule } from '@angular/http';
import {routing} from './app.routing';
import { PopArchivoComponent } from './captura-datos/pops/pop-archivo/pop-archivo.component';
import { PopInformeComponent } from './captura-datos/pops/pop-informe/pop-informe.component';
import { NgbModule} from '@ng-bootstrap/ng-bootstrap';



@NgModule({
  declarations: [
    AppComponent,
    InicioSesionComponent,
    CapturaDatosComponent,
    RecuperarPassComponent,
    HeaderComponent,
    FooterComponent,
    PopArchivoComponent,
    PopInformeComponent,
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    HttpModule,
    routing,
    NgbModule.forRoot(),
  ],
  providers: [GastosMedicosService],
  bootstrap: [AppComponent]
})
export class AppModule { }
