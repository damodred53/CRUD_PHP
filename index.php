<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Google Fonts Pre Connect -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts Links (Roboto 400, 500 and 700 included) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">

    <!-- CSS Files Links -->
    <link rel="stylesheet" href="./styles.css">

    <!-- Title -->
    <title>logiciel_RH</title>
</head>

<body>
    <div class="container">
        <a href="ajouter.php" class="Btn_add"><img src="./assets/plus-solid.svg" alt="icône de croix d'ajout"> Ajouter
        </a>
        <?php 
            require_once "connexion.php";
        ?>


        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php
                require_once "connexion.php";

                // requête pour afficher les données depuis la base de donénes sql
                $req = mysqli_query($con, "SELECT * FROM Employee");
                if(mysqli_num_rows($req) == 0) {
                    echo "Il n'existe pas encore d'employé dans la base de données";
                } else {
                    while($row=mysqli_fetch_assoc($req)) {
                        ?>
                            <tr>
                                <td><?=$row['nom']?></td>
                                <td><?=$row['prenom']?></td>
                                <td><?=$row['age']?></td>
                                <td><a href="modifier.php?id=<?=$row['id']?>"> <img src="./assets/edit.svg"></a></td>
                                <td><a href="supprimer.php?id=<?=$row['id']?>"> <img src="./assets/delete.svg"></a></td>
                            </tr>
                        <?php
                    }
                }
            ?>
            
        </table>
    </div>

</body>

</html>