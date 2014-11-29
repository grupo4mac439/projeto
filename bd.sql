SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

CREATE SCHEMA vendaingressos;
ALTER SCHEMA vendaingressos OWNER TO mac439_grupo4_2014;

SET search_path = vendaingressos, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

CREATE TABLE artista (
    id integer NOT NULL,
    nome character varying(40) NOT NULL,
    nome_artistico character varying(20) NOT NULL,
    e_diretor boolean,
    e_ator boolean,
    e_musico boolean
);


CREATE SEQUENCE artista_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE artista_id_seq OWNED BY artista.id;

CREATE TABLE cliente (
    id integer NOT NULL,
    login character varying(15),
    cpf character varying(12) NOT NULL,
    email character varying(40),
    nome character varying(40) NOT NULL,
    endereco character varying(25),
    senha character varying(255) NOT NULL,
    data_cadastro date NOT NULL
);


CREATE SEQUENCE cliente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE cliente_id_seq OWNED BY cliente.id;

CREATE TABLE compra (
    id integer NOT NULL,
    id_cliente integer NOT NULL,
    data date NOT NULL,
    desconto integer,
    CONSTRAINT compra_desconto_check CHECK (((desconto >= 0) AND (desconto <= 100)))
);


CREATE SEQUENCE compra_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE compra_id_seq OWNED BY compra.id;

CREATE TABLE conjunto (
    id integer NOT NULL,
    nome character varying(30) NOT NULL
);


CREATE SEQUENCE conjunto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE conjunto_id_seq OWNED BY conjunto.id;

CREATE TABLE evento (
    id integer NOT NULL,
    nome character varying(20),
    genero character varying(20) NOT NULL,
    classificacao character varying(2) NOT NULL,
    foto character varying(30),
    tipo character varying(1)
);


CREATE SEQUENCE evento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE evento_id_seq OWNED BY evento.id;

CREATE TABLE filmes_existentes (
    id integer NOT NULL,
    nome character varying(40),
    ano_lancamento integer,
    id_diretor integer
);


CREATE SEQUENCE filmes_existentes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE filmes_existentes_id_seq OWNED BY filmes_existentes.id;

CREATE TABLE ingresso (
    id integer NOT NULL,
    id_lugar integer
);


CREATE SEQUENCE ingresso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE ingresso_id_seq OWNED BY ingresso.id;

CREATE TABLE instancia_evento (
    id integer NOT NULL,
    data date NOT NULL,
    hora time without time zone NOT NULL,
    id_evento integer,
    id_local integer
);


CREATE SEQUENCE instancia_evento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE instancia_evento_id_seq OWNED BY instancia_evento.id;

CREATE TABLE local (
    id integer NOT NULL,
    endereco character varying(25),
    capacidade integer NOT NULL,
    tipo character(1) NOT NULL,
    nome character varying(40),
    CONSTRAINT local_capacidade_check CHECK ((capacidade > 0)),
    CONSTRAINT local_tipo_check CHECK ((((tipo = 's'::bpchar) OR (tipo = 'c'::bpchar)) OR (tipo = 't'::bpchar)))
);


CREATE SEQUENCE local_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE local_id_seq OWNED BY local.id;

CREATE TABLE lugares (
    id integer NOT NULL,
    id_setor integer,
    status character varying(10) NOT NULL,
    CONSTRAINT lugares_status_check CHECK (((((status)::text = 'reservado'::text) OR ((status)::text = 'livre'::text)) OR ((status)::text = 'comprado'::text)))
);


CREATE TABLE lugares_comprados (
    id_lugar integer NOT NULL,
    id_compra integer NOT NULL,
    id_cliente integer NOT NULL
);


CREATE SEQUENCE lugares_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE lugares_id_seq OWNED BY lugares.id;

CREATE TABLE lugares_marcados (
    num_cadeira integer NOT NULL,
    id_lugar integer
);


CREATE TABLE lugares_naomarcados (
    id integer NOT NULL,
    id_lugar integer
);


CREATE TABLE participacao_conjunto (
    id_conjunto integer NOT NULL,
    id_musico integer NOT NULL
);


CREATE TABLE participacao_filme (
    id_artista integer NOT NULL,
    id_filme integer NOT NULL
);


CREATE TABLE participacao_filmesexistentes (
    id_ator integer NOT NULL,
    id_filme integer NOT NULL
);


CREATE TABLE participacao_peca (
    id_artista integer NOT NULL,
    id_peca integer NOT NULL
);


CREATE TABLE participacao_show (
    id_artista integer NOT NULL,
    id_show integer NOT NULL
);


CREATE TABLE rede (
    id integer NOT NULL,
    nome character varying(15)
);


CREATE SEQUENCE rede_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE rede_id_seq OWNED BY rede.id;

CREATE TABLE reserva (
    id_cliente integer NOT NULL,
    id_lugar integer NOT NULL,
    data_ini date NOT NULL,
    data_fim date NOT NULL
);


