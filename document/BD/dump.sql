PGDMP                          w        	   realitiie    9.5.16    9.5.16 A    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            �           1262    16402 	   realitiie    DATABASE     �   CREATE DATABASE realitiie WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'French_France.1252' LC_CTYPE = 'French_France.1252';
    DROP DATABASE realitiie;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            �           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    6            �           0    0    SCHEMA public    ACL     �   REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;
                  postgres    false    6                        3079    12355    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            �           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1            �            1259    24640    article    TABLE     �   CREATE TABLE public.article (
    id_article integer NOT NULL,
    titre character varying(100) NOT NULL,
    texte character varying(10000) NOT NULL,
    id_membre integer NOT NULL,
    date date NOT NULL,
    compte_rendu boolean DEFAULT false
);
    DROP TABLE public.article;
       public         postgres    false    6            �            1259    24638    article_id_article_seq    SEQUENCE        CREATE SEQUENCE public.article_id_article_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.article_id_article_seq;
       public       postgres    false    189    6            �           0    0    article_id_article_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.article_id_article_seq OWNED BY public.article.id_article;
            public       postgres    false    188            �            1259    24623    equipe    TABLE     |   CREATE TABLE public.equipe (
    id_jeu integer NOT NULL,
    id_membre integer NOT NULL,
    role character varying(30)
);
    DROP TABLE public.equipe;
       public         postgres    false    6            �            1259    24588    jeux    TABLE     �   CREATE TABLE public.jeux (
    id_jeu integer NOT NULL,
    titre character varying(50) NOT NULL,
    git character varying(100),
    telechargement character varying(100),
    description character varying(10000)
);
    DROP TABLE public.jeux;
       public         postgres    false    6            �            1259    24586    jeux_id_jeu_seq    SEQUENCE     x   CREATE SEQUENCE public.jeux_id_jeu_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.jeux_id_jeu_seq;
       public       postgres    false    6    184            �           0    0    jeux_id_jeu_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.jeux_id_jeu_seq OWNED BY public.jeux.id_jeu;
            public       postgres    false    183            �            1259    24732    media    TABLE     �   CREATE TABLE public.media (
    id_media integer NOT NULL,
    id_jeu integer,
    id_maj integer,
    id_article integer,
    id_membre integer
);
    DROP TABLE public.media;
       public         postgres    false    6            �            1259    24730    media_id_media_seq    SEQUENCE     {   CREATE SEQUENCE public.media_id_media_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.media_id_media_seq;
       public       postgres    false    6    193            �           0    0    media_id_media_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.media_id_media_seq OWNED BY public.media.id_media;
            public       postgres    false    192            �            1259    16405    membre    TABLE       CREATE TABLE public.membre (
    id_membre integer NOT NULL,
    nom character varying(50),
    prenom character varying(50),
    surnom character varying(50) NOT NULL,
    password character(60) NOT NULL,
    promo integer,
    role character varying(20)
);
    DROP TABLE public.membre;
       public         postgres    false    6            �            1259    16403    membre_id_membre_seq    SEQUENCE     }   CREATE SEQUENCE public.membre_id_membre_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.membre_id_membre_seq;
       public       postgres    false    182    6            �           0    0    membre_id_membre_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.membre_id_membre_seq OWNED BY public.membre.id_membre;
            public       postgres    false    181            �            1259    24609 	   miseajour    TABLE     �   CREATE TABLE public.miseajour (
    id_maj integer NOT NULL,
    id_jeu integer NOT NULL,
    texte character varying(10000),
    date date NOT NULL
);
    DROP TABLE public.miseajour;
       public         postgres    false    6            �            1259    24607    miseajour_id_maj_seq    SEQUENCE     }   CREATE SEQUENCE public.miseajour_id_maj_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.miseajour_id_maj_seq;
       public       postgres    false    186    6            �           0    0    miseajour_id_maj_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.miseajour_id_maj_seq OWNED BY public.miseajour.id_maj;
            public       postgres    false    185            �            1259    24658    tuto    TABLE     �   CREATE TABLE public.tuto (
    id_tuto integer NOT NULL,
    titre character varying(100) NOT NULL,
    texte character varying(1000),
    pdf character varying(100) NOT NULL
);
    DROP TABLE public.tuto;
       public         postgres    false    6            �            1259    24656    tuto_id_tuto_seq    SEQUENCE     y   CREATE SEQUENCE public.tuto_id_tuto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.tuto_id_tuto_seq;
       public       postgres    false    6    191            �           0    0    tuto_id_tuto_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.tuto_id_tuto_seq OWNED BY public.tuto.id_tuto;
            public       postgres    false    190            �           2604    24643 
   id_article    DEFAULT     x   ALTER TABLE ONLY public.article ALTER COLUMN id_article SET DEFAULT nextval('public.article_id_article_seq'::regclass);
 A   ALTER TABLE public.article ALTER COLUMN id_article DROP DEFAULT;
       public       postgres    false    189    188    189            �           2604    24591    id_jeu    DEFAULT     j   ALTER TABLE ONLY public.jeux ALTER COLUMN id_jeu SET DEFAULT nextval('public.jeux_id_jeu_seq'::regclass);
 :   ALTER TABLE public.jeux ALTER COLUMN id_jeu DROP DEFAULT;
       public       postgres    false    183    184    184            �           2604    24735    id_media    DEFAULT     p   ALTER TABLE ONLY public.media ALTER COLUMN id_media SET DEFAULT nextval('public.media_id_media_seq'::regclass);
 =   ALTER TABLE public.media ALTER COLUMN id_media DROP DEFAULT;
       public       postgres    false    193    192    193            �           2604    16408 	   id_membre    DEFAULT     t   ALTER TABLE ONLY public.membre ALTER COLUMN id_membre SET DEFAULT nextval('public.membre_id_membre_seq'::regclass);
 ?   ALTER TABLE public.membre ALTER COLUMN id_membre DROP DEFAULT;
       public       postgres    false    181    182    182            �           2604    24612    id_maj    DEFAULT     t   ALTER TABLE ONLY public.miseajour ALTER COLUMN id_maj SET DEFAULT nextval('public.miseajour_id_maj_seq'::regclass);
 ?   ALTER TABLE public.miseajour ALTER COLUMN id_maj DROP DEFAULT;
       public       postgres    false    186    185    186            �           2604    24661    id_tuto    DEFAULT     l   ALTER TABLE ONLY public.tuto ALTER COLUMN id_tuto SET DEFAULT nextval('public.tuto_id_tuto_seq'::regclass);
 ;   ALTER TABLE public.tuto ALTER COLUMN id_tuto DROP DEFAULT;
       public       postgres    false    190    191    191            �          0    24640    article 
   TABLE DATA               Z   COPY public.article (id_article, titre, texte, id_membre, date, compte_rendu) FROM stdin;
    public       postgres    false    189   kF       �           0    0    article_id_article_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.article_id_article_seq', 6, true);
            public       postgres    false    188                      0    24623    equipe 
   TABLE DATA               9   COPY public.equipe (id_jeu, id_membre, role) FROM stdin;
    public       postgres    false    187   dR       |          0    24588    jeux 
   TABLE DATA               O   COPY public.jeux (id_jeu, titre, git, telechargement, description) FROM stdin;
    public       postgres    false    184   �R       �           0    0    jeux_id_jeu_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.jeux_id_jeu_seq', 3, true);
            public       postgres    false    183            �          0    24732    media 
   TABLE DATA               P   COPY public.media (id_media, id_jeu, id_maj, id_article, id_membre) FROM stdin;
    public       postgres    false    193   S       �           0    0    media_id_media_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.media_id_media_seq', 1, false);
            public       postgres    false    192            z          0    16405    membre 
   TABLE DATA               W   COPY public.membre (id_membre, nom, prenom, surnom, password, promo, role) FROM stdin;
    public       postgres    false    182   )S       �           0    0    membre_id_membre_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.membre_id_membre_seq', 11, true);
            public       postgres    false    181            ~          0    24609 	   miseajour 
   TABLE DATA               @   COPY public.miseajour (id_maj, id_jeu, texte, date) FROM stdin;
    public       postgres    false    186   fU       �           0    0    miseajour_id_maj_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.miseajour_id_maj_seq', 1, false);
            public       postgres    false    185            �          0    24658    tuto 
   TABLE DATA               :   COPY public.tuto (id_tuto, titre, texte, pdf) FROM stdin;
    public       postgres    false    191   V       �           0    0    tuto_id_tuto_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.tuto_id_tuto_seq', 1, true);
            public       postgres    false    190            �           2606    24648    article_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_pkey PRIMARY KEY (id_article);
 >   ALTER TABLE ONLY public.article DROP CONSTRAINT article_pkey;
       public         postgres    false    189    189            �           2606    24650    article_titre_key 
   CONSTRAINT     U   ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_titre_key UNIQUE (titre);
 C   ALTER TABLE ONLY public.article DROP CONSTRAINT article_titre_key;
       public         postgres    false    189    189            �           2606    24627    equipe_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.equipe
    ADD CONSTRAINT equipe_pkey PRIMARY KEY (id_jeu, id_membre);
 <   ALTER TABLE ONLY public.equipe DROP CONSTRAINT equipe_pkey;
       public         postgres    false    187    187    187            �           2606    24593 	   jeux_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.jeux
    ADD CONSTRAINT jeux_pkey PRIMARY KEY (id_jeu);
 8   ALTER TABLE ONLY public.jeux DROP CONSTRAINT jeux_pkey;
       public         postgres    false    184    184            �           2606    24595    jeux_titre_key 
   CONSTRAINT     O   ALTER TABLE ONLY public.jeux
    ADD CONSTRAINT jeux_titre_key UNIQUE (titre);
 =   ALTER TABLE ONLY public.jeux DROP CONSTRAINT jeux_titre_key;
       public         postgres    false    184    184            �           2606    24737 
   media_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_pkey PRIMARY KEY (id_media);
 :   ALTER TABLE ONLY public.media DROP CONSTRAINT media_pkey;
       public         postgres    false    193    193            �           2606    16410    membre_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.membre
    ADD CONSTRAINT membre_pkey PRIMARY KEY (id_membre);
 <   ALTER TABLE ONLY public.membre DROP CONSTRAINT membre_pkey;
       public         postgres    false    182    182            �           2606    24703    miseajour_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.miseajour
    ADD CONSTRAINT miseajour_pkey PRIMARY KEY (id_maj, id_jeu);
 B   ALTER TABLE ONLY public.miseajour DROP CONSTRAINT miseajour_pkey;
       public         postgres    false    186    186    186            �           2606    24666 	   tuto_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY public.tuto
    ADD CONSTRAINT tuto_pkey PRIMARY KEY (id_tuto);
 8   ALTER TABLE ONLY public.tuto DROP CONSTRAINT tuto_pkey;
       public         postgres    false    191    191            �           2606    24668    tuto_titre_key 
   CONSTRAINT     O   ALTER TABLE ONLY public.tuto
    ADD CONSTRAINT tuto_titre_key UNIQUE (titre);
 =   ALTER TABLE ONLY public.tuto DROP CONSTRAINT tuto_titre_key;
       public         postgres    false    191    191            �           2606    24701    unique_surnom 
   CONSTRAINT     Q   ALTER TABLE ONLY public.membre
    ADD CONSTRAINT unique_surnom UNIQUE (surnom);
 >   ALTER TABLE ONLY public.membre DROP CONSTRAINT unique_surnom;
       public         postgres    false    182    182                       2606    24651    article_id_membre_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_id_membre_fkey FOREIGN KEY (id_membre) REFERENCES public.membre(id_membre);
 H   ALTER TABLE ONLY public.article DROP CONSTRAINT article_id_membre_fkey;
       public       postgres    false    182    189    2027                       2606    24628    equipe_id_jeu_fkey    FK CONSTRAINT     z   ALTER TABLE ONLY public.equipe
    ADD CONSTRAINT equipe_id_jeu_fkey FOREIGN KEY (id_jeu) REFERENCES public.jeux(id_jeu);
 C   ALTER TABLE ONLY public.equipe DROP CONSTRAINT equipe_id_jeu_fkey;
       public       postgres    false    184    2031    187                       2606    24633    equipe_id_membre_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.equipe
    ADD CONSTRAINT equipe_id_membre_fkey FOREIGN KEY (id_membre) REFERENCES public.membre(id_membre);
 F   ALTER TABLE ONLY public.equipe DROP CONSTRAINT equipe_id_membre_fkey;
       public       postgres    false    2027    182    187                       2606    24743    media_id_article_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_id_article_fkey FOREIGN KEY (id_article) REFERENCES public.article(id_article);
 E   ALTER TABLE ONLY public.media DROP CONSTRAINT media_id_article_fkey;
       public       postgres    false    189    2039    193                       2606    24738    media_id_maj_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_id_maj_fkey FOREIGN KEY (id_maj, id_jeu) REFERENCES public.miseajour(id_maj, id_jeu);
 A   ALTER TABLE ONLY public.media DROP CONSTRAINT media_id_maj_fkey;
       public       postgres    false    193    2035    186    186    193                       2606    24748    media_id_membre_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_id_membre_fkey FOREIGN KEY (id_membre) REFERENCES public.membre(id_membre);
 D   ALTER TABLE ONLY public.media DROP CONSTRAINT media_id_membre_fkey;
       public       postgres    false    193    182    2027                        2606    24618    miseajour_id_jeu_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.miseajour
    ADD CONSTRAINT miseajour_id_jeu_fkey FOREIGN KEY (id_jeu) REFERENCES public.jeux(id_jeu);
 I   ALTER TABLE ONLY public.miseajour DROP CONSTRAINT miseajour_id_jeu_fkey;
       public       postgres    false    2031    184    186            �   �  x��Y]o�}6���H���`!�7�����J�U�L��0K��
�t����H�d�	'Q�#޼�������r�	�ݙ����Su��Z;1:����ꩲV�}�}���ڪ¨����h~6*5*���d}������u�����������ֳ�����������^�O*��L����͟7���ڋ�K5t�o�JW�,Dȷ_��T��v*3^e=5���l�g+���$�.Tn��F�|R�J�z���kU9]��T�3��ګ���/9~���v��p�T����?PG�0O��(jOl0ȗ�xL!7:3��*R�F����W�L�;�*�+Ce)��pzr�0��p�W�`\_�Z5�e���J�����S��W=�*G8�Fx@_g����&8I��IRO(��&�ʣ�{�ŝ����[5�<��/�����Ku%`S9b�1P������bou߮�v�q�OvY��o�Q�Qe>�}ۛ�W��ɶ�+���j�Q���Ɯ�ź<��W��K�@&����	����Ȯ�,�X���x9zo�ʎ}7���f� ��sܤ�r}�P�]X��1���&gX���2����������|��m�{XT��Q-�n"4���J�$F�0"�7:��s� A�K�G����H�P�L+
����WC
��,c�x<$���A2z;�h0C����hx'1�S/م�1�:^��2�3�Ot����Ƹ��3����t��f7ɥv1_W89r�!|�p=諺9?�¢" @���ذ_�iR��`ű�0eV��7�8�cۨ��M�������yT��q�+&!�4�gU�=Cq~�Sr�;?����RG����ET/.[.l���f���Y]��,�U�q�=���H=q�'�
�U�j������ܹ�.V�"a��*��gN�H��R!&2ӤH�h����9�x��K]KF���{�_,J0:�I�9TyaJ�+P��$6U�p��=�yC=��>�8�ų_Mq�L�T$��("��0����m�N�Nq�?_�9�0��D�H�W!Eh��v�[[ۏБŎ�BG���<fO~ƞ<t&��/���Y��*rl�3����3�����a����KS�~�2��=��k��K>�r��!��˳�q{}���k*8xsJBJ�"���3��̤�k��k�7UxT� �ۯ��J��&�PE����}��Ϭt>����W}X�H�2mmÑ�]O�TŀQ���C$����pSl�@O�-X��T�|�Yu[����S-�Ny������0����ȿr \;)V��\����}u��:�:�#���TI4�������G_����F��n�BOw]�_�M~��S�Z�8G���U۪\dڈ�C� w���S݉�t����{�
�n�� `���xc��T�#O��p8��5?��UW̃�qb�m{j�M���n뒖&�$�ǳ=un�h�p�j/
�s��H~���3�I���D8e2%d_��<����y��Ӳ_wstX[��
ms2껵9:8\e�2����Fq��5[۝����+��̫����*de݇K���kȷ$�IW�����!p�o$8�/G*J9�K	������)'����`h���c���4�I䤬��ı��/7�H����CҎ-|j]����c�v����3dB�Z��������d��>'��� E�������f��!��j� q�d�;Qy� �'3Z�8\h�Y���� c�6�b�Zx�\FnGz����Ƨ��E)-5��y�P�QD����ކ7�w0t:��]����������V�!�?<?�dSe��&��6,I�����m�N�%EU����5�b�CeE�߶���:���t]�+�9W����5���"4�e��bs�3�LC;���&�����{\��O�'mN9�]I<�&����9�Bg8�Va�@gh�MF��ap�^*@��-�J�#%�P���9�Fp�	�C��g$MbXBR�\I��׈��j0(ԇҷ��f2����H
0�}�]�I�׆ 	��+�Ȭd�ĥ~4n���0%ٟ:9RӠ(���;b�D�=�P�-����@pZ��l�$�i����?�Ӧr��e��]%N^Z����̳��WW�`�3��Y~"��������(�㵤�lovZ
zX�,�i��CJ_��-�ѳ�Dp:&��ӅNu���G�Jrx�%�P�<:�[����R(�F\mv$��@ߛ�!��<0������ݞc�
O����:�z��ҕl��Hm����_=Q~ �9;�G�3Un��i�
,=i��+�pQ�>']G�ݹM�F����:��ug^mU'r��=Tc7�3��	 �s�w�J.C��1u{f��sT���ֳ�/�2���NY��̾1Y�N+���	J�'��N�,�����SO&��,4��l��,��4�|�3P���B��øP7:�g^��gأP2C��oa���*ux$B&���~_ʈ��Vm�uf��	(e��fQ���g�Ճp'��t)q��m��׽ШF�zr=����Jٛs�HV��,���Q��/ry&�NB0����qd}��	2��zsPMi�<ޥu�����vޚ7��O{�eQja���
��sB#[�k��L�'�����7��؉Q�b�5�.��n�����=_�P�E��{����[7�DO���
�����n�s�Tt��<�X�H���u�bt4������|/�*MBv����x����9eե��A</A�\a�]fx{��&���+��G9��!B��]�xt�,��"*�w7�c!:¶����}��1�'�K�D!��msL"��ߪ���z��C)�m�
P]��h(`g�(w��J��`�-,�i��YAs���^����?|����uiU���L�=L�:1�l����l$8���}~�k�~! -�j��E���4���i�Y�G~&��}���R4[2d�E��gM���#n}}}![/� ���.��yْw�{����e         7   x�3�4�tI-SPS��Oy�0+'�8�$����(�!dR���_P �[��c���� f�      |   Q   x�3�J-.)���������|.cN��Ԣ�ĴNN��!�[fzF�BZ~�BIF��K~~�gH0>ȁ����� g�l      �      x������ � �      z   -  x�=�M��0 ��u<�,z;�]%�i"�5�GP4�׈7���/6�5E_੷������8Q�
��m��x�Ë<}��c��b���&
b�o���yE�J�㲇ټ-Sc��Iw�ĉ��� �BD��L���>_�QJ�f��ǩf�.�� �On�C�L��TNZmo����;���7�e�Lύ���0	s�jCe ����te�%W�Y�w�� �584��xIUx")�	-�赕Mk��p/�d�����������F�����`W�n�/ܑ�����)ҬR�Kҡ(L���7��;��T�������� ;j���_÷yр�T�l�|TFm`/���6ݥUW��l!��'����6:�&JOT�?Փ+�/z��{	u���.������2B}�h�<�{��hH����U$�dE�t�$�����8����GW�̑�0����ťLG���T��DЄ�9\�Z�A7����PL��m��1=����5���ǥe�u��8E݀��e������7���串�x�"�N��Gf�q��j%�88�;_�W��I���/Ś�/      ~   	  x�]�;N�0���?�(	%E�؂QҌ�aw��?"J�A��ًp�ޥ��<���yh���}�	3����S�1t�9��A����h��X��o��Q�Y�$��l�|]T�;3����(��*#�%�
����9c���� e���:�f쇻]?���vԊR��h�'_�1�|}����OJ�ec�`���h��b���OE`���^B�t�.�B��9�d�8G��*r���C�o���ԗp�ta�%��^��9*i�ڵm�����      �   l   x�3�v�q�sq�U.,M�I-)�,N,����t,((J�K)JUx԰L!3��QìԢ�"��<�b��T��R�@n~��9�
�@~�Bb^fnj�g1��z)i\1z\\\ �i-"     