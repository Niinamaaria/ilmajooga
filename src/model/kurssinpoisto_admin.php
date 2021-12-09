<?php

require_once HELPERS_DIR . 'DB.php';

function poistaKurssi($idkurssi) {
    return DB::run('DELETE FROM kurssi WHERE idkurssi = ?',[$idkurssi])->rowCount();
}

?>