drop table if exists usuarios cascade;

create table usuarios (
    id       bigserial   constraint pk_usuarios primary key,
    nombre   varchar(20) not null constraint uq_usuario_unico unique,
    password char(60)    not null
);

insert into usuarios (nombre, password)
    values ('pepe', crypt('pepe', gen_salt('bf', 13))),
           ('juan', crypt('juan', gen_salt('bf', 13)));

drop table if exists cuentas cascade;

create table cuentas (
    id             bigserial    constraint pk_cuentas primary key,
    fecha_apertura timestamp    not null default current_timestamp,
    num_cuenta     varchar(100) not null,
    id_usuario     bigint       constraint fk_cuentas_usuarios
                                references usuarios (id)
                                on delete no action on update cascade
);

insert into cuentas (num_cuenta, id_usuario)
    values ('AA12345', 1),
           ('BB12345', 2),
           ('AB12345', 1);

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
            ('reintegro', -50, 1),
            ('transferencia', 120.50, 2),
            ('transferencia', 25, 3);
