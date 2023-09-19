<?php

namespace App\Classes\Api\Inc;

class witchStrposClass
{

    public $howMany = 0;
    public $actPos = 0;
    public $returnPos = 0;

    public function withcPos($inWhat, $what, $witch): void
    {
        $pos = strpos($inWhat, $what);
        $this->actPos = $this->actPos + $pos;
        $string = substr($inWhat, $pos + 1);
        $this->howMany++;
        if ($this->howMany == $witch) {
            $this->returnPos = $this->actPos;
            $this->init();
        } else {
            $this->withcPos($string, $what, $witch);
        }
    }

    public function getReturnPos(): int
    {
        return $this->returnPos;
    }

    public function init(): void
    {
        $this->actPos = 0;
        $this->howMany = 0;
    }

    public function getPos($string, $witch): int
    {
        $this->withcPos($string, "'", $witch);
        return $this->returnPos;
    }

    public function getSubstrMark($string, $witch): string
    {
        $beginPos = $this->getPos($string, $witch);
        $endPos = $this->getPos($string, $witch + 1);

        return substr($string, $beginPos + ($witch - 1), ($endPos + 2) - $beginPos);
    }

    public function getSubstr($string, $witch): string
    {
        $beginPos = $this->getPos($string, $witch);
        $endPos = $this->getPos($string, $witch + 1);

        $vmi = substr($string, $beginPos + $witch, $endPos - $beginPos);
        return substr($string, $beginPos + $witch, $endPos - $beginPos);
    }

}


