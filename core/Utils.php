<?php

class Utils
{
    public static function getDaysSince(DateTime $date): string
    {
        // voir https://www.php.net/manual/fr/class.dateinterval.php
        $units = [
            'y' => ['an', 'ans'],
            'm' => ['mois'],
            'd' => ['jour', 'jours'],
            'h' => ['heure', 'heures'],
            'i' => ['minute', 'minutes'],
            's' => ['seconde', 'secondes'],
        ];
        $diff = $date->diff(new DateTime('now'));

        $index2 = 0;
        foreach (array_keys($units) as $index) {
            if ($diff->{$index} > 0) {
                $value = $diff->{$index};
                $index2 = ($value === 1 ? 0 : 1);
                break;
            }
        }

        // valeurs par défaut quand la durée est inférieure à une seconde
        if (!isset($value)) {
            $index = 's';
        }
        return sprintf('%d %s', $diff->{$index}, $units[$index][$index2]);
    }

    public static function getHashedValue(string $value): string
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }
}