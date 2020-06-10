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
  $env = file(".env");
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
          $inscription_address = $inscription[27];
          $inscription_postalcode = $inscription[29];
          $inscription_yearbuilt = $inscription[59];
          $inscription_sq_ft = $inscription[66].$inscription[67];
          $inscription_mun_code = $inscription[22];
          $inscription_status = $inscription[115];
          $inscription_bed = $inscription[82];
          $inscription_bath = $inscription[85];

          $inscription_titre = "$inscription_no_civique $inscription_address";

          if ($inscription_status == "EV") {
            $inscription_status="Active";
          } else {
            $inscription_status="Inactive";
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
            'bed' => $inscription_bed,
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

          $membres[] = array(
            'id' => $_id,
            'name' => $_prenom." ".$_nom,
            'email' => $_email,
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
            'lang' => $_lang
            'description' => $_description
          );
        }
      }


      $file = "$tmp_folder/CARACTERISTIQUES.TXT";
      $benefits = [];
      if (file_exists($file)) {
        $lines = file($file);
        foreach($lines as $line) {
          $benefit = str_getcsv($line, ",");

          $_no_inscription = $photo[0];
          $_benefit_fr = $photo[4];
          $_benefit_en = $photo[5];

          $benefits[] = array(
            'no_inscription' => $_no_inscription,
            'benefit_fr' => $_benefit_fr
            'benefit_en' => $_benefit_en
          );
        }
      }

      foreach($membres as $membre) {
        $sql = "SELECT * FROM agents WHERE centris_agent_id='".$membre["id"]."'";
        $results = mysqli_query($db, $sql);
        if (!$results->num_rows) {
          $photo_file = file_get_contents($membre["photo"]);
          $photo_file_name = md5($membre["photo"]).".jpg";
          file_put_contents("public/uploads/media/$photo_file_name", $photo_file);
          $sql = "INSERT INTO agents(centris_agent_id, name, email, image) VALUES(
            '".$membre["id"]."',
            '".$membre["name"]."',
            '".$membre["email"]."',
            '".$photo_file_name."'
          )";
          $results = mysqli_query($db, $sql);
        }
      }

      foreach($inscriptions as $inscription) {
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
              '".$inscription["titre"]."',
              '".$inscription["titre"]."',
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
            location='".$inscription["no_civique"]." ".$inscription["address"]." ".$inscription["mun_code"].", ".$inscription["postalcode"]." "."',
            bed='".$inscription["bed"]."',
            bath='".$inscription["bath"]."'
          WHERE property_no='".$inscription["id"]."'";
          mysqli_query($db, $sql);
        }
      }

      foreach($benefits as $bidx => $benefit) {
        if (!empty($benefit["benefit_fr"])) {
          $sql = "SELECT * FROM benefits WHERE name='".$benefit["benefit_fr"]."'";
          $results = mysqli_query($db, $sql);
          if (!$results->num_rows) {
            $sql = "INSERT INTO benefits(name) VALUES('".$benefit["benefit_fr"]."')";
            mysqli_query($db, $sql);
            $id = mysqli_insert_id($db);
            $benefits[$bidx]["id"] = $id;
          } else {
            $row_b = mysqli_fetch_assoc($results);
            $benefits[$bidx]["id"] = $row_b["id"];
          }
        }

        if (!empty($benefit["benefit_en"])) {
          $sql = "SELECT * FROM benefits WHERE name='".$benefit["benefit_en"]."'";
          $results = mysqli_query($db, $sql);
          if (!$results->num_rows) {
            $sql = "INSERT INTO benefits(name) VALUES('".$benefit["benefit_en"]."')";
            mysqli_query($db, $sql);
            $id = mysqli_insert_id($db);
            $benefits[$bidx]["id"] = $id;
          } else {
            $row_b = mysqli_fetch_assoc($results);
            $benefits[$bidx]["id"] = $row_b["id"];
          }
        }

        $sql = "SELECT * FROM property WHERE property_no='".$benefit["no_inscription"]."'";
        $results = mysqli_query($db, $sql);
        if ($results->num_rows) {
          $row_p = mysqli_fetch_assoc($results);
          $sql = "INSERT INTO property_benefits(property_id, benefit_id) VALUES('".$row_p["id"]."','".$benefit["id"]."')";
          mysqli_query($db, $sql);
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
            file_put_contents("public/uploads/media/$photo_file_name", $photo_file);
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
