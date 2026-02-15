<?php
// Heading
$_['heading_title']                       = 'Playful Sparkle - IndexNow';
$_['heading_getting_started']             = 'Začíname';
$_['heading_setup']                       = 'Nastavenie IndexNow';
$_['heading_troubleshot']                 = 'Bežné problémy';
$_['heading_faq']                         = 'Často kladené otázky';
$_['heading_contact']                     = 'Kontaktujte podporu';
$_['entry_indexnow_services']                    = 'Služby IndexNow';

// Text
$_['text_extension']                      = 'Rozšírenia';
$_['text_success']                        = 'Úspech: Úspešne ste upravili IndexNow feed!';
$_['text_success_generate_service_key']   = 'Úspech: Úspešne ste vygenerovali nový servisný kľúč!';
$_['text_success_remove_queue']           = 'Úspech: URL v čakacej rade boli úspešne odstránené!';
$_['text_success_clear_log']              = 'Úspech: Log bol úspešne vyčistený!';
$_['text_success_clear_queue']            = 'Úspech: Čakacia rada bola úspešne vyčistená!';
$_['text_success_submit_queue']           = 'Úspech: URL v čakacej rade boli úspešne odoslané!';
$_['text_success_submit_url_list']        = 'Úspech: Zoznam URL bol úspešne odoslaný!';
$_['text_edit']                           = 'Upraviť IndexNow';
$_['text_getting_started']                = '<p><strong>Prehľad:</strong> Rozšírenie <strong>Playful Sparkle - IndexNow</strong> pre OpenCart 4.x+ umožňuje vášmu obchodu automaticky informovať vyhľadávače ako Bing a Yandex, keď sa pridá, upraví alebo odstráni obsah vášho obchodu. Týmto sa zabezpečí rýchlejšie indexovanie zmien, čo zlepší viditeľnosť vášho obchodu a výkonnosť vo vyhľadávaní. Ponúka funkcie ako manuálne odosielanie URL, odosielanie URL do čakacej rady, prispôsobiteľné nastavenia a podporu Cron.</p><p><strong>Požiadavky:</strong> OpenCart 4.x+, PHP 7.4+ alebo vyšší.</p>';
$_['text_setup']                          = '<ul><li><strong>Krok 1: Inštalácia rozšírenia</strong> - Nahrajte a nainštalujte rozšírenie v administračnom paneli OpenCart. Po inštalácii sa automaticky vygeneruje servisný kľúč pre každý obchod.</li><li><strong>Krok 2: Povolenie rozšírenia pre každý obchod</strong> - Otvorte nastavenia rozšírenia a povoľte ho pre každý obchod, v ktorom chcete používať IndexNow.</li><li><strong>Krok 3: Výber služby IndexNow</strong> - Vyberte koncový bod IndexNow, do ktorého chcete odosielať údaje.</li><li><strong>Krok 4: Konfigurácia automatického upozornenia</strong> - Povoľte možnosti automatického upozornenia na odosielanie adries URL pri pridaní, aktualizácii alebo odstránení kategórií, produktov, výrobcov alebo článkov.</li><li><strong>Krok 5: Opätovné vygenerovanie servisného kľúča (voliteľné)</strong> - V prípade potreby môžete v nastaveniach rozšírenia znova vygenerovať servisný kľúč samostatne pre každý obchod.</li><li><strong>Krok 6: Odoslanie adries URL</strong> - Adresy URL odošlite spracovaním frontu, importovaním mapy stránok XML, nahraním súboru mapy stránok alebo manuálnym zadaním adries URL.</li><li><strong>Krok 7: Sledovanie protokolov</strong> - Po odoslaní skontrolujte výsledky na karte "Protokol". V prípade potreby môžete protokol aj vymazať.</li></ul>';
$_['text_troubleshot']                    = '<details><summary><strong>Zoznam odoslaných URL obsahuje neplatné URL alebo URL s hostiteľom, ktorý nezodpovedá aktívnemu obchodu</strong></summary> Uistite sa, že textové pole zoznamu URL obsahuje platné URL a že doména URL zodpovedá doméne aktívneho obchodu.</details>
<details><summary><strong>Nezobrazuje sa súbor sitemap xyz</strong></summary> Uistite sa, že URL súboru sitemap je správne zadaná.</details>
<details><summary><strong>Neplatný typ súboru. Nahrajte platný súbor</strong></summary> Uistite sa, že nahrávate platný XML súbor sitemap.</details>
<details><summary><strong>Čakacia rada nie je naplnená</strong></summary> Uistite sa, že možnosti notifikácie pre vyhľadávače sú povolené. Tieto možnosti umožňujú systému pridať URL do čakacej rady pre kategórie, produkty, výrobcov alebo články vždy, keď sú pridané, upravené alebo odstránené.</details>
<details><summary><strong>Žiadne služby nie sú povolené. Povoľte aspoň jednu službu</strong></summary> Musíte povoliť aspoň jednu službu IndexNow pred kliknutím na tlačidlo "Odoslať URL v čakacej rade".</details>';
$_['text_faq']                            = '<details><summary><strong>Ako môžem povoliť alebo zakázať rozšírenie pre každý obchod?</strong></summary><p>Rozšírenie môžete povoliť alebo zakázať pre každý obchod samostatne v nastaveniach rozšírenia.</p></details>
<details><summary><strong>Môžem povoliť alebo zakázať služby IndexNow pre každý obchod?</strong></summary><p>Ano, služby IndexNow môžete povoliť alebo zakázať pre každý obchod samostatne v nastaveniach rozšírenia.</p></details>
<details><summary><strong>Ako vygenerujem kľúč služby pre každý obchod?</strong></summary><p>Kľúč služby je automaticky vygenerovaný počas inštalácie a je jedinečný pre každý obchod. Není potrebné ho generovať manuálne.</p></details>
<details><summary><strong>Môžem znovu vygenerovať kľúč služby pre každý obchod?</strong></summary><p>Ano, kľúč služby môžete znovu vygenerovať pre každý obchod samostatne v nastaveniach rozšírenia. Týmto spôsobom môžete obnoviť alebo zmeniť kľúč podľa potreby.</p></details>
<details><summary><strong>Môžem použiť vlastnú Cron URL pre odosielanie URL adries do služieb IndexNow?</strong></summary><p>Ano, môžete si vybrať, či použijete Cron URL poskytovanú rozšírením alebo URL stránku Cron v OpenCart na odosielanie URL adries v čakacom zozname. Obe možnosti fungujú bez problémov.</p></details>
<details><summary><strong>Ako veľká a aké URL môžu byť v súbore sitemap?</strong></summary><p>Súbor sitemap môže mať veľkosť až 50 MB a môže obsahovať až 50 000 URL adries. Uistite sa, že váš sitemap neprekročí tieto limity.</p></details>
<details><summary><strong>Ako môžem odoslať URL adresy do služieb IndexNow?</strong></summary><p>URL adresy do služieb IndexNow môžete odoslať importovaním sitemapu, nahraním súboru XML sitemapu alebo ručným zadaním URL adresy do sitemapu. Okrem toho môžete odoslať jednotlivé URL adresy z čakacieho zoznamu alebo odoslať všetky URL adresy v čakacom zozname naraz pre vybraný obchod.</p></details>
<details><summary><strong>Ako vymazať protokol o odoslaných URL adresách?</strong></summary><p>Protokol môžete vymazať v záložke Protokol. Protokol bude vymazaný bez chýb vždy, keď sa rozhodnete ho vymazať.</p></details>';
$_['text_contact']                        = '<p>Pre ďalšiu pomoc sa, prosím, obráťte na náš tím podpory:</p><ul><li><strong>Kontakt:</strong> <a href="mailto:%s">%s</a></li><li><strong>Dokumentácia:</strong> <a href="%s" target="_blank" rel="noopener noreferrer">Dokumentácia pre používateľov</a></li></ul>';
$_['text_log_no_results']                 = 'Momentálne nie sú k dispozícii žiadne záznamy v protokole.';
$_['text_queue_no_results']               = 'Momentálne nie sú v čakacom zozname žiadne URL adresy.';
$_['text_categories']                     = 'Kategórie na vašom webe sú pridané, aktualizované alebo odstránené.';
$_['text_products']                       = 'Produkty na vašom webe sú pridané, aktualizované alebo odstránené.';
$_['text_manufacturers']                  = 'Výrobcovia na vašom webe sú pridaní, aktualizovaní alebo odstránení.';
$_['text_information']                    = 'Informačné stránky na vašom webe sú pridané, aktualizované alebo odstránené.';
$_['text_topics']                         = 'Témy článkov na vašom webe sú pridané, aktualizované alebo odstránené.';
$_['text_articles']                       = 'Články na vašom webe sú pridané, aktualizované alebo odstránené.';
$_['text_url_list_warning']               = 'URL adresy, ktoré vložíte, budú overené. Každá URL musí byť správne formátovaná s "http" alebo "https" a jej hostiteľ musí zodpovedať hostiteľovi obchodu: "%s". Môžete odoslať maximálne 10 000 URL adries.';
$_['text_http_status_code']               = 'Analýza HTTP odpovedí statusových kódov zo služieb IndexNow vám pomôže pochopiť, či boli vaše požiadavky spracované úspešne alebo sa vyskytli problémy. Tieto kódy poskytujú informácie o výsledkoch indexovania URL a potenciálnych chybách. Navštívte nasledujúce služby IndexNow, aby ste sa dozvedeli viac o ich HTTP statusových kódoch:<br><br><ul><li><a href="https://www.bing.com/indexnow/getstarted" target="_blank" rel="noopener noreferrer">Microsoft Bing Webmaster Tools</a></li><li><a href="https://searchadvisor.naver.com/guide/indexnow-request" target="_blank" rel="noopener noreferrer">Naver Search Advisor</a></li><li><a href="https://napoveda.seznam.cz/cz/fulltext-hledani-v-internetu/protokol-indexnow/odeslani-vice-stranek-jednim-pozadavkem/" target="_blank" rel="noopener noreferrer">Seznam.cz</a></li><li><a href="https://yandex.com/support/webmaster/indexnow/reference/post-url.html" target="_blank" rel="noopener noreferrer">Yandex Webmaster Tools</a></li></ul>';

