<?php

namespace App\Lib;

use App\Config;

class Logger
{




	public function log($data)
	{


	    $config = new Config();


		$todays_log_file = "log-" . date($config->date_format) . ".log";

		try {
			if (!is_writable(DEV_LOG_DIR)) {

				throw new \Exception('Your log directory defined in Config.php is not writable.');

			} else {


				$data_string = date(DATE_FORMAT." H:i:s")."\t".$_SERVER['REMOTE_ADDR']."\t".$_SERVER['REQUEST_URI']."\t".$data;

				$fd = fopen(DEV_LOG_DIR . DIRECTORY_SEPARATOR . $todays_log_file, "a+");

				fwrite($fd, $data_string . PHP_EOL);

				fclose($fd);


			}


		} catch (\Exception $e) {


            if ($config->dev_mode) {
                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>Exception : <?php echo $e->getFile();?></title>
                    <style type="text/css">
                        html,
                        body {
                            margin: 0;
                            padding: 0;
                            height: 100%;
                            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
                        }
                        .container{
                            width:80%;
                            margin-left:auto;
                            margin-right: auto;
                            padding-top:30px;
                        }
                        pre{
                            border: 1px solid #eee;

                            padding: 15px;
                        }


                    </style>
                </head>
                <body>
                <div class="container">
                    <h1>Exception</h1>
                    <?php
                    echo "<pre>";
                    print_r($e);

                    echo "</pre>";
                    ?>
                    <p>Framework Version : <?php echo SF_VERSION;?></p>
                </div>
                </body>
                </html>

                <?php
            }


        }

	}

}