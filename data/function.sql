CREATE OR REPLACE FUNCTION f_update_nb_emprunte() RETURNS TRIGGER AS
$f_update_nb_emprunte$
BEGIN 
  IF OLD.emprunteur IS NULL AND NEW.emprunteur IS NOT NULL 
  THEN  
      UPDATE "User" 
      SET nb_livres_empruntes = nb_livres_empruntes + 1
      WHERE id_user = NEW.emprunteur;
  END IF;
  IF OLD.emprunteur IS NOT NULL AND NEW.emprunteur IS NULL 
  THEN
      UPDATE "User" 
      SET nb_livres_rendus = nb_livres_rendus + 1
      WHERE id_user = OLD.emprunteur;
  END IF; 
  RETURN NULL;
END;
$f_update_nb_emprunte$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION f_init_user() RETURNS TRIGGER AS
$f_init_user$
BEGIN
  NEW.nb_livres_empruntes = 0;
  NEW.nb_livres_rendus = 0;
  RETURN NEW;
END
$f_init_user$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION f_init_livre() RETURNS TRIGGER AS
$f_init_livre$
BEGIN
  NEW.emprunteur = NULL;
  NEW.date_emprunt = NULL;
  RETURN NEW;
END
$f_init_livre$ LANGUAGE plpgsql;