// Column
$_['column_log_id']                       = 'ID protokolu';
$_['column_log_url']                      = 'URL';
$_['column_log_service_name']             = 'Názov služby';
$_['column_log_status_code']              = 'Statusový kód';
$_['column_log_date_added']               = 'Dátum pridania';
$_['column_queue_id']                     = 'ID čakacieho zoznamu';
$_['column_queue_url']                    = 'URL';
$_['column_queue_date_added']             = 'Dátum pridania';
$_['column_queue_action']                 = 'Akcia';

// Tab
$_['tab_general']                         = 'Hlavné';
$_['tab_manual_submit']                   = 'Ručné odoslanie';
$_['tab_queue']                           = 'Čakací zoznam';
$_['tab_log']                             = 'Protokol';
$_['tab_help_and_support']                = 'Pomoc &amp; Podpora';

// Entry
$_['entry_status']                        = 'Stav';
$_['entry_service_key']                   = 'Kľúč služby';
$_['entry_service_key_location']          = 'URL kľúča služby';
$_['entry_active_store']                  = 'Aktívny obchod';
$_['entry_notify_search_engines']         = 'Oznámiť vyhľadávačom';
$_['entry_url_list']                      = 'Zoznam URL';
$_['entry_load_sitemap']                  = 'Načítať Sitemap';
$_['entry_cron_url']                      = 'Cron URL';

