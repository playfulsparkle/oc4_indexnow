<?php
// Heading
$_['heading_title']                       = 'Playful Sparkle - IndexNow';
$_['heading_fix']                         = 'Risoluzione dei bug comuni';
$_['heading_getting_started']             = 'Inizio';
$_['heading_setup']                       = 'Impostazione di IndexNow';
$_['heading_troubleshot']                 = 'Risoluzione dei problemi comuni';
$_['heading_faq']                         = 'Domande frequenti';
$_['heading_contact']                     = 'Contatta il supporto';
$_['heading_services']                    = 'Servizi IndexNow';

// Text
$_['text_extension']                      = 'Estensioni';
$_['text_success']                        = 'Successo: Hai modificato correttamente il feed IndexNow!';
$_['text_success_generate_service_key']   = 'Successo: La nuova chiave del servizio è stata generata correttamente!';
$_['text_success_remove_queue']           = 'Successo: L\'URL in coda è stato rimosso correttamente!';
$_['text_success_clear_log']              = 'Successo: Il log è stato cancellato correttamente!';
$_['text_success_clear_queue']            = 'Successo: La coda è stata svuotata correttamente!';
$_['text_success_submit_queue']           = 'Successo: Gli URL in coda sono stati inviati correttamente!';
$_['text_success_submit_url_list']        = 'Successo: La lista degli URL è stata inviata correttamente!';
$_['text_edit']                           = 'Modifica IndexNow';
$_['text_getting_started']                = '<p><strong>Panoramica:</strong> L\'estensione <strong>Playful Sparkle - IndexNow</strong> per OpenCart 4.x+ consente al tuo negozio di notificare automaticamente i motori di ricerca come Bing e Yandex quando i contenuti del tuo negozio vengono aggiunti, aggiornati o eliminati. Questo garantisce una più rapida indicizzazione delle modifiche, migliorando la visibilità e le performance di ricerca del tuo negozio. Offre funzionalità come l\'invio manuale di URL, l\'invio di URL in coda, impostazioni personalizzabili e supporto Cron.</p><p><strong>Requisiti:</strong> OpenCart 4.x+, PHP 7.4+ o superiore.</p>';
$_['text_setup']                          = '<ul><li><strong>Passo 1: Installa l\'Estensione</strong> - Scarica e installa l\'estensione tramite il pannello di amministrazione di OpenCart. Una volta installato, la chiave del servizio verrà generata automaticamente per ogni negozio.</li>
<li><strong>Passo 2: Abilita l\'Estensione per il Tuo Negozio</strong> - Vai alle impostazioni dell\'estensione e abilita l\'estensione per ogni negozio in cui desideri utilizzare i servizi IndexNow.</li>
<li><strong>Passo 3: Abilita i Servizi IndexNow per il Tuo Negozio</strong> - Nelle impostazioni dell\'estensione, abilita i servizi IndexNow per il negozio selezionato. Puoi anche scegliere di abilitare o disabilitare servizi specifici per ogni negozio.</li>
<li><strong>Passo 4: Imposta le Opzioni di Notifica ai Motori di Ricerca</strong> - Abilita queste opzioni per notificare ai motori di ricerca quando contenuti come categorie, prodotti, produttori o articoli vengono aggiunti, aggiornati o eliminati. Questo garantisce che i motori di ricerca rimangano aggiornati.</li>
<li><strong>Passo 5: Rigenera la Chiave del Servizio (Opzionale)</strong> - Se necessario, puoi rigenerare la chiave del servizio per ogni negozio separatamente tramite le impostazioni dell\'estensione.</li>
<li><strong>Passo 6: Invia gli URL</strong> - Invia gli URL ai servizi IndexNow, inviando gli URL in coda, importando/caricando la tua sitemap XML, o inserendo manualmente un URL e inviandolo ai servizi IndexNow.</li>
<li><strong>Passo 7: Monitora i Log</strong> - Una volta inviati gli URL, puoi controllare la scheda Log per vedere i risultati delle spedizioni. Puoi anche cancellare il log se necessario.</li></ul>';
$_['text_troubleshot']                    = '<details><summary><strong>La lista degli URL inviati contiene URL non validi o URL con un host che non corrisponde al dominio del negozio attivo</strong></summary> Assicurati che il campo di testo della lista degli URL contenga URL validi e che l\'host (dominio) degli URL corrisponda al dominio del negozio attivo.</details>
<details><summary><strong>Impossibile scaricare il file della sitemap xyz</strong></summary> Assicurati che l\'URL della sitemap sia inserito correttamente.</details>
<details><summary><strong>Tipo di file non valido. Carica un file valido</strong></summary> Assicurati di caricare un file sitemap XML valido.</details>
<details><summary><strong>La lista della coda non è popolata</strong></summary> Assicurati che le opzioni per notificare i motori di ricerca siano abilitate. Queste opzioni consentono al sistema di mettere in coda gli URL per categorie, prodotti, produttori o articoli ogni volta che vengono aggiunti, aggiornati o eliminati.</details>
<details><summary><strong>Nessun servizio abilitato. Abilita almeno un servizio</strong></summary> Devi abilitare almeno un servizio IndexNow prima di cliccare il pulsante "Invia URL in coda".</details>';
$_['text_faq']                            = '<details><summary><strong>Come posso abilitare o disabilitare l\'estensione per ogni negozio?</strong></summary><p>Puoi abilitare o disabilitare l\'estensione per ogni negozio separatamente tramite le impostazioni dell\'estensione.</p></details>
<details><summary><strong>Posso abilitare o disabilitare i servizi IndexNow per ogni negozio?</strong></summary><p>Sì, puoi abilitare o disabilitare i servizi IndexNow per ogni negozio separatamente nelle impostazioni dell\'estensione.</p></details>
<details><summary><strong>Come genero una chiave del servizio per ogni negozio?</strong></summary><p>La chiave del servizio viene generata automaticamente durante l\'installazione ed è unica per ogni negozio. Non è necessario generarla manualmente.</p></details>
<details><summary><strong>Posso rigenerare la chiave del servizio per ogni negozio?</strong></summary><p>Sì, puoi rigenerare la chiave del servizio per ogni negozio separatamente tramite le impostazioni dell\'estensione. Questo ti permette di aggiornare o cambiare la chiave se necessario.</p></details>
<details><summary><strong>Posso usare un URL Cron personalizzato per inviare gli URL ai servizi IndexNow?</strong></summary><p>Sì, puoi scegliere di usare l\'URL Cron fornito dall\'estensione o l\'URL della pagina Cron di OpenCart per inviare gli URL in coda. Entrambe le opzioni funzionano senza problemi.</p></details>
<details><summary><strong>Quali sono i limiti di dimensione e URL per la sitemap?</strong></summary><p>Il file della sitemap può essere fino a 50 MB di dimensione e contenere fino a 50.000 URL. Assicurati che la tua sitemap non superi questi limiti.</p></details>
<details><summary><strong>Come posso inviare URL ai servizi IndexNow?</strong></summary><p>Puoi inviare URL ai servizi IndexNow importando una sitemap, caricando un file XML della sitemap, o digitando manualmente l\'URL della sitemap. Inoltre, puoi inviare singoli URL dalla coda o inviare tutti gli URL in coda contemporaneamente per il negozio selezionato.</p></details>
<details><summary><strong>Come posso cancellare il log delle spedizioni di URL?</strong></summary><p>Puoi cancellare il log nella scheda Log. Il log viene cancellato senza errori ogni volta che scegli di eliminarlo.</p></details>';
$_['text_contact']                        = '<p>Per ulteriore assistenza, contatta il nostro team di supporto:</p><ul><li><strong>Contatto:</strong> <a href="mailto:%s">%s</a></li><li><strong>Documentazione:</strong> <a href="%s" target="_blank" rel="noopener noreferrer">Documentazione utente</a></li></ul>';
$_['text_log_no_results']                 = 'Al momento non sono disponibili voci di log.';
$_['text_queue_no_results']               = 'Non ci sono URL in coda al momento.';
$_['text_categories']                     = 'Le categorie sul tuo sito sono aggiunte, aggiornate o eliminate.';
$_['text_products']                       = 'I prodotti sul tuo sito sono aggiunti, aggiornati o eliminati.';
$_['text_manufacturers']                  = 'I produttori sul tuo sito sono aggiunti, aggiornati o eliminati.';
$_['text_information']                    = 'Le pagine di informazioni sul tuo sito sono aggiunte, aggiornate o eliminate.';
$_['text_topics']                         = 'Gli argomenti degli articoli sul tuo sito sono aggiunti, aggiornati o eliminati.';
$_['text_articles']                       = 'Gli articoli sul tuo sito sono aggiunti, aggiornati o eliminati.';
$_['text_url_list_warning']               = 'Gli URL che incollerai saranno convalidati. Ogni URL deve essere correttamente formattato con "http" o "https", e il suo host deve corrispondere all\'host del negozio: "%s". È possibile inviare un massimo di 10.000 URL.';
$_['text_http_status_code']               = 'L\'analisi dei codici di stato della risposta HTTP dai servizi IndexNow ti aiuta a capire se le tue richieste sono state elaborate con successo o se hanno incontrato problemi. Questi codici forniscono informazioni sui risultati dell\'indicizzazione degli URL e sugli eventuali errori. Visita i seguenti servizi IndexNow per saperne di più sui loro codici di stato HTTP:<br><br><ul><li><a href="https://www.bing.com/indexnow/getstarted" target="_blank" rel="noopener noreferrer">Microsoft Bing Webmaster Tools</a></li><li><a href="https://searchadvisor.naver.com/guide/indexnow-request" target="_blank" rel="noopener noreferrer">Naver Search Advisor</a></li><li><a href="https://napoveda.seznam.cz/cz/fulltext-hledani-v-internetu/protokol-indexnow/odeslani-vice-stranek-jednim-pozadavkem/" target="_blank" rel="noopener noreferrer">Seznam.cz</a></li><li><a href="https://yandex.com/support/webmaster/indexnow/reference/post-url.html" target="_blank" rel="noopener noreferrer">Yandex Webmaster Tools</a></li></ul>';