CREATE TABLE salacinema (
    id integer NOT NULL,
    id_local integer NOT NULL,
    id_rede integer NOT NULL
);


CREATE SEQUENCE salacinema_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE salacinema_id_seq OWNED BY salacinema.id;

CREATE TABLE setores (
    id integer NOT NULL,
    nome character varying(25) NOT NULL,
    cota_meia integer NOT NULL,
    preco numeric(6,2) NOT NULL,
    id_inst_evento integer,
    CONSTRAINT setores_preco_check CHECK ((preco >= 0.0))
);


CREATE SEQUENCE setores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE setores_id_seq OWNED BY setores.id;

CREATE TABLE show (
    id_evento integer NOT NULL,
    descricao text
);


CREATE TABLE telefones_local (
    id_local integer NOT NULL,
    ddd numeric(3,0),
    num_telefone numeric(9,0) NOT NULL
);

ALTER TABLE ONLY artista ALTER COLUMN id SET DEFAULT nextval('artista_id_seq'::regclass);




ALTER TABLE ONLY cliente ALTER COLUMN id SET DEFAULT nextval('cliente_id_seq'::regclass);
ALTER TABLE ONLY compra ALTER COLUMN id SET DEFAULT nextval('compra_id_seq'::regclass);
ALTER TABLE ONLY conjunto ALTER COLUMN id SET DEFAULT nextval('conjunto_id_seq'::regclass);
ALTER TABLE ONLY evento ALTER COLUMN id SET DEFAULT nextval('evento_id_seq'::regclass);
ALTER TABLE ONLY filmes_existentes ALTER COLUMN id SET DEFAULT nextval('filmes_existentes_id_seq'::regclass);
ALTER TABLE ONLY ingresso ALTER COLUMN id SET DEFAULT nextval('ingresso_id_seq'::regclass);
ALTER TABLE ONLY instancia_evento ALTER COLUMN id SET DEFAULT nextval('instancia_evento_id_seq'::regclass);
ALTER TABLE ONLY local ALTER COLUMN id SET DEFAULT nextval('local_id_seq'::regclass);
ALTER TABLE ONLY lugares ALTER COLUMN id SET DEFAULT nextval('lugares_id_seq'::regclass);
ALTER TABLE ONLY rede ALTER COLUMN id SET DEFAULT nextval('rede_id_seq'::regclass);
ALTER TABLE ONLY salacinema ALTER COLUMN id SET DEFAULT nextval('salacinema_id_seq'::regclass);
ALTER TABLE ONLY setores ALTER COLUMN id SET DEFAULT nextval('setores_id_seq'::regclass);
ALTER TABLE ONLY artista
    ADD CONSTRAINT artista_pkey PRIMARY KEY (id);
ALTER TABLE ONLY cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (id);
ALTER TABLE ONLY compra
    ADD CONSTRAINT compra_pkey PRIMARY KEY (id, id_cliente);
ALTER TABLE ONLY conjunto
    ADD CONSTRAINT conjunto_pkey PRIMARY KEY (id);
ALTER TABLE ONLY cliente
    ADD CONSTRAINT cpf_unico UNIQUE (cpf);
ALTER TABLE ONLY evento
    ADD CONSTRAINT evento_pkey PRIMARY KEY (id);
ALTER TABLE ONLY filmes_existentes
    ADD CONSTRAINT filmes_existentes_pkey PRIMARY KEY (id);
ALTER TABLE ONLY ingresso
    ADD CONSTRAINT ingresso_pkey PRIMARY KEY (id);
ALTER TABLE ONLY instancia_evento
    ADD CONSTRAINT instancia_evento_pkey PRIMARY KEY (id);
ALTER TABLE ONLY local
    ADD CONSTRAINT local_pkey PRIMARY KEY (id);
ALTER TABLE ONLY lugares_comprados
    ADD CONSTRAINT lugares_comprados_pkey PRIMARY KEY (id_lugar, id_compra, id_cliente);
ALTER TABLE ONLY lugares_marcados
    ADD CONSTRAINT lugares_marcados_pkey PRIMARY KEY (num_cadeira);
ALTER TABLE ONLY lugares_naomarcados
    ADD CONSTRAINT lugares_naomarcados_pkey PRIMARY KEY (id);
ALTER TABLE ONLY lugares
    ADD CONSTRAINT lugares_pkey PRIMARY KEY (id);
ALTER TABLE ONLY participacao_conjunto
    ADD CONSTRAINT participacao_conjunto_pkey PRIMARY KEY (id_conjunto, id_musico);
ALTER TABLE ONLY participacao_filme
    ADD CONSTRAINT participacao_filme_pkey PRIMARY KEY (id_artista, id_filme);
ALTER TABLE ONLY participacao_filmesexistentes
    ADD CONSTRAINT participacao_filmesexistentes_pkey PRIMARY KEY (id_ator, id_filme);
ALTER TABLE ONLY participacao_peca
    ADD CONSTRAINT participacao_peca_pkey PRIMARY KEY (id_artista, id_peca);
