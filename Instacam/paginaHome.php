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
                            echo "<div id = " . $seguito->getUsername() .  " class = divStoria>";
                                echo "<img src=" . $seguito->getPathFoto() . " id= " . $seguito->getUsername() ." class=fotoProfilo>";
                                
                                foreach ($storiesSeguito as $storia) {
                                    echo "<div id = divStoriaNascosta>";
                                        echo "<img src=" . $storia->getPathFoto() . " id = id" . $storia->getIdStoria() . " valoreid=" . $storia->getIdStoria() ." tipo=storia class=coperta username=" . $seguito->getUsername() . ">";
                                    echo "</div>";
                                }
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
                <div id = "divPost">
                    <?php
                        require_once "Classi/Profilo.php";
                        require_once "Classi/Post.php";

                        $allSeguiti = $utenteCorrente->getSeguiti();
                        foreach ($allSeguiti as $seguito)
                        {
                            echo "<div id = " . $seguito->getUsername() . ">";
                            if($seguito == null)
                                continue;
                            $postSeguito = $seguito->getPost();
                            if($postSeguito != null)
                            {  
                                foreach ($postSeguito as $post) 
                                {
                                    echo "<img src=" . $post->getPathFoto() . " id = id" . $post->getId() . " valoreid=" . $post->getId() ." username=" . $seguito->getUsername() . " tipo=post  class = coperta>";
                                }
                            }   
                            echo "</div>";
                        }
                    ?>
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
                                <button onclick=getStories()>Storie</button>
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

    let divStorie = document.querySelectorAll(".divStoria");
    console.log(divStorie);




    for (const storia of divStorie) {

        storia.addEventListener("click", function(e)
        {
            let storieScoperte = document.querySelectorAll(".scoperta");
            console.log(storieScoperte);
            for (const storiaScoperta of storieScoperte) {
                storiaScoperta.className = "coperta";  
            }

            let idTarget = e.target.id;
            let allStories = document.querySelectorAll("#" + e.target.id);
            let storiaSelezionata = document.querySelector("#" + e.target.id + " #divStoriaNascosta img");

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
                pubblicazionaDaScoprire = document.querySelector("#" + usernamePubblicazioneScoperta + " #divStoriaNascosta #id" + nextIdPubblicazione);   
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
                pubblicazionaDaScoprire = document.querySelector("#" + usernamePubblicazioneScoperta + " #divStoriaNascosta #id" + nextIdPubblicazione);   
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

    function getStories()
    {
        alert("storie");
    }

    function getPost()
    {
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