// Column
$_['column_log_id']                       = 'ID Log';
$_['column_log_url']                      = 'URL';
$_['column_log_service_name']             = 'Nome del Servizio';
$_['column_log_status_code']              = 'Codice di Stato';
$_['column_log_date_added']               = 'Data di Aggiunta';
$_['column_queue_id']                     = 'ID Coda';
$_['column_queue_url']                    = 'URL';
$_['column_queue_date_added']             = 'Data di Aggiunta';
$_['column_queue_action']                 = 'Azione';

// Tab
$_['tab_general']                         = 'Generale';
$_['tab_manual_submit']                   = 'Invio Manuale';
$_['tab_queue']                           = 'Coda';
$_['tab_log']                             = 'Log';
$_['tab_help_and_support']                = 'Aiuto &amp; Supporto';

// Entry
$_['entry_status']                        = 'Stato';
$_['entry_service_key']                   = 'Chiave del Servizio';
$_['entry_service_key_location']          = 'URL della Chiave del Servizio';
$_['entry_active_store']                  = 'Negozio Attivo';
$_['entry_notify_search_engines']         = 'Notifica ai Motori di Ricerca';
$_['entry_url_list']                      = 'Elenco URL';
$_['entry_load_sitemap']                  = 'Carica Sitemap';
$_['entry_cron_url']                      = 'URL Cron';

