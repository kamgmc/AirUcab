# Reportes

## Requerimientos
- :green_check_mark:  Producción anual
```sql
SELECT count(a_id) cantidad
FROM Avion, Status_avion, Status
WHERE EXTRACT(Year from a_fecha_fin)=2017
AND sa_avion=a_id AND sa_status=st_id AND st_nombre='Listo'

SELECT count(p_id) cantidad
FROM Pieza, Status_pieza, Status
WHERE EXTRACT(Year from p_fecha_fin)=2017
AND spi_pieza=p_id AND spi_status=st_id AND st_nombre='Listo'
```
- :white_check_mark: Promedio de producción mensual 
```sql
SELECT count(a_id)/12::real cantidad
FROM Avion, Status_avion, Status
WHERE EXTRACT(Year from a_fecha_fin)=2017
AND sa_avion=a_id AND sa_status=st_id AND st_nombre='Listo'

SELECT count(p_id)/12::real cantidad
FROM Pieza, Status_pieza, Status
WHERE EXTRACT(Year from p_fecha_fin)=2017
AND spi_pieza=p_id AND spi_status=st_id AND st_nombre='Listo'
```
- :white_check_mark:  Los mejores 10 clientes en base a la cantidad de compras por año.
```sql
SELECT cl_nombre, count(fv_id) cantidad
FROM Cliente, Factura_venta, Avion
WHERE a_factura_venta=fv_id AND fv_cliente=cl_id AND EXTRACT(Year from fv_fecha)=2017
GROUP BY cl_nombre
ORDER BY cantidad DESC limit 10
```
- :white_check_mark: Evolución de la aeronáutica 
  Copy-Paste
- Modelos de aviones 
- :white_check_mark:  Cantidad media de aviones producida mensualmente según el modelo. 
```sql
SELECT am_nombre modelo, Count(a_id)/12::real cantidad
FROM Avion, Submodelo_avion, Modelo_avion, Status_avion, Status
WHERE a_submodelo_avion=as_id AND as_modelo_avion=am_id AND sa_avion=a_id AND sa_status=st_id AND st_nombre='Listo' 
AND EXTRACT(Month from sa_fecha_fin)=10 AND EXTRACT(Year from sa_fecha_fin)=2018
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
```sql
  SELECT zo_nombre zona,se_nombre sede, AVG(age(sp_fecha_ini,prm_fecha_ini)-age(prm_fecha_fin,prm_fecha_ini)) eficiencia
  FROM Zona, Sede, Prueba, Prueba_material, Status_prueba, Status
  WHERE zo_sede=se_id AND pr_zona=zo_id AND prm_prueba=pr_id AND sp_prueba=pr_id 
  AND sp_status=st_id AND st_nombre='Aprobada' 
  Group by se_nombre,zo_nombre
  UNION
  SELECT zo_nombre zona, se_nombre sede, AVG(age(sp_fecha_ini,pp_fecha_ini)-age(pp_fecha_fin, pp_fecha_ini)) eficiencia
  FROM Zona, Sede, Prueba, Prueba_pieza, Status_prueba, Status
  WHERE zo_sede=se_id AND pr_zona=zo_id AND pp_prueba=pr_id AND sp_prueba=pr_id 
  AND sp_status=st_id AND st_nombre='Aprobada' 
  Group by se_nombre, zo_nombre
  Order By eficiencia
  Limit 1
