<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 03-07-2015
 * Time: 10:01
 */

class Slot {

    // Global varialbes
    private $intReels = 3;
    private $intReelSymbols = 5;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['bank'])) {
            $_SESSION['bank'] = 100;
        }
    }

    private function getWin($intWin) {
        $intReturn = 0;
        switch($intWin) {
            case 0:
                $intReturn = 100;
                break;
            case 1:
                $intReturn = 50;
                break;
        }
        return $intReturn;
    }

    public function getSpin() {
        $this->setBank(-1);
        $arrSpin = array();

        for($i = 0; $i < $this->intReels; $i++) {
            $arrSpin[] = rand(0, $this->intReelSymbols-1);
        }

        $intWon = 0;
        if($arrSpin[0] == $arrSpin[1] && $arrSpin[1] == $arrSpin[2]) {
            $intWon = $this->getWin($arrSpin[0]);
            $this->setBank($intWon);
        }

        $arrReturn = array(
            'reels' => $arrSpin,
            'won'   => $intWon
        );

        return($arrReturn);

    }

    private function setBank($intAmount) {
        $_SESSION['bank'] = $_SESSION['bank'] + $intAmount;
    }

    public function getBank() {
        return $_SESSION['bank'];
    }
}