// Button
$_['button_fix_event_handler']            = 'Correggi il gestore eventi';
$_['button_change_key']                   = 'Cambia Chiave';
$_['button_check_key']                    = 'Verifica Chiave';
$_['button_submit_url']                   = 'Invia URL';
$_['button_submit_queue']                 = 'Invia URL in Coda';
$_['button_clear_queue']                  = 'Svuota la Coda';
$_['button_clear_log']                    = 'Svuota il Log';
$_['button_submit_url_list']              = 'Invia Elenco URL';
$_['button_clear_url_list']               = 'Svuota l\'Elenco URL';
$_['button_upload_sitemap']               = 'Carica URL della Sitemap';
$_['button_import_sitemap']               = 'Importa URL della Sitemap';
$_['button_copy']                         = 'Copia URL';

// Help
$_['help_service_key']                    = 'La chiave API di IndexNow verifica la proprietà del sito ed è generata automaticamente. Modifica la chiave se viene compromessa.';
$_['help_service_key_location']           = 'Clicca sul pulsante "Controlla Chiave" per verificare che la chiave sia accessibile ai motori di ricerca. Questo dovrebbe aprire l’URL live dove la chiave è ubicata.';
$_['help_url_list']                       = 'Inserisci un elenco di URL, uno per riga (fino a 10.000). Assicurati che ogni URL sia formattato correttamente con "http" o "https". Clicca su "Invia Elenco URL" per inviare gli URL ai servizi IndexNow selezionati.';
$_['help_load_sitemap']                   = 'Puoi fornire un URL della sitemap oppure caricare un file sitemap.xml (fino a 50 MB o 50.000 URL). Gli URL dalla sitemap verranno aggiunti all’elenco e inviati al servizio IndexNow selezionato. Sarai notificato quando il processo sarà completato.';
$_['help_cron_url']                       = 'Aggiungi questo URL alla tabella cron del server di hosting. Invierà automaticamente <strong>tutti gli URL in coda</strong> da <strong>tutti i negozi configurati</strong> ai <strong>punti di accesso del servizio IndexNow</strong> a intervalli programmati. In alternativa, puoi utilizzare l’URL <a href="%s">OpenCart 4 Cron Jobs</a> per inviare gli URL ai punti di accesso del servizio IndexNow.';

