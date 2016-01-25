<!DOCTYPE html>
<html>
    <head>
        <title>Inscription</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <form action="./" method="post">
            <legend>Inscription</legend>
            <fieldset>
                <label for="identifiant">Entrez votre identifiant : </label>
                <input type="text" id="identifiant" name="identifiant"/><br />
                <label for="homme">Homme : </label>
                <input type="radio" id="homme" name="civilite" value="Homme"/><br />
                <label for="femme">Femme : </label>
                <input type="radio" id="femme" name="civilite" value="Femme"/><br />
                <label for="email">Entrez votre email : </label>
                <input type="email" id="email" name="email"/><br />
                <label for="mot_de_passe">Entrez votre mot de passe : </label>
                <input type="password" id="mot_de_passe" name="mot_de_passe"/><br />
                <label for="mot_de_passe_verif">Confirmez votre mot de passe : </label>
                <input type="password" id="mot_de_passe_verif" name="mot_de_passe_verif"/><br />
                <label for="telephone">Entrez votre téléphone : </label>
                <input type="tel" id="telephone" name="telephone"/><br />
                <label for="pays">Entrez votre pays : </label>
                <input type="text" id="pays" name="pays"/><br />
                <label for="condition_generale">Acceptez les conditions générales : </label>
                <input type="checkbox" name="condition_generale" value="" /><br />
                <input type="submit" name="submit" value="Inscription"/>
            </fieldset>
        </form>
    </body>
</html>


