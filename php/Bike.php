<?php

class Bike {
    public string $typ;
    public string $bezeichnung;
    public string $preis;
    public string $gewicht;
    public string $groesse;
    public string $gaenge;
    public string $elektro;
    public string $bremse;
    public string $beleuchtung;
    public string $bild;
    public string $rahmenhoehe;
    public string $farbe;

    public function __construct($typ, $bezeichnung, $preis, $gewicht,
                                $groesse, $gaenge, $elektro, $bremse,
                                $beleuchtung, $bild, $rahmenhoehe, $farbe) {

        $this->typ = $typ;
        $this->bezeichnung = $bezeichnung;
        $this->preis = $preis;
        $this->gewicht = $gewicht;
        $this->groesse = $groesse;
        $this->gaenge = $gaenge;
        $this->elektro = $elektro;
        $this->bremse = $bremse;
        $this->beleuchtung = $beleuchtung;
        $this->bild = $bild;
        $this->rahmenhoehe = $rahmenhoehe;
        $this->farbe = $farbe;
    }
}