// Error
$_['error_permission']                    = 'Avviso: Non hai il permesso di modificare l\'estensione IndexNow!';
$_['error_generate_service_key']          = 'Avviso: Impossibile generare una nuova chiave di servizio!';
$_['error_remove_queue']                  = 'Avviso: Impossibile rimuovere gli URL in coda!';
$_['error_not_configured']                = 'Avviso: L\'estensione IndexNow non è configurata!';
$_['error_filetype']                      = 'Avviso: Tipo di file non valido. Carica un file valido.';
$_['error_upload']                        = 'Avviso: Impossibile caricare il file.';
$_['error_download']                      = 'Avviso: Impossibile scaricare il file della sitemap "%s"';
$_['error_invalid_url']                   = 'Avviso: L\'URL non è valido. Fornisci un URL valido.';
$_['error_invalid_url_host']              = 'Avviso: L\'host dell\'URL non è valido. L\'host dell\'URL deve essere lo stesso dell\'host dell\'URL corrente.';
$_['error_no_services_enabled']           = 'Avviso: Nessun servizio è abilitato. Abilita almeno un servizio.';
$_['error_submit_url_list_empty']         = 'Avviso: L\'elenco URL inviato è vuoto.';
$_['error_submit_url_list_invalid']       = 'Avviso: L\'elenco URL inviato contiene URL non validi o URL con un host che non corrisponde a quello del negozio attivo.';
$_['error_empty_queue']                   = 'Avviso: La coda è vuota.';
$_['error_file_upload_limit']             = 'Avviso: La dimensione del file supera il limite di 50 MB. Carica un file di dimensioni inferiori.';
$_['error_service_key']                   = 'La chiave di servizio non è valida. Fornisci una chiave di servizio valida.';
