<?php
function verifyinput ($var) { // fonction pour la securite
		
        $var = trim($var); // trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
        $var = stripcslashes($var); // supprime tous les antislashs
        $var = htmlspecialchars($var); // Convertit les caractères spéciaux en entités HTML
        return $var;
    }