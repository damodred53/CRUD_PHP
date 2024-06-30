<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="./styles.css">
</head>

<body>

<?php
        include_once "connexion.php";
        $id = $_GET['id'];
        $stmt = $con->prepare("SELECT * FROM Employee WHERE id=?");
        $stmt->bind_param("i", $id);  // "i" pour integer, lié à la variable $id
        $stmt->execute();

        // Récupérer les résultats
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Il n'existe pas encore d'employé dans la base de données";
        } else {
            // Afficher les résultats
           $row = $result->fetch_assoc() ;
           
        }
        $stmt->close(); // Fermer la requête préparée
?>

<?php

    
       //vérifier que le bouton ajouter a bien été cliqué
       if(isset($_POST['button'])){
           //extraction des informations envoyé dans des variables par la methode POST
           extract($_POST);
           //verifier que tous les champs ont été remplis
           if(isset($nom) && isset($prenom) && $age){
                //connexion à la base de donnée
                include_once "connexion.php";
                //requête d'ajout
                $id = $_GET['id'];

                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $age = $_POST['age'];

                $stmt2 = $con->prepare("UPDATE Employee SET nom = ?, prenom = ?, age = ? WHERE id = ?");
                $stmt2->bind_param("ssii", $nom, $prenom, $age, $id);
                $stmt2->execute();

                if($stmt2){//si la requête a été effectuée avec succès , on fait une redirection
                    header("location: index.php");
                }else {//si non
                    $message = "Employé non ajouté";
                }

           }else {
               //si non
               $message = "Veuillez remplir tous les champs !";
           }
       }
    
    ?>

    <div class="form">
        <a href="index.php" class="back_btn"><img src="./assets/back.svg"
                alt="icône de retour vers la page précédente">Retour</a>
        <h2>Modifier un employé : </h2>
        <p class="erreur_message">
            Veuillez remplir tous le champs !!
        </p>
        <form action="#" method="POST">
            <label>Nom</label>
            <input type="text" name="nom" value="<?php echo htmlspecialchars($row['nom']); ?>">
            <label>Prénom</label>
            <input type="text" name="prenom" value="<?php echo htmlspecialchars($row['prenom']); ?>" >
            <input type="number" name="age" value="<?php echo htmlspecialchars($row['age']); ?>">
            <input type="submit" value="Modifier" name="button">
        </form>

    </div>
</body>

</html> 