# tce
Fichiers pour le projet Télémesure de Consommation Electrique
______________________________________________________________

Documentation :
- https://www.france-electric.com/Files/20851/IS_031006_Compteur_Landis_EDF_Mono_90A_ZCD12602_long.pdf : Compteur électrique : voir §5.2 (Sortie téléinformation client)
- https://www.eztcp.com/en/products/cse-h53n.php : Passerelle RS232-Ethernet CSE-H53

Exercices : 
- tce1.php : Affichage de la trame téléinfo
- tce2.php : Affichage de la trame et extraction du champ ADCO
- tce3.php : Affichage de la trame et extraction des champs ADCO, HCHC, HCHP, et PAPP

Consultation en temps réel : 
- tce2json.php : Affichage des données en format JSON (Back-end)
- tce.html : Affichage des données en tableau (Front-end)

Consultation des données en base :
- data.sql : Sauvegarde de la table data contenant 3 mesures
- tce2db.php : API REST (Back-end)
- db.html : Affichage des données sauvegardées en tableau (Front-end)
