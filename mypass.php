<?php        
  $filename = 'mypass.txt';
  $order = 'accounts.txt';

  function readAccounts() {
    $dataFile = fopen($order, "r") or die("Unable to open file!");
    fclose($order);
    return $dataFile;
  } 

  function rndPsswd() {
    $chars = 'abcdefghijklmnopqrstuvwxyz';
    $chLength = strlen($chars);
    $date = date('d-m-y h:i:s');

    try {
      $fp = fopen($GLOBALS['filename'], 'a');
      $date .= "\n";
      fwrite($fp, $date);
      fclose($fp);
      $dataFile = fopen($GLOBALS['order'], "r") or throw new Exception('Not exists!');;
    } 
    catch (Exception $e) {
      echo 'File: ',  $order, $e->getMessage(), "\n";

      $filea = fopen($GLOBALS['order'], 'w+');

      fwrite($filea, "not exists");
      fclose($filea);
      echo 'Generated: ',  $order, "\n";
      rndPsswd();
    }
      
    while ($line = fgets($dataFile)) {    
      $output = preg_replace('/\s+/', ' ', trim($line));
      $output .= ":\t";

      // generate output
      for ($j = 0; $j < 8; $j++) {
        $r = rand(0, 2);
        switch ($r) {
          case '0':
            $output .= strtoupper($chars[rand(0, $chLength-1)]);
            break;

          case '1':
            $output .= $chars[rand(0, $chLength-1)];
            break;

          case '2':
            $output .= rand(0, 9);
            break;
        }
      }

      // save output to file
      $output .= "\n";
      $fp = fopen($GLOBALS['filename'], 'a');
      fwrite($fp, $output);
      fclose($fp);
    }
    fclose($dataFile);
    echo("Success\n"); 
  }

  rndPsswd();
?>