# README del Progetto: Social Network

## Descrizione

Questo progetto simula un social network dove gli utenti possono registrarsi, accedere, postare foto, aggiungere commenti e like, visualizzare il proprio profilo e interagire con altri utenti. È strutturato in una serie di pagine e gestori che consentono la gestione dei dati e delle interazioni tra gli utenti.

### Funzionalità principali
- **Registrazione e Login**: Gli utenti possono registrarsi con una mail e una password. Una volta registrati, possono effettuare il login per accedere alla home.
- **Post e Storie**: Gli utenti possono caricare foto, aggiungere descrizioni e interagire con post e storie degli altri utenti. È possibile aggiungere commenti e mettere like ai post.
- **Profilo Utente**: Ogni utente ha un profilo che visualizza i propri dati, i post pubblicati, i seguiti e i follower. È anche possibile eliminare il proprio profilo.

# Progetto Social Media

## Struttura e Funzionalità del Progetto

### 1. **Classe Post**
- **Difficoltà**: 1/4
- **Ordine di esecuzione**: 1

**Attributi**:
- `pathFoto`: il percorso dell'immagine del post
- `data`: la data di creazione del post
- `numeroLike`: il numero di like ricevuti
- `commenti[]`: lista di commenti ricevuti
- `diChiE`: riferimento al profilo dell'utente che ha creato il post

**Metodi**:
- `public toCSV()`: scrive i dati del post su un file CSV
- `public fromCSV()`: legge i dati del post da un file CSV
- `public get` e `set`: metodi di accesso ai dati con controlli
- `private calcolaLike()`: calcola il numero di like per un post

---

### 2. **Classe Storia**
- **Difficoltà**: 2/4
- **Ordine di esecuzione**: 1

**Attributi**:
- `pathFoto`: il percorso dell'immagine della storia
- `data`: la data di creazione della storia
- `diChiE`: riferimento al profilo dell'utente che ha creato la storia
- `numeroVisualizzazioni`: il numero di visualizzazioni della storia

**Metodi**:
- `public toCSV()`: scrive i dati della storia su un file CSV
- `public fromCSV()`: legge i dati della storia da un file CSV
- `public get` e `set`: metodi di accesso ai dati con controlli
- `public contaVisualizzazione()`: calcola il numero di visualizzazioni di una storia (opzionale)

---

### 3. **Classe Profilo/Utente**
- **Difficoltà**: 2/4
- **Ordine di esecuzione**: 1

**Attributi**:
- `nomeUtente`: il nome dell'utente
- `mail`: l'email dell'utente
- `password`: la password dell'utente
- `descrizione`: una breve descrizione del profilo
- `seguiti[]`: lista degli utenti seguiti
- `followers[]`: lista dei follower
- `post[]`: lista dei post dell'utente

**Metodi**:
- `public toCSV()`: scrive i dati del profilo su un file CSV
- `public fromCSV()`: legge i dati del profilo da un file CSV
- `public get` e `set`: metodi di accesso ai dati con controlli

---

### 4. **Funzionalità e Pagine**

#### 4.1 **Index (Registrazione o Login)**
- **Difficoltà**: 1/4
- **Ordine di esecuzione**: 2

#### 4.2 **Pagina Registrazione**
- **Difficoltà**: 2/4
- **Ordine di esecuzione**: 2
- **Funzionalità**:
  - Consente di registrarsi inserendo l'email e la password. I dati vengono salvati in un file.

#### 4.3 **Gestore Registrazione**
- **Difficoltà**: 2/4
- **Ordine di esecuzione**: 2
- **Funzionalità**:
  - Verifica che l'username non sia già in uso e salva i dati del nuovo utente.

#### 4.4 **Pagina Login**
- **Difficoltà**: 1/4
- **Ordine di esecuzione**: 2
- **Funzionalità**:
  - Permette agli utenti di effettuare il login inserendo la mail e la password.

#### 4.5 **Gestore Login**
- **Difficoltà**: 3/4
- **Ordine di esecuzione**: 2
- **Funzionalità**:
  - Verifica che la password e l'email siano corretti e che l'utente esista.

#### 4.6 **Footer (Home, Aggiungi Post, Tuo Profilo)**
- **Difficoltà**: 1/4
- **Ordine di esecuzione**: 2
- **Funzionalità**:
  - Consente di navigare tra le diverse sezioni: Home, Aggiungi Post, Profilo.

