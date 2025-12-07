<?php

namespace App\Services;

class PasswordStrengthService
{
    public function calculateScore(string $password): array
    {
        $score = 0;

        // Longueur
        $length = strlen($password);
        $score += min($length * 4, 40); // max 40 pts

        // Majuscules
        if (preg_match('/[A-Z]/', $password)) {
            $score += 15;
        }

        // Minuscules
        if (preg_match('/[a-z]/', $password)) {
            $score += 15;
        }

        // Chiffres
        if (preg_match('/[0-9]/', $password)) {
            $score += 15;
        }

        // Caractères spéciaux
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            $score += 15;
        }

        // Déterminer niveau
        if ($score < 40) $level = "faible";
        elseif ($score < 70) $level = "moyen";
        else $level = "fort";

        return [
            'score' => $score,
            'level' => $level,
        ];
    }
}
