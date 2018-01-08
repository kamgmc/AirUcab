# Reportes

## Requerimientos
- Producción anual
- Promedio de producción mensual 
- Los mejores 10 clientes en base a la cantidad de compras por año. 
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
GROUP BY nombre
ORDER BY cantidad DESC limit 1
```
- Cuales fueron los aviones mas rentables en base al cumplimiento de las fechas durante a su producción. 
- Especificaciones de modelo (con el formato del enunciado ) 
- Cantidad de productos que no cumplieron con las pruebas de calidad. 
- Promedio de traslados entre las sedes. 
- Listado de Proveedores
- Planta mas eficiente en base al cumplimiento de las fechas 
- Descripción de piezas (formato del enunciado) 

## Requerimientos Secundarios
- Pestana exclusiva para los Reportes
