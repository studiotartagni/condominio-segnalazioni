<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Raccogli i dati dal modulo
    $argomento = $_POST['argomento'];
    $posizione = $_POST['posizione'];
    $descrizione = $_POST['descrizione'];
    $email_utente = $_POST['email']; // Raccogli l'email dell'utente

    // Gestione del file caricato (se presente)
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_nome = $_FILES['foto']['name'];
        $foto_destinazione = 'uploads/' . $foto_nome; // Percorso di destinazione per la foto
        move_uploaded_file($foto_tmp, $foto_destinazione); // Salva la foto nel server
    } else {
        $foto_destinazione = 'Nessuna foto caricata';
    }

    // Indirizzo email a cui inviare la segnalazione
    $to = "pietrobio2010@gmail.com"; // Modifica con la tua email
    $subject = "Segnalazione dal condominio: $argomento";
    
    // Corpo dell'email
    $body = "Hai ricevuto una segnalazione dal condominio:\n\n";
    $body .= "Tipo di problema: $argomento\n";
    $body .= "Posizione nel condominio: $posizione\n";
    $body .= "Descrizione: $descrizione\n";
    $body .= "Foto allegata: $foto_destinazione\n";
    $body .= "Email dell'utente che ha inviato la segnalazione: $email_utente\n"; // Aggiunto campo email
    
    // Headers per l'email
    $headers = "From: $email_utente"; // Usa l'email dell'utente come mittente
    
    // Invia l'email
    if (mail($to, $subject, $body, $headers)) {
        echo "Segnalazione inviata con successo!";
    } else {
        echo "Errore nell'invio della segnalazione.";
    }
} else {
    echo "Richiesta non valida.";
}
?>

