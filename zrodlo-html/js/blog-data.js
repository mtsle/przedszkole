/* Blog — dane wpisów. Jedyne źródło listy na blog.html.
   Dodanie wpisu = dopisanie obiektu poniżej + utworzenie pliku url (podstrona artykułu).
   cat: aktualnosci | wydarzenia | porady | adaptacja | rozwoj | jezykowe | wwr | zycie
   Tylko PRAWDZIWE wpisy (źródło: czarodziejski-dworek.pl/blog). Newest first. */
window.BLOG_CATS = [
  { slug: 'aktualnosci', label: 'Aktualności' },
  { slug: 'wydarzenia',  label: 'Wydarzenia' },
  { slug: 'porady',      label: 'Porady dla rodziców' },
  { slug: 'adaptacja',   label: 'Adaptacja' },
  { slug: 'rozwoj',      label: 'Rozwój dziecka' },
  { slug: 'jezykowe',    label: 'Zajęcia językowe' },
  { slug: 'wwr',         label: 'WWR i terapia' },
  { slug: 'zycie',       label: 'Życie przedszkola' },
];

window.BLOG = [
  {
    slug: 'dzien-otwarty-2025',
    title: 'Dzień otwarty!',
    date: '2025-01-08', dateText: '8 stycznia 2025',
    cat: 'aktualnosci',
    img: 'img/real/blog/dzien-otwarty-2025.webp',
    url: 'blog-dzien-otwarty.html',
    excerpt: 'Szukasz dobrego przedszkola na warszawskiej Woli? Zapraszamy na dzień otwarty — poznaj Czarodziejski Dworek i zapisz dziecko (rocznik 2023).',
  },
  {
    slug: 'szkola-myslenia-pozytywnego',
    title: 'Bierzemy udział w programie „Szkoła Myślenia Pozytywnego”!',
    date: '2024-09-26', dateText: '26 września 2024',
    cat: 'rozwoj',
    img: 'img/real/blog/szkola-myslenia.webp',
    url: 'blog-szkola-myslenia-pozytywnego.html',
    excerpt: 'Roczna przygoda o dbaniu o zdrowie psychiczne, empatię i pozytywną komunikację — dla dzieci i dorosłych z ich otoczenia.',
  },
  {
    slug: 'angielski-wrzesien-2024',
    title: 'Zajęcia z języka angielskiego – wrzesień 2024',
    date: '2024-09-02', dateText: '2 września 2024',
    cat: 'jezykowe',
    img: 'img/real/angielski.webp',
    url: 'blog-angielski-wrzesien-2024.html',
    excerpt: 'Rozkłady i materiały do zajęć z angielskiego dla grup: Białej, Czerwonej, Fioletowej i Niebieskiej.',
  },
  {
    slug: 'piknik-jubileuszowy',
    title: 'Czarodziejski Piknik Jubileuszowy!',
    date: '2024-05-22', dateText: '22 maja 2024',
    cat: 'wydarzenia',
    img: 'img/real/blog/piknik.webp',
    url: 'blog-piknik-jubileuszowy.html',
    excerpt: 'Świętowaliśmy 20-lecie przedszkola — galeria wspomnień, występy artystyczne, warsztaty i strefa relaksu dla absolwentów i ich rodzin.',
  },
  {
    slug: 'dzien-otwarty-2024',
    title: 'Dzień Otwarty!',
    date: '2024-03-14', dateText: '14 marca 2024',
    cat: 'wydarzenia',
    img: 'img/real/blog/dzien-otwarty-2024.webp',
    url: 'blog-dzien-otwarty-2024.html',
    excerpt: 'Angielski, francuski, muzyka, robotyka, taniec i basen — zobacz, jak wygląda dzień w Czarodziejskim Dworku.',
  },
  {
    slug: 'francuski-grudzien-2023',
    title: 'Zajęcia z języka francuskiego – grudzień 2023',
    date: '2023-11-30', dateText: '30 listopada 2023',
    cat: 'jezykowe',
    img: 'img/real/francuski.webp',
    url: 'blog-francuski-grudzien-2023.html',
    excerpt: 'Piosenka „L’as-tu vu ce petit bonhomme” oraz bajki „La moufle” i „Aboie, Georges!” — materiały do zajęć z francuskiego.',
  },
  {
    slug: 'dni-wolne-2023-2024',
    title: 'Dni wolne i uroczystości 2023/2024',
    date: '2023-09-04', dateText: '4 września 2023',
    cat: 'zycie',
    img: 'img/real/blog/dni-wolne.webp',
    url: 'blog-dni-wolne-2023-2024.html',
    excerpt: 'Kalendarz dni wolnych i przedszkolnych uroczystości w roku szkolnym 2023/2024.',
  },
];
