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
    <title>HomePage</title>
</head>
    <body>
        <div id = "container">
            <div id = "divStorieIcona">
                <?php
                    require_once "Classi/Storia.php";
                    $allSeguiti = $utenteCorrente->getSeguiti();
                    foreach ($allSeguiti as $seguito) {
                        if($seguito == null)
                            continue;
                        $storiesSeguito = $seguito->getStories();
                        if($storiesSeguito != null)
                        {
                            echo "<div class=iconaStoria>";
                            echo "<div class=tagName>" . $seguito->getUsername() . "</div>";
                            echo "<div id = " . $seguito->getUsername() .  " class = divStoria>";
                                echo "<img src=" . $seguito->getPathFoto() . " id= " . $seguito->getUsername() ." class=fotoProfilo>";
                            echo "</div>";
                            echo "</div>";

                        }
                    }
                ?>
            </div>
            <div id = "divBody">
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
                    </form>
                </div>
                <div id="divPubblicazioni">
                    <div id = "divPost">
                        <?php
                            require_once "Classi/Profilo.php";
                            require_once "Classi/Post.php";
    
                            $allSeguiti = $utenteCorrente->getSeguiti();
                            foreach ($allSeguiti as $seguito)
                            {
                                if($seguito == null)
                                    continue;
                                $postSeguito = $seguito->getPost();
                                if($postSeguito != null)
                                {  
                                    echo "<div id = " . $seguito->getUsername() . " class = divPostUtente>";
                                    foreach ($postSeguito as $post) 
                                    {
                                        echo "<img src=" . $post->getPathFoto() . " id = id" . $post->getId() . " valoreid=" . $post->getId() ." username=" . $seguito->getUsername() . " tipo=post  class = coperta>";
                                    }
                                    echo "</div>";
                                }   
                            }
                        ?>
                    </div>
                    <div id="divStoria">
                        <?php
                            require_once "Classi/Storia.php";
                            $allSeguiti = $utenteCorrente->getSeguiti();
                            foreach ($allSeguiti as $seguito) {
                                if($seguito == null)
                                    continue;
                                $storiesSeguito = $seguito->getStories();
                                if($storiesSeguito != null)
                                {
                                    echo "<div id = " . $seguito->getUsername() . " class = divPostUtente>";
                                    foreach ($storiesSeguito as $storia)
                                    {
                                            echo "<img src=" . $storia->getPathFoto() . " id = id" . $storia->getIdStoria() . " valoreid=" . $storia->getIdStoria() ." tipo=storia class=coperta username=" . $seguito->getUsername() . ">";
                                    }
                                    echo "</div>";  
                                }
                            }
                        ?>
                    </div>  
                </div>
                <div id = "divRicercaUtentiSeguiti">
                    <?php
                        if(!isset($_SESSION))              
                            session_start();

                        $allSeguiti = $utenteCorrente->getSeguiti();
                        foreach($allSeguiti as $seguito)
                        {
                            if($seguito == null)
                                continue;

                            echo "<div class = divSeguiti>
                                <div>" . $seguito->getUsername() . "</div>
                                <div class = divBottoni>
                                <button onclick=getPost() value = " . $seguito->getUsername() . ">Post</button>
                                <button tipo = storia value = " . $seguito->getUsername() . ">Storie</button>
                                </div>
                            </div>";
                        }  
                    ?>
                </div>
            </div>
        </div>
        <?php
            require_once "footer.php";
        ?>
    </body>
</html>

