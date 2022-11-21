<?php

namespace BCNL\helper;
class F_string
{

    /**
     * 
     * @param int $length
     * @return string
     */
    public static function random(int $length = 8): string
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($characters), 0, $length);
    }


    public static function csv_to_array(string $filename = '', string $delimiter = ';')
    {
        $data = [];
        if (!file_exists($filename) || !is_readable($filename)) {
            return $data;
        }
        if (($handle = fopen($filename, 'r')) !== false) {
            $row = fgetcsv($handle, 5000, $delimiter); //remove first line
            while (($row = fgetcsv($handle, 5000, $delimiter)) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }
        return $data;
    }


    public static function csv_to_xml(string $base64code = "")
    {
        if (preg_match("/^data:application\/vnd.ms-excel;base64/i", $base64code)) {
            $imagestrng = str_replace('data:application/vnd.ms-excel;base64,', "", $base64code);
            $decode_string = str_replace(' ', '+', $imagestrng);
            //file_put_contents("file.csv", base64_decode($decode_string));
            $inputFile = fopen("file.csv", 'rt');
            $headers = fgetcsv($inputFile);

            $doc = new \DomDocument();
            $doc->formatOutput = true;

            $start = $doc->createElement('logs');
            $root = $doc->appendChild($start);

            while (($row = fgetcsv($inputFile)) !== FALSE) {
                $container = $doc->createElement('log');

                foreach ($headers as $i => $header) {
                    $child = $container->appendChild($doc->createElement($header));
                    $value = $child->appendChild($doc->createTextNode($row[$i]));
                }

                $root->appendChild($container);
            }
            return $doc->saveXML();
            //return (string) base64_decode($decode_string);
        }

        return "";
    }
}
