create database AirUcab WITH ENCODING = 'UTF8';

create table Status(
	st_id serial,
	st_nombre varchar(30) unique not null,
	constraint Pk_status primary key(st_id)
);
create table Rol_sistema(
	sr_id serial,
	sr_nombre varchar(30) unique not null,
	constraint Pk_rol_sistema primary key(sr_id)
);
create table Permiso(
	pe_id serial,
	pe_nombre varchar(35) not null,
	pe_iniciales varchar(5) unique not null,
	constraint Pk_permiso primary key(pe_id)
);
create table Rol_permiso(
	rp_id serial,
	rp_permiso integer not null,
	rp_rol integer not null,
	constraint Pk_RolPermiso primary key(rp_id),
	constraint Fk_rp_rol foreign key(rp_rol) references Rol_sistema(sr_id),
	constraint Fk_rp_permiso foreign key(rp_permiso) references Permiso(pe_id)
);
create table Lugar(
	lu_id serial,
	lu_nombre varchar(50) not null,
	lu_tipo varchar(9) not null,
	lu_lugar integer,
	constraint Pk_lugar primary key(lu_id),
	constraint Fk_lu_lugar foreign key(lu_lugar) references Lugar(lu_id),
	constraint Check_lu_tipo check(lu_tipo IN ('País','Estado','Municipio','Parroquia'))
);
create table Sede(
	se_id serial,
	se_nombre varchar(30) not null,
	se_area numeric(10,3),
	se_principal boolean not null,
	se_lugar integer not null,
	constraint Pk_sede primary key(se_id),
	constraint Fk_se_lugar foreign key(se_lugar) references Lugar(lu_id),
	constraint Check_se_area check(se_area > 0)
);
create table Zona(
	zo_id serial,
	zo_nombre varchar(30) not null,
	zo_tipo varchar(15) not null,
	zo_sede integer not null,
	constraint Pk_zona primary key(zo_id),
	constraint Check_zo_tipo check(zo_tipo in ('Ensamblaje','Prueba')),
	constraint Fk_zo_sede foreign key(zo_sede) references Sede(se_id)
);
create table Titulacion(
	ti_id serial,
	ti_nombre varchar(30) unique not null,
	constraint Pk_titulacion primary key(ti_id)
);
create table Cargo(
	er_id serial,
	er_nombre varchar(30) unique not null,
	constraint Pk_cargo primary key(er_id)
);
create table Empleado(
	em_id serial,
	em_nacionalidad char(1) not null,
	em_ci numeric(8,0) not null,
	em_nombre varchar(30) not null,
	em_apellido varchar(30) not null,
	em_fecha_ingreso date not null,
	em_usuario varchar(15) not null,
	em_clave varchar(100) not null,
	em_titulacion integer not null,
	em_cargo integer not null,
	em_rol integer not null,
	em_zona integer not null,
	em_direccion integer not null,
	em_supervisa integer,
	em_gerencia integer,
	constraint Pk_empleado primary key(em_id),
	constraint Check_em_nacionalidad check(em_nacionalidad IN ('V','E','P')),
	constraint Check_em_ci check(em_ci > 0),
	constraint Fk_em_titulacion foreign key(em_titulacion) references Titulacion(ti_id),
	constraint Fk_em_cargo foreign key(em_cargo) references Cargo (er_id),
	constraint Fk_em_rol foreign key(em_rol) references Rol_sistema(sr_id),
	constraint Fk_em_zona foreign key(em_zona) references Zona(zo_id),
	constraint Fk_em_direccion foreign key(em_direccion) references Lugar(lu_id),
	constraint Fk_em_supervisa foreign key(em_supervisa) references Zona(zo_id),
	constraint Fk_em_gerencia foreign key(em_gerencia) references Sede(se_id)
);
create unique index Em_cedula on Empleado (em_nacionalidad,em_ci);
create table Beneficiario(
	be_id serial,
	be_nacionalidad char(1) not null,
	be_ci numeric(8,0) not null,
	be_nombre varchar(30) not null,
	be_apellido varchar(30) not null,
	be_empleado integer not null,
	constraint Pk_beneficiario primary key(be_id),
	constraint Check_be_nacionalidad check(be_nacionalidad IN ('V','E','P')),
	constraint Check_be_ci check(be_ci > 0),
	constraint Fk_be_empleado foreign key(be_empleado) references Empleado(em_id)
);
create unique index Be_cedula on Beneficiario (be_nacionalidad,be_ci);
create table Experiencia(
	ex_id serial,
	ex_descripcion text not null,
	ex_years numeric(2,1) not null,
	ex_empleado integer not null,
	constraint Pk_experiencia primary key(ex_id),
	constraint Check_ex_years check(ex_years >= 0),
	constraint Fk_ex_empleado foreign key(ex_empleado) references Empleado(em_id)
);
create table Cliente(
	cl_id serial,
	cl_tipo_rif char(1) not null,
	cl_rif numeric(9,0) not null,
	cl_nombre varchar(30) not null,
	cl_pagina_web varchar(50),
	cl_fecha_inicio date not null,
	cl_direccion integer not null,
	constraint Pk_cliente primary key(cl_id),
	constraint Check_cl_tipo_rif check(cl_tipo_rif IN ('G','J','V','E')),
	constraint Check_cl_rif check(cl_rif > 0),
	constraint Fk_cl_direccion foreign key (cl_direccion) references Lugar(lu_id)
);
create unique index Cl_Rif on Cliente (cl_tipo_rif,cl_rif);
create table Factura_venta(
	fv_id serial,
	fv_fecha date not null,
	fv_cliente integer not null,
	constraint Pk_factura_venta primary key(fv_id),
	constraint Fk_fv_cliente foreign key(fv_cliente) references Cliente(cl_id)
);
create table Proveedor(
	po_id serial,
	po_tipo_rif char(1) not null,
	po_rif numeric(9,0) not null,
	po_nombre varchar(30) not null,
	po_pagina_web varchar(50),
	po_fecha_ini date not null,
	po_direccion integer not null,
	constraint Pk_proveedor primary key(po_id),
	constraint Check_po_tipo_rif check(po_tipo_rif IN('G','J','V','E')),
	constraint Check_po_rif check(po_rif > 0),
	constraint Fk_po_direccion foreign key(po_direccion) references Lugar(lu_id)
);
create unique index Po_Rif on Proveedor (po_tipo_rif,po_rif);
create table Tipo_contacto(
	ct_id serial,
	ct_nombre varchar(30) unique not null,
	constraint Pk_tipo_contacto primary key(ct_id)
);
create table Contacto(
	co_id serial,
	co_valor varchar(50) not null,
	co_tipo integer not null,
	co_cliente integer,
	co_empleado integer,
	co_proveedor integer,
	constraint Pk_contacto primary key(co_id),
	constraint Fk_co_tipo_contacto foreign key(co_tipo) references Tipo_contacto(ct_id),
	constraint Fk_co_cliente foreign key(co_cliente) references Cliente(cl_id),
	constraint Fk_co_empleado foreign key(co_empleado) references Empleado(em_id),
	constraint Fk_co_proveedor foreign key(co_proveedor) references Proveedor(po_id),
	constraint Check_co_arco check(co_cliente IS not null or co_empleado IS not null or co_proveedor IS not null)
);
create table Marca_motor(
	mb_id serial,
	mb_nombre varchar(30) unique not null,
	constraint Pk_marca_motor primary key(mb_id)
);
create table Modelo_motor(
	mm_id serial,
	mm_nombre varchar(30) not null,
	mm_tipo varchar(7) not null,
	mm_empuje_max numeric(5,2) not null,
	mm_empuje_normal numeric(5,2) not null,
	mm_empuje_crucero numeric (5,2) not null,
	mm_longitud numeric(3,2) not null,
	mm_diametro_aspa numeric(4,2),
	mm_marca integer not null,
	constraint Pk_modelo_motor primary key(mm_id),
	constraint Check_mm_tipo check(mm_tipo IN ('Hélice','Reactor')),
	constraint Check_mm_empuje_max check(mm_empuje_max > 0),
	constraint Check_mm_empuje_normal check(mm_empuje_normal > 0),
	constraint Check_mm_empuje_crucero check(mm_empuje_crucero > 0),
	constraint Check_mm_longitud check(mm_longitud > 0),
	constraint Check_mm_diametro_aspa check(mm_diametro_aspa > 0),
	constraint Fk_mm_marca foreign key(mm_marca) references Marca_motor(mb_id)
);
create table Modelo_avion(
	am_id serial,
	am_nombre varchar(30) unique not null,
	am_longitud numeric(4,2) not null,
	am_envergadura numeric(4,2) not null,
	am_altura numeric(4,2) not null,
	am_ala_superficie numeric(4,1) not null,
	am_ala_flecha numeric(4,2) not null,
	am_peso_aterrizaje_max numeric(6,1) not null,
	am_alcance numeric(6,2) not null,
	am_velocidad_max numeric(6,2) not null,
	am_techo_servicio numeric(6,1) not null,
	am_regimen_ascenso numeric(4,1) not null,
	am_numero_pasillos numeric(2,0) not null,
	am_fuselaje_tipo varchar(6) not null,
	am_fuselaje_altura numeric(4,2) not null,
	am_fuselaje_ancho numeric(4,2) not null,
	am_cabina_altura numeric(4,2) not null,
	am_cabina_ancho numeric(4,2) not null,
	am_carga_volumen numeric(4,2) not null,
	am_capacidad_pilotos numeric(1,0) not null,
	am_capacidad_asistentes numeric(2,0) not null,
	am_carrera_despegue numeric(5,1) not null,
	am_tiempo_estimado date not null,
	constraint Pk_modelo_avion primary key(am_id),
	constraint Check_am_longitud check(am_longitud > 0),
	constraint Check_am_envergadura check(am_envergadura > 0),
	constraint Check_am_altura check(am_altura > 0),
	constraint Check_am_ala_superficie check(am_ala_superficie > 0),
	constraint Check_am_ala_flecha check(am_ala_flecha > 0),
	constraint Check_am_peso_aterrizaje_max check(am_peso_aterrizaje_max > 0),
	constraint Check_am_alcance check(am_alcance > 0),
	constraint Check_am_velocidad_max check(am_velocidad_max > 0),
	constraint Check_am_techo_servicio check(am_techo_servicio > 0),
	constraint Check_am_regimen_ascenso check(am_regimen_ascenso > 0),
	constraint Check_am_numero_pasillos check(am_numero_pasillos > 0),
	constraint Check_am_fuselaje_altura check(am_fuselaje_altura > 0),
	constraint Check_am_fuselaje_ancho check(am_fuselaje_ancho > 0),
	constraint Check_am_cabina_altura check(am_cabina_altura > 0),
	constraint Check_am_cabina_ancho check(am_cabina_ancho > 0),
	constraint Check_am_carga_volumen check(am_carga_volumen > 0),
	constraint Check_am_capacidad_pilotos check(am_capacidad_pilotos > 0),
	constraint Check_am_capacidad_asistentes check(am_capacidad_asistentes >= 0),
	constraint Check_am_carrera_despegue check(am_carrera_despegue > 0),
	constraint Check_am_fuselaje_tipo check(am_fuselaje_tipo IN ('Ancho','Normal'))
);
create table Distribucion(
	di_id serial,
	di_nombre varchar(30) not null,
	di_numero_clases numeric(1,0) not null,
	di_capacidad_pasajeros numeric(4,0) not null,
	di_distancia_asientos numeric(3,1) not null,
	di_ancho_asientos numeric(3,1) not null,
	di_modelo_avion integer not null,
	constraint Pk_distribucion primary key(di_id),
	constraint Check_di_numero_clases check(di_numero_clases > 0),
	constraint Check_di_capacidad_pasajeros check(di_capacidad_pasajeros > 0),
	constraint Check_di_distancia_asientos check(di_distancia_asientos > 0),
	constraint Check_di_ancho_asientos check(di_ancho_asientos > 0),
	constraint Fk_di_modelo_avion foreign key(di_modelo_avion) references Modelo_avion(am_id)
);
create table Submodelo_avion(
	as_id serial,
	as_nombre varchar(30) not null,
	as_peso_maximo_despegue numeric(6) not null,
	as_peso_vacio numeric(6) not null,
	as_velocidad_crucero numeric(6) not null,
	as_carrera_despegue_peso_maximo numeric(6) not null,
	as_autonomia_peso_maximo_despegue numeric(6) not null,
	as_capacidad_combustible numeric(6) not null,
	as_alcance_carga_maxima numeric(6) not null,
	as_modelo_avion integer not null,
	constraint Pk_submodelo_avion primary key(as_id),
	constraint Check_as_peso_maximo_despegue check(as_peso_maximo_despegue > 0),
	constraint Check_as_peso_vacio check(as_peso_vacio > 0),
	constraint Check_as_velocidad_crucero check(as_velocidad_crucero > 0),
	constraint Check_as_carrera_despegue_peso_maximo check(as_carrera_despegue_peso_maximo > 0),
	constraint Check_as_autonomia_peso_maximo_despegue check(as_autonomia_peso_maximo_despegue > 0),
	constraint Check_as_capacidad_combustible check(as_capacidad_combustible > 0),
	constraint Check_as_alcance_carga_maxima check(as_alcance_carga_maxima > 0),
	constraint Fk_as_modelo_avion foreign key(as_modelo_avion) references Modelo_avion(am_id)
);
create table S_avion_m_motor(
	smt_id serial,
	smt_cantidad numeric(3,0) not null,
	smt_submodelo_avion integer not null,
	smt_modelo_motor integer not null,
	constraint Pk_m_avion_m_motor primary key(smt_id),
	constraint Check_smt_cantidad check(smt_cantidad > 0),
	constraint Fk_smt_submodelo_avion foreign key(smt_submodelo_avion) references Submodelo_avion(as_id),
	constraint Fk_smt_modelo_motor foreign key(smt_modelo_motor) references Modelo_motor(mm_id)
);
create table Tipo_ala(
	wt_id serial,
    wt_nombre varchar(30) unique not null,
    constraint Pk_tipo_ala primary key(wt_id)
);
create table Tipo_estabilizador(
	et_id serial,
    et_nombre varchar(30) unique not null,
    constraint Pk_tipo_estabilizador primary key(et_id)
);
create table Modelo_pieza(
    pm_id serial,
    pm_nombre varchar(30) unique not null,
    pm_tiempo_estimado date not null,
    pm_modelo_pieza integer,
    pm_tipo_ala integer,
    pm_tipo_estabilizador integer,
    constraint Pk_modelo_pieza primary key(pm_id),
    constraint Fk_pm_modelo_pieza foreign key(pm_modelo_pieza) references Modelo_pieza(pm_id),
    constraint Fk_pm_tipo_ala foreign key(pm_tipo_ala) references Tipo_ala(wt_id),
    constraint Fk_pm_tipo_estabilizador foreign key(pm_tipo_estabilizador) references Tipo_estabilizador(et_id)
);
create table S_avion_m_pieza(
	smp_id serial,
    smp_cantidad numeric(3,0) not null,
    smp_submodelo_avion integer not null,
    smp_modelo_pieza integer not null,
    constraint Pk_s_avion_m_pieza primary key(smp_id),
    constraint Check_smp_cantidad check(smp_cantidad > 0),
    constraint Fk_smp_submodelo_avion foreign key(smp_submodelo_avion) references Submodelo_avion(as_id),
    constraint Fk_smp_modelo_pieza foreign key(smp_modelo_pieza) references Modelo_pieza(pm_id)
);
create table Prueba(
	pr_id serial,
	pr_nombre varchar(30) not null,
	pr_tipo varchar(15) not null,
	pr_zona integer not null,
	pr_empleado integer not null,
	constraint Pk_prueba primary key(pr_id),
	constraint Check_pr_tipo check(pr_tipo IN ('Prueba','Ensamblaje')),
	constraint Fk_pr_zona foreign key(pr_zona) references Zona(zo_id),
	constraint Fk_pr_empleado foreign key(pr_empleado) references Empleado(em_id)
);
create table Status_prueba(
	sp_id serial,
    sp_fecha_ini date not null,
    sp_fecha_fin date not null,
    sp_prueba integer not null,
    sp_status integer not null,
    constraint Pk_status_prueba primary key(sp_id),
    constraint Fk_sp_prueba foreign key(sp_prueba) references Prueba(pr_id),
    constraint Fk_sp_status foreign key(sp_status) references Status(st_id)
);
create table Factura_compra(
	fc_id serial,
	fc_fecha date not null,
	fc_proveedor integer not null,
	constraint Pk_factura_compra primary key(fc_id),
	constraint Fk_fc_proveedor foreign key(fc_proveedor) references Proveedor(po_id)
);
create table Tipo_pago(
	pt_id serial,
	pt_tipo numeric(1,0) not null,
	pt_numero integer not null,
	pt_tc_nombre varchar(30),
	pt_tc_cod numeric(3,0),
	pt_tc_fecha date,
	constraint Pk_tipo_pago primary key (pt_id),
	constraint Check_pt_tipo check(pt_tipo > 0),
	constraint Check_pt_tc_cod check(pt_tc_cod > 0)
);
create table Pago(
	pa_id serial,
	pa_monto numeric(7,2) not null,
	pa_fecha date not null,
	pa_tipo_pago integer not null,
	pa_factura_venta integer,
	pa_factura_compra integer,
	constraint Pk_pago primary key(pa_id),
	constraint Check_pa_monto check(pa_monto > 0),
	constraint Fk_pa_tipo_pago foreign key(pa_tipo_pago) references Tipo_pago(pt_id),
	constraint Fk_pa_factura_venta foreign key(pa_factura_venta) references Factura_venta(fv_id),
	constraint Fk_pa_factura_compra foreign key(pa_factura_compra) references Factura_compra(fc_id),
	constraint Check_pa_arco check (pa_factura_venta IS not null or pa_factura_compra IS not null)
);
create table Tipo_material(
	mt_id serial,
    mt_nombre varchar(30) unique not null,
    constraint Pk_tipo_material primary key(mt_id)
);
create table T_material_m_pieza(
	tmm_id serial,
    tmm_cantidad numeric(6,2) not null,
    tmm_tipo_material integer not null,
    tmm_modelo_pieza integer not null,
    constraint Pk_t_material_m_pieza primary key(tmm_id),
    constraint Check_tmm_cantidad check(tmm_cantidad > 0),
    constraint Fk_tmm_tipo_material foreign key(tmm_tipo_material) references Tipo_material(mt_id),
    constraint Fk_tmm_modelo_pieza foreign key (tmm_modelo_pieza) references Modelo_pieza(pm_id)
);
create table Avion(
	a_id serial,
    a_fecha_ini date not null,
    a_fecha_fin date not null,
    a_factura_venta integer not null,
    a_submodelo_avion integer not null,
	a_precio numeric(8,2) not null,
    constraint Pk_avion primary key(a_id),
    constraint Fk_a_factura_venta foreign key(a_factura_venta) references Factura_venta(fv_id),
    constraint Fk_a_submodelo_avion foreign key(a_submodelo_avion) references Submodelo_avion(as_id),
	constraint Check_a_precio check(a_precio > 0)
);
create table Status_avion(
	sa_id serial,
    sa_fecha_ini date not null,
    sa_fecha_fin date not null,
    sa_avion integer not null,
    sa_status integer not null,
    constraint Pk_status_avion primary key(sa_id),
    constraint Fk_sa_avion foreign key(sa_avion) references Avion(a_id),
    constraint Fk_sa_status foreign key(sa_status) references Status(st_id)
);
create table Motor(
	mo_id serial,
	mo_fecha_ini date not null,
	mo_fecha_fin date not null,
	mo_modelo_motor integer not null,
	mo_avion integer not null,
	constraint Pk_motor primary key(mo_id),
	constraint Fk_mo_modelo_motor foreign key(mo_modelo_motor) references Modelo_motor(mm_id),
	constraint Fk_mo_avion foreign key(mo_avion) references Avion(a_id)
);
create table Status_motor(
	stm_id serial,
    stm_fecha_ini date not null,
    stm_fecha_fin date not null,
    stm_motor integer not null,
    stm_status integer not null,
    constraint Pk_status_motor primary key(stm_id),
    constraint Fk_stm_motor foreign key(stm_motor) references Motor(mo_id),
    constraint Fk_stm_status foreign key(stm_status) references Status(st_id)
);
create table Pieza(
    p_id serial,
    p_fecha_ini date not null,
    p_fecha_fin date not null,
    p_modelo_pieza integer not null,
    p_avion integer not null,
    constraint Pk_pieza primary key(p_id),
    constraint Fk_p_modelo_pieza foreign key(p_modelo_pieza) references Modelo_pieza(pm_id),
    constraint Fk_p_avion foreign key(p_avion) references Avion(a_id)
);
create table Status_pieza(
    spi_id serial,
    spi_fecha_ini date not null,
    spi_fecha_fin date not null,
    spi_pieza integer not null,
    spi_status integer not null,
    constraint Pk_status_pieza primary key(spi_id),
    constraint Fk_spi_pieza foreign key(spi_pieza) references Pieza(p_id),
    constraint Fk_spi_status foreign key(spi_status) references Status(st_id)
);
create table Material(
	m_id serial,
    m_fecha date not null,
    m_tipo_material integer not null,
    m_factura_compra integer not null,
	m_pieza integer not null,
	m_precio numeric(4,2) not null,
    constraint Pk_material primary key(m_id),
    constraint Fk_m_tipo_material foreign key(m_tipo_material) references Tipo_material(mt_id),
    constraint Fk_m_factura_compra foreign key(m_factura_compra) references Factura_compra(fc_id),
	constraint Fk_m_pieza foreign key(m_pieza) references Pieza(p_id),
	constraint Check_m_precio check(m_precio > 0)
);
create table Prueba_material(
	prm_id serial,
    prm_fecha_ini date not null,
    prm_fecha_fin date not null,
    prm_material integer not null,
    prm_prueba integer not null,
    prm_status integer not null,
    constraint Pk_prueba_material primary key(prm_id),
    constraint Fk_prm_material foreign key(prm_material) references Material(m_id),
    constraint Fk_prm_prueba foreign key(prm_prueba) references Prueba(pr_id),
    constraint Fk_prm_status foreign key(prm_status) references Status(st_id)
);
create table Status_material(
	sm_id serial,
    sm_fecha_ini date not null,
    sm_fecha_fin date not null,
    sm_material integer not null,
    sm_status integer not null,
    constraint Pk_status_material primary key(sm_id),
    constraint Fk_sm_material foreign key(sm_material) references Material(m_id),
    constraint Fk_sm_status foreign key(sm_status) references Status(st_id)
);
create table Prueba_pieza(
	pp_id serial,
    pp_fecha_ini date not null,
    pp_fecha_fin date not null,
    pp_pieza integer not null,
    pp_prueba integer not null,
    pp_status integer not null,
    constraint Pk_prueba_pieza primary key(pp_id),
    constraint Fk_pp_pieza foreign key(pp_pieza) references Pieza(p_id),
    constraint Fk_pp_prueba foreign key(pp_prueba) references Prueba(pr_id),
    constraint Fk_pp_status foreign key(pp_status) references Status(st_id)
);
create table Traslado(
	tr_id serial,
    tr_fecha_ini date not null,
	tr_fecha_fin date not null,
	tr_confirmacion boolean not null,
    tr_zona_envia integer not null,
    tr_zona_recibe integer not null,
    tr_pieza integer,
    tr_material integer,
    constraint Pk_traslado primary key(tr_id),
    constraint Fk_tr_zona_envia foreign key(tr_zona_envia) references Zona(zo_id),
    constraint Fk_tr_zona_recibe foreign key(tr_zona_recibe) references Zona(zo_id),
    constraint Fk_tr_pieza foreign key(tr_pieza) references Pieza(p_id),
    constraint Fk_tr_material foreign key(tr_material) references Material(m_id),
    constraint Check_tr_arco check(tr_pieza IS not null or tr_material IS not null)
);
