--
-- PostgreSQL database cluster dump
--

SET default_transaction_read_only = off;

SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;

--
-- Roles
--

CREATE ROLE postgres;
ALTER ROLE postgres WITH SUPERUSER INHERIT CREATEROLE CREATEDB LOGIN REPLICATION BYPASSRLS PASSWORD 'md5d492158967dc270f630865e36a432eae';






\connect template1

--
-- PostgreSQL database dump
--

-- Dumped from database version 11.2
-- Dumped by pg_dump version 11.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- PostgreSQL database dump complete
--

\connect postgres

--
-- PostgreSQL database dump
--

-- Dumped from database version 11.2
-- Dumped by pg_dump version 11.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: article; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.article (
    id_article integer NOT NULL,
    titre character varying(100) NOT NULL,
    texte character varying(10000) NOT NULL,
    id_membre integer NOT NULL,
    date date NOT NULL
);


ALTER TABLE public.article OWNER TO postgres;

--
-- Name: article_id_article_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.article_id_article_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.article_id_article_seq OWNER TO postgres;

--
-- Name: article_id_article_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.article_id_article_seq OWNED BY public.article.id_article;


--
-- Name: equipe; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.equipe (
    id_jeu integer NOT NULL,
    id_membre integer NOT NULL,
    role character varying(10)
);


ALTER TABLE public.equipe OWNER TO postgres;

--
-- Name: jeux; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jeux (
    id_jeu integer NOT NULL,
    titre character varying(50) NOT NULL,
    git character varying(100),
    telechargement character varying(100)
);


ALTER TABLE public.jeux OWNER TO postgres;

--
-- Name: jeux_id_jeu_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jeux_id_jeu_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jeux_id_jeu_seq OWNER TO postgres;

--
-- Name: jeux_id_jeu_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jeux_id_jeu_seq OWNED BY public.jeux.id_jeu;


--
-- Name: media; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.media (
    id_medial integer NOT NULL,
    type character varying(10),
    lien character varying(100)
);


ALTER TABLE public.media OWNER TO postgres;

--
-- Name: media_id_medial_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.media_id_medial_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.media_id_medial_seq OWNER TO postgres;

--
-- Name: media_id_medial_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.media_id_medial_seq OWNED BY public.media.id_medial;


--
-- Name: membre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.membre (
    id_membre integer NOT NULL,
    nom character varying(50),
    prenom character varying(50),
    surnom character varying(50) NOT NULL,
    password character varying(20) NOT NULL,
    promo integer,
    role character(1)
);


ALTER TABLE public.membre OWNER TO postgres;

--
-- Name: membre_id_membre_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.membre_id_membre_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.membre_id_membre_seq OWNER TO postgres;

--
-- Name: membre_id_membre_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.membre_id_membre_seq OWNED BY public.membre.id_membre;


--
-- Name: miseajour; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.miseajour (
    id_maj integer NOT NULL,
    id_jeu integer NOT NULL,
    texte character varying(100),
    date date NOT NULL
);


ALTER TABLE public.miseajour OWNER TO postgres;

--
-- Name: miseajour_id_maj_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.miseajour_id_maj_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.miseajour_id_maj_seq OWNER TO postgres;

--
-- Name: miseajour_id_maj_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.miseajour_id_maj_seq OWNED BY public.miseajour.id_maj;


--
-- Name: tuto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tuto (
    id_tuto integer NOT NULL,
    titre character varying(100) NOT NULL,
    texte character varying(1000),
    pdf character varying(100) NOT NULL
);


ALTER TABLE public.tuto OWNER TO postgres;

--
-- Name: tuto_id_tuto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tuto_id_tuto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tuto_id_tuto_seq OWNER TO postgres;

--
-- Name: tuto_id_tuto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tuto_id_tuto_seq OWNED BY public.tuto.id_tuto;


--
-- Name: article id_article; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article ALTER COLUMN id_article SET DEFAULT nextval('public.article_id_article_seq'::regclass);


--
-- Name: jeux id_jeu; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jeux ALTER COLUMN id_jeu SET DEFAULT nextval('public.jeux_id_jeu_seq'::regclass);


--
-- Name: media id_medial; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media ALTER COLUMN id_medial SET DEFAULT nextval('public.media_id_medial_seq'::regclass);


--
-- Name: membre id_membre; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.membre ALTER COLUMN id_membre SET DEFAULT nextval('public.membre_id_membre_seq'::regclass);


--
-- Name: miseajour id_maj; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.miseajour ALTER COLUMN id_maj SET DEFAULT nextval('public.miseajour_id_maj_seq'::regclass);


--
-- Name: tuto id_tuto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tuto ALTER COLUMN id_tuto SET DEFAULT nextval('public.tuto_id_tuto_seq'::regclass);


