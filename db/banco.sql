drop table if exists usuarios cascade;

create table usuarios (
    id       bigserial   constraint pk_usuarios primary key,
    nombre   varchar(20) not null constraint uq_usuario_unico unique,
    password char(60)    not null
);

insert into usuarios (nombre, password)
    values ('pepe', crypt('pepe', gen_salt('bf', 13)));

drop table if exists cuentas cascade;

create table cuentas (
    id             bigserial constraint pk_cuentas primary key,
    fecha_apertura timestamp not null default current_timestamp,
    id_usuario     bigint    constraint fk_cuentas_usuarios
                             references usuarios (id)
                             on delete no action on update cascade
);

insert into cuentas (id_usuario)
    values (1);

drop table  if exists movimientos cascade;

create table movimientos (
    id              bigserial    constraint pk_movimientos primary key,
    fecha_aparicion timestamp    not null default current_timestamp,
    concepto        varchar(200) not null,
    importe         numeric(7,2) not null,
    id_cuenta       bigint       constraint fk_movimientos_cuentas
                                 references cuentas (id)
                                 on delete no action on update cascade
);

insert into movimientos (concepto, importe, id_cuenta)
    values  ('transferencia', 200, 1),
            ('cobro', -50, 1);
