<?php
function transfert ()
{
$ret = false;
$img_blob = '';
$img_taille = 0;
$img_type = '';
$img_nom = '';
$taille_max = 250000;
$ret = is_uploaded_file ($_FILES['fic']['tmp_name']);
if ( !$ret )
{
echo "Problème de transfert";
return false;
}
else
{
// Le fichier a bien été reçu
$img_taille = $_FILES['fic']['size'];
if ( $img_taille > $taille_max )
{
echo "Trop gros !";
return false;
}
$img_type = $_FILES['fic']['type'];
$img_nom = $_FILES['fic']['name'];


include ("connexion.php");
$img_blob = file_get_contents ($_FILES['fic']['tmp_name']);
$req = "INSERT INTO vehicule ( photo) VALUES ( ".
// N'oublions pas d'échapper le contenu binaire
"'".addslashes ($img_blob)."') WHERE id_conducteur=".$donnees2['id_conducteur']." ";
$ret = mysql_query ($req) or die (mysql_error ());
return true;
}
}
?>