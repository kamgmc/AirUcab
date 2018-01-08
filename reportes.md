# Reportes

## Requerimientos
- Producción anual
- Promedio de producción mensual 
- :white_check_mark:  Los mejores 10 clientes en base a la cantidad de compras por año.
```sql
SELECT cl_nombre, count(cl_id) cantidad
FROM Cliente, Factura_venta, Avion
WHERE a_factura_venta=fv_id AND fv_cliente=cl_id AND EXTRACT(Year from fv_fecha)=2017
GROUP BY cl_nombre
ORDER BY cantidad DESC limit 10
```
- Evolución de la aeronáutica 
- Modelos de aviones 
- Cantidad media de aviones producida mensualmente según el modelo. 
- :white_check_mark:  El modelo mas vendido 
```sql
SELECT am_nombre modelo, COUNT(a_id) cantidad
FROM avion,submodelo_avion, modelo_avion
WHERE a_submodelo_avion=as_id AND as_modelo_avion=am_id
GROUP BY am_nombre
ORDER BY cantidad DESC limit 1
```
- El equipo mas eficiente (en base al menor retraso en sus asignaciones ) 
- Inventario Mensual. 
- Producto mas pedido al inventario 
- :white_check_mark:  El tipo de alas mas utilizado en los aviones.
```sql
SELECT wt_nombre nombre, COUNT(wt_id) cantidad
FROM Tipo_ala, Modelo_pieza, Pieza, Avion
WHERE pm_tipo_ala=wt_id AND p_modelo_pieza=pm_id AND p_avion=a_id
GROUP BY wt_nombre
ORDER BY cantidad DESC limit 1
```
- Cuales fueron los aviones mas rentables en base al cumplimiento de las fechas durante a su producción. 
- Especificaciones de modelo (con el formato del enunciado ) 
- :white_check_mark:  Cantidad de productos que no cumplieron con las pruebas de calidad.
```sql
SELECT count(pr_id)
FROM Prueba, Status_prueba, Status
WHERE sp_prueba=pr_id AND sp_status=st_id AND st_nombre='Rechazado'
```
- Promedio de traslados entre las sedes. 
- :white_check_mark:  Listado de Proveedores
```sql
SELECT *
FROM proveedor
```
- Planta mas eficiente en base al cumplimiento de las fechas 
- Descripción de piezas (formato del enunciado) 

## Requerimientos Secundarios
- Pestana exclusiva para los Reportes
