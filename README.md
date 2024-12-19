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

## Come eseguire il progetto

1. Clona il repository:
    ```bash
    git clone https://github.com/tuo-username/progetto-social-media.git
    ```

2. Naviga nella cartella del progetto:
    ```bash
    cd progetto-social-media
    ```

3. Compila ed esegui il progetto utilizzando il tuo ambiente di sviluppo preferito.

4. Segui le istruzioni per registrarti, fare il login e interagire con i post e le storie.

## Struttura dei file

- `src/`: Contiene il codice sorgente.
- `data/`: Contiene i file CSV per salvare i dati di utenti, post e storie.

## Contribuire

Se desideri contribuire a questo progetto, sentiti libero di fare un fork e inviare una pull request. Assicurati di seguire le convenzioni di codifica e di testare le tue modifiche.

## Licenza

Questo progetto è concesso in licenza sotto la [MIT License](LICENSE).