--
-- Data for Name: article; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.article VALUES (1, 'fIIEts, celui qui part de RealitIIE en emportant la caisse, 30 ans après, il raconte son histoire', 'Qui va lire ce truc sérieux??', 4, '2019-04-13');
INSERT INTO public.article VALUES (2, 'Des études montrent que Carapuce est supérieur à Bowser en tout points', 'carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce carapuce ', 1, '2019-03-26');
INSERT INTO public.article VALUES (3, 'L''ITALIE ENVAHIE L''ALGERIE!!! PRANK QUI TOURNE MAL! EXPLICATION!!!', 'ITALIA DE LA PASTA!!!!', 1, '2006-01-08');


--
-- Data for Name: equipe; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.equipe VALUES (1, 3, 'dev');
INSERT INTO public.equipe VALUES (2, 1, 'dev');
INSERT INTO public.equipe VALUES (2, 2, 'ia');


--
-- Data for Name: jeux; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.jeux VALUES (1, 'Fight for the Door', '', '');
INSERT INTO public.jeux VALUES (2, 'Overcraft', '', '');


--
-- Data for Name: media; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.media VALUES (1, 'sextape', 'ta_pas_envie_de_voir.ypr');
INSERT INTO public.media VALUES (2, 'CARAPUCE!', 'carapuce.png');


--
-- Data for Name: membre; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.membre VALUES (1, 'BRANDI', 'Matteo', 'Altreon', 'carapute', 2021, 'a');
INSERT INTO public.membre VALUES (2, 'ACHEROUFKEBIR', 'Yacine', 'DBA3', 'bowser>cara', 2021, 'a');
INSERT INTO public.membre VALUES (3, 'VAN DER LEE', 'Rémi', 'fIIEts', 'C_pas_ekrire', 2021, 'a');
INSERT INTO public.membre VALUES (4, 'PILLONEL', 'Matthis', '801', 'vieux', 2020, 'r');


--
-- Data for Name: miseajour; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.miseajour VALUES (1, 1, 'Implémentation des leviers', '2019-05-10');
INSERT INTO public.miseajour VALUES (2, 2, 'Réglage de l''IA et ajout de carapuce', '2025-12-18');


--
-- Data for Name: tuto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tuto VALUES (1, '[BLENDER] Squelettisation', 'Apprendre à insérer un squelette sur un modèle afin de pouvoir l''animer.', 'squelettisation.pdf');


--
-- Name: article_id_article_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.article_id_article_seq', 3, true);


--
-- Name: jeux_id_jeu_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jeux_id_jeu_seq', 2, true);


--
-- Name: media_id_medial_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.media_id_medial_seq', 2, true);


--
-- Name: membre_id_membre_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.membre_id_membre_seq', 4, true);


--
-- Name: miseajour_id_maj_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.miseajour_id_maj_seq', 2, true);


--
-- Name: tuto_id_tuto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tuto_id_tuto_seq', 1, true);


--
-- Name: article article_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_pkey PRIMARY KEY (id_article);


--
-- Name: equipe equipe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.equipe
    ADD CONSTRAINT equipe_pkey PRIMARY KEY (id_jeu, id_membre);


--
-- Name: jeux jeux_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jeux
    ADD CONSTRAINT jeux_pkey PRIMARY KEY (id_jeu);


--
-- Name: media media_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_pkey PRIMARY KEY (id_medial);


--
-- Name: membre membre_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.membre
    ADD CONSTRAINT membre_pkey PRIMARY KEY (id_membre);


--
-- Name: miseajour miseajour_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.miseajour
    ADD CONSTRAINT miseajour_pkey PRIMARY KEY (id_maj);


--
-- Name: tuto tuto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tuto
    ADD CONSTRAINT tuto_pkey PRIMARY KEY (id_tuto);


--
-- Name: article article_id_membre_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_id_membre_fkey FOREIGN KEY (id_membre) REFERENCES public.membre(id_membre);


--
-- Name: equipe equipe_id_jeu_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.equipe
    ADD CONSTRAINT equipe_id_jeu_fkey FOREIGN KEY (id_jeu) REFERENCES public.jeux(id_jeu);


--
-- Name: equipe equipe_id_membre_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.equipe
    ADD CONSTRAINT equipe_id_membre_fkey FOREIGN KEY (id_membre) REFERENCES public.membre(id_membre);


--
-- Name: miseajour miseajour_id_jeu_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.miseajour
    ADD CONSTRAINT miseajour_id_jeu_fkey FOREIGN KEY (id_jeu) REFERENCES public.jeux(id_jeu);


--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database cluster dump complete
--