ALTER TABLE ONLY participacao_show
    ADD CONSTRAINT participacao_show_pkey PRIMARY KEY (id_artista, id_show);
ALTER TABLE ONLY rede
    ADD CONSTRAINT rede_pkey PRIMARY KEY (id);
ALTER TABLE ONLY reserva
    ADD CONSTRAINT reserva_pkey PRIMARY KEY (id_cliente, id_lugar, data_ini);
ALTER TABLE ONLY salacinema
    ADD CONSTRAINT salacinema_pkey PRIMARY KEY (id, id_rede, id_local);
ALTER TABLE ONLY setores
    ADD CONSTRAINT setores_pkey PRIMARY KEY (id);
ALTER TABLE ONLY show
    ADD CONSTRAINT show_pkey PRIMARY KEY (id_evento);
ALTER TABLE ONLY telefones_local
    ADD CONSTRAINT telefones_local_pkey PRIMARY KEY (id_local, num_telefone);
ALTER TABLE ONLY compra
    ADD CONSTRAINT compra_id_cliente_fkey FOREIGN KEY (id_cliente) REFERENCES cliente(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY filmes_existentes
    ADD CONSTRAINT filmes_existentes_id_diretor_fkey FOREIGN KEY (id_diretor) REFERENCES artista(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY ingresso
    ADD CONSTRAINT ingresso_id_lugar_fkey FOREIGN KEY (id_lugar) REFERENCES lugares(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY instancia_evento
    ADD CONSTRAINT instancia_evento_id_evento_fkey FOREIGN KEY (id_evento) REFERENCES evento(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY instancia_evento
    ADD CONSTRAINT instancia_evento_id_local_fkey FOREIGN KEY (id_local) REFERENCES local(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY lugares_comprados
    ADD CONSTRAINT lugares_comprados_id_compra_fkey FOREIGN KEY (id_compra, id_cliente) REFERENCES compra(id, id_cliente) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY lugares_comprados
    ADD CONSTRAINT lugares_comprados_id_lugar_fkey FOREIGN KEY (id_lugar) REFERENCES lugares(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY lugares
    ADD CONSTRAINT lugares_id_setor_fkey FOREIGN KEY (id_setor) REFERENCES setores(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY lugares_marcados
    ADD CONSTRAINT lugares_marcados_id_lugar_fkey FOREIGN KEY (id_lugar) REFERENCES lugares(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY lugares_naomarcados
    ADD CONSTRAINT lugares_naomarcados_id_lugar_fkey FOREIGN KEY (id_lugar) REFERENCES lugares(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY participacao_conjunto
    ADD CONSTRAINT participacao_conjunto_id_conjunto_fkey FOREIGN KEY (id_conjunto) REFERENCES conjunto(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY participacao_conjunto
    ADD CONSTRAINT participacao_conjunto_id_musico_fkey FOREIGN KEY (id_musico) REFERENCES artista(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY participacao_filme
    ADD CONSTRAINT participacao_filme_id_artista_fkey FOREIGN KEY (id_artista) REFERENCES artista(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY participacao_filmesexistentes
    ADD CONSTRAINT participacao_filmesexistentes_id_ator_fkey FOREIGN KEY (id_ator) REFERENCES artista(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY participacao_filmesexistentes
    ADD CONSTRAINT participacao_filmesexistentes_id_filme_fkey FOREIGN KEY (id_filme) REFERENCES filmes_existentes(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY participacao_peca
    ADD CONSTRAINT participacao_peca_id_artista_fkey FOREIGN KEY (id_artista) REFERENCES artista(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY participacao_show
    ADD CONSTRAINT participacao_show_id_artista_fkey FOREIGN KEY (id_artista) REFERENCES artista(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY participacao_show
    ADD CONSTRAINT participacao_show_id_show_fkey FOREIGN KEY (id_show) REFERENCES show(id_evento) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY reserva
    ADD CONSTRAINT reserva_id_cliente_fkey FOREIGN KEY (id_cliente) REFERENCES cliente(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY reserva
    ADD CONSTRAINT reserva_id_lugar_fkey FOREIGN KEY (id_lugar) REFERENCES lugares(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY salacinema
    ADD CONSTRAINT salacinema_id_local_fkey FOREIGN KEY (id_local) REFERENCES local(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY salacinema
    ADD CONSTRAINT salacinema_id_rede_fkey FOREIGN KEY (id_rede) REFERENCES rede(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY setores
    ADD CONSTRAINT setores_id_inst_evento_fkey FOREIGN KEY (id_inst_evento) REFERENCES instancia_evento(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY show
    ADD CONSTRAINT show_id_evento_fkey FOREIGN KEY (id_evento) REFERENCES evento(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE ONLY telefones_local
    ADD CONSTRAINT telefones_local_id_local_fkey FOREIGN KEY (id_local) REFERENCES local(id) ON UPDATE CASCADE ON DELETE CASCADE;
