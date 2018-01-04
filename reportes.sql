SELECT Count(*) FROM Avion where date_part('year', a_fecha_fin) = date_part('year', CURRENT_DATE);
SELECT AVG(Count(*)) FROM Avion where date_part('year', a_fecha_fin) = date_part('year', CURRENT_DATE);
SELECT COUNT(a_id) AS ventas, cl_nombre AS cliente FROM Factura_venta, Cliente, Avion WHERE fv_cliente=cl_id AND a_factura_venta=fv_id GROUP BY cl_nombre ORDER BY ventas DESC LIMIT 10; 