#### 4.7 **Gestore Logout**
- **Difficoltà**: 1/4
- **Ordine di esecuzione**: 2
- **Funzionalità**:
  - Pulisce i dati dell'utente e rimanda alla pagina di login.

#### 4.8 **Pagina Aggiungi Storia**
- **Difficoltà**: 2/4
- **Ordine di esecuzione**: 3
- **Funzionalità**:
  - Permette di caricare una foto e creare una nuova storia. I dati vengono salvati in un file.

#### 4.9 **Gestore Aggiungi Storia**
- **Difficoltà**: 2/4
- **Ordine di esecuzione**: 3
- **Funzionalità**:
  - Prende i dati della storia e li imposta nel sistema.

#### 4.10 **Pagina Aggiungi Post**
- **Difficoltà**: 2/4
- **Ordine di esecuzione**: 3
- **Funzionalità**:
  - Permette di caricare una foto e aggiungere una descrizione al post.

#### 4.11 **Gestore Aggiungi Post**
- **Difficoltà**: 2/4
- **Ordine di esecuzione**: 3
- **Funzionalità**:
  - Prende i dati del post e li salva nel sistema.

#### 4.12 **Pagina Profilo**
- **Difficoltà**: 4/4
- **Ordine di esecuzione**: 4
- **Funzionalità**:
  - Visualizza le informazioni del profilo, i post, i seguiti e i follower. Permette anche l'eliminazione del profilo.

#### 4.13 **Gestore Pagina Profilo**
- **Difficoltà**: 3/4
- **Ordine di esecuzione**: 4
- **Funzionalità**:
  - Gestisce la visualizzazione del profilo, l'aggiornamento e l'eliminazione.

#### 4.14 **Pagina Home**
- **Difficoltà**: 4/4
- **Ordine di esecuzione**: 5
- **Funzionalità**:
  - Mostra i post e le storie pubblicate, permettendo di aggiungere commenti e like.

#### 4.15 **Gestore Pagina Home**
- **Difficoltà**: 4/4
- **Ordine di esecuzione**: 5
- **Funzionalità**:
  - Gestisce la visualizzazione dei post e delle storie, i commenti e i like.

---


# Struttura dei file

## FILEUTENTI
- **FILEUTENTE**
  - **FILEINFO**
    - `bio`: Biografia dell'utente
    - `foto`: Foto del profilo
    - `pathFile`: Percorso del file principale dell'utente
    - `pathFileSeguiti`: Percorso del file che contiene i seguiti
    - `pathFilePost`: Percorso del file che contiene i post
  - **FILESEGUITI**
    - `nomeUtente`: Nome dell'utente seguito
  - **FILEPUBBLICAZIONE**
    - `idPubblicazione`: Identificativo unico della pubblicazione (storia o post)
    - `tipoPubblicazione`: Tipo di pubblicazione (storia o post)
    - **FILEPOST**
      - `id`: Identificativo unico del post
      - `nomeUtente`: Nome dell'utente che ha creato il post
      - `descrizione`: Descrizione del post
      - `pathFoto`: Percorso della foto associata al post
      - `luogo`: Luogo in cui è stato pubblicato il post
      - `pathFileCommentiPost`: Percorso del file che contiene i commenti del post
      - `pathFileLikePost`: Percorso del file che contiene i like del post
      - `giaVisto`: Flag che indica se il post è già stato visto
    - **FILELIKEPOST**
      - `nomeUtente`: Nome dell'utente che ha messo il like al post
    - **FILECOMMENTI**
      - `nomeUtente`: Nome dell'utente che ha commentato
      - `testoCommento`: Testo del commento
    - **FILESTORIA**
      - `id`: Identificativo unico della storia
      - `nomeUtente`: Nome dell'utente che ha creato la storia
      - `pathFoto`: Percorso della foto associata alla storia
      - `dataPubblicazione`: Data di pubblicazione della storia
      - `luogo`: Luogo in cui è stata pubblicata la storia
      - `giaVisto`: Flag che indica se la storia è stata vista
      - `pathFileLikeStoria`: Percorso del file che contiene i like della storia
    - **FILELIKESTORIA**
      - `nomeUtente`: Nome dell'utente che ha messo il like alla storia



## Struttura dei file

- `src/`: Contiene il codice sorgente.
- `data/`: Contiene i file CSV per salvare i dati di utenti, post e storie.
