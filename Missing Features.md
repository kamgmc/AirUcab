# Missing features

## PREGUNTAS A LA PROFE
- [ ] Los reportes se le tiene que entregar en físico/digital los queries de estos reportes?
- [ ] Los reportes estarían integrados en la aplicación?
- [ ] Producción anual. Se refiere a que reporte la cantidad de aviones que se produjeron y ganancia en X año 
- [ ] Promedio de producción mensual. Al igual que la anual solo que se proporcionaría X mes? (Se se separa la producción de piezas de la de aviones, se hacen juntas? Se omiten las piezas y solo se consideran los aviones?
- [ ] Evolución aeronáutica. Parecido como se vio en el enunciado? Por ejemplo una lista con los modelos que se fueron creando a través de los años pero con los que existen en la base: AU80, AU801, AU802, AU802A, AU802B, AU802C, ..., AU747SilverB y de haberse creado otros modelos aparecerían luego del AU747SilverB.
- [ ] El equipo mas eficiente (en base al menor retraso en sus asignaciones ) se esta refiriendo a zonas o sedes? O es una entidad Equipos que no estaba en el enunciado?
- [ ] Inventario mensual. Sería el inventario que queda disponible luego de un mes de producción? (Este ya sería sólo con el mes pasado más reciente)
- [ ] Producto más pedido del inventario. Cómo esta definido "Producto" aviones, alas, estabilizadores, motores, materiales? O el inventario es solo de materiales y por ende los productos son los materiales?
- [ ] Especificaciones de modelo (con el formato del enunciado ), descripción de las piezas, listado de proveedores. Estos tres no serian los mismos CRUDs? Porque en nuestra aplicación hace el Mostrar de estas entidades con el mismo formato del enunciado. Contaría como reporte?
￼![Tabla Modelo Avion](https://image.prntscr.com/image/2u2I2ZiqS0OgSfYm2uJv8w.png)
![Detalle Modelo Avion](https://image.prntscr.com/image/gPFTyX0ATjyiwrbmUEtS8A.png)
- [ ] Promedio de traslados entre las sedes. Es la división entre todos los traslados existentes entre la cantidad de sedes?
- [ ] Descripción de piezas (formato del enunciado) pero no encuentro la descripción en el enunciado. Es texto plano?
- [ ] La entidad Lugar se maneja como Permiso? Es decir, solo se crean nuevos lugares mas no se modifican o eliminan?

## HACER SECUNDARIOS
- [ ] Actualizar iconos de tabs (todos sincronizados)
- [ ] Actualizar informacion de usuario (todas sincronizadas) o mas ideal, llamarlo con PHP (REQ. SECUNDARIO)

:white_check_mark: Hacer los botones para el SIDEBAR para que se sepa que es lo que falta exactamente

## FALTAN
- [ ] ACTUALIZAR PAGO FALTANTE
- [ ] FILTROS (ALEX O BORIS)
- [ ] Acomodar los DELETE de Motor con Traslado

## FRONTEND

:white_check_mark: Tipo de Contacto (Cliente)

:white_check_mark: Status (en Pruebas, para poder agregar nuevos estatus)

:white_check_mark: Agregar `TAB` Marca Motor a Motores

:white_check_mark: Zonas 

:white_check_mark: Sedes 

:white_check_mark: Pruebas 

:white_check_mark: Traslados

:white_check_mark: Marca de Motor 

:white_check_mark: Motor 

:white_check_mark: Cliente

:white_check_mark: Proveedor

:white_check_mark: Factura compra

:white_check_mark: Tipo Ala

:white_check_mark: Tipo Estabilizador

:white_check_mark: Material

:white_check_mark: Piezas

## BACKEND
- [ ] Marca de Motor
- [ ] Motor
- [ ] Pruebas
- [ ] Traslados
- [ ] Zonas
- [ ] Sedes
- [ ] Tipo de Contacto (empleado)
- [ ] Cliente
- [ ] Factura compra
- [ ] Tipo Ala
- [ ] Tipo Estabilizador
- [x] Material
- [ ] Piezas

:white_check_mark: Proveedor

## PERMISOS
- [ ] Hacer los permisos mas detallados

## REPORTES (nigga avanzo ahi en reportes.sql)
- [ ] Hacer algunos
- [ ] Hacer un tab en el sidebar que sea “REPORTES”
- [ ] Hacer interfaz de las tablas requerida (con el formato del enunciado)

## BUGS
- [ ] Agregar TipoContacto en Empleados.php


# USO:
:white_check_mark: -> Estado Beta, ya es para usarse (en su contexto, si es backend, es operable con todo, si es frontend, requiere backend)
- [x] -> Esta listo pero no ha sido revisado para estado Beta
