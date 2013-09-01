<?php


class SuperFPDF extends PDF_EPS {
  
  /***********************************
   *     user space functions
   ***********************************/
  function __construct() {
  }
  
  
  /***********************************
   *     data aggregation functions
   ***********************************/  

  /*
  * general setter function
  *
  * proper usage:
  * $field may be either a string or an array of strings
  * if field is an array, $rdata must be an array(A) of associative arrays(B) with each of B representing a field
  * if field is a string, $rdata must be an associative array 
  *
  */
  public function setDocumentDetails($field, $rdata){
    if(is_array($field)) {
      for($i=0;$i<count($field);$i++) {
        $this->$field[$i] = $rdata[$i];
      }
    } else $this->$field=$rdata;
  }

  
  /*
  Informations
  Author: The-eh
  License: Freeware
  Description
  This script implements Code 39 barcodes. A Code 39 barcode can encode a string with the following characters: digits (0 to 9), uppercase letters (A to Z) and 8 additional characters (- . space $ / + % *).

  Code39(float xpos, float ypos, string code [, float baseline [, float height]])
  xpos: abscissa of barcode
  ypos: ordinate of barcode
  code: value of barcode
  baseline: corresponds to the width of a wide bar (defaults to 0.5)
  height: bar height (defaults to 5) 
  */
  public function Code39($xpos, $ypos, $code, $baseline=0.5, $height=5, $printText=false){

    $wide = $baseline;
    $narrow = $baseline / 3 ;
    $gap = $narrow;

    $barChar['0'] = 'nnnwwnwnn';
    $barChar['1'] = 'wnnwnnnnw';
    $barChar['2'] = 'nnwwnnnnw';
    $barChar['3'] = 'wnwwnnnnn';
    $barChar['4'] = 'nnnwwnnnw';
    $barChar['5'] = 'wnnwwnnnn';
    $barChar['6'] = 'nnwwwnnnn';
    $barChar['7'] = 'nnnwnnwnw';
    $barChar['8'] = 'wnnwnnwnn';
    $barChar['9'] = 'nnwwnnwnn';
    $barChar['A'] = 'wnnnnwnnw';
    $barChar['B'] = 'nnwnnwnnw';
    $barChar['C'] = 'wnwnnwnnn';
    $barChar['D'] = 'nnnnwwnnw';
    $barChar['E'] = 'wnnnwwnnn';
    $barChar['F'] = 'nnwnwwnnn';
    $barChar['G'] = 'nnnnnwwnw';
    $barChar['H'] = 'wnnnnwwnn';
    $barChar['I'] = 'nnwnnwwnn';
    $barChar['J'] = 'nnnnwwwnn';
    $barChar['K'] = 'wnnnnnnww';
    $barChar['L'] = 'nnwnnnnww';
    $barChar['M'] = 'wnwnnnnwn';
    $barChar['N'] = 'nnnnwnnww';
    $barChar['O'] = 'wnnnwnnwn';
    $barChar['P'] = 'nnwnwnnwn';
    $barChar['Q'] = 'nnnnnnwww';
    $barChar['R'] = 'wnnnnnwwn';
    $barChar['S'] = 'nnwnnnwwn';
    $barChar['T'] = 'nnnnwnwwn';
    $barChar['U'] = 'wwnnnnnnw';
    $barChar['V'] = 'nwwnnnnnw';
    $barChar['W'] = 'wwwnnnnnn';
    $barChar['X'] = 'nwnnwnnnw';
    $barChar['Y'] = 'wwnnwnnnn';
    $barChar['Z'] = 'nwwnwnnnn';
    $barChar['-'] = 'nwnnnnwnw';
    $barChar['.'] = 'wwnnnnwnn';
    $barChar[' '] = 'nwwnnnwnn';
    $barChar['*'] = 'nwnnwnwnn';
    $barChar['$'] = 'nwnwnwnnn';
    $barChar['/'] = 'nwnwnnnwn';
    $barChar['+'] = 'nwnnnwnwn';
    $barChar['%'] = 'nnnwnwnwn';

    $this->SetFont('Arial', '', 10);
    if($printText) $this->Text($xpos, $ypos + $height + 4, $code);
    $this->SetFillColor(0);

    $code = '*'.strtoupper($code).'*';
    for($i=0; $i<strlen($code); $i++){
        $char = $code{$i};
        if(!isset($barChar[$char])){
            $this->Error('Invalid character in barcode: '.$char);
        }
        $seq = $barChar[$char];
        for($bar=0; $bar<9; $bar++){
            if($seq{$bar} == 'n'){
                $lineWidth = $narrow;
            }else{
                $lineWidth = $wide;
            }
            if($bar % 2 == 0){
                $this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
            }
            $xpos += $lineWidth;
        }
        $xpos += $gap;
    }
  }
  
}

