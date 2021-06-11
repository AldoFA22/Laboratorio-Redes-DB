--
-- PostgreSQL database dump
--

-- Dumped from database version 11.12 (Raspbian 11.12-0+deb10u1)
-- Dumped by pg_dump version 11.12 (Raspbian 11.12-0+deb10u1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: createuser(character varying, character varying, character varying); Type: FUNCTION; Schema: public; Owner: dba6
--

CREATE FUNCTION public.createuser(id_usuario character varying, nombre character varying, apellido character varying) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
	begin
		INSERT INTO usuarios VALUES (id_usuario, nombre, apellido);
		return id_usuario;
	end
	$$;


ALTER FUNCTION public.createuser(id_usuario character varying, nombre character varying, apellido character varying) OWNER TO dba6;

--
-- Name: getapartados(); Type: FUNCTION; Schema: public; Owner: dba6
--

CREATE FUNCTION public.getapartados() RETURNS TABLE(id integer, id_herramienta integer, usuario text, fecha_apartado timestamp without time zone, fecha_entrega timestamp without time zone, diferencia timestamp without time zone)
    LANGUAGE plpgsql
    AS $$
	begin
		SELECT * FROM apartados NATURAL JOIN usuarios ORDER BY apartados.id_apartado DESC;
	end; $$;


ALTER FUNCTION public.getapartados() OWNER TO dba6;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: apartados; Type: TABLE; Schema: public; Owner: dba6
--

CREATE TABLE public.apartados (
    id_apartado integer NOT NULL,
    id_herramienta integer NOT NULL,
    matricula_usuario character varying(9) NOT NULL,
    fecha_creacion timestamp without time zone,
    fecha_entrega timestamp without time zone,
    entregado boolean NOT NULL,
    CONSTRAINT apartados_fecha_entrega_check CHECK ((fecha_entrega >= now()))
);


ALTER TABLE public.apartados OWNER TO dba6;

--
-- Name: apartados_id_apartado_seq; Type: SEQUENCE; Schema: public; Owner: dba6
--

CREATE SEQUENCE public.apartados_id_apartado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.apartados_id_apartado_seq OWNER TO dba6;

--
-- Name: apartados_id_apartado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dba6
--

ALTER SEQUENCE public.apartados_id_apartado_seq OWNED BY public.apartados.id_apartado;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: dba6
--

CREATE TABLE public.usuarios (
    id_usuario character varying(9) NOT NULL,
    nombre_usuario character varying(50) NOT NULL,
    apellido_usuario character varying(50) NOT NULL
);


ALTER TABLE public.usuarios OWNER TO dba6;

--
-- Name: apartados id_apartado; Type: DEFAULT; Schema: public; Owner: dba6
--

ALTER TABLE ONLY public.apartados ALTER COLUMN id_apartado SET DEFAULT nextval('public.apartados_id_apartado_seq'::regclass);


--
-- Data for Name: apartados; Type: TABLE DATA; Schema: public; Owner: dba6
--

COPY public.apartados (id_apartado, id_herramienta, matricula_usuario, fecha_creacion, fecha_entrega, entregado) FROM stdin;
1	4	A01328274	2021-06-10 00:00:00	2021-06-15 00:00:00	t
16	21	A01328275	2021-06-11 08:21:00.808043	2021-06-14 00:00:00	t
20	28	A01328275	2021-06-11 09:35:03.136819	2021-06-13 00:00:00	f
19	28	A01328275	2021-06-11 09:34:48.806285	2021-06-16 00:00:00	f
21	30	A01328274	2021-06-11 09:35:22.910084	2021-07-01 00:00:00	f
17	23	A01328275	2021-06-11 08:21:24.060568	2021-06-14 00:00:00	t
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: dba6
--

COPY public.usuarios (id_usuario, nombre_usuario, apellido_usuario) FROM stdin;
A01328274	Theo Salvador	Pérez Tovar
A01097122	Juana Sanchez	Arroy
A01328275	Juana Sanchez	Arroy
A01730969	Arturo	Zambrix
A01730968	Arturo	Zambrix
\.


--
-- Name: apartados_id_apartado_seq; Type: SEQUENCE SET; Schema: public; Owner: dba6
--

SELECT pg_catalog.setval('public.apartados_id_apartado_seq', 23, true);


--
-- Name: apartados apartados_pkey; Type: CONSTRAINT; Schema: public; Owner: dba6
--

ALTER TABLE ONLY public.apartados
    ADD CONSTRAINT apartados_pkey PRIMARY KEY (id_apartado, matricula_usuario);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: dba6
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);


--
-- Name: apartados apartados_matricula_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: dba6
--

ALTER TABLE ONLY public.apartados
    ADD CONSTRAINT apartados_matricula_usuario_fkey FOREIGN KEY (matricula_usuario) REFERENCES public.usuarios(id_usuario);


--
-- PostgreSQL database dump complete
--

