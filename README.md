[Tuto para markdown](https://docs.gitlab.com/ee/user/markdown.html)

# Integrar Bootstrap en Angular

Primero ir a la carpeta de la aplicación y ejecutar desde la terminal de node.js ejecutar:

>>npm install --save bootstrap

>>npm install popper.js

Después de la instalación de bootsrap y de [Popper.js](https://github.com/FezVrasta/popper.js#installation), vamos a la carpeta raíz de nuestro proyecto en Angular y buscamos el archivo angular-cli.json y dentro de este archivo añadimos a bootstrap de la siguiente manera: 

```json
"styles": [
        "../node_modules/bootstrap/dist/css/bootstrap.min.css",
        "styles.css"
      ]
```
Eso es todo.

[Fuente](https://stackoverflow.com/questions/43557321/angular-4-how-to-include-bootstrap)