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

    public function getSpin() {
        $this->setBank(-1);
        $arrSpin = array();

        for($i = 0; $i < $this->intReels; $i++) {
            $arrSpin[] = rand(0, $this->intReelSymbols-1);
        }

        $intWon = 0;
        if($arrSpin[0] == $arrSpin[1] && $arrSpin[1] == $arrSpin[2]) {
            // Same symbol on all three reels
            $intWon = $this->getWin(3, $arrSpin[0]);
        }
        else if($arrSpin[0] == $arrSpin[1]) {
            // Same symbol on reel 1 and 2
            $intWon = $this->getWin(2, $arrSpin[0]);
        }
        $this->setBank($intWon);

        $arrReturn = array(
            'reels' => $arrSpin,
            'won'   => $intWon
        );

        return($arrReturn);
    }

    private function getWin($intReelsAlike, $intSymbol) {
        $arrPayouts = array(
            2 => array(
                1, 1, 2, 2, 4
            ),
            3 => array(
                5, 5, 10, 15, 50
            )
        );
        return $arrPayouts[$intReelsAlike][$intSymbol];
    }

    private function setBank($intAmount) {
        $_SESSION['bank'] = $_SESSION['bank'] + $intAmount;
    }

    public function getBank() {
        return array('bank' => $_SESSION['bank']);
    }
}
