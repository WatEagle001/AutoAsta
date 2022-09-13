<?php
    require_once ('session_Manager.php');
    require_once('page.php');



    $user = createSession();
    $page = new page();

    if($_SESSION["isAdmin"] != 1){
        $_SESSION['errorMsg'] = "Devi essere un amministratore per accedere alla funzionalit&agrave; di aggiunta veicolo";
        header('Location: pagina_avvisi.php');
        exit;
    }

    if(!empty($_POST)){
        $checkIMG = $page->upload($_POST,$_FILES);
        if($checkIMG){
            $checkIns = $user->addVeicolo($_POST['Targa'],$_POST['marca'],$_POST['modello'],$_POST['cilindrata'],$_POST['anno'],$_POST['posti'],$_POST['cambio'],$_POST['carburante'],$_POST['colore_esterni'],basename($_FILES["url_immagine"]["name"]),$_POST['descrizione'],$_POST['chilometri_Percorsi'],1);
            if($checkIns){
                $_SESSION['successMsg'] = "Veicolo aggiunto con successo";
                $checkIns = $user->addAstaEmpty($_POST['Prezzo'],$_POST['Targa']);
            }
            else {
                $_SESSION['errorMsg'] = "Impossibile aggiungere il veicolo richiesto";
            }
        }
        
        header('Location: pagina_avvisi.php');
        exit;
    }
        
?>
<!DOCTYPE html>
 <html lang="it">
     <head>
         <link rel="icon" type="image/x-icon" href="img/2061866.png"/>
         <title>Aggiungi Veicolo - Auto Asta</title>
         <link rel="stylesheet" type="text/css" media="screen" href="css/styleAlternative.css"/>
         <link rel="stylesheet" type="text/css" media="screen and (max-width:1200px), only screen and (max-width:1200px)"  href="css/mobile.css"/>
         <meta charset="UTF-8"/>
         <meta name="description" content="Login Utente di Auto Asta"/>
         <meta name="keywords" content="auto, asta, homepage, principale, veicoli"/>
         <meta name="author" content="Carlesso Niccolò, Pillon Matteo, Soldà Matteo, Veronese Andrea"/>  
         <script src="JS/miniscript.js"></script>     
     </head>
     <body>
         <div class="globalDiv">
         <?php require_once ('header.php')?>
         <main>
         <form action="addVeicolo.php" method="post" id="formAddVeicolo" enctype="multipart/form-data">
             <div class="registration_form">
             <h2>Inserimento Veicolo</h2>
             <p>Compila i campi seguenti per inserire un nuovo veicolo</p>
             <hr>

             <fieldset name="targa" form="formAddVeicolo">
                 <label for="Targa"><b>Targa</b></label>
                 <input type="text" placeholder="Inserisci la targa" name="Targa" id="Targa" onblur="return checkText('Targa','Targa non valida, formato accettato: ab000cd',/^[a-zA-Z]{2}[0-9]{3}[a-zA-Z]{2}$/)" required >
             </fieldset>
            
             <fieldset name="marca" form="formAddVeicolo">
                <label for="marca"><b>Marca</b></label>
                 <input type="text" placeholder="Inserisci la marca" name="marca" id="marca" required >

             </fieldset>

             <fieldset name="modello" form="formAddVeicolo">
                 <label for="modello"><b>Modello</b></label>
                 <input type="text" placeholder="Inserisci il modello" name="modello" id="modello"  onblur="return checkText('modello','Modello non valido',/^[a-zA-Z0-9]+$/)" >
             </fieldset>
            
             <fieldset name="cilindrata" form="formAddVeicolo">
                <label for="cilindrata"><b>Cilindrata</b></label>
                <input type="number" placeholder="Inserisci cilindrata" name="cilindrata" id="cilindrata">
             </fieldset>

             <fieldset name="anno" form="formAddVeicolo">
                <label for="anno"><b>Anno</b></label>
                <input type="number" placeholder="Inserisci l'anno di immatricolazione" name="anno" id="anno">
             </fieldset>

             <fieldset name="posti" form="formAddVeicolo">
                 <label for="posti"><b>Posti a Sedere</b></label>
                 <input type="number" placeholder="Inserisci i posti per i passeggeri" name="posti" id="posti" max="10" >
             </fieldset>

             <fieldset name="cambio" form="formAddVeicolo">
                <label for="cambio"><b>Tipologia Cambio</b></label>
                <select id ="cambio" name = "cambio" form = "formAddVeicolo">
                    <option value="Automatico">Automatico</option>
                    <option value="Manuale">Manuale</option>
                    <option value="SemiAutomatico">Semi Automatico</option>
                </select>
             </fieldset>

             <fieldset name="carburante" form="formAddVeicolo">
                <label for="carburante"><b>Carburante</b></label>
                <select id ="carburante" name = "carburante" form = "formAddVeicolo">
                    <option value="Benzina">Benzina</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Elettrico">Elettrico</option>
                    <option value="Ibrido">Ibrido</option>
                    <option value="Gasolio">Gasolio</option>
                    <option value="GPL">GPL</option>
                </select>
             </fieldset>

             <fieldset name="colore_esterni" form="formAddVeicolo">
               <label for="colore_esterni"><b>Colore Esterno</b></label>
               <input type="text" placeholder="Inserisci il colore della carrozzeria" name="colore_esterni" id="colore_esterni"  >
            </fieldset>
            
            <fieldset name="url_immagine" form="formAddVeicolo">
                <label for="url_immagine"><b>Inserisci l'Immagine</b></label>
                <input type="file" name="url_immagine" id="url_immagine" required aria-required="true">
            </fieldset>

            <fieldset name="descrizione" form="formAddVeicolo">
                <label for="descrizione"><b>Descrizione</b></label>
                <input type="text" placeholder="Inserisci una descrizione completa" name="descrizione" id="descrizione"  >
            </fieldset>

            <fieldset name="chilometri_Percorsi" form="formAddVeicolo">
                <label for="chilometri_Percorsi"><b>Chilometraggio</b></label>
                <input type="number" placeholder="Inserisci i chilometri percorsi" name="chilometri_Percorsi" id="chilometri_Percorsi"  value ="0" min="0">
            </fieldset>

            <fieldset name="prezzo" form="formAddVeicolo">
                <label for="Prezzo"><b>Prezzo base di vendita</b></label>
                <input type="number" placeholder="Inserisci il prezzo base di vendita" name="Prezzo" id="Prezzo"  value ="0" min="0">
            </fieldset>

             <button type="submit" class="register_btn" name="submit">Inserisci Veicolo</button>
             <input type="reset" class="reset_btn">
             </div>
         </form>
</main>
         <?php require_once ('html/footer.html')?>
        </div>
     </body>
 </html>