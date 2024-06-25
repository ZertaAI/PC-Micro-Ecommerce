<?php
    /************************************************************************/
    /* 
            - Procedure d'enregistrement d'un client
        Note : un client ne peut pas s'enregistrer en tant qu'administrateur    
    */
    /************************************************************************/
?>

<div align='center'>
    <!-- Demande des informations du client pour son enregistrement -->
    <form name="enregistrer" action="?page=requeteClient&type_requete=3" method="post">
    
        <table align="center">
        
            <tr>
                <td>Nom (nom d'utilisateur aussi) : <input type="text" name="nom" class="input_text" id="input_text_menu" /></td>
            </tr>
            <br />
            <tr>                
                <td>Mot de passe (nom d'utilisateur aussi) : <input type="password" name="mdp" class="input_text" id="input_text_menu" /></td>
            </tr>
            <br />
            <tr>
                <td>Prenom : <input type="text" name="prenom" class="input_text" id="input_text_menu" /></td>
            </tr>
            <br />
            <tr>
                <td>Adresse : <input type="text" name="adresse" class="input_text" id="input_text_menu" /></td>
            </tr>
            <br />
            <tr>
                <td>Numero de telephone : <input type="text" name="tel" class="input_text" id="input_text_menu" /></td>
            </tr>
            <br />
            <tr>
                <td>E-Mail : <input type="text" name="email" class="input_text" id="input_text_menu" /></td>
            </tr>
            <br />
            <tr>
                <!-- Bouton : Valider l'enregistrement du client -->
                <td><center><input type="submit" name="valider" class="input_button" value="valider" /></center><br /></td>
            </tr>
            <br />    
            <tr>
                <td align="right">
                    <textarea rows ="25" cols="70">
CONDITIONS GENERALES D'UTILISATION (EXEMPLE TYPE)

    
    PREAMBULE

Les utilisateurs de notre site doivent avoir plus de 18 ans et doivent etre capable juridiquement de contacter, visiter et utiliser notre site.

Les sites visites sont informatifs et ne pratiquent aucune vente directe (voir la liste des sites en bas de page) et se limitent a mettre en rapport des "prospects" avec des "fournisseurs" maitres de leur art ; aucune transaction ne se fait par l'intermediaire de la societe F. VERGNE, la dite transaction ayant directement lieu entre les deux parties ; ainsi la responsabilite de la dite societe F. VERGNE ne peut en aucun cas etre engagee en cas de litige entre les parties sus-mentionnees. Les "produits" ou "services" presentes sont directement geres par les societes "fournisseurs" aupres des "prospects" et leurs notices ou description est fournie a la societe F. VERGNE par les dits "fournisseurs".

Tous les visiteurs de notre site sont reputes avoir lu et approuve sans restriction nos conditions generales d'utilisation. En cas de desaccord avec les presentes, le visiteur doit immediatement quitter notre site internet.

Les elements suivant ne sont pas garantis : les anomalies, erreurs ou bugs des informations, produits ou services fournis sur le site.

Les interruptions ou pannes du site la compatibilite du site avec un materiel ou une configuration particuliere En aucun cas la responsabilite de l'editeur ne peut etre engagee pour les dommages indirects et/ou immateriels, previsibles ou imprevisibles (incluant la perte de profits) decoulant de la fourniture et/ou de l'utilisation ou de l'impossibilite partielle ou totale d'utiliser les services fournis par le site quant au contenu des sites sur lesquels nous renvoyons par l'intermediaire de liens hypertextes. en cas de survenance d'un evenement irrestible, imprevisible et exterieur.

Les elements constitutifs de notre site Internet beneficient, au meme titre que les autres oeuvres de l'esprit, de la protection par le droit de la propriete intellectuelle : la societe proprietaire du site reste titulaire de tous les droits de propriete intellectuelle relatifs au site et des droits d'usage y afferent l'acces au site ne confere aucun droit sur les droits de propriete intellectuelle relatifs au site, qui restent la propriete exclusive de la societe F. VERGNE, titulaire du site.

les elements accessibles sur le site sont proteges par les droits de propriete intellectuelle et industrielle. sauf dispositions explicites, il est interdit de reproduire, modifier, transmettre, publier, adapter, sur quelque support que ce soit ou exploiter de quelque maniere que ce soit, tout ou partie du site sans l'autorisation ecrite prealable de la societe F. VERGNE. La violation de ces dispositions pourra faire l'objet de toute action en justice appropriee, notamment d'une action en contrefacon.

Les presents sites ont fait l'objet d'une declaration a la CNIL. Leur numero est inscrit sur la page d'entree du site que vous lisez. Dans tous les cas et conformement a la legislation francaise en vigueur et plus particulierement a la loi du 6 janvier 1978 Informatique et liberte, vous disposez d'un droit d'acces, de rectification, d'opposition et de suppression sur ces donnees que vous pouvez exercer en ecrivant a l'adresse suivante : F. VERGNE 24, rue du Pont Neuf 60660 Cires-les-Mello ainsi qu'a l'adresse email lafeste@lafeste.com . La collecte des donnees a usage commercial sur les dits sites a fait l'objet de la declaration : numero 1232417 a la CNIL.

Il est ici precise que les bases de donnees constituees par les emails envoyes par les differents sites ont fait l'objet de declarations respectives aupres de la CNIL (Commission Nationale de l'Informatique et des Libertes).

Les sites sont heberges sur les serveurs des societes : OVH - SAS au capital de 500 k€ RCS Roubaix - Tourcoing 424 761 419 00011 - Code APE 721Z - N° TVA : FR 22-424-761-419-00011
Siege social : 140 Quai du Sartel - 59100 Roubaix - France

Toutes les marques mentionnees dans les sites, sont la propriete exclusive de leurs ayants droit.

  
    MENTIONS LEGALES DU SITE

Glossaire :

- Utilisateur : Internaute se connectant, utilisant les annuaires / sites (voir glossaire).
- Informations personnelles : « les informations qui permettent, sous quelque forme que ce soit, directement ou non, l'identification des personnes physiques auxquelles elles s'appliquent » (article 4 de la loi n° 78-17 du 6 janvier 1978).
- Le site que vous etes en train de visiter.
- Partenaire : representant d'une societe ou de toute autre structure legale dont les produits, services, fabrications, prestations sont presentees par un site internet cree et gere par F. Vergne a la demande du partenaire.
- Apporteur d'affaires : la societe La Feste qui a travers son reseau de sites internet sensibilise une clientele potentiel pour un produit, un service, une fabrication en vue d'apporter des prospects a ses partenaires.
Editeurs

En vertu de l'article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'economie numerique, il est precise aux utilisateurs du site que vous etes en train de visiter l'identite des differents intervenants dans le cadre de sa realisation et de son suivi :


Le proprietaire et/ou editeur est une personne morale.
Proprietaire et/ou editeur du site : PC Micro

Informations personnelles collecteés :

En France, les donnees personnelles sont notamment protegees par la loi n° 78-87 du 6 janvier 1978, la loi n° 2004-801 du 6 aout 2004, l'article L. 226-13 du Code penal et la Directive Europeenne du 24 octobre 1995.

A l'occasion de l'utilisation du site que vous etes en train de visiter, sont notamment recueillies les donnees suivantes :
- l'adresse Internet URL des liens par l'intermediaire desquels l'utilisateur a accede au site www.annuaire-referencement.fr.
- Le fournisseur d'acces de l'utilisateur ;
- L'adresse de protocole Internet (IP) de l'utilisateur.

L'utilisateur du present site (ci-apres denommee « Utilisateur ») est informe que, lors de sa navigation sur le site que vous etes en train de visiter (ci-apres denomme « Site »), des donnees a caractere personnel le concernant sont collecteés et traiteés par F. Vergne.

L'utilisateur du Site est informe que ses donnees :

- sont collecteés de maniere loyale et licite,

- sont collecteés pour des finalites determinees, explicites et legitimes,

- ne seront pas traitees ulterieurement de maniere incompatible avec ces finalites,

- sont adequates, pertinentes et non excessives au regard des finalites pour lesquelles elles sont collecteés et de leurs traitements ulterieurs,

- sont exactes et completes,

- sont conservees sous une forme permettant l'identification des personnes concernees pendant une duree qui n'excede pas la duree necessaire aux finalites pour lesquelles elles sont collecteés et traiteés.

En tout etat de cause F. VERGNE ne collecte des informations personnelles relatives a l'utilisateur (nom, adresse electronique, coordonnees telephoniques) que pour le besoin des services proposes par les annuaires / sites (voir glossaire).

L'utilisateur fournit ces informations en toute connaissance de cause, notamment lorsqu'il procede par lui-meme a leur saisie.
Il est alors precise a l'utilisateur du site que vous etes en train de visiter le caractere obligatoire ou non des informations qu'il serait amene a fournir.

L'utilisateur justifiant de son identite dispose de la possibilite de solliciter aupres de F. VERGNE, a l'adresse electronique lafeste@lafeste.com :

- la verification des donnees a caractere personnel le concernant ayant fait l'objet d'une collecte par F. VERGNE ou pour son compte ;
- les informations ayant trait aux finalites de traitement de ces donnees ;
- les informations ayant trait a l'identite et au rattachement geographique des destinataires de ces donnees ;
- la communication d'une copie de ces donnees delivree gratuitement, dans la mesure ou une telle demande n'est pas abusive, notamment par son caractere repetitif et disproportionne.

Aucune information personnelle de l'utilisateur du site que vous etes en train de visiter n'est :

- collectee a l'insu de l'utilisateur ;
- publiee a l'insu de l'utilisateur ;
- echangee, transferee, cedee ou vendue sur un support quelconque a des tiers. Seule l'hypothese du rachat de F. VERGNE et de ses droits permettrait la transmission desdites informations a l'eventuel acquereur qui serait a son tour tenu de la meme obligation de conservation et de modification des donnees vis a vis de l'utilisateur du site que vous etes en train de visiter.

Au demeurant F. VERGNE est autorise(e) a effectuer des etudes et analyses statistiques sur l'utilisation et la typologie des utilisateurs du site que vous etes en train de visiter, sous reserve de confirmer l'anonymat de ces derniers.

 
Rectification des informations nominatives collecteées

Conformement aux dispositions de l'article 34 de la loi n° 48-87 du 6 janvier 1978, l'utilisateur dispose d'un droit de modification des donnees nominatives collecteées le concernant. Pour ce faire, l'utilisateur envoie a F. VERGNE :


- un courrier electronique a l'adresse lafeste@lafeste.com ,
- un courrier a l'adresse 24 rue du Pont Neuf, , 60660 CIRES LES MELLO, France ,
en indiquant son nom ou sa raison sociale, ses coordonnees physiques et/ou electroniques, ainsi que le cas echeant la reference dont il disposerait en tant que membre du site que vous etes en train de visiter.
La modification interviendra dans des delais raisonnables a compter de la reception de la demande de l'utilisateur.

 
Declaration CNIL :

Le site que vous etes en train de visiter collectant des informations personnelles de ses utilisateurs, il a fait l'objet d'une declaration prealable aupres de la CNIL enregistree sous le numero de recepisse non requis.
Cookies :

Un « Cookie » permet l'identification de l'utilisateur, la personnalisation de sa consultation du site que vous etes en train de visiter et l'acceleration de la mise en page du site grace a l'enregistrement d'un leger fichier de donnees sur son ordinateur.
L'utilisateur reconnait etre informe de cette pratique et autorise F. VERGNE a y proceder.
En tout etat de cause F. VERGNE s'engage a ne jamais communiquer le contenu de ces « Cookies » a des tierces personnes, sauf en cas de requisition legale.
L'utilisateur peut refuser l'enregistrement de « Cookies » ou configurer son navigateur pour etre prevenu prealablement a l'acception les « Cookies ». Pour ce faire, l'utilisateur procedera au parametrage de son navigateur a partir du menu « outil » pour Microsoft Internet Explorer 5 ou 6.0, ou du menu « Edition » pour Netscape 6 ou 7.

 
Droits d'auteur :

La totalite des elements du site que vous etes en train de visiter, notamment les textes, presentations, illustrations, photographies, arborescences et mises en forme sont, sauf documents publics et precisions complementaires, la propriete intellectuelle exclusive de F. VERGNE ou de ses partenaires.
A ce titre, leurs representations, reproductions, imbrications, diffusions et rediffusions, partielles ou totales, sont interdites conformement aux dispositions de l'article L. 122-4 du Code de la propriete intellectuelle. Toute personne y procedant sans pouvoir justifier d'une autorisation prealable et expresse du detenteur de ces droits encourt les peines relatives au delit de contrefacon prevues aux articles L. 335-2 et suivants du Code de la propriete intellectuelle.
En outre, les representations, reproductions, imbrications, diffusions et rediffusions, partielles ou totales, de la base de donnees contenue dans les annuaires / sites (voir glossaire) sont interdites en vertu des dispositions de la loi n°98-536 du 1er juillet 1998 relative a la protection juridique des bases de donnees.
En tout etat de cause, sur toute copie autorisee de tout ou partie du contenu du site, devra figurer la mention « Copyright 2007 F. VERGNE tous droits reserves ».

Les elements figurant au sein du present site, tels que sons, images, photographies, videos, ecrits, animations, programmes, charte graphique, utilitaires, bases de donnees, logiciel, sont proteges par les dispositions du Code de la propriete intellectuelle et appartiennent a [indiquer le nom du titulaire des droits de propriete intellectuelle afferents aux elements du site].


L'utilisateur s'interdit de porter atteinte aux droits de propriete intellectuelle afferents a ces elements et notamment de les reproduire, representer, modifier, adapter, traduire, d'en extraire et/ou reutiliser une partie qualitativement ou quantitativement substantielle, a l'exclusion des actes necessaires a leur usage normal et conforme.

 
Marques :

Les marques et logos contenus dans les annuaires / sites (voir glossaire) sont deposés par F. VERGNE, ou eventuellement par un de ses partenaires. A ce titre, toute personne procedant a leurs representations, reproductions, imbrications, diffusions et rediffusions encourt les sanctions prevues aux articles L. 713-2 et suivants du Code de la propriete intellectuelle.
Marques citees :

Les marques citees soit textuellement sous forme de legende, soit graphiquement sous forme d'image, d'illustration ou de logo appartiennent a leurs proprietaires respectives et ne sont presentes sur les sites qu'en tant que representantes du savoir-faire du partenaire du site dans ses fabrications, realisations ou prestations. Ces figurations ont ete communiquees a F. Vergne / La Feste par le partenaire et non directement copiees.
Precisions complementaires relatives aux marques et droits d'auteur figurant sur le site que vous etes en train de visiter :

Concepteur multimedia et graphisme : FV Events - Ces mentions legales et conditions d'utilisation ont ete creees sur le site www.mentions-legales.fr (copyright Diagnostic et Formation - tous droits reserves).

 
Nature publicitaire du contenu du site :

En tout etat de cause, F. VERGNE informe le cas echeant l'internaute de la nature publicitaire des contenus du site que vous etes en train de visiter.

Notre societe n'intervient qu'en tant que "apporteur d'affaires" a travers des sites qui sont des "portails" de presentation et non des sites de vente en ligne de produit ; notre societe n'intervient aucunement en tant que prestataire final que ce soit :

    *  pour le tir d'un feu d'artifice automatique ou classique ou de quelque type que ce soit

    *  pour la mise en place de materiel scenique et festif de quelque type que ce soit

    *  pour la direction ou la gestion d'un evenement de quelque taille, type que ce soit

    *  pour la mise en oeuvre d'un chantier evenementiel

    *  pour la livraison du ou des produits qui sont l'affaire de la societe mise en relation avec le client

    *  pour la mise a disposition de produits de PLV, publicite, pavoisement ou l'un des produits ou services presentes sur nos sites

    *  d'une maniere generale nos sites presentent des produits ou des prestations dont les prix sont communiques par les societes avec lesquelles nous travaillons et dont nous ne sommes pas responsables

    *  le client est repute agir en terme de relations commerciales avec la societe qui lui est proposee mais qu'il n'est pas oblige de retenir et ne peut nous imputer un defaut de fabrication, un prix ou tout autre defaut ou manquement.
    
    * le client ne peut arguer du fait qu'il a trouve un produit sur un de nos sites vitrines pour reclamer quelque dedommagement que ce soit en cas de probleme lie aux dits produits.

La societe La Feste en tant qu'apporteur d'affaire met en ligne sur internet des sites web presentant des produits, des prestations, des realisations qui appartiennent au "partenaire" qui a sollicite la creation du ou des dits sites.

Notre societe se limite a ecrire, concevoir, un cadre scenarise, un site internet vitrine, proposer des prestataires, des fabricants ou des revendeurs "maitres de leur art" qui assument l'entiere responsabilite de leurs prestations, de leurs relations avec le client final comme du rendu spectaculaire du produit achete.

Notre societe ne se substitue en aucun cas au prestataire final, au revendeur, au fabricant, ou a l'usine qui agit ou fabrique pour le client.

Notre societe ne peut etre tenue en aucun cas responsable en cas d'incident de quelque nature que ce soit lors de l'installation, exploitation ou demontage du spectacle, fetes, manifestations, galas, feu d'artifice ou autre, le prestataire choisi par le client assurant la gestion et responsabilite de son chantier.

LES PRIX

Les prix communiques le sont A TITRE INDICATIF et doivent faire l'objet d'une confirmation en bonne et due forme par l'etablissement d'un devis entre les parties directement concernees notre societe n'intervenant en aucune maniere a cette etape du processus.

 
    Responsabilite :

LA SOCIETE decline toute responsabilite :

    * En cas d’interruption d'un de ses sites pour des operations de maintenance techniques ou d’actualisation des informations publiees ;
    * En cas d’impossibilite momentanee d’acces a un de ses sites (et/ou aux sites lui etant lies) en raison de problemes techniques et ce quelles qu’en soient l’origine et la provenance ;
    * En cas de dommages directs ou indirects causes a l’utilisateur, quelle qu’en soit la nature, resultant du contenu, de l’acces, ou de l’utilisation des sites de F. Vergne / La Feste (et/ou des sites qui lui sont lies) ;
    * En cas d’utilisation anormale ou d’une exploitation illicite des sites de la Feste. L’utilisateur des sites de F. Vergne / La Feste est alors seul responsable des dommages causes aux tiers et des consequences des reclamations ou actions qui pourrait en decouler. L’utilisateur renonce egalement a exercer tout recours contre F. Vergne - F. Vergne / La Feste dans le cas de poursuites diligentees par un tiers a son encontre du fait de l’utilisation et/ou de l’exploitation illicite du site.

 
    Observations et suggestions :

Il est possible de transmettre des observations et des suggestions au responsable du site a l'adresse electronique lafeste@lafeste.com.
Date de la derniere mise a jour :

La derniere mise a jour des mentions legales date du 2007-12-15.
Les principales lois concernees :

- Loi n° 78-87 du 6 janvier 1978, notamment modifiee par la loi n° 2004-801 du 6 aout 2004 relative a l'informatique, aux fichiers et aux libertes.
- Loi n° 2004-575 du 21 juin 2004 pour la confiance dans l’economie numerique.

 

Les presentes conditions generales sont soumises au droit francais, qui determine, au cas par cas, la loi applicable. En l'absence de toute disposition imperative contraire ou en presence d'un choix dans la determination de la loi applicable, la loi francaise sera appliquee.
                    </textarea>
                </td>
            </tr>
        </table>
    </form>
</div>
