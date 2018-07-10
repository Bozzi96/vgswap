<?php

    /*
     * Questo script salva i parametri della ricerca in una variabile di sessione,
     * dopodiché reindirizza alla pagina di visualizzazione dei risultati.
     * Sarà quella pagina a richiedere i risultati della ricerca al server.
    */

    # Viene effettuata una connessione per poter utilizzare la funzione "real_escape_string()"
    require '../db/connection.php';

    # Sanitizzazione dell'input
    function sanitize_input($conn, $str) {
        $str = trim($str);
        $str = $conn -> real_escape_string($str);
        $str = filter_var($str, FILTER_SANITIZE_STRING);
        return $str;
    }


    session_start();

    # Array che verrà salvato nella sessione
    $search_param = array();

    # Filling dell'array con i parametri di ricerca
    $search_param['v_name'] = sanitize_input($conn, $_POST['v_name']);
    $search_param['console'] = sanitize_input($conn, $_POST['console']);

    # Salvataggio dei parametri in una variabile di sessione
    $_SESSION['search_param'] = $search_param;

    $conn -> close();

    # Redirect alla pagina di visualizzazione degli annunci trovati
    header("location: ../pages/list_ad.php");
    exit();
    
?>