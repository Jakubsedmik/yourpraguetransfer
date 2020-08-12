<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaymentStatus
 *
 * @author Jackie
 */
class PaymentStatus {
    
    protected $prCode;
    protected $srCode;
    protected $digok;


    public function __construct($prcode,$srcode,$digok) {
        $this->prCode = $prcode;
        $this->srCode = $srcode;
        $this->digok = $digok;
    }
    
    public function canIProceed(){
        if($this->digok){
            if($this->prCode == 0 ){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }
    
    public function errorText(){
        
        $srErrorCodes = array(
            1 => "ORDERNUMBER",
            2 => "MERCHANTNUMBER",
            6 => "AMOUNT",
            7 => "CURRENCY",
            8 => "DEPOSITFLAG",
            10 => "MERORDERNUM",
            11 => "CREDITNUMBER",
            12 => "OPERATION",
            18 => "BATCH",
            22 => "ORDER",
            24 => "URL",
            25 => "MD",
            26 => "DESC",
            34 => "DIGEST",
            3000 => "Neověřeno v 3D. Vydavatel karty není zapojen do 3D nebo karta nebyla aktivována.",
            3001 => "Držitel karty ověřen.",
            3002 => "Neověřeno v 3D. Vydavatel karty nebo karta není zapojena do 3D."
        );
        
        $prErrorCodes = array(
            0 => "OK",
            1 => "Příliš dlouhé pole " . $srErrorCodes[$this->srCode],
            2 => "Příliš krátké pole " . $srErrorCodes[$this->srCode],
            3 => "Chybný obsah pole " . $srErrorCodes[$this->srCode],
            4 => "Pole je prázdné " . $srErrorCodes[$this->srCode],
            5 => "Chybí povinné pole " . $srErrorCodes[$this->srCode],
            11 => "Neznámý obchodník",
            14 => "Duplikátní číslo platby",
            15 => "Objekt nenalezen" . $srErrorCodes[$this->srCode],
            17 => "Částka k zaplacení překročila povolenou (autorizovanou) částku",
            18 => "Součet vracených částek překročil zaplacenou částku",
            20 => "Objekt není ve stavu odpovídajícím této operaci" . $srErrorCodes[$this->srCode],
            25 => "Uživatel není oprávněn k provedení operace",
            26 => "Technický problém při spojení s autorizačním centrem",
            27 => "Chybný typ platby",
            28 => "Zamítnuto v 3D" . $srErrorCodes[$this->srCode],
            30 => "Zamítnuto v autorizačním centru",
            31 => "Chybný podpis",
            35 => "Expirovaná session",
            50 => "Držitel karty zrušil platbu",
            200 => "Žádost o doplňující informace",
            1000 => "Technický problém"
        );
        
        if($this->digok){
            if($this->prCode!=0){
                return $prErrorCodes[$this->prCode];
            }else {
                return $prErrorCodes[$this->prCode];
            }
        }else{
            return "Autorizace platební brány selhala.";
        }
    }
    
    public function __toString() {
        return $this->digok . "|" . $this->prCode . "|" . $this->srCode;
    }
}
