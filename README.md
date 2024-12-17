# README del Progetto: Social Network

## Descrizione

Questo progetto simula un social network dove gli utenti possono registrarsi, accedere, postare foto, aggiungere commenti e like, visualizzare il proprio profilo e interagire con altri utenti. È strutturato in una serie di pagine e gestori che consentono la gestione dei dati e delle interazioni tra gli utenti.

### Funzionalità principali
- **Registrazione e Login**: Gli utenti possono registrarsi con una mail e una password. Una volta registrati, possono effettuare il login per accedere alla home.
- **Post e Storie**: Gli utenti possono caricare foto, aggiungere descrizioni e interagire con post e storie degli altri utenti. È possibile aggiungere commenti e mettere like ai post.
- **Profilo Utente**: Ogni utente ha un profilo che visualizza i propri dati, i post pubblicati, i seguiti e i follower. È anche possibile eliminare il proprio profilo.

### Struttura del progetto

#### Pagine principali

1. **index**:
   - Pagina di benvenuto che consente di registrarsi o fare il login.
   - **Registrati**: Permette l'inserimento di email e password.
     - **Pagina Utente**: Dopo la registrazione, l'utente viene reindirizzato alla pagina home.
   - **Login**: Consente l'inserimento di email e password (con controllo per evitare doppio login).
     - **Pagina Home**: Dopo il login, l'utente viene reindirizzato alla home dove può interagire con i post e storie.

2. **paginaHome**:
   - Visualizzazione dei post e storie recenti.
   - Possibilità di aggiungere commenti e like ai post.

3. **paginaAddPost**:
   - Permette all'utente di caricare foto, aggiungere descrizioni e settaggi di parametri per il post.

4. **paginaAddStoria**:
   - Consente di caricare foto per le storie e di creare un file relativo alla storia.

5. **paginaProfilo**:
   - Mostra i dati dell'utente, i suoi post, i seguiti e i follower.
   - Opzione per eliminare il profilo.

6. **footer**:
   - Link per navigare tra Home, aggiungere un post e visualizzare il proprio profilo.

#### Gestori

1. **gestoreLogin**:
   - Gestisce il controllo della correttezza delle credenziali e verifica se l'utente è già registrato.

2. **gestoreRegistrati**:
   - Gestisce la registrazione dell'utente, salvando i dati nel sistema (evitando duplicati).

3. **gestoreLogout**:
   - Pulisce tutte le informazioni di sessione e rimanda l'utente alla pagina index.

4. **gestorePaginaProfilo**:
   - Gestisce la visualizzazione e la modifica del profilo utente.

5. **gestorePaginaHome**:
   - Gestisce la visualizzazione dei post e delle storie nella home.

#### Classi principali

1. **Post**:
   - **Attributi**: 
     - `pathFoto`: percorso della foto.
     - `data`: data di pubblicazione del post.
     - `numeroLike`: numero di like ricevuti.
     - `commenti[]`: array contenente i commenti.
     - `diChiÈ`: riferimento al profilo dell'utente che ha creato il post.
   - **Metodi**:
     - `toCSV()`: salva i dati del post su un file CSV.
     - `fromCSV()`: carica i dati del post da un file CSV.
     - `get e set`: metodi per ottenere e impostare i dati.
     - `calcolaLike()`: calcola il numero di like ricevuti.

2. **Storia**:
   - **Attributi**:
     - `pathFoto`: percorso della foto.
     - `data`: data di pubblicazione della storia.
     - `diChiÈ`: riferimento al profilo dell'utente che ha creato la storia.
     - `numeroVisualizzazione`: numero di visualizzazioni della storia.
   - **Metodi**:
     - `toCSV()`: salva i dati della storia su un file CSV.
     - `fromCSV()`: carica i dati della storia da un file CSV.
     - `get e set`: metodi per ottenere e impostare i dati.
     - `contaVisualizzazioni()`: calcola il numero di visualizzazioni della storia.

3. **Profilo**:
   - **Attributi**:
     - `nomeUtente`: nome utente dell'utente.
     - `mail`: email dell'utente.
     - `password`: password dell'utente.
     - `descrizione`: descrizione del profilo.
     - `seguiti[]`: lista degli utenti seguiti.
     - `followers[]`: lista dei follower.
     - `post[]`: lista dei post creati dall'utente.
   - **Metodi**:
     - `toCSV()`: salva i dati del profilo su un file CSV.
     - `fromCSV()`: carica i dati del profilo da un file CSV.
     - `get e set`: metodi per ottenere e impostare i dati.

## Installazione

1. Clona il repository:
   ```bash
   git clone https://github.com/username/progetto-social-network.git
