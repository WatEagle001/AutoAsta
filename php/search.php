<?php
if(!empty($_GET)){
    $input = $_GET['search'];
    strtolower($input);
    $wordsAuto = array('auto','veicoli','veicolo','moto',
    'motocicletta','motociclette','automobile','vettura','autovettura','mezzo','quad','motorino', 'audi',
'volkswagen', 'volvo','cadillac','opel','ferrari', 'pagani', 'mercedes', 'toyota');

    $wordsEventi  = array('eventi','evento','asta','manifestazione',
                    'aste','prossimi', 'padova', 'milano', 'roma', 'bologna');

    if(checkDistance($input,$wordsAuto)){
        header('Location: ../php/veicoli.php');
        exit;
    }
    elseif(checkDistance($input,$wordsEventi)){
        header('Location: ../php/eventi.php');
        exit;
    }
    else {
        header('Location: ../php/404.php');
        exit;
    }
}

function checkDistance($input, $words){

    // distanza più vicina non ancora trovata
    $shortest = -1;

    // ciclo per trovare la parola che più si avvicina a quella fornita in input
    foreach ($words as $word) {

        // viene calcolata la distanza tra la parola corrente e quella fornita in input
        $lev = levenshtein($input, $word);

        // controllo se c'è un match perfetto
        if ($lev == 1) {
            // se esiste lo salvo ed esco dal ciclo
            $closest = $word;
            $shortest = 0;
            break;
        }

        // se la distanza minima o il match esatto non sono stati ancora trovati
        //salvo la distanza e il match più vicini possibili alla parola 
        if ($lev <= $shortest || $shortest < 0) {
            $closest  = $word;
            $shortest = $lev;
        }
    }

    if ($shortest == 0) {
        return true;
    } else return false;
}