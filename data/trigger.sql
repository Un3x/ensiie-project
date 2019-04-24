CREATE TRIGGER increase_nb_user AFTER UPDATE
ON "Livre" FOR EACH ROW
EXECUTE PROCEDURE f_update_nb_emprunte();

CREATE TRIGGER initialization_user BEFORE INSERT
ON "User" FOR EACH ROW
EXECUTE PROCEDURE f_init_user();

CREATE TRIGGER initialization_livre BEFORE INSERT
ON "Livre" FOR EACH ROW
EXECUTE PROCEDURE f_init_livre();