// Button
$_['button_change_key']                   = 'Zmeniť kľúč';
$_['button_check_key']                    = 'Skontrolovať kľúč';
$_['button_submit_url']                   = 'Odoslať URL';
$_['button_submit_queue']                 = 'Odoslať čakajúce URL';
$_['button_clear_queue']                  = 'Vymazať čakajúce URL';
$_['button_clear_log']                    = 'Vymazať protokol';
$_['button_submit_url_list']              = 'Odoslať zoznam URL';
$_['button_clear_url_list']               = 'Vymazať zoznam URL';
$_['button_upload_sitemap']               = 'Nahrať Sitemap URL';
$_['button_import_sitemap']               = 'Importovať Sitemap URL';
$_['button_copy']                         = 'Skopírovať URL';

// Help
$_['help_service_key']                    = 'IndexNow API kľúč overuje vlastníctvo stránky a generuje sa automaticky. Zmeňte kľúč, ak bol kompromitovaný.';
$_['help_service_key_location']           = 'Kliknite na tlačidlo „Skontrolovať kľúč“, aby ste sa uistili, že je kľúč prístupný pre vyhľadávače. Malo by sa otvoriť živé URL, kde sa kľúč nachádza.';
$_['help_url_list']                       = 'Zadajte zoznam URL, jednu na riadok (až 10 000). Uistite sa, že každá URL je správne naformátovaná s "http" alebo "https". Kliknite na „Odoslať zoznam URL“, aby ste poslali URL do vybraných IndexNow služieb.';
$_['help_load_sitemap']                   = 'Môžete poskytnúť URL mapy stránok alebo nahrať súbor sitemap.xml (do 50 MB alebo 50 000 URL). URL z mapy stránok sa pridajú do zoznamu a pošlú do vybraných IndexNow služieb. O procese budete informovaní po jeho dokončení.';
$_['help_cron_url']                       = 'Pridajte túto URL do cron tabuľky vášho hostingového servera. Automaticky pošle <strong>všetky URL v čakacej rade</strong> zo <strong>všetkých nakonfigurovaných obchodov</strong> do <strong>vybraných IndexNow koncových bodov služieb</strong> v naplánovaných intervaloch. Alternatívne môžete použiť <a href="%s">OpenCart 4 Cron Jobs</a> URL na odoslanie URL do IndexNow koncových bodov služieb.';

