# tce
Fichiers pour le projet Télémesure de Consommation Electrique
______________________________________________________________

Documentation :
- Compteur EDF.pdf : Voir §5.2 (Sortie téléinformation client)

Exercices : 
- tce1.php : Affichage de la trame téléinfo
- tce2.php : Affichage de la trame et extraction du champ ADCO
- tce3.php : Affichage de la trame et extraction des champs ADCO, HCHC, HCHP, et PAPP

Consultation en temps réel : 
- tce2json.php : Affichage des données en format JSON (Back-end)
- tce.html : Affichage des données en tableau (Front-end)

Consultation des données en base :
- sc.sql : Sauvegarde des tables etudiant et entree
- etudiants.php : API REST (Back-end)
- SN1.html : Affichage de la liste des étudiants (Front-end)
- createEtudiant.html : Formulaire pour ajouter un nouvel étudiant
- updateEtudiant.html : Formulaire pour modifier les données d'un étudiant existant
