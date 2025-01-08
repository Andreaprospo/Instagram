<?php
    require_once "Classi/Profilo.php";

    if(!isset($_SESSION))
        session_start();
    
    $utenteCorrente = "";
    if(isset($_SESSION["utenteCorrente"]))
        $utenteCorrente = $_SESSION["utenteCorrente"];
    else
    {
        header("location: index.php");
        exit;
    }

    echo $utenteCorrente->getUsername();
?>
<?php
    function getAllUtenti()
    {
        require_once "Classi/Profilo.php";  
        if(!isset($_SESSION))
            session_start();
    
        $utenteCorrente = $_SESSION["utenteCorrente"];

        $usernameUtenteCorrente = $utenteCorrente->getUsername();
        if (is_dir("./FileUtenti")) {
            $allUsers = scandir("./FileUtenti");
            $vettoreAppoggio = [];
            foreach ($allUsers as $user) {
                if ($user != '.' && $user != '..' && $user != $usernameUtenteCorrente) {
                    $vettoreAppoggio[] = $user;
                }
            }
        }
        return $vettoreAppoggio;
    }

    function checkUsername($array, $user)
    {
        foreach ($array as $userInArray) {
            if($userInArray == null)
            {
                continue;
            }
            if($user == $userInArray->getUsername())
                return true; 
        }
        return false;
    }
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
                    require_once "Classi/Storia.php";
                    $allSeguiti = $utenteCorrente->getSeguiti();
                    foreach ($allSeguiti as $seguito) {
                        if($seguito == null)
                            continue;
                        $storiesSeguito = $seguito->getStories();
                        if($storiesSeguito != null)
                        {
                            echo "<div id = " . $seguito->getUsername() .  " class = divStoria >";
                                echo "<img src=" . $seguito->getPathFoto() . " id= " . $seguito->getUsername() ." class=fotoProfilo>";
                                
                                foreach ($storiesSeguito as $storia) {
                                    echo "<div id = divStoriaNascosta>";
                                        echo "<img src=" . $storia->getPathFoto() . " id= " . $storia->getIdStoria() ." class=coperta>";
                                    echo "</div>";
                                }
                            echo "</div>";
                        }
                    }
                ?>
            </div>
            <div id = "divBarraRicerca">
                <input type="text" id="barraRicerca">
                <button onclick="filtra()">Cerca</button>
                <form action="gestoreAggiungiSeguiti.php" id = "formSuggerimenti">
                    <div id = "divSuggerimenti">
                        <?php

                            $allUtenti = getAllUtenti();
                            $allSeguiti = $utenteCorrente->getSeguiti();

                            foreach ($allUtenti as $utente)
                            {
                                if(checkUsername($allSeguiti, $utente) || $utente == $utenteCorrente)
                                    continue;
                                echo "<div class = popup username = $utente>";
                                    echo "<div>$utente</div>";
                                    echo "<button name = username value = $utente>Segui</button>";
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
            </form>
        </div>
        <?php
            require_once "footer.php";
        ?>
    </body>
</html>

<script>

    let divStorie = document.querySelectorAll(".divStoria");
    console.log(divStorie);

    for (const storia of divStorie) {

        
        storia.addEventListener("click", function(e)
        {
            let idTarget = e.target.id;
            let allStories =document.querySelectorAll("#" + e.target.id);
            let storiaSelezionata = document.querySelectorAll("#" + idTarget + " #divStoriaNascosta");
            
            function cambiaImmagine()
            {
                console.log("Inizio change");
                console.log(idTarget);
                console.log(document.querySelector("#" + (idTarget)+ " #divStoriaNascosta .scoperta"));
                let storiaScoperta = document.querySelector("#" + idTarget + " #divStoriaNascosta .scoperta");
                if(storiaScoperta != null)
                {
                    storiaScoperta.className = "coperta";
                    console.log("scoperta");
                }

                console.log(document.querySelector("#" + (idTarget+1) + " #divStoriaNascosta .coperta"));
                let prossimaStoria = document.querySelector("#" + (idTarget+1)+ " #divStoriaNascosta .coperta");
                if(prossimaStoria != null)
                {
                    prossimaStoria.className = "scoperta";
                    console.log("scoperta");
                }
            }

            // Avvia il ciclo
            setTimeout(cambiaImmagine, 2000);
        })
    }

</script>

<script>

    function filtra()
    {
        let testo = document.querySelector("#barraRicerca").value.toLowerCase();

        let allDivUtenti = document.querySelectorAll("#divBarraRicerca #divSuggerimenti .popup");
        console.log(allDivUtenti);
        
        if(testo == "")
        {
            for (const divUtente of allDivUtenti) 
            {
                divUtente.style.display = "flex";
            }
        }
        for (const divUtente of allDivUtenti) 
        {
            let username = divUtente.getAttribute("username");
            
            if(!username.toLowerCase().includes(testo))
            {
                divUtente.style.display = "none";
            }
            else
            {
                divUtente.style.display = "flex";
            }
        }
    }

</script>