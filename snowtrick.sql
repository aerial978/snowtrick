-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 21 juil. 2023 à 14:22
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `snowtrick`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`) VALUES
(96, 'Grabs', '2023-04-08 14:27:52'),
(97, 'Rotations', '2023-04-08 14:27:52'),
(98, 'Flips', '2023-04-08 14:27:52'),
(99, 'Rotations désaxées', '2023-04-08 14:27:52'),
(100, 'Slides', '2023-04-08 14:27:52'),
(101, 'One foot tricks', '2023-04-08 14:27:52'),
(102, 'Old school', '2023-04-08 14:27:52');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220801185633', '2023-04-08 14:10:51', 92);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `trick_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `trick_id`, `user_id`, `content`, `created_at`) VALUES
(1, 234, 19, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '2023-04-14 13:45:24'),
(2, 230, 19, 'When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.', '2023-04-14 13:46:35'),
(3, 231, 19, 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-14 13:47:31'),
(4, 228, 19, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', '2023-04-14 13:48:07'),
(5, 225, 19, 'Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', '2023-04-14 13:49:26'),
(6, 232, 20, 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken.', '2023-04-14 13:51:55'),
(7, 226, 20, 'Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren \'60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.', '2023-04-14 13:52:35'),
(8, 230, 20, 'In tegenstelling tot wat algemeen aangenomen wordt is Lorem Ipsum niet zomaar willekeurige tekst. het heeft zijn wortels in een stuk klassieke latijnse literatuur uit 45 v.Chr. en is dus meer dan 2000 jaar oud.', '2023-04-14 13:53:09'),
(9, 229, 20, 'Richard McClintock, een professor latijn aan de Hampden-Sydney College in Virginia, heeft één van de meer obscure latijnse woorden, consectetur, uit een Lorem Ipsum passage opgezocht, en heeft tijdens het zoeken naar het woord in de klassieke literatuur de onverdachte bron ontdekt.', '2023-04-14 13:54:29'),
(10, 233, 20, 'Het standaard stuk van Lorum Ipsum wat sinds de 16e eeuw wordt gebruikt is hieronder, voor wie er interesse in heeft, weergegeven. Secties 1.10.32 en 1.10.33 van \"de Finibus Bonorum et Malorum\" door Cicero zijn ook weergegeven in hun exacte originele vorm, vergezeld van engelse versies van de 1914 vertaling door H. Rackham.', '2023-04-14 13:55:05'),
(11, 234, 21, 'Lorem Ipsum è un testo segnaposto utilizzato nel settore della tipografia e della stampa. Lorem Ipsum è considerato il testo segnaposto standard sin dal sedicesimo secolo, quando un anonimo tipografo prese una cassetta di caratteri e li assemblò per preparare un testo campione.', '2023-04-16 08:10:32'),
(12, 233, 21, 'È sopravvissuto non solo a più di cinque secoli, ma anche al passaggio alla videoimpaginazione, pervenendoci sostanzialmente inalterato.', '2023-04-16 08:12:39'),
(13, 231, 21, 'Fu reso popolare, negli anni ’60, con la diffusione dei fogli di caratteri trasferibili “Letraset”, che contenevano passaggi del Lorem Ipsum, e più recentemente da software di impaginazione come Aldus PageMaker, che includeva versioni del Lorem Ipsum.', '2023-04-16 08:16:51'),
(14, 229, 21, 'Questo testo è un trattato su teorie di etica, molto popolare nel Rinascimento. La prima riga del Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", è tratta da un passaggio della sezione 1.10.32.', '2023-04-16 08:18:42'),
(15, 226, 21, 'Il brano standard del Lorem Ipsum usato sin dal sedicesimo secolo è riprodotto qui di seguito per coloro che fossero interessati. Anche le sezioni 1.10.32 e 1.10.33 del \"de Finibus Bonorum et Malorum\" di Cicerone sono riprodotte nella loro forma originale, accompagnate dalla traduzione inglese del 1914 di H. Rackham.', '2023-04-16 08:20:03'),
(16, 232, 22, '1500\'lerden beri kullanılmakta olan standard Lorem Ipsum metinleri ilgilenenler için yeniden üretilmiştir. Çiçero tarafından yazılan 1.10.32 ve 1.10.33 bölümleri de 1914 H. Rackham çevirisinden alınan İngilizce sürümleri eşliğinde özgün biçiminden yeniden üretilmiştir.', '2023-04-16 08:22:34'),
(17, 228, 22, 'Virginia\'daki Hampden-Sydney College\'dan Latince profesörü Richard McClintock, bir Lorem Ipsum pasajında geçen ve anlaşılması en güç sözcüklerden biri olan \'consectetur\' sözcüğünün klasik edebiyattaki örneklerini incelediğinde kesin bir kaynağa ulaşmıştır. Lorm Ipsum, Çiçero tarafından M.Ö. 45 tarihinde kaleme alınan \"de Finibus Bonorum et Malorum\" (İyi ve Kötünün Uç Sınırları) eserinin 1.10.32 ve 1.10.33 sayılı bölümlerinden gelmektedir.', '2023-04-16 08:23:21'),
(18, 225, 22, 'Beşyüz yıl boyunca varlığını sürdürmekle kalmamış, aynı zamanda pek değişmeden elektronik dizgiye de sıçramıştır. 1960\'larda Lorem Ipsum pasajları da içeren Letraset yapraklarının yayınlanması ile ve yakın zamanda Aldus PageMaker gibi Lorem Ipsum sürümleri içeren masaüstü yayıncılık yazılımları ile popüler olmuştur.', '2023-04-16 08:24:19'),
(19, 233, 22, 'Beşyüz yıl boyunca varlığını sürdürmekle kalmamış, aynı zamanda pek değişmeden elektronik dizgiye de sıçramıştır.', '2023-04-16 08:25:33'),
(21, 230, 22, 'Lorm Ipsum, Çiçero tarafından M.Ö. 45 tarihinde kaleme alınan \"de Finibus Bonorum et Malorum\" (İyi ve Kötünün Uç Sınırları) eserinin 1.10.32 ve 1.10.33 sayılı bölümlerinden gelmektedir.', '2023-04-16 08:56:31'),
(22, 226, 22, 'Lorem Ipsum pasajlarının birçok çeşitlemesi vardır. Ancak bunların büyük bir çoğunluğu mizah katılarak veya rastgele sözcükler eklenerek değiştirilmişlerdir. Eğer bir Lorem Ipsum pasajı kullanacaksanız, metin aralarına utandırıcı sözcükler gizlenmediğinden emin olmanız gerekir.', '2023-04-16 08:57:45'),
(23, 234, 23, 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquí, contenido aquí\".', '2023-04-18 07:45:56'),
(24, 232, 23, 'Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo.', '2023-04-18 07:46:59'),
(25, 231, 23, 'Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).', '2023-04-18 07:47:43'),
(26, 229, 23, 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles. Si vas a utilizar un pasaje de Lorem Ipsum, necesitás estar seguro de que no hay nada avergonzante escondido en el medio del texto.', '2023-04-18 07:48:43'),
(27, 228, 23, 'Todos los generadores de Lorem Ipsum que se encuentran en Internet tienden a repetir trozos predefinidos cuando sea necesario, haciendo a este el único generador verdadero (válido) en la Internet. Usa un diccionario de mas de 200 palabras provenientes del latín, combinadas con estructuras muy útiles de sentencias, para generar texto de Lorem Ipsum que parezca razonable.', '2023-04-18 07:49:31'),
(28, 225, 23, 'El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados. Las secciones 1.10.32 y 1.10.33 de \"de Finibus Bonorum et Malorum\" por Cicero son también reproducidas en su forma original exacta, acompañadas por versiones en Inglés de la traducción realizada en 1914 por H. Rackham.', '2023-04-18 07:50:32'),
(29, 233, 24, 'Vastoin yleistä uskomusta, Lorem Ipsum ei ole vain sattumanvarainen teksti. Sillä on pitkät juuret klassisesta latinalaisesta kirjallisuudesta vuonna 45 eKr alkaen, tehden siitä yli 2000 vuotta vanhan.', '2023-04-18 07:53:09'),
(30, 230, 24, 'Richard McClintock, latinalainen professori Hampden-Sydneyn yliopistossa Virginiassa, etsi yhden vaikeaselkoisimmista latinalaisista sanoista, consectetur, Lorem Ipsumin kappaleesta ja etsi lainauksia sanasta klassisessa kirjallisuudessa löytäen varman lähteen.', '2023-04-18 07:58:41'),
(31, 226, 24, 'Ensimmäinen Lorem Ipsumin rivi, \"Lorem ipsum dolor sit amet..\", tulee rivistä joka on osassa 1.10.32.', '2023-04-18 07:59:43'),
(32, 225, 24, 'Monet tietokoneen julkistusohjelmien pakkaukset ja nettisivueditorit käyttävät nyt Lorem Ipsumia heidän normaalina mallitekstinä. \'Lorem Ipsumia\' etsittäessä löytyy monen monta nettisivua, jotka ovat vasta aluillaan. Useita versioita on muodostunut vuosien kuluessa, jotkut vahingossa ja jotkut tarkoituksella (lisätty huumoria ja niin edelleen).', '2023-04-18 08:00:49'),
(33, 232, 24, 'Se tuli kuuluisuuteen 1960-luvulla kun Letraset-paperiarkit, joissa oli Lorem Ipsum pätkiä, julkaistiin ja vielä myöhemmin tietokoneen julkistusohjelmissa, kuten Aldus PageMaker joissa oli versioita Lorem Ipsumista.', '2023-04-18 08:02:20'),
(34, 228, 24, 'Lorem Ipsum on yksinkertaisesti testausteksti, jota tulostus- ja ladontateollisuudet käyttävät. Lorem Ipsum on ollut teollisuuden normaali testausteksti jo 1500-luvulta asti, jolloin tuntematon tulostaja otti kaljuunan ja sekoitti sen tehdäkseen esimerkkikirjan.', '2023-04-18 08:03:27'),
(35, 234, 25, 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte.', '2023-04-18 08:05:29'),
(36, 231, 25, 'Du texte.\' est qu\'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard.', '2023-04-18 08:06:33'),
(37, 229, 25, 'De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'à leur phase de construction.', '2023-04-18 08:07:20'),
(38, 226, 25, 'Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).', '2023-04-18 08:08:04'),
(39, 230, 25, 'Plusieurs variations de Lorem Ipsum peuvent être trouvées ici ou là, mais la majeure partie d\'entre elles a été altérée par l\'addition d\'humour ou de mots aléatoires qui ne ressemblent pas une seconde à du texte standard. Si vous voulez utiliser un passage du Lorem Ipsum, vous devez être sûr qu\'il n\'y a rien d\'embarrassant caché dans le texte.', '2023-04-18 08:09:04'),
(40, 232, 25, 'Tous les générateurs de Lorem Ipsum sur Internet tendent à reproduire le même extrait sans fin, ce qui fait de lipsum.com le seul vrai générateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour générer un Lorem Ipsum irréprochable. Le Lorem Ipsum ainsi obtenu ne contient aucune répétition, ni ne contient des mots farfelus, ou des touches d\'humour.', '2023-04-18 08:10:57'),
(41, 225, 26, 'Det er en kendsgerning, at man bliver distraheret af læsbart indhold på en side, når man betragter dens layout. Meningen med at bruge Lorem Ipsum er, at teksten indeholder mere eller mindre almindelig tekstopbygning i modsætning til \"Tekst her - og mere tekst her\", mens det samtidigt ligner almindelig tekst.', '2023-04-19 07:58:54'),
(42, 228, 26, 'Mange layoutprogrammer og webdesignere bruger Lorem Ipsum som fyldtekst. En søgning på Lorem Ipsum afslører mange websider, som stadig er på udviklingsstadiet. Der har været et utal af variationer, som er opstået enten på grund af fejl og andre gange med vilje (som blandt andet et resultat af humor).', '2023-04-19 07:59:41'),
(43, 233, 26, 'Der er mange tilgængelige udgaver af Lorem Ipsum, men de fleste udgaver har gennemgået forandringer, når nogen har tilføjet humor eller tilfældige ord, som på ingen måde ser ægte ud. Hvis du skal bruge en udgave af Lorem Ipsum, skal du sikre dig, at der ikke indgår noget pinligt midt i teksten.', '2023-04-19 08:03:06'),
(44, 231, 26, 'Alle Lorem Ipsum-generatore på nettet har en tendens til kun at dublere små brudstykker af Lorem Ipsum efter behov, hvilket gør dette til den første ægte generator på internettet.', '2023-04-19 08:03:51'),
(45, 229, 26, 'Den bruger en ordbog på over 200 ord på latin kombineret med en håndfuld sætningsstrukturer til at generere sætninger, som ser pålidelige ud. Resultatet af Lorem Ipsum er derfor altid fri for gentagelser, tilføjet humor eller utroværdige ord osv.', '2023-04-19 08:04:38'),
(46, 234, 26, 'I modsætning til hvad mange tror, er Lorem Ipsum ikke bare tilfældig tekst. Det stammer fra et stykke litteratur på latin fra år 45 f.kr., hvilket gør teksten over 2000 år gammel. Richard McClintock, professor i latin fra Hampden-Sydney universitet i Virginia, undersøgte et af de mindst kendte ord \"consectetur\" fra en del af Lorem Ipsum, og fandt frem til dets oprindelse ved at studere brugen gennem klassisk litteratur.', '2023-04-19 08:05:37'),
(47, 232, 27, 'Lorem Ipsum jest tekstem stosowanym jako przykładowy wypełniacz w przemyśle poligraficznym. Został po raz pierwszy użyty w XV w. przez nieznanego drukarza do wypełnienia tekstem próbnej książki. Pięć wieków później zaczął być używany przemyśle elektronicznym, pozostając praktycznie niezmienionym.', '2023-04-19 08:07:32'),
(48, 230, 27, 'Spopularyzował się w latach 60. XX w. wraz z publikacją arkuszy Letrasetu, zawierających fragmenty Lorem Ipsum, a ostatnio z zawierającym różne wersje Lorem Ipsum oprogramowaniem przeznaczonym do realizacji druków na komputerach osobistych, jak Aldus PageMaker.', '2023-04-19 08:08:46'),
(49, 226, 27, 'W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem. Ma ono korzenie w klasycznej łacińskiej literaturze z 45 roku przed Chrystusem, czyli ponad 2000 lat temu!', '2023-04-19 08:09:28'),
(50, 228, 27, 'Richard McClintock, wykładowca łaciny na uniwersytecie Hampden-Sydney w Virginii, przyjrzał się uważniej jednemu z najbardziej niejasnych słów w Lorem Ipsum – consectetur – i po wielu poszukiwaniach odnalazł niezaprzeczalne źródło: Lorem Ipsum pochodzi z fragmentów (1.10.32 i 1.10.33) „de Finibus Bonorum et Malorum”.', '2023-04-19 08:10:34'),
(51, 229, 27, 'czyli „O granicy dobra i zła”, napisanej właśnie w 45 p.n.e. przez Cycerona. Jest to bardzo popularna w czasach renesansu rozprawa na temat etyki. Pierwszy wiersz Lorem Ipsum, „Lorem ipsum dolor sit amet...” pochodzi właśnie z sekcji 1.10.32.', '2023-04-19 08:11:22'),
(52, 231, 27, 'Standardowy blok Lorem Ipsum, używany od XV wieku, jest odtworzony niżej dla zainteresowanych. Fragmenty 1.10.32 i 1.10.33 z „de Finibus Bonorum et Malorum” Cycerona, są odtworzone w dokładnej, oryginalnej formie, wraz z angielskimi tłumaczeniami H. Rackhama z 1914 roku.', '2023-04-19 08:12:12'),
(53, 233, 27, 'Jest dostępnych wiele różnych wersji Lorem Ipsum, ale większość zmieniła się pod wpływem dodanego humoru czy przypadkowych słów, które nawet w najmniejszym stopniu nie przypominają istniejących. Jeśli masz zamiar użyć fragmentu Lorem Ipsum, lepiej mieć pewność, że nie ma niczego „dziwnego” w środku tekstu.', '2023-04-19 08:13:14'),
(54, 234, 27, 'Wszystkie Internetowe generatory Lorem Ipsum mają tendencje do kopiowania już istniejących bloków, co czyni nasz pierwszym prawdziwym generatorem w Internecie. Używamy zawierającego ponad 200 łacińskich słów słownika, w kontekście wielu znanych sentencji, by wygenerować tekst wyglądający odpowiednio.', '2023-04-19 08:13:56'),
(55, 225, 28, 'Es ist ein lang erwiesener Fakt, dass ein Leser vom Text abgelenkt wird, wenn er sich ein Layout ansieht. Der Punkt, Lorem Ipsum zu nutzen, ist, dass es mehr oder weniger die normale Anordnung von Buchstaben darstellt und somit nach lesbarer Sprache aussieht.', '2023-04-20 08:25:01'),
(56, 226, 28, 'Viele Desktop Publisher und Webeditoren nutzen mittlerweile Lorem Ipsum als den Standardtext, auch die Suche im Internet nach \"lorem ipsum\" macht viele Webseiten sichtbar, wo diese noch immer vorkommen.', '2023-04-20 08:26:54'),
(57, 229, 28, 'Mittlerweile gibt es mehrere Versionen des Lorem Ipsum, einige zufällig, andere bewusst (beeinflusst von Witz und des eigenen Geschmacks).', '2023-04-20 08:27:40'),
(58, 231, 28, 'Es gibt viele Variationen der Passages des Lorem Ipsum, aber der Hauptteil erlitt Änderungen in irgendeiner Form, durch Humor oder zufällige Wörter welche nicht einmal ansatzweise glaubwürdig aussehen.', '2023-04-20 08:28:33'),
(59, 233, 28, 'Wenn du eine Passage des Lorem Ipsum nutzt, solltest du aufpassen dass in der Mitte des Textes keine ungewollten Wörter stehen. Viele der Generatoren im Internet neigen dazu, vorgefertigte Stücke zu wiederholen - was es nötig machte einen richtigen Generator zu entwickeln.', '2023-04-20 08:29:15'),
(60, 228, 28, 'Wir nutzen ein Wörterbuch aus über 200 Lateinischen Wörter, kombiniert mit einer Handvoll Kunstsätzen, welche das Lorem Ipsum glaubwürdig macht. Das generierte Lorem Ipsum ist außerdem frei von Wiederholungen, Humor oder unqualitativen Wörter.', '2023-04-20 08:30:14'),
(61, 234, 20, 'Het standaard stuk van Lorum Ipsum wat sinds de 16e eeuw wordt gebruikt is hieronder, voor wie er interesse in heeft, weergegeven. Secties 1.10.32 en 1.10.33 van \"de Finibus Bonorum et Malorum\" door Cicero zijn ook weergegeven in hun exacte originele vorm, vergezeld van engelse versies van de 1914 vertaling door H. Rackham.', '2023-04-20 08:32:16'),
(62, 234, 22, 'Bu da, bu üreteci İnternet üzerindeki gerçek Lorem Ipsum üreteci yapar. Bu üreteç, 200\'den fazla Latince sözcük ve onlara ait cümle yapılarını içeren bir sözlük kullanır.', '2023-04-20 08:33:44'),
(63, 234, 25, 'Contrairement à une opinion répandue, le Lorem Ipsum n\'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans.', '2023-04-20 08:35:04'),
(64, 234, 27, 'Wszystkie Internetowe generatory Lorem Ipsum mają tendencje do kopiowania już istniejących bloków, co czyni nasz pierwszym prawdziwym generatorem w Internecie.', '2023-04-20 08:36:37'),
(65, 234, 28, 'Lorem Ipsum ist ein einfacher Demo-Text für die Print- und Schriftindustrie. Lorem Ipsum ist in der Industrie bereits der Standard Demo-Text seit 1500, als ein unbekannter Schriftsteller eine Hand voll Wörter nahm und diese durcheinander warf um ein Musterbuch zu erstellen.', '2023-04-20 08:37:40');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE `picture` (
  `id` int(11) NOT NULL,
  `trick_id` int(11) NOT NULL,
  `picture_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id`, `trick_id`, `picture_link`, `created_at`, `updated_at`) VALUES
(178, 224, '643521e9a6151.jpg', '2023-04-09 15:26:40', '2023-04-11 09:01:29'),
(183, 225, '643429377b693.jpg', '2023-04-10 15:20:23', '2023-04-10 15:20:23'),
(184, 226, '64342eb625a92.jpg', '2023-04-10 15:43:50', '2023-04-10 15:43:50'),
(185, 226, '64342eb62a54d.jpg', '2023-04-10 15:43:50', '2023-04-10 15:43:50'),
(186, 226, '6434408ee3160.jpg', '2023-04-10 16:59:58', '2023-04-10 16:59:58'),
(188, 225, '6434441c6e07e.jpg', '2023-04-10 17:15:08', '2023-04-10 17:15:08'),
(189, 227, '643448da2e5a5.jpg', '2023-04-10 17:35:22', '2023-04-10 17:35:22'),
(190, 227, '643449b6a9a45.webp', '2023-04-10 17:39:02', '2023-04-10 17:39:02'),
(193, 228, '64344b6d3f994.jpg', '2023-04-10 17:46:21', '2023-04-10 17:46:21'),
(194, 228, '64344b8fb33a9.jpg', '2023-04-10 17:46:55', '2023-04-10 17:46:55'),
(195, 229, '64345204c5806.jpg', '2023-04-10 18:14:28', '2023-04-10 18:14:28'),
(196, 229, '643454ff2e28a.jpg', '2023-04-10 18:27:11', '2023-04-10 18:27:11'),
(197, 230, '6434599d78f34.jpg', '2023-04-10 18:46:53', '2023-04-10 18:46:53'),
(198, 224, '6435235795e16.jpg', '2023-04-11 09:07:35', '2023-04-11 09:07:35'),
(199, 224, '64352387568a3.jpg', '2023-04-11 09:08:23', '2023-04-11 09:08:23'),
(200, 224, '64355bcc80156.jpg', '2023-04-11 13:08:28', '2023-04-11 13:08:28'),
(201, 231, '64357cfde4853.jpg', '2023-04-11 15:30:05', '2023-04-11 15:30:05'),
(202, 231, '64357e198b4b9.jpg', '2023-04-11 15:34:49', '2023-04-11 15:34:49'),
(203, 232, '6435802ecdf88.jpg', '2023-04-11 15:43:42', '2023-04-11 15:43:42'),
(204, 233, '6435820fcd138.jpg', '2023-04-11 15:51:43', '2023-04-11 15:51:43'),
(205, 233, '6435820fd12a7.jpg', '2023-04-11 15:51:43', '2023-04-11 15:51:43'),
(206, 234, '6435843d17d38.jpg', '2023-04-11 16:01:01', '2023-04-11 16:01:01'),
(207, 234, '6435843d1c9b6.jpg', '2023-04-11 16:01:01', '2023-04-11 16:01:01'),
(208, 224, '6449446e47adf.jpg', '2023-04-26 15:34:06', '2023-04-26 15:34:06'),
(209, 224, '644d1db828323.jpg', '2023-04-26 15:34:32', '2023-04-29 13:38:00');

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `trick`
--

CREATE TABLE `trick` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trick`
--

INSERT INTO `trick` (`id`, `category_id`, `name`, `description`, `created_at`, `updated_at`, `slug`, `cover_image`) VALUES
(224, 100, 'coco', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-04-08 15:00:20', '2023-04-29 13:35:27', 'dudul', '644d1d1f35bd1.jpg'),
(225, 96, 'mute', 'Considered with the Indy as the basis of the grab, the Mute consists of grabbing your board between your feet using your front hand. Regular means riding with the left foot in front while Goofy means riding with the right foot in front.', '2023-04-10 15:17:44', '2023-04-10 17:15:08', 'mute', '6434441c6fe3d.jpg'),
(226, 96, 'indy', 'Considered with the Mute as the basis of the grab, the Indy consists of grabbing your board between your feet using your back hand. Regular means riding with the left foot in front while Goofy means riding with the right foot in front.', '2023-04-10 15:43:50', '2023-04-10 17:09:24', 'indy', '643442c4af7cf.jpg'),
(227, 97, 'frontside 180', 'A 180 designates a half-turn, or 180 degrees of angle. Frontside defines tricks where the action happens in front of the toe edge.', '2023-04-10 17:35:22', '2023-04-11 15:44:16', '180', '643449b6aec99.webp'),
(228, 97, 'frontside 360', 'A 360 is equivalent to a full turn. The direction of rotation differs according to the rider. The regulars will turn left while the goofies will swing to their right. Seemingly simple, this trick requires a good mastery. Frontside defines tricks where the action happens in front of the heel edge.', '2023-04-10 17:45:38', '2023-04-11 15:44:00', '360', '64344b8fb4aaf.jpg'),
(229, 98, 'front flip', 'A flip is a vertical rotation. Front flips are forward rotations. It is possible to do several flips in a row, and add a grab to the rotation.', '2023-04-10 18:14:28', '2023-04-10 18:27:11', 'front-flip', '643454ff2f96d.jpg'),
(230, 100, 'nose slide', 'A slide consists of sliding on a slide bar. The slide is done either with the board in the axis of the bar, or perpendicular, or more or less off-axis. You can slide with the board centered in relation to the bar (this is located approximately below the rider\'s feet), but also in nose slide, that is to say the front of the board on the bar .', '2023-04-10 18:46:53', '2023-04-10 18:46:53', 'nose-slide', '6434599d7b1ce.jpg'),
(231, 102, 'backside air', 'A trick performed on the backside wall of the halfpipe where the athlete grabs the heel edge of the board with the front hand.', '2023-04-11 15:30:05', '2023-04-11 15:34:49', 'backside-air', '64357e198cb79.jpg'),
(232, 97, 'frontside 540', 'An aerial manoeuvre in which the snowboarder rotates 540 degrees — one-and-a-half spins.', '2023-04-11 15:43:42', '2023-04-11 15:43:42', 'frontside-540', '6435802ecf6df.jpg'),
(233, 96, 'stalefish', 'An aerial manoeuvre in which the athlete grabs the heel edge behind the rear leg with the rear hand, while the rear leg is straightened.', '2023-04-11 15:51:43', '2023-04-11 15:51:43', 'stalefish', '6435820fceba6.jpg'),
(234, 96, 'japan air', 'An aerial manoeuvre in which the athlete’s front hand grabs the toe edge between the feet, the front knee is tucked, the board is pulled up and the back is arched.', '2023-04-11 16:01:01', '2023-04-14 13:43:57', 'japan', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `token_registration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_registration_lifetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `roles`, `password`, `file`, `created_at`, `is_verified`, `token_registration`, `token_registration_lifetime`) VALUES
(19, 'Caroline-Françoise Descamps', 'maurice79@toussaint.com', '[\"ROLE_USER\"]', '$2y$13$AEtiUO.LT90Wvt4poSXwBOW7LVJsPsg0//XnOsFJI6526PZVIcUWW', 'default.png', '2023-04-08 14:25:15', 0, NULL, NULL),
(20, 'Astrid Guyot', 'sanchez.georges@schmitt.com', '[\"ROLE_USER\"]', '$2y$13$hOy8e4DYm5uLI9jTO4OJKe48Ve1P4hxFzlX1n4QO/Y1AGKT4K3hXa', 'default.png', '2023-04-08 14:25:16', 0, NULL, NULL),
(21, 'Édith Royer', 'grenard@wanadoo.fr', '[\"ROLE_USER\"]', '$2y$13$FNYz0mZMkjZAqAYfJs53ROPviOldsR.oMOBCmP0jbjUJvLdaUKlkm', 'default.png', '2023-04-08 14:25:16', 0, NULL, NULL),
(22, 'Gérard Henry', 'julien.weber@gmail.com', '[\"ROLE_USER\"]', '$2y$13$mAgthUbCf6uvZvJ67n4vBeAF62IxyUyDtdrlTh.kTiH9rTcgnl2..', 'default.png', '2023-04-08 14:25:17', 0, NULL, NULL),
(23, 'Julien Jacques', 'oceane.blanchard@dbmail.com', '[\"ROLE_USER\"]', '$2y$13$YLC.urrdGeJckT/v9LYmk.sbJcL0wtByzVSv67YhmtM21H0vXSAj.', 'default.png', '2023-04-08 14:25:17', 0, NULL, NULL),
(24, 'Céline Gautier', 'fchauveau@monnier.net', '[\"ROLE_USER\"]', '$2y$13$xDb5nioOw6NO.libjH3GKOlDY/2PIelvyAJKJX0J/8bGvNk9kqQ4.', 'default.png', '2023-04-08 14:25:18', 0, NULL, NULL),
(25, 'Denis Morel', 'guy33@coste.com', '[\"ROLE_USER\"]', '$2y$13$vQjnx1q8YTM6HZYrU8pyTOM/hJrJMfbo1JgOoIbAsrBLv2cPA8ENG', 'default.png', '2023-04-08 14:25:19', 0, NULL, NULL),
(26, 'Adélaïde Barbier-Normand', 'clopes@fournier.fr', '[\"ROLE_USER\"]', '$2y$13$oK4Zs/VTzEUmEsfxSzrmeOYDt7RFUprOtQorXTfaHfJP9CMMTS/3G', 'default.png', '2023-04-08 14:25:19', 0, NULL, NULL),
(27, 'Xavier-Christophe Gimenez', 'margot.andre@sfr.fr', '[\"ROLE_USER\"]', '$2y$13$OqfxFUmX4uJySUdQ4z3D/.O2hxUHGpk6BZOF1KVUsUoV2G.bKMY82', 'default.png', '2023-04-08 14:25:20', 0, NULL, NULL),
(28, 'john45*AC', 'jojo@yahoo.fr', '[\"ROLE_USER\"]', '$2y$13$2/gXaPKBrhzMeUqQLOoPTuY0JHZ7W8g9sbQMaC1SCY5QYnlrG7YxS', 'default.png', '2023-04-16 15:51:03', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `trick_id` int(11) NOT NULL,
  `video_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `trick_id`, `video_link`, `created_at`, `updated_at`) VALUES
(1, 225, 'jm19nEvmZgM', '2023-04-10 15:17:44', '2023-04-10 15:17:44'),
(2, 225, 'CflYbNXZU3Q', '2023-04-10 15:17:44', '2023-04-10 15:17:44'),
(3, 226, 'TvRBTCnyLAw', '2023-04-10 15:43:50', '2023-04-10 15:43:50'),
(4, 226, '85lY1ZG8m-A', '2023-04-10 15:43:50', '2023-04-10 15:43:50'),
(5, 227, 'GnYAlEt-s00', '2023-04-10 17:35:22', '2023-04-10 17:35:22'),
(6, 228, 'hUddT6FGCws', '2023-04-10 17:45:38', '2023-04-10 17:45:38'),
(7, 229, 'gMfmjr-kuOg', '2023-04-10 18:14:28', '2023-04-10 18:14:28'),
(8, 231, '_CN_yyEn78M', '2023-04-11 15:30:05', '2023-04-11 15:30:05'),
(9, 232, '_hJX9HrdkeA', '2023-04-11 15:43:42', '2023-04-11 15:43:42'),
(10, 233, 'f9FjhCt_w2U', '2023-04-11 15:51:43', '2023-04-11 15:51:43'),
(11, 234, 'jH76540wSqU', '2023-04-11 16:01:01', '2023-04-11 16:01:01');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6BD307FB281BE2E` (`trick_id`),
  ADD KEY `IDX_B6BD307FA76ED395` (`user_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_16DB4F89B281BE2E` (`trick_id`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `trick`
--
ALTER TABLE `trick`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D8F0A91E5E237E06` (`name`),
  ADD UNIQUE KEY `UNIQ_D8F0A91E989D9B62` (`slug`),
  ADD KEY `IDX_D8F0A91E12469DE2` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- Index pour la table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CC7DA2CB281BE2E` (`trick_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `trick`
--
ALTER TABLE `trick`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_B6BD307FB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `FK_16DB4F89B281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `trick`
--
ALTER TABLE `trick`
  ADD CONSTRAINT `FK_D8F0A91E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
