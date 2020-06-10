<?php

/*

add the following line to the crontab:

  0 1 * * * php /path/to/import-centris-data.php >/dev/null 2>&1

*/

try {
  /* ---------------------------------------------*/
  $CENTRIS_FTP_HOSTNAME = "ftp.localgo.ca";
  $CENTRIS_FTP_USERNAME = "centris@localgo.ca";
  $CENTRIS_FTP_PASSWORD = "C3md@mp17!";
  /* ---------------------------------------------*/
  $env = file("../.env");
  $DB_DATABASE=false;
  $DB_USERNAME=false;
  $DB_PASSWORD=false;
  $DB_HOST=false;
  foreach($env as $conf) {
    if (explode( "=", $conf)[0] == "DB_DATABASE") {
      $DB_DATABASE = trim(explode( "=", $conf)[1]);
    }
    if (explode( "=", $conf)[0] == "DB_USERNAME") {
      $DB_USERNAME = trim(explode( "=", $conf)[1]);
    }
    if (explode( "=", $conf)[0] == "DB_PASSWORD") {
      $DB_PASSWORD = trim(explode( "=", $conf)[1]);
    }
    if (explode( "=", $conf)[0] == "DB_HOST") {
      $DB_HOST = trim(explode( "=", $conf)[1]);
    }
  }

  $db = mysqli_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);

  $tmp_folder = sys_get_temp_dir()."/".md5(uniqid());
  $local_file = md5(uniqid()).'.zip';
  $server_file = 'LOCALGO'.date('Ymd').'.zip';

  if (!is_dir($tmp_folder)) {
    @mkdir($tmp_folder);
  }

  $local_file_path = "$tmp_folder/$local_file";
  // set up basic connection
  $conn_id = ftp_ssl_connect($CENTRIS_FTP_HOSTNAME);

  // login with username and password
  $login_result = ftp_login($conn_id, $CENTRIS_FTP_USERNAME, $CENTRIS_FTP_PASSWORD);

  ftp_pasv($conn_id, true);

  // try to download $server_file and save to $local_file
  if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
      // echo "Successfully written to $local_file\n";
      @rename($local_file, $local_file_path);
      // echo "... $local_file_path \n";
      // ftp_delete($conn_id, $server_file);
      $zip = new ZipArchive;
      $res = $zip->open($local_file_path);
      if ($res === TRUE) {
        $zip->extractTo($tmp_folder);
        $zip->close();
      }

      @unlink($local_file_path);

      $inscriptions_files = "$tmp_folder/INSCRIPTIONS.TXT";
      $inscriptions = [];
      if (file_exists($inscriptions_files)) {
        $inscriptions_lines = file($inscriptions_files);
        foreach($inscriptions_lines as $line) {
          $inscription = str_getcsv($line, ",");

          $inscription_id = $inscription[0];
          $inscription_agent_id = $inscription[2];
          $inscription_prix = $inscription[6];
          $inscription_geo_lat = $inscription[144];
          $inscription_geo_long = $inscription[145];
          $inscription_no_civique = $inscription[25];
          $inscription_address = utf8_encode($inscription[27]);
          $inscription_postalcode = $inscription[29];
          $inscription_yearbuilt = $inscription[59];
          $inscription_sq_ft = $inscription[66].$inscription[67];
          $inscription_land_sq_ft = $inscription[75].$inscription[76];
          $inscription_mun_code = $inscription[22];
          $inscription_status = $inscription[115];
          $inscription_bed = $inscription[82];
          $inscription_bath = $inscription[85];
          $inscription_genre = $inscription[53].$inscription[54];

          $inscription_titre = utf8_encode("$inscription_no_civique $inscription_address");

          if ($inscription_status == "EV") {
            $inscription_status="Active";
          } else {
            $inscription_status="InActive";
          }
          $inscriptions[] = array(
            'id' => $inscription_id,
            'agent_id' => $inscription_agent_id,
            'prix' => $inscription_prix,
            'geo_lat' => $inscription_geo_lat,
            'geo_long' => $inscription_geo_long,
            'status' => $inscription_status,
            'no_civique' => $inscription_no_civique,
            'address' => $inscription_address,
            'postalcode' => $inscription_postalcode,
            'mun_code' => $inscription_mun_code,
            'yearbuilt' => $inscription_yearbuilt,
            'sq_ft' => $inscription_sq_ft,
            'land_sq_ft' => $inscription_land_sq_ft,
            'bed' => $inscription_bed,
            'genre' => $inscription_genre,
            'bath' => $inscription_bath,
            'titre' => $inscription_titre
          );
        }
      }

      $members_files = "$tmp_folder/MEMBRES.TXT";
      $membres = [];
      if (file_exists($members_files)) {
        $members_lines = file($members_files);
        foreach($members_lines as $line) {
          $member = str_getcsv($line, ",");

          $_id = $member[0];
          $_nom = $member[4];
          $_prenom = $member[5];
          $_email = $member[11];
          $_photo = $member[15];
          $_phone = $member[8];
          $_website = $member[12];

          $membres[] = array(
            'id' => $_id,
            'name' => $_prenom." ".$_nom,
            'email' => $_email,
            'phone' => $_phone,
            'website' => $_website,
            'photo' => $_photo
          );
        }
      }

      $photos_files = "$tmp_folder/PHOTOS.TXT";
      $photos = [];
      if (file_exists($photos_files)) {
        $photos_lines = file($photos_files);
        foreach($photos_lines as $line) {
          $photo = str_getcsv($line, ",");

          $_no_inscription = $photo[0];
          $_photo_url = $photo[6];

          $photos[] = array(
            'no_inscription' => $_no_inscription,
            'photo_url' => $_photo_url
          );
        }
      }

      $file = "$tmp_folder/REMARQUES.TXT";
      $remarques = [];
      if (file_exists($file)) {
        $lines = file($file);
        foreach($lines as $line) {
          $remarque = str_getcsv($line, ",");

          $_no_inscription = $photo[0];
          $_lang = $photo[2];
          $_description = $photo[6];

          $remarques[] = array(
            'no_inscription' => $_no_inscription,
            'lang' => $_lang,
            'description' => $_description
          );
        }
      }

      $file = "mun.csv";
      $_MUN = [];
      if (file_exists($file)) {
        $lines = file($file);
        foreach($lines as $line) {
          $benefit = str_getcsv($line, ",");
          $_MUN[$benefit[0]] = $benefit;
        }
      }

      $file = "genres.csv";
      $_GENRES = [];
      if (file_exists($file)) {
        $lines = file($file);
        foreach($lines as $line) {
          $benefit = str_getcsv($line, ",");
          $_GENRES[$benefit[0].$benefit[1]] = $benefit;
        }
      }

      $file = "benefits.csv";
      $_CARACTERISTIQUES = [];
      if (file_exists($file)) {
        $lines = file($file);
        foreach($lines as $line) {
          $benefit = str_getcsv($line, ",");
          $_CARACTERISTIQUES[$benefit[0]] = $benefit;
        }
      }

      $file = "SOUS_TYPE_CARACTERISTIQUES.csv";
      $_SOUS_CARACTERISTIQUES = [];
      if (file_exists($file)) {
        $lines = file($file);
        foreach($lines as $line) {
          $benefit = str_getcsv($line, ",");
          if (!isset($_SOUS_CARACTERISTIQUES[$benefit[0]])) {
            $_SOUS_CARACTERISTIQUES[$benefit[0]]=[];
          }
          $_SOUS_CARACTERISTIQUES[$benefit[0]][$benefit[1]] = $benefit;
        }
      }

      $file = "$tmp_folder/CARACTERISTIQUES.TXT";
      $CARACTERISTIQUES = [];
      if (file_exists($file)) {
        $lines = file($file);
        foreach($lines as $line) {
          $benefit = str_getcsv($line, ",");

          $_no_inscription = $benefit[0];
          $_tcar_code = $benefit[1];
          $_scar_code = $benefit[2];
          $_nb= $benefit[3];
          $_info_fr = $benefit[4];
          $_info_en = $benefit[5];

          $CARACTERISTIQUES[] = array(
            'no_inscription' => $_no_inscription,
            'tcar_code' => $_tcar_code,
            'scar_code' => $_scar_code,
            'nb' => $_nb,
            'info_fr' => $_info_fr,
            'info_en' => $_info_en
          );
        }
      }

      foreach($membres as $membre) {
        $sql = "SELECT * FROM agents WHERE centris_agent_id='".$membre["id"]."'";
        $results = mysqli_query($db, $sql);
        if (!$results->num_rows) {
          $photo_file = file_get_contents($membre["photo"]);
          $photo_file_name = md5($membre["photo"]).".jpg";
          file_put_contents("../public/uploads/media/$photo_file_name", $photo_file);
          $sql = "INSERT INTO agents(centris_agent_id, name, email, phone, website, image) VALUES(
            '".$membre["id"]."',
            '".$membre["name"]."',
            '".$membre["email"]."',
            '".$membre["phone"]."',
            '".$membre["website"]."',
            '".$photo_file_name."'
          )";
          $results = mysqli_query($db, $sql);
        }
      }

      foreach($inscriptions as $inscription) {
        if (isset($_GENRES[$inscription["genre"]])) {
          $sql = "SELECT * FROM property_types WHERE type_fr='".mysqli_real_escape_string($db, utf8_encode($_GENRES[$inscription["genre"]][3]))."'";
          $results = mysqli_query($db, $sql);
          if (!$results->num_rows) {
            $sql = "INSERT INTO property_types(type_fr,type_en) VALUES(
              '".mysqli_real_escape_string($db, utf8_encode($_GENRES[$inscription["genre"]][3]))."',
              '".mysqli_real_escape_string($db, utf8_encode($_GENRES[$inscription["genre"]][5]))."'
            )";
            // echo $sql;
            $results = mysqli_query($db, $sql);
            $id = mysqli_insert_id($db);
            $inscription["property_type_id"] = $id;
          } else {
            $row_id = mysqli_fetch_assoc($results);
            $inscription["property_type_id"] = $row_id["id"];
          }
        } else {
          $inscription["property_type_id"] = 0;
        }

        if (isset($_MUN[$inscription["mun_code"]])) {
          $sql = "SELECT * FROM locations WHERE name='".mysqli_real_escape_string($db, utf8_encode($_MUN[$inscription["mun_code"]][1]))."'";
          $results = mysqli_query($db, $sql);
          if (!$results->num_rows) {
            $sql = "INSERT INTO locations(name) VALUES(
              '".mysqli_real_escape_string($db, utf8_encode($_MUN[$inscription["mun_code"]][1]))."'
            )";
            // echo $sql;
            $results = mysqli_query($db, $sql);
            $id = mysqli_insert_id($db);
            $inscription["location_id"] = $id;
          } else {
            $row_id = mysqli_fetch_assoc($results);
            $inscription["location_id"] = $row_id["id"];
          }
        } else {
          $inscription["location_id"] = 0;
        }

        $address = mysqli_real_escape_string($db, $inscription["no_civique"]." ".$inscription["address"].", ".utf8_encode($_MUN[$inscription["mun_code"]][1]).", QC, ".$inscription["postalcode"]);

        $sql = "SELECT * FROM property WHERE property_no='".$inscription["id"]."'";
        $results = mysqli_query($db, $sql);
        if (!$results->num_rows) {
          $sql = "SELECT * FROM agents WHERE centris_agent_id='".$inscription["agent_id"]."'";
          $results = mysqli_query($db, $sql);
          if ($results->num_rows) {
            $row_agent = mysqli_fetch_assoc($results);
            $sql = "INSERT INTO property(property_no, map_latitude, map_longitude, price, name, description, status, property_type_id, agent_id) VALUES(
              '".$inscription["id"]."',
              '".$inscription["geo_lat"]."',
              '".$inscription["geo_long"]."',
              '".$inscription["prix"]."',
              '".$address."',
              '".$address."',
              'Active',
              '1',
              '".$row_agent["id"]."'
            )";
            // echo $sql;
            $results = mysqli_query($db, $sql);
          }
        }

        $sql = "SELECT * FROM property WHERE property_no='".$inscription["id"]."'";
        $results = mysqli_query($db, $sql);
        if ($results->num_rows) {

          $sql = "UPDATE property SET
            status='".$inscription["status"]."',
            year_built='".$inscription["yearbuilt"]."',
            sq_ft='".$inscription["sq_ft"]."',
            land_sq_ft='".$inscription["land_sq_ft"]."',
            bed='".$inscription["bed"]."',
            location_id='".$inscription["location_id"]."',
            property_type_id='".$inscription["property_type_id"]."',
            address='$address',
            postalcode='".$inscription["postalcode"]."',
            bath='".$inscription["bath"]."'
          WHERE property_no='".$inscription["id"]."'";
          if ($inscription["id"] == "13816570") {
            print_r($sql);
            print_r($_GENRES[$inscription["genre"]][3]);
          }
          // echo "$sql\n";
          mysqli_query($db, $sql);
        }
      }

      foreach($CARACTERISTIQUES as $bidx => $benefit) {
        if (isset($_CARACTERISTIQUES[$benefit["tcar_code"]])) {
          if (isset($_SOUS_CARACTERISTIQUES[$benefit["tcar_code"]][$benefit["scar_code"]])) {
            $info_fr = mysqli_real_escape_string($db, $_SOUS_CARACTERISTIQUES[$benefit["tcar_code"]][$benefit["scar_code"]][3]);
            $info_en = mysqli_real_escape_string($db, $_SOUS_CARACTERISTIQUES[$benefit["tcar_code"]][$benefit["scar_code"]][5]);
            if (!empty($benefit["info_fr"])) {
              $info_fr .= " ($info_fr)";
            }
            if (!empty($benefit["info_en"])) {
              $info_en .= " ($info_en)";
            }
            $sql = "SELECT * FROM benefits WHERE name_fr='".mysqli_real_escape_string($db, utf8_encode($_CARACTERISTIQUES[$benefit["tcar_code"]][2]))."'
            AND info_fr='$info_fr'";
            $results = mysqli_query($db, $sql);
            if (!$results->num_rows) {
              $sql = "INSERT INTO benefits(name_fr,name_en,info_fr,info_en,nb) VALUES(
                '".mysqli_real_escape_string($db, utf8_encode($_CARACTERISTIQUES[$benefit["tcar_code"]][2]))."',
                '".mysqli_real_escape_string($db, utf8_encode($_CARACTERISTIQUES[$benefit["tcar_code"]][4]))."',
                '".$info_fr."',
                '".$info_en."',
                '".$benefit["nb"]."'
              )";
              echo "$sql\n";
              mysqli_query($db, $sql);
              $id = mysqli_insert_id($db);
              $CARACTERISTIQUES[$bidx]["id"] = $id;
            } else {
              $row_p = mysqli_fetch_assoc($results);
              $CARACTERISTIQUES[$bidx]["id"] = $row_p["id"];
            }
            $sql = "SELECT * FROM property WHERE property_no='".$benefit["no_inscription"]."'";
            $results = mysqli_query($db, $sql);
            if ($results->num_rows) {
              $row_p = mysqli_fetch_assoc($results);
              $sql = "SELECT * FROM property_benefits WHERE
              property_id='".$row_p["id"]."'
              AND benefit_id='".$CARACTERISTIQUES[$bidx]["id"]."'
              ";
              $results = mysqli_query($db, $sql);
              if (!$results->num_rows) {
                $sql = "INSERT INTO property_benefits(property_id, benefit_id) VALUES('".$row_p["id"]."','".$CARACTERISTIQUES[$bidx]["id"]."')";
                mysqli_query($db, $sql);
              }
            }
          }
        }

      }

      foreach($photos as $photo) {
        $sql = "SELECT * FROM property WHERE property_no='".$photo["no_inscription"]."'";
        $results = mysqli_query($db, $sql);
        if ($results->num_rows) {
          $row_inscription = mysqli_fetch_assoc($results);
          $photo_file_name = md5($photo["photo_url"]).".jpg";

          $sql = "SELECT * FROM property_gallery WHERE image='".$photo_file_name."' AND property_id='".$row_inscription["id"]."'";
          $results = mysqli_query($db, $sql);
          if (!$results->num_rows) {
            $photo_file = file_get_contents($photo["photo_url"]);

            if (empty($row_inscription["image"])) {
              $sql = "UPDATE property SET image='$photo_file_name' WHERE property_no='".$photo["no_inscription"]."'";
              mysqli_query($db, $sql);
            }
            file_put_contents("../public/uploads/media/$photo_file_name", $photo_file);
            $sql = "INSERT INTO property_gallery(property_id, image) VALUES(
              '".$row_inscription["id"]."',
              '".$photo_file_name."'
            )";
            $results = mysqli_query($db, $sql);
          }

        }
      }

      foreach($remarques as $remarque) {
        $sql = "SELECT * FROM property WHERE property_no='".$remarque["no_inscription"]."'";
        $results = mysqli_query($db, $sql);
        if ($results->num_rows) {
          if ($remarque["lang"] == "F") {
            $sql = "UPDATE property SET description = '".$remarque["description"]."' WHERE property_no='".$remarque["no_inscription"]."'";
            $results = mysqli_query($db, $sql);
          }
          if ($remarque["lang"] == "A") {
            $sql = "UPDATE property SET description_en = '".$remarque["description"]."' WHERE property_no='".$remarque["no_inscription"]."'";
            $results = mysqli_query($db, $sql);
          }
        }
      }

      @unlink($tmp_folder);

      mysqli_close($db);

      echo "Everything was super successful...\n";
  } else {
      echo "Nothing works.\n";
  }

  // close the connection
  @ftp_close($conn_id);
} catch (Exception $e) {
  echo "Everything went horribly wrong... \n";
}
