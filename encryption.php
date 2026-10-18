<?php
#En funktion förskjuter texten med vald ASCII mängd
function krypteraText(string $text, int $key): string
{
    $resultat = '';
    $unicodeMax = 0x10FFFF;


    for ($index = 0; $index < mb_strlen($text, 'UTF-8'); $index++) {
        $tecken = mb_substr($text, $index, 1, 'UTF-8');
        $ordVarde = mb_ord($tecken, 'UTF-8');
        $nyOrdVarde = ($ordVarde + $key + $unicodeMax + 1) % ($unicodeMax + 1);
        $resultat .= mb_chr($nyOrdVarde, 'UTF-8');
    }
    return $resultat;
}
#Spegelvänder texten
function vandText(string $text): string
{
    return implode('', array_reverse(mb_str_split($text, 1, 'UTF-8')));
}

$message = "Katt";

$encryptedMessage = krypteraText($message, 100);
$encryptedMessage = vandText($encryptedMessage);
echo $encryptedMessage;
