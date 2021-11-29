<?php

// Aloitetaan istunnot

session_start();

// Suoritetaan projektin aloitusskripti
// Tämä lataa kaikki tarvittavat määritykset, tällä hetkellä ainoastaan config.php-tiedoston 
// mutta myöhemmin myös muuta tarpeellista 

require_once '../src/init.php';

  // Haetaan kirjautuneen käyttäjän tiedot.
  // Tarkistetaan, onko käyttäjä kirjautunut sisälle seli onko käyttäjätunnuksen sisältävä istuntomuuttuja määritelty.
  // Jos on, niin haetaan tiedot ja tallennetaan ne loggeduser- muuttujaan. 
  // Muussa tapauksessa loggeduser-muuttujan arvoksi määritellään tyhjä (NULL)
  if (isset($_SESSION['user'])) {
    require_once MODEL_DIR . 'henkilo.php';
    $loggeduser = haeHenkilo($_SESSION['user']);
  } else {
    $loggeduser = NULL;
  }

// Siistitään polku urlin alusta ja mahdolliset parametrit urlin lopusta.
// Nyt osoitteen alusta poistettava teksti on määritelty config-asetuksissa. 
// Jatkossa sovellus on helpompi ottaa käyttöön toisessa sijainnissa. Riittää, että muutetaan config-asetukset oikeiksi

$request = str_replace($config['urls']['baseUrl'],'',$_SERVER['REQUEST_URI']);
$request = strtok($request, '?');

//Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin

$templates = new League\Plates\Engine(TEMPLATE_DIR);

// Selvitetään mitä sivua on kutsuttu ja suoritetaan sivua vastaava käsittelijä
// Käytetään switch-lausetta, koska tämä on selkeämpi kun muuttujan arvon perusteella suoritetaan eri kokonaisuuksia.

switch ($request) {
  case '/':
  case '/kurssit':
    require_once MODEL_DIR . 'kurssi.php';
    $kurssit = haeKurssit();
    echo $templates->render('kurssit', ['kurssit' => $kurssit]);
    break;
    case '/kurssi':
      require_once MODEL_DIR . 'kurssi.php';
      require_once MODEL_DIR . 'ilmoittautuminen.php';
      $kurssi = haeKurssi($_GET['id']);
      if ($kurssi) {
        if ($loggeduser) {
          $ilmoittautuminen = haeIlmoittautuminen($loggeduser['idhenkilo'],$kurssi['idkurssi']);
        } else {
          $ilmoittautuminen = NULL;
        }
        echo $templates->render('kurssi',['kurssi' => $kurssi,
                                             'ilmoittautuminen' => $ilmoittautuminen,
                                             'loggeduser' => $loggeduser]);
      } else {
        echo $templates->render('kurssinotfound');
      }
      break;
    case '/lisaa_tili':
      if (isset($_POST['laheta'])) {
        $formdata = cleanArrayData($_POST);
        require_once CONTROLLER_DIR . 'tili.php';
        $tulos = lisaaTili($formdata,$config['urls']['baseUrl']);
        if ($tulos['status'] == "200") {
          echo $templates->render('tili_luotu', ['formdata' => $formdata]);
          break;
        }
        echo $templates->render('lisaa_tili', ['formdata' => $formdata, 'error' => $tulos['error']]);
        break;
      } else {
        echo $templates->render('lisaa_tili', ['formdata' => [], 'error' => []]);
      }
        break;
        case "/kirjaudu":
          if (isset($_POST['laheta'])) {
            require_once CONTROLLER_DIR . 'kirjaudu.php';
            if (tarkistaKirjautuminen($_POST['email'],$_POST['salasana'])) {
              session_regenerate_id();
              $_SESSION['user'] = $_POST['email'];
              header("Location: " . $config['urls']['baseUrl']);    
            } else {
              echo $templates->render('kirjaudu', [ 'error' => ['virhe' => 'Väärä käyttäjätunnus tai salasana!']]);
            }
          } else {
            echo $templates->render('kirjaudu', [ 'error' => []]);
          }
          break; 
          case '/ilmoittaudu':
            if ($_GET['id']) {
              require_once MODEL_DIR . 'ilmoittautuminen.php';
              $idkurssi = $_GET['id'];
              if ($loggeduser) {
                lisaaIlmoittautuminen($loggeduser['idhenkilo'],$idkurssi);
              }
              header("Location: kurssi?id=$idkurssi");
            } else {
              header("Location: kurssit");
            }
            break;    
    case '/peru':
      if ($_GET['id']) {
        require_once MODEL_DIR . 'ilmoittautuminen.php';
        $idkurssi = $_GET['id'];
        if ($loggeduser) {
          poistaIlmoittautuminen($loggeduser['idhenkilo'],$idkurssi);
        }
        header("Location: kurssi?id=$idkurssi");
      } else {
        header("Location: kurssit");  
      }
      break;
      case "/logout":
            require_once CONTROLLER_DIR . 'kirjaudu.php';
            logout();
            header("Location: " . $config['urls']['baseUrl']);
            break;   
    default:
    echo $templates->render('notfound');
}
?>