import { Component, OnInit} from '@angular/core';
import {GastosMedicos} from "./gastosMedicos";
import {GastosMedicosService} from "../servicios/gastos-medicos.service";
let fileInput:any;
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-captura-datos',
  templateUrl: './captura-datos.component.html',
  styleUrls: ['./captura-datos.component.css']
})

export class CapturaDatosComponent implements OnInit {
  gastos: GastosMedicos;


  constructor(private gastoServicio: GastosMedicosService) { }

  ngOnInit() {
    this.gastos=new GastosMedicos();
  }
  fileChangeEvent(entrada: any ){
    fileInput=document.getElementById('file');
    var etiqueta=document.getElementById('columna');
    alert("Se agrego el archivo correctamente");
   // console.log(this.modalService.open(contenido).result)
      etiqueta.innerHTML='<div class="row"><div class="col-md-4">'+entrada.target.files[0].name+'</div><div class="col-md-8"><P ALIGN="RIGHT"><span class="glyphicon glyphicon-trash" id="agrega" aria-hidden="true"></span></P> </div></div>';
      document.getElementById('agrega').addEventListener('click', this.eliminaElemento.bind(this));
      document.getElementById('agrega').style.cursor="pointer";

    /*
    Opciones interesantes para reemplazar elementos
    var textoCelda = document.createTextNode(fileInput.target.files[0].name);
    etiqueta.replaceChild(textoCelda,etiqueta.lastChild);
    */

  /*
    Este codigo suprime un evento
    etiqueta.onchange=function(){
      return false;
    }*/
  }

  public eliminaElemento(){
    var etiqueta=document.getElementById('columna');
   etiqueta.innerHTML='<input type="file" accept=".txt, .csv" name="file" id="file" class="inputfile">\n' +
      '      <label for="file" id="etiqueta"><span class="glyphicon glyphicon-open" aria-hidden="true" id="elimina"></span></label>';
   document.getElementById('file').addEventListener('change',this.fileChangeEvent.bind(this));
   document.getElementById('file').style.overflow="hidden";
    document.getElementById('file').style.width='0px';
    document.getElementById('file').style.height='0px';
    document.getElementById('etiqueta').style.cursor="pointer";
  }

  accionEnviar() {
    let files=fileInput.files[0];
    let archivoPromise=this.getFileBlob(files);
    archivoPromise.then(blob=>{
      this.gastos.archivo=blob;
      this.gastoServicio.enviarInforme(this.gastos).subscribe((respuesta) => {
       // console.log(respuesta);
        if (respuesta) {
          // Aqui se va a llamar al pop-up de confirmación de informe enviado
          //enviarInforme();
          alert("Se guardo el informe correctamente");


        }
      });
      console.log(this.gastos.archivo);
    });
  }

  getFileBlob(file) {
    var reader = new FileReader();
    //Solo funciona en html 5
    return new Promise(function (resolve, reject) {
      reader.onload = (function (theFile) {
        return function (e) {
          resolve(e.target.result);
        };
      })(file);
      reader.readAsDataURL(file);
    });
  }

  public cambiaColor(entrada: any,nombre:string){
    document.getElementById(nombre).style.borderColor='#ff570a';
  }

}
