create table Distribucion(
	di_id serial,
	di_nombre varchar(30) not null,
    di_numero_clases numeric(1,0) not null,
    di_capacidad_pasajeros numeric(4,0) not null,
    di_distancia_asientos numeric(3,2) not null,
    di_ancho_asientos numeric(3,2) not null,
    di_modelo_avion integer not null,
    constraint Pk_distribucion primary key(di_id),
    constraint check_di_numero_clases check(di_numero_clases > 0),
    constraint check_di_capacidad_pasajeros check(di_capacidad_pasajeros > 0),
    constraint Fk_di_modelo_avion foreign key(di_modelo_avion) references Modelo_avion(am_id)
);
