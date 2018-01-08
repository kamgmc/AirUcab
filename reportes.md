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
- :white_check_mark:  Cantidad media de aviones producida mensualmente según el modelo. 
```sql
SELECT am_nombre modelo, Count(a_id)/12 cantidad
FROM Avion, Submodelo_avion, Modelo_avion, Status_avion, Status
WHERE a_submodelo_avion=as_id AND as_modelo_avion=am_id AND sa_avion=a_id AND sa_status=st_id AND st_nombre='Listo' AND EXTRACT(Month from sa_fecha_fin)=10 AND EXTRACT(Year from sa_fecha_fin)=2018
GROUP BY am_nombre
```
- :white_check_mark:  El modelo mas vendido 
```sql
SELECT am_nombre modelo, COUNT(a_id) cantidad
FROM avion,submodelo_avion, modelo_avion
WHERE a_submodelo_avion=as_id AND as_modelo_avion=am_id
GROUP BY am_nombre
ORDER BY cantidad DESC limit 1
```
- El equipo mas eficiente (en base al menor retraso en sus asignaciones ) 
- :white_check_mark:  Inventario Mensual.
```sql
SELECT mt_nombre material, count(m_id) cantidad
FROM Material, Tipo_material, Factura_compra
WHERE m_factura_compra=fc_id AND m_tipo_material=mt_id AND m_pieza IS null AND EXTRACT(Month from fc_fecha)=05
GROUP BY material
```
- :white_check_mark:  Producto mas pedido al inventario 
```sql
SELECT mt_nombre material, count(m_id) cantidad
FROM Material, Tipo_material, Factura_compra
WHERE m_factura_compra=fc_id AND m_tipo_material=mt_id AND m_pieza IS not null AND EXTRACT(Month from fc_fecha)=05
GROUP BY material
ORDER BY cantidad DESC limit 1
```
- :white_check_mark:  El tipo de alas mas utilizado en los aviones.
```sql
SELECT wt_nombre nombre, COUNT(wt_id) cantidad
FROM Tipo_ala, Modelo_pieza, Pieza, Avion
WHERE pm_tipo_ala=wt_id AND p_modelo_pieza=pm_id AND p_avion=a_id
GROUP BY wt_nombre
ORDER BY cantidad DESC limit 1
```
- :white_check_mark:  Cuales fueron los aviones mas rentables en base al cumplimiento de las fechas durante a su producción. 
```sql
SELECT am_nombre nombre
FROM Avion, Status_avion, Status, Modelo_avion, Submodelo_avion
WHERE sa_avion=a_id AND sa_status=st_id AND st_nombre='Listo' AND a_submodelo_avion=as_id 
AND as_modelo_avion=am_id AND age(sa_fecha_fin, a_fecha_ini) < age(a_fecha_fin, a_fecha_ini)   
GROUP BY nombre 
ORDER BY nombre DESC limit 10
```
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
