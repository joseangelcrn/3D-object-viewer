# 3D-object-viewer

## ¿Qué es?

Aplicación web para el almacenamiento de modelos 3D con visor tridimensional incorporado.

## ¿Por qué esta aplicación?

He estado aprendiendo temas de <b>fotogrametría</b>, practicando con objetos de mis alrededores y quise, de alguna forma, almacenar todos aquellos resultados fotogrametricos en un un sitio: esta aplicación. La aplicación no tiene mayor misterio: almacena ciertos tipo de ficheros y da la posibilidad de verlos en un visor 3D incorporado en ella, pero cumple la función especifica para la cual la he desarrollado.

<hr>

# A cerca de la aplicación

### Modelos fakes y seeders

La aplicación solo tiene dos modelos principales, <b>los usuarios y los modelos 3d<b>.

- Para crear usuarios fake (sin guardar en bd): `User::factory()->make();` 
- Para crear usuarios fake (con guardado en bd): `User::factory()->create()` 

- Para crear modelos fake (sin guardar en bd): `Model3D::factory()->make()` 
- Para crear modelos fake (con guardado en bd): `Model3D::factory()->create()` 

### ¡¡ [Los modelos 3D creados de esta manera no tendrán un modelo 3D real, para ver un modelo real debe subirlo y acceder, posteriormente, al visor de este.] !!

### Rellenar la bd con datos

- Cargar seeds `php artisan db:seed` <br>
- Limpiar la BD y cargar seeds `php artisan migrate:refresh --seed`


### Correr los tests

`php artisan test`

Debes de ver algo asi 

```
   PASS  Tests\Feature\Model3DCrudTest
  ✓ store
  ✓ show
  ✓ update
  ✓ delete

  Tests:  4 passed
  Time:   x.xxs
```



<hr>

# Sobre la fotogrametría

## ¿Qué es la fotogrametría?

La Fotogrametría es una técnica empleada para determinar las propiedades geométricas, dimensiones y forma, de los objetos y espacios. Esto se consigue, como se puede deducir de su denominación, mediante la realización de fotografías. 

<br> 

O dicho de otra manera: crear modelos tridimensionales a partir de fotos.

## ¿Qué usos puede tener la fotogrametría?

- Agronomía.
- Cartografía.
- Ortofotografía.
- Arquitectura.
- Planeamiento y ordenación del territorio.
- Medio ambiente.
- Arqueología.
- Control de estructuras.
- Mediciones.
- Topografía.
- Medicina.
- Zoologia. 
- Modelos realistas para peliculas y/o videojuegos.

## 
