SELECT SUM(*) FROM Avion where date_part('year', a_fecha_fin) = date_part('year', CURRENT_DATE); --Produccion Anual de este año

SELECT AVG(a_precio) FROM Avion where date_part('year', a_fecha_fin) = date_part('year', CURRENT_DATE); --Promedio de produccion anual

SELECT COUNT(a_id) AS ventas, cl_nombre AS cliente FROM Factura_venta, Cliente, Avion WHERE fv_cliente=cl_id AND a_factura_venta=fv_id GROUP BY cl_nombre ORDER BY ventas DESC LIMIT 10; --Top Ten mejores clientes segun el numero de aviones comprados

SELECT am_nombre AS modelo, COUNT(*) AS ventas FROM Modelo_avion, Submodelo_avion, Avion WHERE am_id=as_modelo_avion AND as_id=a_submodelo_avion GROUP BY am_nombre ORDER BY ventas DESC LIMIT 1; --Modelo de Avion mas Vendido