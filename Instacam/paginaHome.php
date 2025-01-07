<?php
    require_once "Classi/Profilo.php";

    if(!isset($_SESSION))
        session_start();
    
    $utenteCorrente = $_SESSION["utenteCorrente"];
    if($utenteCorrente == null)
    {
        header("location: index.php");
        exit;
    }
    echo $utenteCorrente->getUsername();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="iconaSito.png" type="image/png">
    <link rel="stylesheet" href="CSS/styleFooter.css">
    <link rel="stylesheet" href="CSS/stylePaginaHome.css">
    <title>Document</title>
</head>
    <body>
        <div id = "container">
            <div id = "divStorie">
                <?php
                    $allSeguiti = $utenteCorrente->getSeguiti();
                    foreach ($allSeguiti as $seguito) {
                        $storiesSeguito = $seguito->getStories();
                        print_r($storiesSeguito);
                        if($storiesSeguito != null)
                        {
                            echo "<div id = divStoria>";
                                echo "<img src=$seguito->getPathFoto() alt=>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
            <form action="gestoreAggiungiSeguiti.php" id = "formSuggerimenti">
                <div id = "divBarraRicerca">
                    <input type="text" id="barraRicerca">
                    <div id = "divSuggerimenti"></div>
                </div>
            </form>
        </div>
        <?php
            require_once "footer.php";
        ?>
    </body>
</html>
<script>    
    console.log("CIOA");
    let barraRicerca = document.querySelector("#barraRicerca");
    let divBarraRicerca = document.querySelector("#divBarraRicerca");

    barraRicerca.addEventListener("focusout", function()
    {
        
        <?php
            function getAllUtenti()
            {
                require_once "Classi/Profilo.php";  
                if(!isset($_SESSION))
                    session_start();
            
                $utenteCorrente = $_SESSION["utenteCorrente"];

                $usernameUtenteCorrente = $utenteCorrente->getUsername();
                if (is_dir("FileUtenti")) {
                    $allUsers = scandir("FileUtenti");
                    $vettoreAppoggio = [];
                    foreach ($allUsers as $user) {
                        if ($user != '.' && $user != '..' && $user != $usernameUtenteCorrente) {
                            $vettoreAppoggio[] = $user;
                        }
                    }
                }
                return $vettoreAppoggio;
            }
        ?>

        //chiesto a chatGpt così non vado a salvari gli utenti su un file ma li prendo direttamente tramite le cartelle

        const fileUtenti = <?php echo json_encode(getAllUtenti());?>;
        const fileUtentiSeguiti = <?php echo json_encode($utenteCorrente->getSeguiti());?>;
        const utenteCorrente = "<?php echo $utenteCorrente->getUsername() ?>";
        console.log(fileUtenti);
        
        let form = document.querySelector("#formSuggerimenti");
        let divSuggerimenti = document.querySelector("#divSuggerimenti"); 
        divSuggerimenti.textContent = "";
        divSuggerimenti.style.display = "block"; 

        for (const utente of fileUtenti) {

            if(fileUtentiSeguiti.includes(utente) || fileUtentiSeguiti.includes(utenteCorrente))
                continue;

            //CONTROLLARE QUELLI CHE NON HO ANCORA SEGUITO
            //(NON FACCIO RIAPPARIRE QUELLI CHE SEGUO GIà)
            let div = document.createElement("div");
            let sottoDiv = document.createElement("div");
            let bottone = document.createElement("button");

            div.className = "popup";
            bottone.textContent = "Segui";
            bottone.name = "username";
            bottone.value = utente;

            sottoDiv.textContent = utente;
            div.appendChild(sottoDiv);
            div.appendChild(bottone);
            divSuggerimenti.appendChild(div);
        }
        console.log(divSuggerimenti);
    });

    // divBarraRicerca.addEventListener("focusout", function()
    // {
    //     let divSuggerimenti = document.querySelector("#divSuggerimenti"); 
    //     divSuggerimenti.textContent =  "";
    // });

</script>
