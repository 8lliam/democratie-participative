<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groupe</title>
    <link href="../css/sideBar.css" rel="stylesheet">
    <link href="../css/Accueil.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Liste des Groupes</h1>
    </header>
    <?php
        require "sideBar.php";
    ?>
    <main>
        <div class="group-container">
            <?php
                $groupsLeft = [
                    ["name" => "Groupe A", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur magna at velit maximus, a pretium justo viverra. Cras sollicitudin lorem nec odio ultrices, vel vehicula libero hendrerit. Etiam sit amet mauris eros.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur magna at velit maximus, a pretium justo viverra. Cras sollicitudin lorem nec odio ultrices, vel vehicula libero hendrerit. Etiam sit amet mauris eros.", "image" => ""],
                    ["name" => "Groupe B", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula, odio id dignissim malesuada, ligula augue convallis metus, ut posuere neque arcu eget ligula. Integer et velit nec elit fermentum lacinia.", "image" => ""],
                    ["name" => "Groupe C", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Aenean imperdiet nunc eros, et mollis ipsum cursus ac. Donec nec tellus vel urna tincidunt egestas non sed magna.", "image" => "../img/groupeLogo.png"],
                    ["name" => "Groupe D", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ac metus ligula. Ut fermentum vehicula orci. Nullam et libero ac est pellentesque bibendum. Duis at nisi et quam hendrerit scelerisque.", "image" => ""]
                ];

                foreach ($groupsLeft as $group) {
                    $image = $group['image'] ? $group['image'] : '../img/groupeLogo.png';
                    echo "<div class='group-card'>";
                    echo "<img src='$image' alt='Image du groupe'>";
                    echo "<div class='group-card-content'>";
                    echo "<h3><a href='#'>{$group['name']}</a></h3>";
                    echo "<p>{$group['description']}</p>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>

        <div class="divider"></div>

        <div class="group-container">
            <?php
                $groupsRight = [
                    ["name" => "Groupe X", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce euismod, sapien et euismod cursus, lectus velit gravida arcu, ut mollis sapien turpis at metus.", "image" => "../img/groupeLogo.png"],
                    ["name" => "Groupe Y", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Cras consectetur diam eu orci dignissim tincidunt.", "image" => ""],
                    ["name" => "Groupe Z", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vehicula lectus et eros sagittis, vel condimentum augue placerat.", "image" => "../img/groupeLogo.png"],
                    ["name" => "Groupe W", "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum, turpis vel aliquet bibendum, sapien mi pharetra lectus, at pulvinar lorem libero et est.", "image" => ""]
                ];

                foreach ($groupsRight as $group) {
                    $image = $group['image'] ? $group['image'] : '../img/groupeLogo.png';
                    echo "<div class='group-card'>";
                    echo "<img src='$image' alt='Image du groupe'>";
                    echo "<div class='group-card-content'>";
                    echo "<h3><a href='#'>{$group['name']}</a></h3>";
                    echo "<p>{$group['description']}</p>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </main>
</body>
</html>