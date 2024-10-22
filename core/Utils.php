<?php

class Utils
{
    /**
     * Renvoie l'intervalle entre $date et la date actuelle, arrondi par défaut à la plus grande unité non nulle
     *
     * @param DateTime $date
     * @param bool $roundToFirstUnit
     * @return string
     */
    public static function getDaysSince(DateTime $date, bool $roundToFirstUnit = false): string
    {
        // voir https://www.php.net/manual/fr/class.dateinterval.php
        $units = [
            'y' => ['an', 'ans'],
            'm' => ['mois', 'mois'],
            'd' => ['jour', 'jours'],
            'h' => ['heure', 'heures'],
            'i' => ['minute', 'minutes'],
            's' => ['seconde', 'secondes'],
        ];
        $diff = $date->diff(new DateTime('now'));

        $format = [];
        foreach (array_keys($units) as $index) {
            if ($diff->{$index} > 0) {
                $value = $diff->{$index};
                $index2 = ($value === 1 ? 0 : 1);
                $format[] = sprintf('%d %s', $diff->{$index}, $units[$index][$index2]);
                if ($roundToFirstUnit) {
                    break;
                }
            }
        }

        // valeurs par défaut pour les très rares cas où l'intervalle de temps est strictement inférieur à une seconde
        if (empty($format)) {
            return '0 seconde';
        }
        return implode(', ', $format);
    }

    /**
     * Renvoie l'intervalle entre $date et la date actuelle, formaté selon ISO 8601, pour utilisation avec la balise <time>
     *
     * @param DateTime $date
     * @return string
     */
    public static function getISO8601Format(DateTime $date): string
    {
        $diff = $date->diff(new DateTime('now'));
        $duration = 'P';
        if (!empty($diff->y)) {
            $duration .= "{$diff->y}Y";
        }
        if (!empty($diff->m)) {
            $duration .= "{$diff->m}M";
        }
        if (!empty($diff->d)) {
            $duration .= "{$diff->d}D";
        }
        if (!empty($diff->h) || !empty($diff->i) || !empty($diff->s)) {
            $duration .= 'T';
            if (!empty($diff->h)) {
                $duration .= "{$diff->h}H";
            }
            if (!empty($diff->i)) {
                $duration .= "{$diff->i}M";
            }
            if (!empty($diff->s)) {
                $duration .= "{$diff->s}S";
            }
        }
        if ($duration === 'P') {
            $duration = 'PT0S'; // intervalle de zéro seconde
        }
        return $duration;
    }

    public static function getHashedValue(string $value): string
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    public static function setSession(int $userId): void
    {
        $_SESSION['userId'] = $userId;
    }

    public static function isAuthenticated(): bool
    {
        return isset($_SESSION['userId']);
    }

    public static function redirectIfNotAuthenticated(): void
    {
        if (!self::isAuthenticated()) {
            header('Location: ./identification');
            exit;
        }
    }

    public static function getUserFromSession(): User
    {
        try {
            return (new UserManager())->getById($_SESSION['userId']);
        } catch (Exception $e) {
            $homeController = new HomeController();
            $homeController->showError(
                User::ERR_NOT_FOUND,
                $e->getMessage(),
            );
            exit;
        }
    }
}