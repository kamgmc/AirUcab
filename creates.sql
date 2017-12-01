create database AirUcab WITH ENCODING = 'UTF8';

create table Status(
	st_id serial,
    st_nombre varchar(30),
    constraint Pk_status primary key(st_id)
);
create table Rol_de_sistema(
	sr_id serial,
	sr_nombre varchar(30) not null,
	constraint Pk_rol_sistema primary key(sr_id)
);
create table Permiso(
	pe_id serial,
	pe_nombre varchar(30) not null,
	constraint Pk_permiso primary key(pe_id)
);
create table Rol_permiso(
	rp_id serial,
	rp_permiso serial not null,
	rp_rol serial not null,
	constraint Pk_RolPermiso primary key(rp_id),
	constraint Fk_rp_rol foreign key(rp_rol) references Rol_de_sistema(sr_id),
	constraint Fk_rp_permiso foreign key(rp_permiso) references Permiso(pe_id)
);
create table Lugar(
    lu_id serial,
    lu_nombre varchar(50) not null,
    lu_tipo varchar(9) not null,
    lu_lugar integer,
    constraint Pk_lugar primary key(lu_id),
    constraint Fk_lu_lugar foreign key(lu_lugar) references Lugar(lu_id),
	constraint check_lu_tipo check(lu_tipo IN ('Pais','Estado','Municipio','Parroquia'))
);
create table Sede(
	se_id serial,
	se_nombre varchar(30) not null,
	se_area numeric(10,3),
	se_principal numeric(1,0) not null,
	se_lugar serial not null,
	constraint Pk_sede primary key(se_id),
	constraint Fk_se_lugar foreign key(se_lugar) references Lugar(lu_id)
);
create table Zona(
	zo_id serial,
	zo_nombre varchar(30) not null,
	zo_tipo varchar(15) not null,
	zo_sede serial not null,
	constraint Pk_zona primary key(zo_id),
	constraint check_zo_tipo check(zo_tipo in ('ensamblaje','prueba')),
	constraint Fk_zo_sede foreign key(zo_sede) references Sede(se_id)
);
create table Titulacion(
	ti_id serial,
    ti_nombre varchar(30),
    constraint Pk_titulacion primary key(ti_id)
);
create table Cargo(
	er_id serial,
    er_nombre varchar(30),
    constraint Pk_cargo primary key(er_id)
);
create table Empleado(
	em_ci numeric(8,0),
    em_nombre varchar(30) not null,
    em_apellido varchar(30) not null,
    em_fecha_ingreso date not null,
    em_usuario varchar(15) not null,
    em_clave varchar(100) not null,
    em_titulacion serial not null,
    em_cargo serial not null,
    em_rol serial not null,
    em_zona serial not null,
    em_direccion serial not null,
    constraint Pk_empleado primary key(em_ci),
    constraint Fk_em_titulacion foreign key(em_titulacion) references Titulacion(ti_id),
    constraint Fk_em_cargo foreign key(em_cargo) references Cargo (er_id),
    constraint Fk_em_rol foreign key(em_rol) references Rol_de_sistema(sr_id),
    constraint Fk_em_zona foreign key(em_zona) references Zona(zo_id),
    constraint Fk_em_direccion foreign key(em_direccion) references Lugar(lu_id)
);
create table Beneficiario(
	be_ci numeric(8,0),
    be_nombre varchar(30) not null,
    be_apellido varchar(30) not null,
    be_empleado numeric(8,0) not null,
    constraint Pk_beneficiario primary key(be_ci),
    constraint Fk_be_empleado foreign key(be_empleado) references Empleado(em_ci)
);
create table Experiencia(
	ex_id serial,
    ex_descripcion text not null,
    ex_years numeric(2,1) not null,
    ex_empleado numeric(8,0) not null,
    constraint Pk_experiencia primary key(ex_id),
    constraint Fk_ex_empleado foreign key(ex_empleado) references Empleado(em_ci)
);
create table Cliente(
	cl_rif numeric(9,0),
    cl_nombre varchar(30) not null,
    cl_pagina_web varchar(50),
    cl_fecha_inicio date not null,
    cl_direccion serial not null,
    constraint Pk_cliente primary key(cl_rif),
    constraint Fk_cl_direccion foreign key (cl_direccion) references Lugar(lu_id)
);
create table Factura_venta(
	fv_id serial,
    fv_fecha date not null,
    fv_cliente numeric(9,0) not null,
    constraint Pk_factura_venta primary key(fv_id),
    constraint Fk_fv_cliente foreign key(fv_cliente) references Cliente(cl_rif)
);
create table Detalle_factura_venta(
	dfv_id serial,
    dfv_cantidad numeric(4,0) not null,
    dfv_precio numeric(10,3) not null,
    dfv_factura_venta serial not null,
    constraint Pk_detalle_factura_venta primary key(dfv_id),
    constraint Fk_dfv_factura_venta foreign key(dfv_factura_venta) references Factura_venta(fv_id)
);
