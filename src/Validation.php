<?php

namespace BCNL;

/**
 * Description of Validation
 *
 * @author Administrator
 */
class Validation {

    /**
     * 
     * @param string $value
     * @return bool
     */
    public function onderwijsnummer(string $value = ""): bool {
        if (empty($value) === true) {
            return false;
        }
        $length = strlen($value);
        if ($length > 9 || is_numeric($value) === false) {
            return false;
        }
        if ($length < 9) {
            $value = str_pad($value, 9, "0", STR_PAD_LEFT);
        }

        $result = 0;
        $products = range(9, 2);
        $listdb = str_split($value);
        $last = end($listdb);
        array_pop($listdb);
        foreach ($listdb as $i => $char) {
            $result += (int) $char * $products[$i];
        }

        if ($result % 11 === $last + 5) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @param string $value
     * @return bool
     */
    public function bsn(string $value = ""): bool {
        if (empty($value) === true) {
            return false;
        }

        $length = strlen($value);
        if ($length > 9 || is_numeric($value) === false) {
            return false;
        }
        if ($length < 9) {
            $value = str_pad($value, 9, "0", STR_PAD_LEFT);
        }

        $result = 0;
        $products = range(9, 2);
        $products[] = -1;

        $listdb = str_split($value);
        foreach ($listdb as $i => $char) {
            $result += (int) $char * $products[$i];
        }

        if ($result % 11 === 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @param string $value
     * @return bool
     */
    public function btw(string $value = ""): bool {
        if (empty($value) === true) {
            return false;
        }

        $length = strlen($value);
        $result = (bool) preg_match('/^NL[0-9]{9}B[0-9]{2}$/', strtoupper($value));

        if ($length > 14 || $result === false) {
            return false;
        }

        $bsn = substr($value, 2, -3);
        return $this->validateBsn($bsn);
    }

    /**
     * 
     * @param string $value
     * @return bool
     */
    public function iban(string $value = ""): bool {
        if (empty($value) === true) {
            return false;
        }

        $testiban = strtoupper($value);
        $testiban = str_replace(' ', '', $testiban);
        if (strlen($testiban) !== 18) {
            return false;
        }

        $iban_replace_chars = range('A', 'Z');
        $iban_replace_values = [];
        foreach (range(10, 35) as $intvalue) {
            $iban_replace_values[] = (string) $intvalue;
        }

        $testiban = substr($testiban, 4) . substr($testiban, 0, 4);
        $testiban = str_replace(
                $iban_replace_chars, $iban_replace_values, $testiban
        );
        $head = (int) substr($testiban, 0, 9);
        $tail = substr($testiban, 9);
        $mod = $head % 97;
        foreach (str_split($tail, 7) as $chunk) {
            $digit = (int) ((string) $mod . $chunk);
            $mod = $digit % 97;
        }
        return $mod === 1;
    }

}