```
- :white_check_mark:  Inventario Mensual.
```sql
SELECT mt_nombre material, count(m_id) cantidad
FROM Material, Tipo_material
WHERE m_tipo_material=mt_id AND m_pieza IS null 
AND EXTRACT(Month from m_fecha)=05
GROUP BY material
```
- :white_check_mark:  Producto mas pedido al inventario 
```sql
SELECT mt_nombre material, count(m_id) cantidad
FROM Material, Tipo_material, Factura_compra
WHERE m_factura_compra=fc_id 
AND m_tipo_material=mt_id 
GROUP BY material
ORDER BY cantidad DESC limit 1
```
- :white_check_mark:  El tipo de alas mas utilizado en los aviones.
```sql
SELECT 'Ala '||wt_nombre nombre, COUNT(a_id) cantidad
FROM Tipo_ala, Modelo_pieza, Pieza, Avion
WHERE pm_tipo_ala=wt_id AND p_modelo_pieza=pm_id AND p_avion=a_id
GROUP BY wt_nombre
ORDER BY cantidad DESC limit 1
```
- :white_check_mark:  Cuales fueron los aviones mas rentables en base al cumplimiento de las fechas durante a su producción. 
```sql
SELECT a_id||' - '||am_nombre nombre, AVG(age(sa_fecha_ini,a_fecha_ini)-age(a_fecha_fin,a_fecha_ini)) eficiencia
FROM Avion, Status_avion, Status, Modelo_avion, Submodelo_avion
WHERE sa_avion=a_id AND sa_status=st_id AND st_nombre='Listo' AND a_submodelo_avion=as_id 
AND as_modelo_avion=am_id AND age(sa_fecha_fin, a_fecha_ini) < age(a_fecha_fin, a_fecha_ini)   
GROUP BY a_id, nombre 
ORDER BY eficiencia limit 10
```
- Especificaciones de modelo (con el formato del enunciado ) 
- :white_check_mark:  Cantidad de productos que no cumplieron con las pruebas de calidad.
```sql
SELECT count(pr_id)
FROM Prueba, Status_prueba, Status
WHERE sp_prueba=pr_id AND sp_status=st_id AND st_nombre='Rechazado'
```
- Promedio de traslados entre las sedes. 
```sql
Select se_nombre AS sede, Count(tr_id) AS cantidad
From Traslado, Zona envia,Zona recibe, Sede
Where (envia.zo_sede=se_id OR recibe.zo_sede=se_id)
AND tr_zona_envia=envia.zo_id
AND tr_zona_recibe=recibe.zo_id
Group By se_nombre
```
- :white_check_mark:  Listado de Proveedores
```sql
SELECT po_id id, po_tipo_rif||'-'||po_rif AS rif, po_nombre nombre, 
(Select SUM(m_precio) From Material, Factura_compra Where m_factura_compra=fc_id AND fc_proveedor=po.po_id) as monto, 
po_fecha_ini as fecha, 
(SELECT COUNT(fc_id) FROM Factura_compra WHERE fc_proveedor=po.po_id) as compras, lu_nombre direccion 
FROM proveedor po 
LEFT JOIN Lugar ON lu_id=po_direccion 
ORDER BY nombre
```
- Planta mas eficiente en base al cumplimiento de las fechas 
```sql
SELECT se_nombre sede, AVG(age(sp_fecha_ini,prm_fecha_ini)-age(prm_fecha_fin,prm_fecha_ini)) eficiencia
FROM Zona, Sede, Prueba, Prueba_material, Status_prueba, Status
WHERE zo_sede=se_id AND pr_zona=zo_id AND prm_prueba=pr_id AND sp_prueba=pr_id 
AND sp_status=st_id AND st_nombre='Aprobada' 
Group by se_nombre 
UNION
SELECT se_nombre sede, AVG(age(sp_fecha_ini,pp_fecha_ini)-age(pp_fecha_fin, pp_fecha_ini)) eficiencia
FROM Zona, Sede, Prueba, Prueba_pieza, Status_prueba, Status
WHERE zo_sede=se_id AND pr_zona=zo_id AND pp_prueba=pr_id AND sp_prueba=pr_id 
AND sp_status=st_id AND st_nombre='Aprobada' 
Group by se_nombre
Order By eficiencia
```
- Descripción de piezas (formato del enunciado) 

## Requerimientos Secundarios
- Pestana exclusiva para los Reportes