// Error
$_['error_permission']                    = 'Upozornenie: Nemáte povolenie na úpravu rozšírenia IndexNow!';
$_['error_generate_service_key']          = 'Upozornenie: Nepodarilo sa vygenerovať nový služobný kľúč!';
$_['error_remove_queue']                  = 'Upozornenie: Nepodarilo sa odstrániť URL z čakacej rady!';
$_['error_not_configured']                = 'Upozornenie: Rozšírenie IndexNow nie je nakonfigurované!';
$_['error_filetype']                      = 'Upozornenie: Neplatný typ súboru. Nahrajte platný súbor.';
$_['error_upload']                        = 'Upozornenie: Súbor sa nepodarilo nahrať.';
$_['error_download']                      = 'Upozornenie: Nepodarilo sa stiahnuť súbor mapy stránok "%s"';
$_['error_invalid_url']                   = 'Upozornenie: URL je neplatná. Poskytnite platnú URL.';
$_['error_invalid_url_host']              = 'Upozornenie: Hostiteľ URL je neplatný. Hostiteľ URL musí byť rovnaký ako hostiteľ aktuálnej URL.';
$_['error_no_services_enabled']           = 'Upozornenie: Žiadne služby nie sú povolené. Povoliť aspoň jednu službu.';
$_['error_submit_url_list_empty']         = 'Upozornenie: Zoznam odoslaných URL je prázdny.';
$_['error_submit_url_list_invalid']       = 'Upozornenie: Zoznam odoslaných URL obsahuje neplatné URL alebo URL s hostiteľom, ktorý sa nezhoduje s aktívnym obchodom.';
$_['error_empty_queue']                   = 'Upozornenie: Čakacia rada je prázdna.';
$_['error_file_upload_limit']             = 'Upozornenie: Veľkosť súboru presahuje limit 50 MB. Nahrajte menší súbor.';
$_['error_service_key']                   = 'Služobný kľúč je neplatný. Poskytnite platný služobný kľúč.';
$_['error_service_key_location']          = 'Miesto kľúča služby je neplatné. Poskytnite prosím platné miesto kľúča služby.';