<script>

    let divStorieIcona = document.querySelectorAll(".divStoria");
    console.log(divStorieIcona);

    for (const storia of divStorieIcona) {

        storia.addEventListener("click", function(e)
        {
            let divPost = document.querySelector("#divPost");
            divPost.style.display = "none";
            let divStoria = document.querySelector("#divStoria");
            divStoria.style.display = "block";

            let storieScoperte = document.querySelectorAll(".scoperta");
            for (const storiaScoperta of storieScoperte) {
                storiaScoperta.className = "coperta";  
            }

            let username = e.target.id;
            console.log(username);
            let storiaSelezionata = document.querySelector("#divStoria" + " #" + username + " img");

            storiaSelezionata.className = "scoperta";
            console.log(storiaSelezionata);
        })
    }

    let buttonStorie = document.querySelectorAll("button[tipo = storia]");
    for (const button of buttonStorie) 
    {
        button.addEventListener("click", function(e)
        {
            let divPost = document.querySelector("#divPost");
            divPost.style.display = "none";
            let divStoria = document.querySelector("#divStoria");
            if(divStoria.style.display == "block")
            {
                divStoria.style.display = "none";
                return;
            }
            else
                divStoria.style.display = "block";


            let storieScoperte = document.querySelectorAll(".scoperta");
            for (const storiaScoperta of storieScoperte) {
                storiaScoperta.className = "coperta";  
            }

            let username = e.target.value;
            console.log(username);
            let storiaSelezionata = document.querySelector("#divStoria" + " #" + username + " img");

            storiaSelezionata.className = "scoperta";
            console.log(storiaSelezionata);
        })
    }


    window.addEventListener("keydown", function(e)
    {            
        if(e.key == "ArrowRight")
        {
            let pubblicazioneScoperta = document.querySelector(".scoperta");
            console.log(pubblicazioneScoperta);
            if(pubblicazioneScoperta == null)
                return;
            let idPubblicazioneSelezionata = pubblicazioneScoperta.getAttribute("valoreid");
            let usernamePubblicazioneScoperta = pubblicazioneScoperta.getAttribute("username");
            let tipo = pubblicazioneScoperta.getAttribute("tipo");

            let pubblicazionaDaScoprire;
            let nextIdPubblicazione = Number(idPubblicazioneSelezionata)+1;
            if(tipo == "storia")
                pubblicazionaDaScoprire = document.querySelector("#divStoria #" + usernamePubblicazioneScoperta + " #id" + nextIdPubblicazione);   
            else
                pubblicazionaDaScoprire = document.querySelector("#divPost #" + usernamePubblicazioneScoperta + " #id" + nextIdPubblicazione);

            document.querySelector(".scoperta").className = "coperta";
            if(pubblicazionaDaScoprire != null)
            {
                pubblicazionaDaScoprire.className = "scoperta";
            }
        }
        else if(e.key == "ArrowLeft")
        {
            let pubblicazioneScoperta = document.querySelector(".scoperta");
            console.log(pubblicazioneScoperta);
            if(pubblicazioneScoperta == null)
                return;
            let idPubblicazioneSelezionata = pubblicazioneScoperta.getAttribute("valoreid");
            let usernamePubblicazioneScoperta = pubblicazioneScoperta.getAttribute("username");
            let tipo = pubblicazioneScoperta.getAttribute("tipo");

            let pubblicazionaDaScoprire;
            let nextIdPubblicazione = Number(idPubblicazioneSelezionata)-1;
            if(tipo == "storia")
                pubblicazionaDaScoprire = document.querySelector("#divStoria #" + usernamePubblicazioneScoperta + " #id" + nextIdPubblicazione);   
            else
                pubblicazionaDaScoprire = document.querySelector("#divPost #" + usernamePubblicazioneScoperta + " #id" + nextIdPubblicazione);

            document.querySelector(".scoperta").className = "coperta";
            if(pubblicazionaDaScoprire != null)
            {
                pubblicazionaDaScoprire.className = "scoperta";
            }
        }
        else if(e.key == "Escape")
        {
            let storiaScoperta = document.querySelector(".scoperta");
            if(storiaScoperta != null)
                storiaScoperta.className = "coperta";
            console.log(storiaScoperta);

        }
        console.log(e.key);
    }) 

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

<script>

    function getPost()
    {

        let divStoria = document.querySelector("#divStoria");
        divStoria.style.display = "none";
        let divPost = document.querySelector("#divPost");
        divPost.style.display = "block";

        let buttonClick = this.event.target;
        let usernamePost = buttonClick.value;

        let allPost =document.querySelector("#divPost #" + usernamePost + " img");
        if(allPost.className == "scoperta")
            allPost.className = "coperta";
        else
            allPost.className = "scoperta";

        console.log(allPost); 
    }


</script>